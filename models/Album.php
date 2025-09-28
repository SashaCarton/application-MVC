<?php

require_once __DIR__ . '/Media.php';

/**
 * Classe Album représentant un album musical dans la médiathèque
 * 
 * Hérite de la classe Media et ajoute les propriétés spécifiques trackNumber et recordLabel
 */
class Album extends Media
{
    /**
     * @var int Le nombre de pistes de l'album
     */
    private int $trackNumber;

    /**
     * @var string Le label/maison de disque
     */
    private string $recordLabel;

    /**
     * Constructeur de la classe Album
     *
     * @param string $titre Le titre de l'album
     * @param string $auteur L'artiste de l'album
     * @param DateTime $datePublication La date de sortie
     * @param int $trackNumber Le nombre de pistes
     * @param string $recordLabel Le label/maison de disque
     * @param bool $disponible État de disponibilité (true par défaut)
     * @param string|null $image Image en base64 (optionnel)
     * @param int|null $id Identifiant (null pour un nouvel album)
     */
    public function __construct(
        string $titre,
        string $auteur,
        DateTime $datePublication,
        int $trackNumber,
        string $recordLabel,
        bool $disponible = true,
        ?string $image = null,
        ?int $id = null
    ) {
        parent::__construct($titre, $auteur, $datePublication, $disponible, $image, $id);
        $this->trackNumber = $trackNumber;
        $this->recordLabel = $recordLabel;
    }

    /**
     * Obtenir le type de média
     * 
     * @return string Le type "Album"
     */
    public function getType(): string
    {
        return 'Album';
    }

    /**
     * Obtenir les propriétés spécifiques à l'album
     * 
     * @return array Les propriétés spécifiques
     */
    public function getSpecificProperties(): array
    {
        return [
            'trackNumber' => $this->trackNumber,
            'recordLabel' => $this->recordLabel
        ];
    }

    /**
     * Obtenir une description détaillée de l'album
     * 
     * @return string Description de l'album
     */
    public function getDescription(): string
    {
        $status = $this->disponible ? 'Disponible' : 'Emprunté';
        $tracks = $this->trackNumber === 1 ? 'piste' : 'pistes';

        return "Album: {$this->titre} par {$this->auteur} ({$this->trackNumber} {$tracks}, {$this->recordLabel}) - {$status}";
    }

    /**
     * Vérifier si c'est un album long (plus de 15 pistes)
     * 
     * @return bool True si l'album fait plus de 15 pistes
     */
    public function isLongAlbum(): bool
    {
        return $this->trackNumber > 15;
    }

    /**
     * Obtenir la catégorie de taille de l'album
     * 
     * @return string La catégorie de taille
     */
    public function getSizeCategory(): string
    {
        if ($this->trackNumber <= 5) {
            return 'EP';
        } elseif ($this->trackNumber <= 12) {
            return 'Album standard';
        } elseif ($this->trackNumber <= 20) {
            return 'Album long';
        } else {
            return 'Double album';
        }
    }

    /**
     * Vérifier si c'est un EP (Extended Play)
     * 
     * @return bool True si l'album a 5 pistes ou moins
     */
    public function isEP(): bool
    {
        return $this->trackNumber <= 5;
    }

    /**
     * Vérifier si l'album provient d'un label spécifique
     * 
     * @param string $label Le label à vérifier
     * @return bool True si l'album provient de ce label
     */
    public function isFromLabel(string $label): bool
    {
        return strcasecmp($this->recordLabel, $label) === 0;
    }

    /**
     * Obtenir les informations de format de l'album
     * 
     * @return string Les informations de format
     */
    public function getFormatInfo(): string
    {
        $tracks = $this->trackNumber === 1 ? 'piste' : 'pistes';
        return "{$this->trackNumber} {$tracks} - {$this->getSizeCategory()}";
    }

    // Getters et Setters
    public function getTrackNumber(): int
    {
        return $this->trackNumber;
    }

    public function setTrackNumber(int $trackNumber): void
    {
        if ($trackNumber <= 0) {
            throw new InvalidArgumentException("Le nombre de pistes doit être positif.");
        }
        $this->trackNumber = $trackNumber;
    }

    public function getRecordLabel(): string
    {
        return $this->recordLabel;
    }

    public function setRecordLabel(string $recordLabel): void
    {
        if (empty(trim($recordLabel))) {
            throw new InvalidArgumentException("Le label ne peut pas être vide.");
        }
        $this->recordLabel = trim($recordLabel);
    }
}
