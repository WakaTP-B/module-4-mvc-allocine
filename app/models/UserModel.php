<?php

class UserModel
{
    private PDO $bdd;
    private PDOStatement $addUser;
    private PDOStatement $delUser;
    private PDOStatement $getUser;
    private PDOStatement $getUsers;
    private PDOStatement $editUser;
    private PDOStatement $loginUser;

    function __construct()
    {
        $this->bdd = new PDO("mysql:host=bdd;dbname=allocine", "root", "root");

        $this->addUser = $this->bdd->prepare("INSERT INTO User (username, password) VALUES (:username, :password) ");

        $this->getUser = $this->bdd->prepare("SELECT * FROM `User` WHERE `id` = :user_id");

        $this->loginUser = $this->bdd->prepare("SELECT * FROM `User` WHERE `username` = :username");





        $this->delUser = $this->bdd->prepare("DELETE FROM `User` WHERE `id` = :id;");

        // Adaptez cette requête à votre table User
        $this->editUser = $this->bdd->prepare("UPDATE `User` SET ...TODO... WHERE `id` = :id");

        $this->getUsers = $this->bdd->prepare("SELECT * FROM `User` LIMIT :limit");
    }

    public function add(string $username, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->addUser->bindValue(":username", $username);
        $this->addUser->bindValue(":password", $hashedPassword);

        $this->addUser->execute();
    }

    public function getByUsername(string $username): ?UserEntity
    {
        $this->loginUser->bindValue(':username', $username);
        $this->loginUser->execute();
        $rawUser = $this->loginUser->fetch();

        if (!$rawUser) {
            return null;
        }

        return new UserEntity(
            $rawUser["id"],
            $rawUser["username"],
            $rawUser["password"],
            $rawUser["role"]
        );
    }






    public function del(int $id): void
    {
        $this->delUser->bindValue("id", $id);
        $this->delUser->execute();
    }
    public function get($id): UserEntity | NULL
    {
        $this->getUser->bindValue("id", $id, PDO::PARAM_INT);
        $this->getUser->execute();
        $rawUser = $this->getUser->fetch();

        // Si le produit n'existe pas, je renvoie NULL
        if (!$rawUser) {
            return NULL;
        }
        return new UserEntity(
            $rawUser["id"],
            $rawUser["username"],
            $rawUser["password"],
            $rawUser["role"]
        );
    }

    public function getAll(int $limit = 50): array
    {
        $this->getUsers->bindValue("limit", $limit, PDO::PARAM_INT);
        $this->getUsers->execute();
        $rawUsers = $this->getUsers->fetchAll();

        $UsersEntity = [];
        foreach ($rawUsers as $rawUser) {
            $UsersEntity[] = new UserEntity(
                $rawUser["id"],
                $rawUser["username"],
                $rawUser["password"],
                $rawUser["role"]
            );
        }

        return $UsersEntity;
    }

    // À part l'id, les paramètres de la méthode edit sont optionnels.
    // Nous ne voulons pas forcer le développeur à modifier tous les champs
    public function edit(int $id,): UserEntity | NULL
    {
        $originalUserEntity = $this->get($id);

        // Si le produit n'existe pas, je renvoie NULL
        if (!$originalUserEntity) {
            return NULL;
        }

        // On utilise un opérateur ternaire ? : ;
        // Il permet en une ligne de renvoyer le titre original du 
        // produit si le paramètre est NULL.
        // En effet, si le paramètre est NULL, cela veut dire que 
        // l'utilisateur ne souhaite pas le modifier.
        // Le même résultat est possible avec des if else
        // Je précise PDO::PARAM_INT car id est un INT
        $this->editUser->bindValue("id", $id, PDO::PARAM_INT);

        // $this->editUser->bindValue($columnName,
        //  $columnName ? $columnName : $originalUserEntity->getColumnName() );

        $this->editUser->execute();

        // Une fois modifié, je renvoie le User en utilisant ma
        // propre méthode public UserModel::get().
        return $this->get($id);
    }
}

class UserEntity
{
    private int $id;
    private string $username;
    private string $password;
    private string $role;

    function __construct(int $id, string $username, string $password, string $role)
    {

        $this->id = $id;
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setRole($role);
    }
    // Setters
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRole(): string
    {
        return $this->role;
    }
}
