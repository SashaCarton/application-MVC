<?php
namespace Repository;
require_once __DIR__ . '/../models/db_connect.php';
require_once __DIR__ . '/../models/Media.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../models/Movie.php';
require_once __DIR__ . '/../models/Album.php';
require_once __DIR__ . '/../models/Genre.php';

use PDO;
use Exception;
use DateTime;
use Media;
use Book;
use Movie;
use Album;
use Genre;

class MediaRepository
{
    private static function getConnection(): PDO
    {
        return connection();
    }

    private static function mapToMediaObject(array $data): ?Media
    {
        try {
            $datePublication = !empty($data['date_publication']) ? new DateTime($data['date_publication']) : new DateTime();

            $disponible = (bool) ($data['disponible'] ?? true);

            switch ($data['type']) {
                case 'book':
                    return new Book(
                        $data['titre'],
                        $data['auteur'],
                        $datePublication,
                        (int) ($data['pageNumber'] ?? 0),
                        $disponible,
                        $data['image'] ?? null,
                        (int) $data['id']
                    );

                case 'movie':
                    $genreValue = $data['movie_genre'] ?? $data['genre'] ?? null;
                    $genre = !empty($genreValue) ? Genre::from($genreValue) : Genre::AUTRE;
                    return new Movie(
                        $data['titre'],
                        $data['auteur'],
                        $datePublication,
                        (int) ($data['duration'] ?? 0),
                        $genre,
                        $disponible,
                        $data['image'] ?? null,
                        (int) $data['id']
                    );

                case 'album':
                    return new Album(
                        $data['titre'],
                        $data['auteur'],
                        $datePublication,
                        (int) ($data['songNumber'] ?? 0),
                        $data['editor'] ?? '',
                        $disponible,
                        $data['image'] ?? null,
                        (int) $data['id']
                    );

                default:
                    return null;
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la conversion des données : " . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupérer tous les médias
     */
    public static function findAll(): array
    {
        try {
            $db = self::getConnection();

            // Requête avec JOINs pour récupérer les données spécifiques de chaque type
            $sql = "
                SELECT 
                    m.*,
                    b.pageNumber,
                    mv.duration, mv.genre,
                    a.songNumber, a.editor
                FROM medias m
                LEFT JOIN books b ON m.id = b.media_id AND m.type = 'book'
                LEFT JOIN movies mv ON m.id = mv.media_id AND m.type = 'movie'
                LEFT JOIN albums a ON m.id = a.media_id AND m.type = 'album'
                ORDER BY m.titre ASC
            ";

            $stmt = $db->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medias = [];
            foreach ($results as $data) {
                $media = self::mapToMediaObject($data);
                if ($media) {
                    $medias[] = $media;
                }
            }
            return $medias;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des médias : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupérer un média par son ID
     */
    public static function findById(int $id): ?Media
    {
        try {
            $db = self::getConnection();

            // Requête avec JOINs pour récupérer les données spécifiques
            $sql = "
                SELECT 
                    m.*,
                    b.pageNumber,
                    mv.duration, mv.genre,
                    a.songNumber, a.editor
                FROM medias m
                LEFT JOIN books b ON m.id = b.media_id AND m.type = 'book'
                LEFT JOIN movies mv ON m.id = mv.media_id AND m.type = 'movie'
                LEFT JOIN albums a ON m.id = a.media_id AND m.type = 'album'
                WHERE m.id = :id
            ";

            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            }

            return self::mapToMediaObject($data);
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération du média : " . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupérer les médias disponibles
     */
    public static function findAvailable(): array
    {
        try {
            $db = self::getConnection();

            // Requête avec JOINs pour récupérer les données spécifiques
            $sql = "
                SELECT 
                    m.*,
                    b.pageNumber,
                    mv.duration, mv.genre,
                    a.songNumber, a.editor
                FROM medias m
                LEFT JOIN books b ON m.id = b.media_id AND m.type = 'book'
                LEFT JOIN movies mv ON m.id = mv.media_id AND m.type = 'movie'
                LEFT JOIN albums a ON m.id = a.media_id AND m.type = 'album'
                WHERE m.disponible = 1
                ORDER BY m.titre ASC
            ";

            $stmt = $db->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medias = [];
            foreach ($results as $data) {
                $media = self::mapToMediaObject($data);
                if ($media) {
                    $medias[] = $media;
                }
            }
            return $medias;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des médias disponibles : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupérer les médias empruntés
     */
    public static function findBorrowed(): array
    {
        try {
            $db = self::getConnection();

            // Requête avec JOINs pour récupérer les données spécifiques
            $sql = "
                SELECT 
                    m.*,
                    b.pageNumber,
                    mv.duration, mv.genre,
                    a.songNumber, a.editor
                FROM medias m
                LEFT JOIN books b ON m.id = b.media_id AND m.type = 'book'
                LEFT JOIN movies mv ON m.id = mv.media_id AND m.type = 'movie'
                LEFT JOIN albums a ON m.id = a.media_id AND m.type = 'album'
                WHERE m.disponible = 0
                ORDER BY m.titre ASC
            ";

            $stmt = $db->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medias = [];
            foreach ($results as $data) {
                $media = self::mapToMediaObject($data);
                if ($media) {
                    $medias[] = $media;
                }
            }
            return $medias;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des médias empruntés : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Créer un nouveau média à partir d'un objet Media
     */
    public static function save(Media $media): bool
    {
        try {
            $db = self::getConnection();
            $mediaArray = $media->toArray();
            $specificProps = $media->getSpecificProperties();

            // Construction dynamique de la requête selon le type
            $type = $media->getType();
            $statut = $media->isDisponible() ? 'disponible' : 'emprunte';

            switch ($type) {
                case 'Book':
                    $stmt = $db->prepare('INSERT INTO medias (titre, auteur, type, date_publication, statut, page_number, image) VALUES (:titre, :auteur, :type, :date_publication, :statut, :page_number, :image)');
                    return $stmt->execute([
                        'titre' => $mediaArray['titre'],
                        'auteur' => $mediaArray['auteur'],
                        'type' => $type,
                        'date_publication' => $mediaArray['datePublication'],
                        'statut' => $statut,
                        'page_number' => $specificProps['pageNumber'],
                        'image' => $mediaArray['image']
                    ]);

                case 'Movie':
                    $stmt = $db->prepare('INSERT INTO medias (titre, auteur, type, date_publication, statut, duration, genre, image) VALUES (:titre, :auteur, :type, :date_publication, :statut, :duration, :genre, :image)');
                    return $stmt->execute([
                        'titre' => $mediaArray['titre'],
                        'auteur' => $mediaArray['auteur'],
                        'type' => $type,
                        'date_publication' => $mediaArray['datePublication'],
                        'statut' => $statut,
                        'duration' => $specificProps['duration'],
                        'genre' => $specificProps['genre'],
                        'image' => $mediaArray['image']
                    ]);

                case 'Album':
                    $stmt = $db->prepare('INSERT INTO medias (titre, auteur, type, date_publication, statut, track_number, record_label, image) VALUES (:titre, :auteur, :type, :date_publication, :statut, :track_number, :record_label, :image)');
                    return $stmt->execute([
                        'titre' => $mediaArray['titre'],
                        'auteur' => $mediaArray['auteur'],
                        'type' => $type,
                        'date_publication' => $mediaArray['datePublication'],
                        'statut' => $statut,
                        'track_number' => $specificProps['trackNumber'],
                        'record_label' => $specificProps['recordLabel'],
                        'image' => $mediaArray['image']
                    ]);

                default:
                    return false;
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la création du média : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Mettre à jour un média
     */
    public static function update(Media $media): bool
    {
        try {
            $db = self::getConnection();
            $mediaArray = $media->toArray();
            $specificProps = $media->getSpecificProperties();
            $type = $media->getType();
            $statut = $media->isDisponible() ? 'disponible' : 'emprunte';

            switch ($type) {
                case 'Book':
                    $stmt = $db->prepare('UPDATE medias SET titre = :titre, auteur = :auteur, type = :type, date_publication = :date_publication, statut = :statut, page_number = :page_number, image = :image WHERE id = :id');
                    return $stmt->execute([
                        'titre' => $mediaArray['titre'],
                        'auteur' => $mediaArray['auteur'],
                        'type' => $type,
                        'date_publication' => $mediaArray['datePublication'],
                        'statut' => $statut,
                        'page_number' => $specificProps['pageNumber'],
                        'image' => $mediaArray['image'],
                        'id' => $media->getId()
                    ]);

                case 'Movie':
                    $stmt = $db->prepare('UPDATE medias SET titre = :titre, auteur = :auteur, type = :type, date_publication = :date_publication, statut = :statut, duration = :duration, genre = :genre, image = :image WHERE id = :id');
                    return $stmt->execute([
                        'titre' => $mediaArray['titre'],
                        'auteur' => $mediaArray['auteur'],
                        'type' => $type,
                        'date_publication' => $mediaArray['datePublication'],
                        'statut' => $statut,
                        'duration' => $specificProps['duration'],
                        'genre' => $specificProps['genre'],
                        'image' => $mediaArray['image'],
                        'id' => $media->getId()
                    ]);

                case 'Album':
                    $stmt = $db->prepare('UPDATE medias SET titre = :titre, auteur = :auteur, type = :type, date_publication = :date_publication, statut = :statut, track_number = :track_number, record_label = :record_label, image = :image WHERE id = :id');
                    return $stmt->execute([
                        'titre' => $mediaArray['titre'],
                        'auteur' => $mediaArray['auteur'],
                        'type' => $type,
                        'date_publication' => $mediaArray['datePublication'],
                        'statut' => $statut,
                        'track_number' => $specificProps['trackNumber'],
                        'record_label' => $specificProps['recordLabel'],
                        'image' => $mediaArray['image'],
                        'id' => $media->getId()
                    ]);

                default:
                    return false;
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour du média : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprimer un média
     */
    public static function delete(int $id): bool
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('DELETE FROM medias WHERE id = :id');
            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            error_log("Erreur lors de la suppression du média : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Changer le statut d'un média
     */
    public static function updateStatus(int $id, string $status): bool
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('UPDATE medias SET statut = :statut WHERE id = :id');
            return $stmt->execute([
                'statut' => $status,
                'id' => $id
            ]);
        } catch (Exception $e) {
            error_log("Erreur lors du changement de statut du média : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Emprunter un média (créer un enregistrement d'emprunt et marquer comme indisponible)
     */
    public static function borrow(int $mediaId, int $userId): bool
    {
        try {
            $db = self::getConnection();
            $db->beginTransaction();

            // Vérifier que le média est disponible
            $stmt = $db->prepare('SELECT disponible FROM medias WHERE id = :id');
            $stmt->execute(['id' => $mediaId]);
            $media = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$media || !$media['disponible']) {
                $db->rollBack();
                return false;
            }

            // Marquer le média comme emprunté
            $stmt = $db->prepare('UPDATE medias SET disponible = 0 WHERE id = :id');
            $stmt->execute(['id' => $mediaId]);

            // Créer l'enregistrement d'emprunt
            $stmt = $db->prepare('INSERT INTO emprunts (user_id, media_id, date_emprunt) VALUES (:user_id, :media_id, NOW())');
            $stmt->execute([
                'user_id' => $userId,
                'media_id' => $mediaId
            ]);

            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollBack();
            error_log("Erreur lors de l'emprunt du média : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Rendre un média (marquer l'emprunt comme rendu et le média comme disponible)
     */
    public static function returnMedia(int $mediaId, int $userId): bool
    {
        try {
            $db = self::getConnection();
            $db->beginTransaction();

            // Vérifier qu'il y a un emprunt en cours pour cet utilisateur et ce média
            $stmt = $db->prepare('
                SELECT id FROM emprunts 
                WHERE user_id = :user_id AND media_id = :media_id AND date_retour IS NULL
            ');
            $stmt->execute([
                'user_id' => $userId,
                'media_id' => $mediaId
            ]);
            $emprunt = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$emprunt) {
                $db->rollBack();
                return false;
            }

            // Marquer l'emprunt comme rendu
            $stmt = $db->prepare('UPDATE emprunts SET date_retour = NOW() WHERE id = :id');
            $stmt->execute(['id' => $emprunt['id']]);

            // Marquer le média comme disponible
            $stmt = $db->prepare('UPDATE medias SET disponible = 1 WHERE id = :id');
            $stmt->execute(['id' => $mediaId]);

            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollBack();
            error_log("Erreur lors du retour du média : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Compter les médias par statut
     */
    public static function countByStatus(): array
    {
        try {
            $db = self::getConnection();

            $stmtTotal = $db->query("SELECT COUNT(*) as total FROM medias");
            $total = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

            $stmtDisponible = $db->query("SELECT COUNT(*) as disponible FROM medias WHERE disponible = 1");
            $disponible = $stmtDisponible->fetch(PDO::FETCH_ASSOC)['disponible'];

            $emprunte = $total - $disponible;

            return [
                'total' => (int) $total,
                'disponible' => (int) $disponible,
                'emprunte' => (int) $emprunte
            ];
        } catch (Exception $e) {
            error_log("Erreur lors du comptage des médias : " . $e->getMessage());
            return ['total' => 0, 'disponible' => 0, 'emprunte' => 0];
        }
    }

    /**
     * Compter les médias par type
     */
    public static function countByType(): array
    {
        try {
            $db = self::getConnection();
            $stmt = $db->query("SELECT type, COUNT(*) as count FROM medias GROUP BY type");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $counts = [
                'Book' => 0,
                'Movie' => 0,
                'Album' => 0
            ];

            foreach ($results as $result) {
                $typeMapping = [
                    'book' => 'Book',
                    'movie' => 'Movie',
                    'album' => 'Album'
                ];

                $className = $typeMapping[$result['type']] ?? $result['type'];
                $counts[$className] = (int) $result['count'];
            }

            return $counts;
        } catch (Exception $e) {
            error_log("Erreur lors du comptage des médias par type : " . $e->getMessage());
            return ['Book' => 0, 'Movie' => 0, 'Album' => 0];
        }
    }

    /**
     * Rechercher des médias par titre, auteur ou propriétés spécifiques
     */
    public static function search(string $query): array
    {
        try {
            $db = self::getConnection();
            $searchTerm = '%' . $query . '%';

            // Recherche dans les champs communs et spécifiques avec jointures
            $stmt = $db->prepare('
                SELECT DISTINCT m.*, 
                       b.pageNumber, 
                       mo.duration, mo.genre as movie_genre,
                       a.songNumber, a.editor
                FROM medias m
                LEFT JOIN books b ON m.id = b.media_id
                LEFT JOIN movies mo ON m.id = mo.media_id  
                LEFT JOIN albums a ON m.id = a.media_id
                WHERE m.titre LIKE :query 
                   OR m.auteur LIKE :query 
                   OR (mo.genre IS NOT NULL AND mo.genre LIKE :query)
                   OR (a.editor IS NOT NULL AND a.editor LIKE :query)
                ORDER BY m.titre ASC
            ');
            $stmt->execute(['query' => $searchTerm]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medias = [];
            foreach ($results as $data) {
                $media = self::mapToMediaObject($data);
                if ($media) {
                    $medias[] = $media;
                }
            }
            return $medias;
        } catch (Exception $e) {
            error_log("Erreur lors de la recherche de médias : " . $e->getMessage());

            // Si la recherche avec jointures échoue, utiliser une recherche simple
            try {
                $stmt = $db->prepare('
                    SELECT * FROM medias 
                    WHERE titre LIKE :query 
                       OR auteur LIKE :query 
                    ORDER BY titre ASC
                ');
                $stmt->execute(['query' => $searchTerm]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $medias = [];
                foreach ($results as $data) {
                    $media = self::mapToMediaObject($data);
                    if ($media) {
                        $medias[] = $media;
                    }
                }
                return $medias;
            } catch (Exception $fallbackError) {
                error_log("Erreur lors de la recherche simple : " . $fallbackError->getMessage());
                return [];
            }
        }
    }

    /**
     * Rechercher des médias par type spécifique
     */
    public static function findByType(string $type): array
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('SELECT * FROM medias WHERE type = :type ORDER BY titre ASC');
            $stmt->execute(['type' => $type]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medias = [];
            foreach ($results as $data) {
                $media = self::mapToMediaObject($data);
                if ($media) {
                    $medias[] = $media;
                }
            }
            return $medias;
        } catch (Exception $e) {
            error_log("Erreur lors de la recherche par type : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Rechercher des films par genre
     */
    public static function findMoviesByGenre(Genre $genre): array
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare("SELECT * FROM medias WHERE type = 'Movie' AND genre = :genre ORDER BY titre ASC");
            $stmt->execute(['genre' => $genre->value]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $movies = [];
            foreach ($results as $data) {
                $movie = self::mapToMediaObject($data);
                if ($movie instanceof Movie) {
                    $movies[] = $movie;
                }
            }
            return $movies;
        } catch (Exception $e) {
            error_log("Erreur lors de la recherche de films par genre : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Vérifier si un utilisateur a emprunté un média spécifique (et ne l'a pas encore rendu)
     */
    public static function isMediaBorrowedByUser(int $mediaId, int $userId): bool
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('
                SELECT COUNT(*) as count FROM emprunts 
                WHERE user_id = :user_id AND media_id = :media_id AND date_retour IS NULL
            ');
            $stmt->execute([
                'user_id' => $userId,
                'media_id' => $mediaId
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int) $result['count'] > 0;
        } catch (Exception $e) {
            error_log("Erreur lors de la vérification de l'emprunt : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtenir les médias empruntés par un utilisateur spécifique
     */
    public static function getMediasBorrowedByUser(int $userId): array
    {
        try {
            $db = self::getConnection();

            $sql = "
                SELECT 
                    m.*,
                    b.pageNumber,
                    mv.duration, mv.genre,
                    a.songNumber, a.editor,
                    e.date_emprunt
                FROM medias m
                INNER JOIN emprunts e ON m.id = e.media_id AND e.date_retour IS NULL
                LEFT JOIN books b ON m.id = b.media_id AND m.type = 'book'
                LEFT JOIN movies mv ON m.id = mv.media_id AND m.type = 'movie'
                LEFT JOIN albums a ON m.id = a.media_id AND m.type = 'album'
                WHERE e.user_id = :user_id
                ORDER BY e.date_emprunt DESC
            ";

            $stmt = $db->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medias = [];
            foreach ($results as $data) {
                $media = self::mapToMediaObject($data);
                if ($media) {
                    $medias[] = $media;
                }
            }
            return $medias;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des médias empruntés par l'utilisateur : " . $e->getMessage());
            return [];
        }
    }
}