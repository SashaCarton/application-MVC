<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | MÉDIATHÈQUE</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;700;900&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
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

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: #ccc;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
        }

        .main-content {
            margin-top: 100px;
            padding: 40px 50px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 300;
            margin-bottom: 15px;
            letter-spacing: 3px;
        }

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .add-btn {
            padding: 12px 30px;
            background: #22c55e;
            color: #000;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .add-btn:hover {
            background: #16a34a;
        }

        .medias-table {
            width: 100%;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-collapse: collapse;
        }

        .medias-table th,
        .medias-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .medias-table th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .action-btn {
            padding: 8px 16px;
            margin: 2px;
            border: 1px solid;
            background: transparent;
            color: inherit;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .edit-btn {
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .edit-btn:hover {
            background: #3b82f6;
            color: #000;
        }

        .delete-btn {
            border-color: #ef4444;
            color: #ef4444;
        }

        .delete-btn:hover {
            background: #ef4444;
            color: #000;
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
                <a href="/medias" class="nav-link">Collection</a>
                <a href="/admin" class="nav-link active">Administration</a>
            </div>
            <div class="nav-actions">
                <span class="user-info">Bienvenue,
                    <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span>
                <a href="/auth/logout" class="logout-btn">Déconnexion</a>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">Administration</h1>
            <p class="page-subtitle">Gestion des médias</p>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="message success">
                <?php echo htmlspecialchars($_SESSION['success']);
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error">
                <?php echo htmlspecialchars($_SESSION['error']);
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="actions-bar">
            <h2>Liste des médias</h2>
            <a href="/admin/add" class="add-btn">+ Ajouter un média</a>
        </div>

        <?php if (empty($medias)): ?>
            <div class="empty-state">
                <h3>Aucun média trouvé</h3>
                <p>Commencez par ajouter des médias à votre collection.</p>
            </div>
        <?php else: ?>
            <table class="medias-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Type</th>
                        <th>Détails</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medias as $media): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($media->getTitre()); ?></td>
                            <td><?php echo htmlspecialchars($media->getAuteur()); ?></td>
                            <td><?php echo htmlspecialchars($media->getType()); ?></td>
                            <td>
                                <?php
                                $type = $media->getType();
                                $props = $media->getSpecificProperties();

                                if ($type === 'Book') {
                                    echo $props['pageNumber'] . ' pages';
                                } elseif ($type === 'Movie') {
                                    echo $media->getFormattedDuration() . ' - ' . $props['genre'];
                                } elseif ($type === 'Album') {
                                    echo $props['trackNumber'] . ' pistes - ' . htmlspecialchars($props['recordLabel']);
                                }
                                ?>
                            </td>
                            <td><?php echo $media->getDatePublication()->format('d/m/Y'); ?></td>
                            <td>
                                <?php if ($media->isDisponible()): ?>
                                    <span style="color: #22c55e;">✓ Disponible</span>
                                <?php else: ?>
                                    <span style="color: #ef4444;">✗ Emprunté</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/admin/edit?id=<?php echo $media->getId(); ?>" class="action-btn edit-btn">Modifier</a>
                                <a href="#" class="action-btn delete-btn"
                                    data-delete-url="/admin/delete?id=<?php echo $media->getId(); ?>"
                                    data-media-title="<?php echo htmlspecialchars($media->getTitre()); ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/../includes/modal-system.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gestion des confirmations de suppression avec modales
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const deleteUrl = this.getAttribute('data-delete-url');
                    const mediaTitle = this.getAttribute('data-media-title');

                    showDelete(
                        'Supprimer le média',
                        `Êtes-vous sûr de vouloir supprimer définitivement "${mediaTitle}" ?\n\nCette action est irréversible.`,
                        () => {
                            // Confirmer : rediriger vers l'URL de suppression
                            window.location.href = deleteUrl;
                        },
                        () => {
                            // Annuler : ne rien faire
                            console.log('Suppression annulée');
                        }
                    );
                });
            });
        });
    </script>
</body>

</html>