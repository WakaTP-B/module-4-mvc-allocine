<?php
class FilmEntity
{
    private int $id;
    private string $nom;
    private string $date_sortie;
    private string $genre;
    private string $auteur;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function getDateSortie(): string
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

    // Setters
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
    public function setDateSortie(string $date_sortie)
    {
        $this->date_sortie = $date_sortie;
    }
    public function setGenre(string $genre)
    {
        $this->genre = $genre;
    }
    public function setAuteur(string $auteur)
    {
        $this->auteur = $auteur;
    }
}
