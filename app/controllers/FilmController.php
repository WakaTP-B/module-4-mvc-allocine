<?php
require_once(__DIR__ . "/../models/FilmModel.php");
require_once(__DIR__ . "/../models/DiffusionModel.php");

class FilmController
{
    public function view(string $method, array $params = [])
    {
        if (empty($method)) {
            $method = "detail";
        }
        try {
            call_user_func([$this, $method], $params);
        } catch (Error $e) {
            require_once(__DIR__ . '/../views/404.php');
        }
    }


    public function detail($params = [])
    {
        $filmModel = new FilmModel();

        $id = isset($params[0]) ? (int)$params[0] : null;

        if (!$id) {
            echo "Film introuvable";
            return;
        }

        $film = $filmModel->get($id);

        $diffusionModel = new DiffusionModel();
        $diffusion = $diffusionModel->get($film->getId());

        require_once(__DIR__ . "/../views/detail.php");
    }

    public function delete()
    {
        echo "Delete";
    }
}
