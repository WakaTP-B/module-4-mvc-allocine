<?php

class ProductModel
{
    private PDO $bdd;

    private PDOStatement $addProduct;
    private PDOStatement $delProduct;
    private PDOStatement $getProduct;
    private PDOStatement $getProducts;
    private PDOStatement $editProduct;



    function __construct()
    {
        // Connexion à la base de donnée
        $this->bdd = new PDO("mysql:host=bdd;dbname=app-database", "root", "root");

        // Création d'une requête préparée qui récupère tout les produits
        $this->getProducts = $this->bdd->prepare("SELECT * FROM `Produit` 
        LIMIT :limit");
        // Requete Get by ID
        $this->getProduct = $this->bdd->prepare("SELECT * FROM `Produit` WHERE id = :id");

        $this->addProduct = $this->bdd->prepare("INSERT INTO `Produit`(name, price, image)VALUES(:name, :price, :image)");

        $this->delProduct = $this->bdd->prepare(" DELETE FROM `Produit` WHERE id = :id ");

        $this->editProduct = $this->bdd->prepare("UPDATE Produit SET name= :name, price = :price, image = :image WHERE id = :id");
    }
    public function getAll(int $limit = 50): array
    {
        // Définir la valeur de LIMIT, par défault 50
        // LIMIT étant un INT ont n'oublie pas de préciser le type PDO::PARAM_INT.
        $this->getProducts->bindValue("limit", $limit, PDO::PARAM_INT);
        // Executer la requête
        $this->getProducts->execute();
        // Récupérer la réponse 
        $rawProducts = $this->getProducts->fetchAll();

        // Formater la réponse dans un tableau de ProductEntity
        $productsEntity = [];
        foreach ($rawProducts as $rawProduct) {
            $productsEntity[] = new ProductEntity(
                $rawProduct["name"],
                $rawProduct["price"],
                $rawProduct["image"],
                $rawProduct["id"]
            );
        }


        // Renvoyer le tableau de ProductEntity
        return $productsEntity;
    }
    /**
     * Recupérer un produit via son id.
     * @return Une ProductEntity ou NULL si aucune ne correspond à l'$id
     * @param int id : la clé primaire de l'entity demandée.
     * */
    public function get(int $id): ProductEntity | NULL
    {
        // Lier l'id avec le bon type
        $this->getProduct->bindValue("id", $id, PDO::PARAM_INT);
        $this->getProduct->execute();

        // Récupérer une seule ligne
        $rawProduct = $this->getProduct->fetch(PDO::FETCH_ASSOC);

        // Si aucun produit trouvé
        if (!$rawProduct) {
            return null;
        }

        // Retourner un objet ProductEntity
        return new ProductEntity(
            $rawProduct["name"],
            $rawProduct["price"],
            $rawProduct["image"],
            $rawProduct["id"]
        );
    }

    /**
     * Ajouter un produit
     * @return void : ne renvoi rien
     * @param les informations de l'entity
     * */
    public function add(string $name, float $price, string $image)
    {
        $this->addProduct->bindValue(":name", $name, PDO::PARAM_STR);
        $this->addProduct->bindValue(":price", $price, PDO::PARAM_STR);
        $this->addProduct->bindValue(":image", $image, PDO::PARAM_STR);

        $this->addProduct->execute();
    }


    /**
     * Supprime un produit via son id
     * @return void : ne renvoi rien
     * @param int $id : la clé primaire de l'entité à supprimer
     * */
    public function del(int $id): void
    {
        $this->delProduct->bindValue(":id", $id, PDO::PARAM_INT);

        $this->delProduct->execute();
    }
    public function edit(
        int $id,
        string $name = NULL,
        float $price = NULL,
        string $image = NULL
    ): ProductEntity | NULL {

        $this->editProduct->bindValue("id", $id, PDO::PARAM_INT);
        $this->editProduct->bindValue(":name", $name, PDO::PARAM_STR);
        $this->editProduct->bindValue(":price", $price, PDO::PARAM_STR);
        $this->editProduct->bindValue(":image", $image, PDO::PARAM_STR);
        $this->editProduct->execute();
        return NULL;
    }
}


class ProductEntity
{
    private $name;
    private $price;
    private $image;
    private $id;

    private const NAME_MIN_LENGTH = 3;
    private const PRICE_MIN = 0;
    private const DEFAULT_IMG_URL = "/public/images/default.png";

    function __construct(string $name, float $price, string $image, int $id = null)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setImage($image);
        $this->id = $id;
    }

    public function setName(string $name)
    {
        if (strlen($name) < $this::NAME_MIN_LENGTH) {
            throw new Error("Name is too short minimum 
            length is " . $this::NAME_MIN_LENGTH);
        }
        $this->name = $name;
    }
    public function setPrice(float $price)
    {
        if ($price < 0) {
            throw new Error("Price is too short minimum price is " . $this::PRICE_MIN);
        }
        $this->price = $price;
    }
    public function setImage(string $image)
    {
        if (strlen($image) <= 0) {
            $this->image = $this::DEFAULT_IMG_URL;
        }
        $this->image = $image;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getId(): int
    {
        return $this->id;
    }
}
