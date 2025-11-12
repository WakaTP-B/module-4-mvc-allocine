<?php

class DiffusionModel
{
    private PDO $bdd;
    private PDOStatement $addDiffusion;
    private PDOStatement $delDiffusion;
    private PDOStatement $getDiffusion;
    private PDOStatement $getDiffusions;
    private PDOStatement $editDiffusion;

    function __construct()
    {
        $this->bdd = new PDO("mysql:host=bdd;dbname=allocine", "root", "root");

        // Adaptez cette requête à votre table Diffusion
        $this->addDiffusion = $this->bdd->prepare("INSERT INTO `Diffusion` (`film_id`, `date_diffusion`) VALUES (:film_id, :date_diffusion)");



        $this->delDiffusion = $this->bdd->prepare("DELETE FROM `Diffusion` WHERE `id` = :id;");

        $this->getDiffusion = $this->bdd->prepare("SELECT * FROM `Diffusion` WHERE `id` = :id;");

        // Adaptez cette requête à votre table Diffusion
        $this->editDiffusion = $this->bdd->prepare("UPDATE `Diffusion` SET ...TODO... WHERE `id` = :id");

        $this->getDiffusions = $this->bdd->prepare("SELECT * FROM `Diffusion` LIMIT :limit");
    }
    // Éditez les paramètres de la méthode add en fonction de votre table Diffusion
    public function add(): void
    {
        // $this->addDiffusion->bindValue("...", $columnValue);
        $this->addDiffusion->execute();
    }

    public function del(int $id): void
    {
        $this->delDiffusion->bindValue("id", $id);
        $this->delDiffusion->execute();
    }
    public function get($id): DiffusionEntity | NULL
    {
        $this->getDiffusion->bindValue("id", $id, PDO::PARAM_INT);
        $this->getDiffusion->execute();
        $rawDiffusion = $this->getDiffusion->fetch();

        // Si le produit n'existe pas, je renvoie NULL
        if (!$rawDiffusion) {
            return NULL;
        }
        return new DiffusionEntity(

            $rawDiffusion["id"],
            $rawDiffusion["film_id"],
            $rawDiffusion["date_diffusion"]
        );
    }

    public function getAll(int $limit = 50): array
    {
        $this->getDiffusions->bindValue("limit", $limit, PDO::PARAM_INT);
        $this->getDiffusions->execute();
        $rawDiffusions = $this->getDiffusions->fetchAll();

        $DiffusionsEntity = [];
        foreach ($rawDiffusions as $rawDiffusion) {
            $DiffusionsEntity[] = new DiffusionEntity(
                $rawDiffusion["id"],
                $rawDiffusion["film_id"],
                $rawDiffusion["date_diffusion"]
            );
        }

        return $DiffusionsEntity;
    }

    public function edit(int $id, int $film_id, string $date_diffusion): DiffusionEntity | NULL
    {
        $original = $this->get($id);
        if (!$original) return NULL;

        $this->editDiffusion->bindValue("id", $id, PDO::PARAM_INT);
        $this->editDiffusion->bindValue("film_id", $film_id, PDO::PARAM_INT);
        $this->editDiffusion->bindValue("date_diffusion", $date_diffusion, PDO::PARAM_STR);
        $this->editDiffusion->execute();

        return $this->get($id);
    }
}
class DiffusionEntity
{

    private int $id;
    private int $film_id;
    private string $date_diffusion;


    function __construct(int $id, int $film_id, string $date_diffusion)
    {
        $this->id = $id;
        $this->setFilm_id($film_id);
        $this->setDate_diffusion($date_diffusion);
    }
    public function setFilm_id(int $film_id)
    {
        return $this->film_id = $film_id;
    }

    public function setDate_diffusion(string $date_diffusion)
    {
        return $this->date_diffusion = $date_diffusion;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getFilm_id(): int
    {
        return $this->film_id;
    }
    public function getDate_diffusion(): string
    {
        return $this->date_diffusion;
    }
}
