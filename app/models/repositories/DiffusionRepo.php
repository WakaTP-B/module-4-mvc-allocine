<?php
require_once __DIR__ . '/../entities/DiffusionEntity.php';

class DiffusionRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter une diffusion
    public function add(DiffusionEntity $diffusion)
    {
        $stmt = $this->pdo->prepare("INSERT INTO diffusion (film_id, date_diffusion) VALUES (?, ?)");
        $stmt->execute([
            $diffusion->getFilmId(),
            $diffusion->getDateDiffusion()
        ]);
        return $this->pdo->lastInsertId();
    }

    // Lister les diffusions d'un film
    public function getByFilmId(int $film_id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM diffusion WHERE film_id = ?");
        $stmt->execute([$film_id]);
        return $stmt->fetchAll();
    }

    // Supprimer une diffusion
    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM diffusion WHERE id = ?");
        $stmt->execute([$id]);
    }
}
