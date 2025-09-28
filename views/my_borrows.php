<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Emprunts | MÉDIATHÈQUE</title>
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

        .nav-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .user-info {
            color: #ccc;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .logout-btn {
            padding: 12px 30px;
            background: transparent;
            border: 2px solid #fff;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 12px;
        }

        .logout-btn:hover {
            background: #fff;
            color: #000;
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

        .page-subtitle {
            color: #aaa;
            font-size: 18px;
            letter-spacing: 1px;
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

        .medias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .media-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .media-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
        }

        .media-type {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 5px 12px;
            background: rgba(255, 255, 255, 0.1);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .media-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 10px;
            color: #fff;
        }

        .media-author {
            color: #aaa;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .media-details {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .detail-label {
            color: #666;
        }

        .detail-value {
            color: #ccc;
        }

        .borrowed-info {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .borrowed-title {
            color: #22c55e;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .borrowed-date {
            color: #fff;
            font-size: 14px;
        }

        .return-action {
            text-align: center;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .return-btn {
            padding: 12px 24px;
            background: #f59e0b;
            color: #000;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .return-btn:hover {
            background: #d97706;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #666;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 30px;
            color: #22c55e;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #16a34a;
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
                <a href="/medias/myBorrows" class="nav-link active">Mes Emprunts</a>
                <a href="/admin/add" class="nav-link">Ajouter Média</a>
            </div>
            <div class="nav-actions">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="user-info">Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="/auth/logout" class="logout-btn">Déconnexion</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">Mes Emprunts</h1>
            <p class="page-subtitle">Médias que vous avez actuellement empruntés</p>
        </div>

        <a href="/medias" class="back-link">← Retour à la collection</a>

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

        <?php if (empty($medias)): ?>
            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <h3>Aucun emprunt en cours</h3>
                <p>Vous n'avez actuellement emprunté aucun média.</p>
                <p><a href="/medias" style="color: #22c55e;">Explorez la collection</a> pour emprunter des médias.</p>
            </div>
        <?php else: ?>
            <div class="medias-grid">
                <?php foreach ($medias as $media): ?>
                    <div class="media-card">
                        <span class="media-type"><?php echo htmlspecialchars($media->getType()); ?></span>

                        <h3 class="media-title"><?php echo htmlspecialchars($media->getTitre()); ?></h3>
                        <p class="media-author">par <?php echo htmlspecialchars($media->getAuteur()); ?></p>

                        <div class="borrowed-info">
                            <div class="borrowed-title">📅 Emprunté le</div>
                            <div class="borrowed-date"><?php echo date('d/m/Y à H:i'); ?></div>
                        </div>

                        <div class="media-details">
                            <div class="detail-item">
                                <span class="detail-label">Date de publication:</span>
                                <span class="detail-value"><?php echo $media->getDatePublication()->format('d/m/Y'); ?></span>
                            </div>
                        </div>

                        <!-- Informations spécifiques -->
                        <?php
                        $type = $media->getType();
                        $props = $media->getSpecificProperties();
                        ?>

                        <div class="media-details">
                            <?php if ($type === 'Book'): ?>
                                <div class="detail-item">
                                    <span class="detail-label">Pages:</span>
                                    <span class="detail-value"><?php echo $props['pageNumber']; ?> pages</span>
                                </div>
                                <?php if ($media->isVoluminous()): ?>
                                    <div class="detail-item">
                                        <span class="detail-label">Type:</span>
                                        <span class="detail-value" style="color: #fbbf24;">📖 Livre volumineux</span>
                                    </div>
                                <?php endif; ?>

                            <?php elseif ($type === 'Movie'): ?>
                                <div class="detail-item">
                                    <span class="detail-label">Durée:</span>
                                    <span class="detail-value"><?php echo $media->getFormattedDuration(); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Genre:</span>
                                    <span class="detail-value"><?php echo $props['genre']; ?></span>
                                </div>

                            <?php elseif ($type === 'Album'): ?>
                                <div class="detail-item">
                                    <span class="detail-label">Pistes:</span>
                                    <span class="detail-value"><?php echo $props['trackNumber']; ?> pistes</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Label:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($props['recordLabel']); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="return-action">
                            <form method="POST" action="/medias/return" style="display: inline;" class="return-form">
                                <input type="hidden" name="media_id" value="<?php echo $media->getId(); ?>">
                                <button type="submit" class="return-btn"
                                    data-media-title="<?php echo htmlspecialchars($media->getTitre()); ?>">
                                    Rendre ce média
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/includes/modal-system.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gestion des confirmations de retour avec modales
            const returnForms = document.querySelectorAll('.return-form');
            returnForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const button = this.querySelector('.return-btn');
                    const mediaTitle = button.getAttribute('data-media-title');

                    showConfirm(
                        'Confirmer le retour',
                        `Êtes-vous sûr de vouloir rendre "${mediaTitle}" ?`,
                        () => {
                            // Confirmer : soumettre le formulaire
                            form.submit();
                        },
                        () => {
                            // Annuler : ne rien faire
                            console.log('Retour annulé');
                        }
                    );
                });
            });
        });
    </script>
</body>

</html>