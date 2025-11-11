<?php
require_once __DIR__ . '/../entities/FilmEntity.php';

class FilmRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter un film
    public function add(FilmEntity $film)
    {
        $stmt = $this->pdo->prepare("INSERT INTO film (nom, date_sortie, genre, auteur) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $film->getNom(),
            $film->getDateSortie(),
            $film->getGenre(),
            $film->getAuteur()
        ]);
        return $this->pdo->lastInsertId();
    }

    // Lister tous les films
    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM film");
        return $stmt->fetchAll();
    }

    // Récupérer un film par id
    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM film WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Supprimer un film
    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM film WHERE id = ?");
        $stmt->execute([$id]);
    }
}
