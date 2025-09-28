<?php

require_once __DIR__ . '/Media.php';

/**
 * Classe Book représentant un livre dans la médiathèque
 * 
 * Hérite de la classe Media et ajoute la propriété spécifique pageNumber
 */
class Book extends Media
{
    /**
     * @var int Le nombre de pages du livre
     */
    private int $pageNumber;

    /**
     * Constructeur de la classe Book
     *
     * @param string $titre Le titre du livre
     * @param string $auteur L'auteur du livre
     * @param DateTime $datePublication La date de publication
     * @param int $pageNumber Le nombre de pages
     * @param bool $disponible État de disponibilité (true par défaut)
     * @param string|null $image Image en base64 (optionnel)
     * @param int|null $id Identifiant (null pour un nouveau livre)
     */
    public function __construct(
        string $titre,
        string $auteur,
        DateTime $datePublication,
        int $pageNumber,
        bool $disponible = true,
        ?string $image = null,
        ?int $id = null
    ) {
        parent::__construct($titre, $auteur, $datePublication, $disponible, $image, $id);
        $this->pageNumber = $pageNumber;
    }

    /**
     * Obtenir le type de média
     * 
     * @return string Le type "Book"
     */
    public function getType(): string
    {
        return 'Book';
    }

    /**
     * Obtenir les propriétés spécifiques au livre
     * 
     * @return array Les propriétés spécifiques
     */
    public function getSpecificProperties(): array
    {
        return [
            'pageNumber' => $this->pageNumber
        ];
    }

    /**
     * Obtenir une description détaillée du livre
     * 
     * @return string Description du livre
     */
    public function getDescription(): string
    {
        $status = $this->disponible ? 'Disponible' : 'Emprunté';
        return "Livre: {$this->titre} par {$this->auteur} ({$this->pageNumber} pages) - {$status}";
    }

    /**
     * Vérifier si c'est un livre volumineux (plus de 300 pages)
     * 
     * @return bool True si le livre fait plus de 300 pages
     */
    public function isVoluminous(): bool
    {
        return $this->pageNumber > 300;
    }

    /**
     * Obtenir la catégorie de taille du livre
     * 
     * @return string La catégorie de taille
     */
    public function getSizeCategory(): string
    {
        if ($this->pageNumber <= 100) {
            return 'Court';
        } elseif ($this->pageNumber <= 300) {
            return 'Moyen';
        } else {
            return 'Volumineux';
        }
    }

    // Getter et Setter pour pageNumber
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void
    {
        if ($pageNumber <= 0) {
            throw new InvalidArgumentException("Le nombre de pages doit être positif.");
        }
        $this->pageNumber = $pageNumber;
    }
}