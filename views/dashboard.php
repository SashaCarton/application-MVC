<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MÉDIATHÈQUE</title>
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

        .dashboard-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 300;
            margin-bottom: 15px;
            letter-spacing: 3px;
            text-align: center;
        }

        .dashboard-subtitle {
            text-align: center;
            color: #aaa;
            font-size: 18px;
            margin-bottom: 50px;
            letter-spacing: 1px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #aaa;
        }

        /* Medias Table */
        .medias-section {
            margin-top: 50px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        .medias-table {
            width: 100%;
            border-collapse: collapse;
        }

        .medias-table th,
        .medias-table td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .medias-table th {
            background: rgba(255, 255, 255, 0.05);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            color: #ccc;
        }

        .medias-table td {
            font-size: 14px;
            vertical-align: middle;
        }

        .medias-table tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .media-title {
            font-weight: 600;
            color: #fff;
        }

        .media-author {
            color: #aaa;
            font-size: 13px;
        }

        .media-type {
            display: inline-block;
            padding: 5px 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
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

            .dashboard-title {
                font-size: 2.5rem;
            }

            .nav-actions {
                flex-direction: column;
                gap: 10px;
            }

            .nav-links {
                display: none;
            }

            .table-container {
                overflow-x: auto;
            }

            .medias-table {
                min-width: 800px;
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

        .main-content>* {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        .medias-section {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <a href="/" class="logo">MÉDIATHÈQUE</a>
            <div class="nav-links">
                <a href="/dashboard" class="nav-link active">Dashboard</a>
                <a href="/medias" class="nav-link">Collection</a>
                <a href="/medias/myBorrows" class="nav-link">Mes Emprunts</a>
                <a href="/admin/add" class="nav-link">Ajouter Média</a>
            </div>
            <div class="nav-actions">
                <span class="user-info">Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="/dashboard/logout" class="logout-btn">Déconnexion</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <h1 class="dashboard-title">Dashboard</h1>
        <p class="dashboard-subtitle">Gestion de la Collection</p>

        <!-- Statistics -->
        <div class="stats-grid">
            <?php
            $totalMedias = count($medias);
            $disponibles = array_filter($medias, function ($media) {
                return $media->isDisponible();
            });
            $empruntes = $totalMedias - count($disponibles);
            $pourcentageDisponible = $totalMedias > 0 ? round((count($disponibles) / $totalMedias) * 100) : 0;

            // Compter par type
            $books = array_filter($medias, function ($media) {
                return $media->getType() === 'Book';
            });
            $movies = array_filter($medias, function ($media) {
                return $media->getType() === 'Movie';
            });
            $albums = array_filter($medias, function ($media) {
                return $media->getType() === 'Album';
            });
            ?>

            <div class="stat-card">
                <div class="stat-number"><?php echo $totalMedias; ?></div>
                <div class="stat-label">Médias Total</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?php echo count($disponibles); ?></div>
                <div class="stat-label">Disponibles</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?php echo $empruntes; ?></div>
                <div class="stat-label">Empruntés</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?php echo $pourcentageDisponible; ?>%</div>
                <div class="stat-label">Taux Disponibilité</div>
            </div>
        </div>

        <!-- Type Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo count($books); ?></div>
                <div class="stat-label">Livres</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?php echo count($movies); ?></div>
                <div class="stat-label">Films</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?php echo count($albums); ?></div>
                <div class="stat-label">Albums</div>
            </div>
        </div>

        <!-- Medias List -->
        <section class="medias-section">
            <h2 class="section-title">Collection des Médias</h2>

            <?php if (empty($medias)): ?>
                <div class="empty-state">
                    <h3>Aucun média disponible</h3>
                    <p>La collection est actuellement vide.</p>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table class="medias-table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Type</th>
                                <th>Informations Spécifiques</th>
                                <th></th>Date Publication</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medias as $media): ?>
                                <tr>
                                    <td>
                                        <div class="media-title"><?php echo htmlspecialchars($media->getTitre()); ?></div>
                                    </td>
                                    <td>
                                        <div class="media-author"><?php echo htmlspecialchars($media->getAuteur()); ?></div>
                                    </td>
                                    <td>
                                        <span class="media-type"><?php echo htmlspecialchars($media->getType()); ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $type = $media->getType();
                                        $props = $media->getSpecificProperties();

                                        if ($type === 'Book') {
                                            echo '<span style="color: #22c55e;">' . $props['pageNumber'] . ' pages</span>';
                                            if ($media->isVoluminous()) {
                                                echo '<br><small style="color: #fbbf24;">📖 Volumineux</small>';
                                            }
                                        } elseif ($type === 'Movie') {
                                            echo '<span style="color: #3b82f6;">' . $media->getFormattedDuration() . '</span>';
                                            echo '<br><small style="color: #a855f7;"> ' . $props['genre'] . '</small>';
                                        } elseif ($type === 'Album') {
                                            echo '<span style="color: #f59e0b;">' . $props['trackNumber'] . ' pistes</span>';
                                            echo '<br><small style="color: #ec4899;"> ' . htmlspecialchars($props['recordLabel']) . '</small>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $media->getDatePublication()->format('d/m/Y'); ?>
                                    </td>
                                    <td>
                                        <?php if ($media->isDisponible()): ?>
                                            <span class="status-badge status-disponible">
                                                <span class="status-dot"></span>
                                                Disponible
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge status-emprunte">
                                                <span class="status-dot"></span>
                                                Emprunté
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Animation au scroll
        document.addEventListener('DOMContentLoaded', function () {
            // Effet de hover sur les cartes statistiques
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Animation des lignes du tableau
            const tableRows = document.querySelectorAll('.medias-table tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = (0.5 + index * 0.05) + 's';
                row.style.animation = 'fadeInUp 0.6s ease-out forwards';
            });
        });
    </script>
</body>

</html>