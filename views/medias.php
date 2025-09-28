<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médiathèque | COLLECTION</title>
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

        /* Header */
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
            transition: all 0.3s ease;
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

        /* Main Content */
        .main-content {
            margin-top: 100px;
            padding: 40px 50px;
        }

        .page-header {
            margin-bottom: 50px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-text {
            text-align: left;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 300;
            margin-bottom: 15px;
            letter-spacing: 3px;
        }

        .page-subtitle {
            color: #aaa;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .add-media-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 30px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        .add-media-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
        }

        .add-media-btn svg {
            transition: transform 0.3s ease;
        }

        .add-media-btn:hover svg {
            transform: rotate(90deg);
        }

        /* Search Section */
        .search-section {
            margin-bottom: 40px;
            text-align: center;
        }

        .search-form {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .search-input {
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 16px;
            border-radius: 0;
            width: 400px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.08);
        }

        .search-input::placeholder {
            color: #666;
        }

        .search-btn {
            padding: 15px 30px;
            background: #fff;
            color: #000;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .search-btn:hover {
            background: #ccc;
        }

        /* Quick Stats */
        .quick-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            min-width: 120px;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #aaa;
        }

        /* Filters */
        .filters {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ccc;
            text-decoration: none;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Medias Grid */
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

        .media-specific {
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.03);
            border-left: 3px solid rgba(255, 255, 255, 0.2);
        }

        .specific-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #aaa;
            margin-bottom: 8px;
        }

        .specific-content {
            font-size: 14px;
            color: #fff;
        }

        .media-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            flex: 1;
        }

        .status-disponible {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-emprunte {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: currentColor;
        }

        .action-btn {
            padding: 8px 16px;
            border: 1px solid;
            background: transparent;
            color: inherit;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .borrow-btn {
            border-color: #22c55e;
            color: #22c55e;
        }

        .borrow-btn:hover {
            background: #22c55e;
            color: #000;
        }

        .return-btn {
            border-color: #f59e0b;
            color: #f59e0b;
        }

        .return-btn:hover {
            background: #f59e0b;
            color: #000;
        }

        /* Messages */
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

        /* Empty State */
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

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .main-content {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .header-text {
                text-align: center;
            }

            .page-title {
                font-size: 2.5rem;
            }

            .add-media-btn {
                padding: 12px 25px;
                font-size: 13px;
            }

            .search-input {
                width: 100%;
                max-width: 300px;
            }

            .search-form {
                flex-direction: column;
                align-items: center;
            }

            .medias-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .media-card {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .media-card:nth-child(even) {
            animation-delay: 0.1s;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="nav">
            <a href="/" class="logo">MÉDIATHÈQUE</a>
            <div class="nav-links">
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="/medias" class="nav-link active">Collection</a>
                <a href="/medias/myBorrows" class="nav-link">Mes Emprunts</a>
                <a href="/admin/add" class="nav-link">Ajouter Média</a>
            </div>
            <div class="nav-actions">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="user-info">Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="/auth/logout" class="logout-btn">Déconnexion</a>
                <?php else: ?>
                    <a href="/auth/login" class="nav-link">Connexion</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <div class="header-content">
                <div class="header-text">
                    <h1 class="page-title">Collection</h1>
                    <p class="page-subtitle">Explorez et empruntez nos médias</p>
                </div>
                <a href="/admin/add" class="add-media-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Ajouter un média
                </a>
            </div>
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

        <div class="search-section">
            <form method="GET" action="/medias/search" class="search-form">
                <input type="text" name="q" value="<?php echo htmlspecialchars($query ?? ''); ?>"
                    placeholder="Rechercher par titre, auteur, genre ou éditeur..." class="search-input">
                <button type="submit" class="search-btn">Rechercher</button>
            </form>

            <div class="quick-stats">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $stats['total'] ?? 0; ?></div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $stats['disponible'] ?? 0; ?></div>
                    <div class="stat-label">Disponibles</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $typeStats['Book'] ?? 0; ?></div>
                    <div class="stat-label">Livres</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $typeStats['Movie'] ?? 0; ?></div>
                    <div class="stat-label">Films</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $typeStats['Album'] ?? 0; ?></div>
                    <div class="stat-label">Albums</div>
                </div>
            </div>
        </div>

        <?php if (!empty($query)): ?>
            <div
                style="text-align: center; margin: 30px 0; padding: 15px; background: rgba(34, 197, 94, 0.1); border-radius: 10px; border-left: 4px solid #22c55e;">
                <p style="margin: 0; color: #22c55e; font-weight: 500;">
                    Résultats de recherche pour : <strong>"<?php echo htmlspecialchars($query); ?>"</strong>
                    <?php if (!empty($medias)): ?>
                        (<?php echo count($medias); ?> résultat<?php echo count($medias) > 1 ? 's' : ''; ?>
                        trouvé<?php echo count($medias) > 1 ? 's' : ''; ?>)
                    <?php endif; ?>
                </p>
                <a href="/medias" style="color: #888; font-size: 14px; text-decoration: none;">← Retour à tous les
                    médias</a>
            </div>
        <?php endif; ?>

        <?php if (empty($medias)): ?>
            <div class="empty-state">
                <h3>Aucun média trouvé</h3>
                <?php if (!empty($query)): ?>
                    <p>Aucun média ne correspond à votre recherche : <strong>"<?php echo htmlspecialchars($query); ?>"</strong>
                    </p>
                    <p><a href="/medias" style="color: #22c55e;">Voir tous les médias</a></p>
                <?php else: ?>
                    <p>Aucun média n'est disponible dans la collection.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="medias-grid">
                <?php foreach ($medias as $media): ?>
                    <div class="media-card">
                        <span class="media-type"><?php echo htmlspecialchars($media->getType()); ?></span>

                        <h3 class="media-title"><?php echo htmlspecialchars($media->getTitre()); ?></h3>
                        <p class="media-author">par <?php echo htmlspecialchars($media->getAuteur()); ?></p>

                        <div class="media-details">
                            <div class="detail-item">
                                <span class="detail-label">Date de publication:</span>
                                <span class="detail-value"><?php echo $media->getDatePublication()->format('d/m/Y'); ?></span>
                            </div>
                        </div>

                        <!-- Informations spécifiques -->
                        <div class="media-specific">
                            <?php
                            $type = $media->getType();
                            $props = $media->getSpecificProperties();
                            ?>
                            <div class="specific-title"><?php echo $type; ?> - Détails</div>
                            <div class="specific-content">
                                <?php if ($type === 'Book'): ?>
                                    📖 <?php echo $props['pageNumber']; ?> pages
                                    <?php if ($media->isVoluminous()): ?>
                                        <br><small style="color: #fbbf24;">Livre volumineux</small>
                                    <?php endif; ?>
                                    <br><small style="color: #22c55e;">Catégorie: <?php echo $media->getSizeCategory(); ?></small>

                                <?php elseif ($type === 'Movie'): ?>
                                    🎬 Durée: <?php echo $media->getFormattedDuration(); ?>
                                    <br>🎭 Genre: <?php echo $props['genre']; ?>
                                    <?php if ($media->isLongMovie()): ?>
                                        <br><small style="color: #fbbf24;">Film long</small>
                                    <?php endif; ?>
                                    <br><small style="color: #3b82f6;">Catégorie:
                                        <?php echo $media->getDurationCategory(); ?></small>

                                <?php elseif ($type === 'Album'): ?>
                                    🎵 <?php echo $props['trackNumber']; ?> pistes
                                    <br>🏷️ Label: <?php echo htmlspecialchars($props['recordLabel']); ?>
                                    <?php if ($media->isEP()): ?>
                                        <br><small style="color: #fbbf24;">EP</small>
                                    <?php endif; ?>
                                    <br><small style="color: #f59e0b;">Format: <?php echo $media->getSizeCategory(); ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="media-actions">
                            <?php if ($media->isDisponible()): ?>
                                <span class="status-badge status-disponible">
                                    <span class="status-dot"></span>
                                    Disponible
                                </span>
                                <form method="POST" action="/medias/borrow" style="display: inline;">
                                    <input type="hidden" name="media_id" value="<?php echo $media->getId(); ?>">
                                    <button type="submit" class="action-btn borrow-btn">Emprunter</button>
                                </form>
                            <?php else: ?>
                                <?php
                                // Vérifier si l'utilisateur connecté a emprunté ce média
                                $userBorrowed = \Repository\MediaRepository::isMediaBorrowedByUser($media->getId(), $_SESSION['user_id']);
                                ?>
                                <span class="status-badge status-emprunte">
                                    <span class="status-dot"></span>
                                    Emprunté
                                </span>
                                <?php if ($userBorrowed): ?>
                                    <form method="POST" action="/medias/return" style="display: inline;">
                                        <input type="hidden" name="media_id" value="<?php echo $media->getId(); ?>">
                                        <button type="submit" class="action-btn return-btn">Rendre</button>
                                    </form>
                                <?php else: ?>
                                    <span class="action-btn" style="border-color: #666; color: #666; cursor: not-allowed;">
                                        Emprunté par un autre utilisateur
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/includes/modal-system.php'; ?>

    <script>
        // Animation au scroll
        document.addEventListener('DOMContentLoaded', function () {
            // Confirmation avant emprunt/retour avec modales personnalisées
            const actionForms = document.querySelectorAll('form[action*="borrow"], form[action*="return"]');
            actionForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Toujours empêcher la soumission par défaut

                    const action = this.action.includes('borrow') ? 'emprunter' : 'rendre';
                    const mediaTitle = this.closest('.media-card').querySelector('.media-title').textContent;

                    const title = action === 'emprunter' ? 'Confirmer l\'emprunt' : 'Confirmer le retour';
                    const message = `Êtes-vous sûr de vouloir ${action} "${mediaTitle}" ?`;

                    showConfirm(title, message,
                        () => {
                            // Confirmer : soumettre le formulaire
                            form.submit();
                        },
                        () => {
                            // Annuler : ne rien faire
                            console.log('Action annulée');
                        }
                    );
                });
            });

            // Effet de hover amélioré sur les cartes
            const mediaCards = document.querySelectorAll('.media-card');
            mediaCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>

</html>