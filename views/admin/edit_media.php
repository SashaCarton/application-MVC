<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un média | MÉDIATHÈQUE</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;700;900&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        /* Reprendre les styles de add_media.php */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #000;
            color: #fff;
            min-height: 100vh;
        }

        .header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 50px;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 3px;
            color: #fff;
            text-decoration: none;
        }

        .main-content {
            margin-top: 100px;
            padding: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
            color: #ccc;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.08);
        }

        .form-input::placeholder {
            color: #666;
        }

        .form-select option {
            background: #000;
            color: #fff;
        }

        .form-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: #22c55e;
            color: #000;
        }

        .btn-primary:hover {
            background: #16a34a;
        }

        .btn-secondary {
            background: transparent;
            color: #ccc;
            border: 1px solid #ccc;
        }

        .btn-secondary:hover {
            background: #ccc;
            color: #000;
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
            margin-left: auto;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .specific-fields {
            margin-top: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.02);
            border-left: 3px solid #22c55e;
        }

        .message {
            padding: 15px 25px;
            margin-bottom: 30px;
            border-left: 4px solid;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .message.success {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #22c55e;
        }

        .message.error {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #ef4444;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="nav">
            <a href="/" class="logo">MÉDIATHÈQUE</a>
            <div class="nav-links">
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="/admin" class="nav-link">Administration</a>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <h1 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; text-align: center; margin-bottom: 20px;">
            Modifier le média</h1>

        <!-- Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error">
                <?php echo htmlspecialchars($_SESSION['error']);
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="/admin/update">
                <input type="hidden" name="id" value="<?php echo $media->getId(); ?>">

                <!-- Type de média (non modifiable) -->
                <div class="form-group">
                    <label class="form-label">Type de média</label>
                    <input type="text" class="form-input" value="<?php echo htmlspecialchars($media->getType()); ?>"
                        readonly style="background: rgba(255, 255, 255, 0.02); color: #666;">
                </div>

                <!-- Champs communs -->
                <div class="form-group">
                    <label for="titre" class="form-label">Titre *</label>
                    <input type="text" id="titre" name="titre" class="form-input" required placeholder="Titre du média"
                        value="<?php echo htmlspecialchars($media->getTitre()); ?>">
                </div>

                <div class="form-group">
                    <label for="auteur" class="form-label">Auteur *</label>
                    <input type="text" id="auteur" name="auteur" class="form-input" required
                        placeholder="Auteur/Réalisateur/Artiste"
                        value="<?php echo htmlspecialchars($media->getAuteur()); ?>">
                </div>

                <div class="form-group">
                    <label for="date_publication" class="form-label">Date de publication *</label>
                    <input type="date" id="date_publication" name="date_publication" class="form-input" required
                        value="<?php echo $media->getDatePublication()->format('Y-m-d'); ?>">
                </div>

                <!-- Champs spécifiques selon le type -->
                <?php
                $type = $media->getType();
                $props = $media->getSpecificProperties();
                ?>

                <?php if ($type === 'Book'): ?>
                    <div class="specific-fields">
                        <h3 style="margin-bottom: 15px; color: #22c55e;">Détails du livre</h3>
                        <div class="form-group">
                            <label for="pageNumber" class="form-label">Nombre de pages</label>
                            <input type="number" id="pageNumber" name="pageNumber" class="form-input" min="1"
                                placeholder="Ex: 350" value="<?php echo $props['pageNumber']; ?>">
                        </div>
                    </div>

                <?php elseif ($type === 'Movie'): ?>
                    <div class="specific-fields">
                        <h3 style="margin-bottom: 15px; color: #3b82f6;">Détails du film</h3>
                        <div class="form-group">
                            <label for="duration" class="form-label">Durée (en minutes)</label>
                            <input type="number" id="duration" name="duration" class="form-input" min="1"
                                placeholder="Ex: 120" value="<?php echo $props['duration']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="genre" class="form-label">Genre</label>
                            <select id="genre" name="genre" class="form-select">
                                <option value="">Sélectionnez un genre</option>
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?php echo htmlspecialchars($genre); ?>" <?php echo ($props['genre'] === $genre) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($genre); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                <?php elseif ($type === 'Album'): ?>
                    <div class="specific-fields">
                        <h3 style="margin-bottom: 15px; color: #f59e0b;">Détails de l'album</h3>
                        <div class="form-group">
                            <label for="trackNumber" class="form-label">Nombre de pistes</label>
                            <input type="number" id="trackNumber" name="trackNumber" class="form-input" min="1"
                                placeholder="Ex: 12" value="<?php echo $props['trackNumber']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="recordLabel" class="form-label">Label/Maison de disque</label>
                            <input type="text" id="recordLabel" name="recordLabel" class="form-input"
                                placeholder="Ex: Sony Music" value="<?php echo htmlspecialchars($props['recordLabel']); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Modifier le média</button>
                    <a href="/admin" class="btn btn-secondary">Annuler</a>
                    <button type="button" class="btn btn-danger" id="deleteBtn">Supprimer</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bouton de suppression avec confirmation
            const deleteBtn = document.getElementById('deleteBtn');
            deleteBtn.addEventListener('click', function () {
                const mediaTitle = document.getElementById('titre').value;
                const mediaId = document.querySelector('input[name="id"]').value;

                showDelete(
                    'Supprimer le média',
                    `Êtes-vous sûr de vouloir supprimer définitivement "${mediaTitle}" ?\n\nCette action est irréversible.`,
                    () => {
                        // Confirmer : rediriger vers l'URL de suppression
                        window.location.href = `/admin/delete?id=${mediaId}`;
                    },
                    () => {
                        // Annuler : ne rien faire
                        console.log('Suppression annulée');
                    }
                );
            });

            // Validation du formulaire
            const form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                const titre = document.getElementById('titre').value.trim();
                const auteur = document.getElementById('auteur').value.trim();

                if (!titre || !auteur) {
                    e.preventDefault();
                    showAlert('Formulaire incomplet', 'Veuillez remplir tous les champs obligatoires (Titre, Auteur).');
                    return;
                }

                // Validation spécifique
                <?php if ($type === 'Book'): ?>
                    const pageNumber = document.getElementById('pageNumber').value;
                    if (!pageNumber || pageNumber <= 0) {
                        e.preventDefault();
                        showAlert('Données invalides', 'Le nombre de pages doit être supérieur à 0.');
                        return;
                    }
                <?php elseif ($type === 'Movie'): ?>
                    const duration = document.getElementById('duration').value;
                    const genre = document.getElementById('genre').value;
                    if (!duration || duration <= 0) {
                        e.preventDefault();
                        showAlert('Données invalides', 'La durée du film doit être supérieure à 0 minutes.');
                        return;
                    }
                    if (!genre) {
                        e.preventDefault();
                        showAlert('Données invalides', 'Veuillez sélectionner un genre pour le film.');
                        return;
                    }
                <?php elseif ($type === 'Album'): ?>
                    const trackNumber = document.getElementById('trackNumber').value;
                    const recordLabel = document.getElementById('recordLabel').value.trim();
                    if (!trackNumber || trackNumber <= 0) {
                        e.preventDefault();
                        showAlert('Données invalides', 'Le nombre de pistes doit être supérieur à 0.');
                        return;
                    }
                    if (!recordLabel) {
                        e.preventDefault();
                        showAlert('Données invalides', 'Le label/maison de disque est obligatoire pour un album.');
                        return;
                    }
                <?php endif; ?>
            });
        });
    </script>

    <?php include __DIR__ . '/../includes/modal-system.php'; ?>
</body>

</html>