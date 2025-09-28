<?php

/**
 * Énumération des genres de films
 * 
 * Définit les différents genres disponibles pour les films
 */
enum Genre: string
{
    case ACTION = 'Action';
    case AVENTURE = 'Aventure';
    case COMEDIE = 'Comedie';
    case DRAME = 'Drame';
    case FANTASTIQUE = 'Fantastique';
    case HORREUR = 'Horreur';
    case ROMANCE = 'Romance';
    case SCIENCE_FICTION = 'Science-Fiction';
    case THRILLER = 'Thriller';
    case DOCUMENTAIRE = 'Documentaire';
    case ANIMATION = 'Animation';
    case GUERRE = 'Guerre';
    case HISTORIQUE = 'Historique';
    case MUSICAL = 'Musical';
    case WESTERN = 'Western';
    case AUTRE = 'Autre';

    /**
     * Obtenir tous les genres sous forme de tableau
     * 
     * @return array Les genres disponibles
     */
    public static function getAll(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    /**
     * Obtenir un genre par sa valeur
     * 
     * @param string $value La valeur du genre
     * @return Genre|null Le genre correspondant ou null
     */
    public static function fromString(string $value): ?Genre
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }
        return null;
    }
}