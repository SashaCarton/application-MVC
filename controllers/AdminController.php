<?php
require_once __DIR__ . '/../models/db_connect.php';
require_once __DIR__ . '/../repository/MediaRepository.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../models/Media.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../models/Movie.php';
require_once __DIR__ . '/../models/Album.php';
require_once __DIR__ . '/../models/Genre.php';

use Repository\MediaRepository;

class AdminController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        AuthController::requireAuth('/admin');
    }

    public function index()
    {
        $medias = MediaRepository::findAll();
        require __DIR__ . '/../views/admin/medias.php';
    }

    public function add()
    {
        $genres = Genre::getAll();
        require __DIR__ . '/../views/admin/add_media.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? '';
            $titre = trim($_POST['titre'] ?? '');
            $auteur = trim($_POST['auteur'] ?? '');
            $datePublication = $_POST['date_publication'] ?? '';

            if (empty($titre) || empty($auteur) || empty($type)) {
                $_SESSION['error'] = 'Tous les champs obligatoires doivent être remplis.';
                header('Location: /admin/add');
                exit();
            }

            try {
                $dateObj = new DateTime($datePublication);
                $media = null;

                switch ($type) {
                    case 'book':
                        $pageNumber = (int) ($_POST['pageNumber'] ?? 0);
                        if ($pageNumber <= 0) {
                            throw new InvalidArgumentException('Le nombre de pages doit être positif.');
                        }
                        $media = new Book($titre, $auteur, $dateObj, $pageNumber);
                        break;

                    case 'movie':
                        $duration = (int) ($_POST['duration'] ?? 0);
                        $genreValue = $_POST['genre'] ?? '';
                        $genre = Genre::fromString($genreValue);

                        if ($duration <= 0) {
                            throw new InvalidArgumentException('La durée doit être positive.');
                        }
                        if (!$genre) {
                            throw new InvalidArgumentException('Genre invalide.');
                        }

                        $media = new Movie($titre, $auteur, $dateObj, $duration, $genre);
                        break;

                    case 'album':
                        $trackNumber = (int) ($_POST['trackNumber'] ?? 0);
                        $recordLabel = trim($_POST['recordLabel'] ?? '');

                        if ($trackNumber <= 0) {
                            throw new InvalidArgumentException('Le nombre de pistes doit être positif.');
                        }
                        if (empty($recordLabel)) {
                            throw new InvalidArgumentException('Le label est obligatoire.');
                        }

                        $media = new Album($titre, $auteur, $dateObj, $trackNumber, $recordLabel);
                        break;

                    default:
                        throw new InvalidArgumentException('Type de média invalide.');
                }

                if (MediaRepository::save($media)) {
                    $_SESSION['success'] = 'Média ajouté avec succès !';
                    header('Location: /admin');
                } else {
                    $_SESSION['error'] = 'Erreur lors de l\'ajout du média.';
                    header('Location: /admin/add');
                }
            } catch (Exception $e) {
                $_SESSION['error'] = 'Erreur : ' . $e->getMessage();
                header('Location: /admin/add');
            }
            exit();
        }

        $this->add();
    }

    /**
     * Afficher le formulaire d'édition d'un média
     */
    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        $media = MediaRepository::findById((int) $id);

        if (!$media) {
            $_SESSION['error'] = 'Média non trouvé.';
            header('Location: /admin');
            exit();
        }

        $genres = Genre::getAll();
        require __DIR__ . '/../views/admin/edit_media.php';
    }

    /**
     * Traiter la modification d'un média
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? 0);
            $media = MediaRepository::findById($id);

            if (!$media) {
                $_SESSION['error'] = 'Média non trouvé.';
                header('Location: /admin');
                exit();
            }

            $titre = trim($_POST['titre'] ?? '');
            $auteur = trim($_POST['auteur'] ?? '');
            $datePublication = $_POST['date_publication'] ?? '';

            if (empty($titre) || empty($auteur)) {
                $_SESSION['error'] = 'Tous les champs obligatoires doivent être remplis.';
                header('Location: /admin/edit?id=' . $id);
                exit();
            }

            try {
                $dateObj = new DateTime($datePublication);

                // Recréer l'objet média avec les nouvelles données
                $type = $media->getType();
                $newMedia = null;
                $disponible = $media->isDisponible();

                switch ($type) {
                    case 'Book':
                        $pageNumber = (int) ($_POST['pageNumber'] ?? 0);
                        if ($pageNumber <= 0) {
                            throw new InvalidArgumentException('Le nombre de pages doit être positif.');
                        }
                        $newMedia = new Book($titre, $auteur, $dateObj, $pageNumber, $disponible, null, $id);
                        break;

                    case 'Movie':
                        $duration = (int) ($_POST['duration'] ?? 0);
                        $genreValue = $_POST['genre'] ?? '';
                        $genre = Genre::fromString($genreValue);

                        if ($duration <= 0) {
                            throw new InvalidArgumentException('La durée doit être positive.');
                        }
                        if (!$genre) {
                            throw new InvalidArgumentException('Genre invalide.');
                        }

                        $newMedia = new Movie($titre, $auteur, $dateObj, $duration, $genre, $disponible, null, $id);
                        break;

                    case 'Album':
                        $trackNumber = (int) ($_POST['trackNumber'] ?? 0);
                        $recordLabel = trim($_POST['recordLabel'] ?? '');

                        if ($trackNumber <= 0) {
                            throw new InvalidArgumentException('Le nombre de pistes doit être positif.');
                        }
                        if (empty($recordLabel)) {
                            throw new InvalidArgumentException('Le label est obligatoire.');
                        }

                        $newMedia = new Album($titre, $auteur, $dateObj, $trackNumber, $recordLabel, $disponible, null, $id);
                        break;
                }

                $media = $newMedia;

                if (MediaRepository::update($media)) {
                    $_SESSION['success'] = 'Média modifié avec succès !';
                    header('Location: /admin');
                } else {
                    $_SESSION['error'] = 'Erreur lors de la modification du média.';
                    header('Location: /admin/edit?id=' . $id);
                }
            } catch (Exception $e) {
                $_SESSION['error'] = 'Erreur : ' . $e->getMessage();
                header('Location: /admin/edit?id=' . $id);
            }
            exit();
        }

        $this->edit();
    }

    /**
     * Supprimer un média
     */
    public function delete()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $media = MediaRepository::findById($id);

        if (!$media) {
            $_SESSION['error'] = 'Média non trouvé.';
            header('Location: /admin');
            exit();
        }

        if (MediaRepository::delete($id)) {
            $_SESSION['success'] = 'Média supprimé avec succès !';
        } else {
            $_SESSION['error'] = 'Erreur lors de la suppression du média.';
        }

        header('Location: /admin');
        exit();
    }
}