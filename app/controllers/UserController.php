<?php

require_once(__DIR__ . "/../models/UserModel.php");

class UserController
{
    public function view(string $method, array $params = [])
    {
        try {
            call_user_func([$this, $method], $params);
        } catch (Error $e) {
            require_once(__DIR__ . '/../views/404.php');
            // ou bien la méthode par défaut...
        }
    }

    public function login($params = [])
    {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user->getPassword())) {
                // mot de passe correct
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['role'] = $user->getRole();

                echo "Connexion réussie !";
                // ou redirectione
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }

        require_once(__DIR__ . "/../views/login.php");
    }

    public function register($params = [])
    {
        $userModel = new UserModel();

        // formulaire soumis
        if (!empty($_POST)) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                try {
                    $userModel->add($username, $password);
                    $success = "Utilisateur ajouté avec succès !";
                    console($success);
                } catch (PDOException $e) {
                    $error = "Impossible de créer l'utilisateur.";
                    console("Erreur PDO : " . $e->getMessage());
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
                console($error);
            }
        }

        require_once(__DIR__ . "/../views/register.php");
    }
}
