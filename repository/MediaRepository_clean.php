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
    public static function findAll(): array
    {
        try {
            $db = self::getConnection();
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
    public static function findById(int $id): ?Media
    {
        try {
            $db = self::getConnection();
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
    public static function findAvailable(): array
    {
        try {
            $db = self::getConnection();
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
    public static function findBorrowed(): array
    {
        try {
            $db = self::getConnection();
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
    public static function save(Media $media): bool
    {
        try {
            $db = self::getConnection();
            $mediaArray = $media->toArray();
            $specificProps = $media->getSpecificProperties();
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
    public static function borrow(int $mediaId, int $userId): bool
    {
        try {
            $db = self::getConnection();
            $db->beginTransaction();
            $stmt = $db->prepare('SELECT disponible FROM medias WHERE id = :id');
            $stmt->execute(['id' => $mediaId]);
            $media = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$media || !$media['disponible']) {
                $db->rollBack();
                return false;
            }
            $stmt = $db->prepare('UPDATE medias SET disponible = 0 WHERE id = :id');
            $stmt->execute(['id' => $mediaId]);
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
    public static function returnMedia(int $mediaId, int $userId): bool
    {
        try {
            $db = self::getConnection();
            $db->beginTransaction();
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
            $stmt = $db->prepare('UPDATE emprunts SET date_retour = NOW() WHERE id = :id');
            $stmt->execute(['id' => $emprunt['id']]);
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
    public static function countByStatus(): array
    {
        try {
            $db = self::getConnection();
            $stmt = $db->query("SELECT statut, COUNT(*) as count FROM medias GROUP BY statut");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $counts = [
                'total' => 0,
                'disponible' => 0,
                'emprunte' => 0
            ];
            foreach ($results as $result) {
                $counts[$result['statut']] = (int) $result['count'];
                $counts['total'] += (int) $result['count'];
            }
            return $counts;
        } catch (Exception $e) {
            error_log("Erreur lors du comptage des médias : " . $e->getMessage());
            return ['total' => 0, 'disponible' => 0, 'emprunte' => 0];
        }
    }
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
                $counts[$result['type']] = (int) $result['count'];
            }
            return $counts;
        } catch (Exception $e) {
            error_log("Erreur lors du comptage des médias par type : " . $e->getMessage());
            return ['Book' => 0, 'Movie' => 0, 'Album' => 0];
        }
    }
    public static function search(string $query): array
    {
        try {
            $db = self::getConnection();
            $searchTerm = '%' . $query . '%';
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
