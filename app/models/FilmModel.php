<?php

class FilmModel
{
    private PDO $bdd;

    private PDOStatement $addFilm;
    private PDOStatement $delFilm;
    private PDOStatement $getFilm;
    private PDOStatement $getFilms;
    private PDOStatement $editFilm;



    function __construct()
    {
        // Connexion à la base de donnée
        $this->bdd = new PDO("mysql:host=bdd;dbname=app-database", "root", "root");

        // Création d'une requête préparée qui récupère tout les films
        $this->getFilms = $this->bdd->prepare("SELECT * FROM `Film` LIMIT :limit");
        // Requete Get by ID
        $this->getFilm = $this->bdd->prepare("SELECT * FROM `film` WHERE id = :id");

        $this->addFilm = $this->bdd->prepare("INSERT INTO `film`(name, price, image)VALUES(:name, :price, :image)");

        $this->delFilm = $this->bdd->prepare(" DELETE FROM `film` WHERE id = :id ");

        $this->editFilm = $this->bdd->prepare("UPDATE film SET name= :name, price = :price, image = :image WHERE id = :id");
    }
    public function getAll(int $limit = 50): array
    {
        // Définir la valeur de LIMIT, par défault 50
        // LIMIT étant un INT ont n'oublie pas de préciser le type PDO::PARAM_INT.
        $this->getFilms->bindValue("limit", $limit, PDO::PARAM_INT);
        // Executer la requête
        $this->getFilms->execute();
        // Récupérer la réponse 
        $rawFilms = $this->getFilms->fetchAll();

        // Formater la réponse dans un tableau de FilmEntity
        $FilmsEntity = [];
        foreach ($rawFilms as $rawFilm) {
            $FilmsEntity[] = new FilmEntity(
                $rawFilm["id"],
                $rawFilm["nom"],
                $rawFilm["date_sortie"],
                $rawFilm["genre"],
                $rawFilm["auteur"],
                $rawFilm["cover"]
            );
        }


        // Renvoyer le tableau de FilmEntity
        return $FilmsEntity;
    }
    /**
     * Recupérer un film via son id.
     * @return Une FilmEntity ou NULL si aucune ne correspond à l'$id
     * @param int id : la clé primaire de l'entity demandée.
     * */
    public function get(int $id): FilmEntity | NULL
    {
        // Lier l'id avec le bon type
        $this->getFilm->bindValue("id", $id, PDO::PARAM_INT);
        $this->getFilm->execute();

        // Récupérer une seule ligne
        $rawFilm = $this->getFilm->fetch(PDO::FETCH_ASSOC);

        // Si aucun film trouvé
        if (!$rawFilm) {
            return null;
        }

        // Retourner un objet FilmEntity
        return new FilmEntity(
                $rawFilm["id"],
                $rawFilm["nom"],
                $rawFilm["date_sortie"],
                $rawFilm["genre"],
                $rawFilm["auteur"],
                $rawFilm["cover"]
        );
    }

    /**
     * Ajouter un film
     * @return void : ne renvoi rien
     * @param les informations de l'entity
     * */
    public function add(string $name, float $price, string $image)
    {
        $this->addFilm->bindValue(":name", $name, PDO::PARAM_STR);
        $this->addFilm->bindValue(":price", $price, PDO::PARAM_STR);
        $this->addFilm->bindValue(":image", $image, PDO::PARAM_STR);

        $this->addFilm->execute();
    }


    /**
     * Supprime un film via son id
     * @return void : ne renvoi rien
     * @param int $id : la clé primaire de l'entité à supprimer
     * */
    public function del(int $id): void
    {
        $this->delFilm->bindValue(":id", $id, PDO::PARAM_INT);

        $this->delFilm->execute();
    }
    public function edit(
        int $id,
        string $name = NULL,
        float $price = NULL,
        string $image = NULL
    ): FilmEntity | NULL {

        $this->editFilm->bindValue("id", $id, PDO::PARAM_INT);
        $this->editFilm->bindValue(":name", $name, PDO::PARAM_STR);
        $this->editFilm->bindValue(":price", $price, PDO::PARAM_STR);
        $this->editFilm->bindValue(":image", $image, PDO::PARAM_STR);
        $this->editFilm->execute();
        return NULL;
    }
}


class FilmEntity
{
    private int $id;
    private string $nom;
    private string $date_sortie;
    private string $genre;
    private string $auteur;
    private string $cover;


    function __construct(int $id, string $nom, string $date_sortie, string $genre, string $auteur, string $cover)
    {
        // $this->setColumnName($columnName);
        $this->id = $id;
        $this->setNom($nom);
        $this->setDate_sortie($date_sortie);
        $this->setGenre($genre);
        $this->setAuteur($auteur);
        $this->setCover($cover);
    }

    public function setNom(string $nom)
    {
        return $this->nom = $nom;
    }

    public function setDate_sortie(string $date_sortie)
    {
        return $this->date_sortie = $date_sortie;
    }
    public function setGenre(string $genre)
    {
        return $this->genre = $genre;
    }
    public function setAuteur(string $auteur)
    {
        return $this->auteur = $auteur;
    }
        public function setCover(string $cover)
    {
        return $this->cover = $cover;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function getDate_sortie(): string
    {
        return $this->date_sortie;
    }
    public function getGenre(): string
    {
        return $this->genre;
    }
    public function getAuteur(): string
    {
        return $this->auteur;
    }
       public function getCover(): string
    {
        return $this->cover;
    }
}
