<?php
class DiffusionEntity
{
    private int $id;
    private int $film_id;
    private string $date_diffusion;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getFilmId(): int
    {
        return $this->film_id;
    }
    public function getDateDiffusion(): string
    {
        return $this->date_diffusion;
    }

    // Setters
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setFilmId(int $film_id)
    {
        $this->film_id = $film_id;
    }
    public function setDateDiffusion(string $date_diffusion)
    {
        $this->date_diffusion = $date_diffusion;
    }
}
