<?php

require_once __DIR__ . '/Media.php';
require_once __DIR__ . '/Genre.php';

/**
 * Classe Movie représentant un film dans la médiathèque
 * 
 * Hérite de la classe Media et ajoute les propriétés spécifiques duration et genre
 */
class Movie extends Media
{
    /**
     * @var int La durée du film en minutes
     */
    private int $duration;

    /**
     * @var Genre Le genre du film
     */
    private Genre $genre;

    /**
     * Constructeur de la classe Movie
     *
     * @param string $titre Le titre du film
     * @param string $auteur Le réalisateur du film
     * @param DateTime $datePublication La date de sortie
     * @param int $duration La durée en minutes
     * @param Genre $genre Le genre du film
     * @param bool $disponible État de disponibilité (true par défaut)
     * @param string|null $image Image en base64 (optionnel)
     * @param int|null $id Identifiant (null pour un nouveau film)
     */
    public function __construct(
        string $titre,
        string $auteur,
        DateTime $datePublication,
        int $duration,
        Genre $genre,
        bool $disponible = true,
        ?string $image = null,
        ?int $id = null
    ) {
        parent::__construct($titre, $auteur, $datePublication, $disponible, $image, $id);
        $this->duration = $duration;
        $this->genre = $genre;
    }

    /**
     * Obtenir le type de média
     * 
     * @return string Le type "Movie"
     */
    public function getType(): string
    {
        return 'Movie';
    }

    /**
     * Obtenir les propriétés spécifiques au film
     * 
     * @return array Les propriétés spécifiques
     */
    public function getSpecificProperties(): array
    {
        return [
            'duration' => $this->duration,
            'genre' => $this->genre->value
        ];
    }

    /**
     * Obtenir une description détaillée du film
     * 
     * @return string Description du film
     */
    public function getDescription(): string
    {
        $status = $this->disponible ? 'Disponible' : 'Emprunté';
        $hours = intval($this->duration / 60);
        $minutes = $this->duration % 60;
        $durationStr = $hours > 0 ? "{$hours}h{$minutes}min" : "{$minutes}min";

        return "Film: {$this->titre} par {$this->auteur} ({$durationStr}, {$this->genre->value}) - {$status}";
    }

    /**
     * Vérifier si c'est un film long (plus de 2h30)
     * 
     * @return bool True si le film fait plus de 150 minutes
     */
    public function isLongMovie(): bool
    {
        return $this->duration > 150;
    }

    /**
     * Obtenir la catégorie de durée du film
     * 
     * @return string La catégorie de durée
     */
    public function getDurationCategory(): string
    {
        if ($this->duration <= 90) {
            return 'Court';
        } elseif ($this->duration <= 120) {
            return 'Moyen';
        } elseif ($this->duration <= 150) {
            return 'Long';
        } else {
            return 'Très long';
        }
    }

    /**
     * Obtenir la durée formatée en heures et minutes
     * 
     * @return string Durée formatée (ex: "2h15min")
     */
    public function getFormattedDuration(): string
    {
        $hours = intval($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return $minutes > 0 ? "{$hours}h{$minutes}min" : "{$hours}h";
        } else {
            return "{$minutes}min";
        }
    }

    /**
     * Vérifier si le film correspond à un genre spécifique
     * 
     * @param Genre $genre Le genre à vérifier
     * @return bool True si le film correspond au genre
     */
    public function isOfGenre(Genre $genre): bool
    {
        return $this->genre === $genre;
    }

    // Getters et Setters
    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        if ($duration <= 0) {
            throw new InvalidArgumentException("La durée doit être positive.");
        }
        $this->duration = $duration;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): void
    {
        $this->genre = $genre;
    }
}