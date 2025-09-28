<?php

/**
 * Classe abstraite Media représentant un média générique dans la médiathèque
 * 
 * Cette classe sert de base pour tous les types de médias (Book, Movie, Album)
 * et définit les propriétés et méthodes communes à tous les médias.
 */
abstract class Media
{
    /**
     * @var int|null L'identifiant unique du média
     */
    protected ?int $id;

    /**
     * @var string Le titre du média
     */
    protected string $titre;

    /**
     * @var string L'auteur/réalisateur/artiste du média
     */
    protected string $auteur;

    /**
     * @var bool Indique si le média est disponible pour l'emprunt
     */
    protected bool $disponible;

    /**
     * @var string|null L'image du média en base64 (optionnel)
     */
    protected ?string $image;

    /**
     * @var DateTime La date de publication du média
     */
    protected DateTime $datePublication;

    /**
     * Constructeur de la classe Media
     *
     * @param string $titre Le titre du média
     * @param string $auteur L'auteur du média
     * @param DateTime $datePublication La date de publication
     * @param bool $disponible État de disponibilité (true par défaut)
     * @param string|null $image Image en base64 (optionnel)
     * @param int|null $id Identifiant (null pour un nouveau média)
     */
    public function __construct(
        string $titre,
        string $auteur,
        DateTime $datePublication,
        bool $disponible = true,
        ?string $image = null,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->disponible = $disponible;
        $this->image = $image;
        $this->datePublication = $datePublication;
    }

    /**
     * Emprunter le média
     * 
     * @return bool True si l'emprunt a réussi, false sinon
     * @throws Exception Si le média n'est pas disponible
     */
    public function emprunter(): bool
    {
        if (!$this->disponible) {
            throw new Exception("Le média '{$this->titre}' n'est pas disponible pour l'emprunt.");
        }

        $this->disponible = false;
        return true;
    }

    /**
     * Rendre le média
     * 
     * @return bool True si le retour a réussi
     */
    public function rendre(): bool
    {
        $this->disponible = true;
        return true;
    }

    /**
     * Obtenir le type de média (implémenté par les classes enfants)
     * 
     * @return string Le type de média
     */
    abstract public function getType(): string;

    /**
     * Obtenir les propriétés spécifiques du média (implémenté par les classes enfants)
     * 
     * @return array Les propriétés spécifiques sous forme de tableau
     */
    abstract public function getSpecificProperties(): array;

    /**
     * Convertir l'objet en tableau pour la base de données
     * 
     * @return array Les données du média pour la base de données
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'auteur' => $this->auteur,
            'disponible' => $this->disponible,
            'image' => $this->image,
            'date_publication' => $this->datePublication->format('Y-m-d'),
            'type' => $this->getType(),
            'specific_properties' => json_encode($this->getSpecificProperties())
        ];
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitre(): string
    {
        return $this->titre;
    }
    public function getAuteur(): string
    {
        return $this->auteur;
    }
    public function isDisponible(): bool
    {
        return $this->disponible;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function getDatePublication(): DateTime
    {
        return $this->datePublication;
    }

    // Setters
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }
    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }
    public function setDisponible(bool $disponible): void
    {
        $this->disponible = $disponible;
    }
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
    public function setDatePublication(DateTime $datePublication): void
    {
        $this->datePublication = $datePublication;
    }
}