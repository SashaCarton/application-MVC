<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MÉDIATHÈQUE - Collection Exclusive</title>
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
            overflow-x: hidden;
        }

        /* Header Navigation */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 50px;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
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
            letter-spacing: 2px;
            color: #fff;
            text-decoration: none;
        }

        .login-btn {
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

        .login-btn:hover {
            background: #fff;
            color: #000;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(4rem, 8vw, 8rem);
            font-weight: 300;
            line-height: 0.9;
            margin-bottom: 30px;
            letter-spacing: -2px;
        }

        .hero-subtitle {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 40px;
            color: #ccc;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 50px;
            color: #aaa;
            font-weight: 300;
        }

        /* Features Section */
        .features {
            padding: 100px 50px;
            background: #111;
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 60px;
        }

        .feature {
            text-align: center;
            padding: 40px 20px;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: linear-gradient(45deg, #333, #555);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .feature-description {
            color: #ccc;
            line-height: 1.6;
            font-weight: 300;
        }

        /* CTA Section */
        .cta {
            padding: 100px 50px;
            text-align: center;
            background: #000;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .cta-description {
            font-size: 18px;
            color: #aaa;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            display: inline-block;
            padding: 18px 50px;
            background: #fff;
            color: #000;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .cta-button:hover {
            background: #f0f0f0;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
        }

        /* Footer */
        .footer {
            padding: 50px;
            text-align: center;
            background: #111;
            border-top: 1px solid #333;
        }

        .footer-text {
            color: #666;
            font-size: 14px;
            font-weight: 300;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 18px;
            }

            .features {
                padding: 60px 20px;
            }

            .cta {
                padding: 60px 20px;
            }

            .footer {
                padding: 30px 20px;
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

        .hero-content>* {
            animation: fadeInUp 0.8s ease forwards;
        }

        .hero-subtitle {
            animation-delay: 0.2s;
        }

        .hero-description {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <a href="#" class="logo">MÉDIATHÈQUE</a>
            <a href="/login" class="login-btn">Se Connecter</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">COLLECTION<br>EXCLUSIVE</h1>
            <p class="hero-subtitle">Médiathèque Premium</p>
            <p class="hero-description">
                Découvrez une collection soigneusement sélectionnée de livres, films, musiques et ressources numériques.
                Une expérience culturelle raffinée pour les esprits curieux et exigeants.
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features-grid">
            <div class="feature">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Bibliothèque Littéraire</h3>
                <p class="feature-description">
                    Une collection exceptionnelle d'ouvrages classiques et contemporains,
                    soigneusement curatée pour enrichir votre univers littéraire.
                </p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </div>
                <h3 class="feature-title">Cinémathèque Premium</h3>
                <p class="feature-description">
                    Films d'auteur, documentaires exclusifs et chef-d'œuvres du cinéma mondial
                    disponibles en haute définition.
                </p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="5.5" cy="11.5" r="4.5"></circle>
                        <circle cx="18.5" cy="11.5" r="4.5"></circle>
                    </svg>
                </div>
                <h3 class="feature-title">Collection Musicale</h3>
                <p class="feature-description">
                    Jazz, classique, électronique expérimentale - explorez des univers sonores
                    d'exception en qualité studio.
                </p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2 class="cta-title">Rejoignez l'Excellence</h2>
        <p class="cta-description">
            Accédez à notre collection exclusive et découvrez un monde de culture raffinée.
            Votre voyage intellectuel commence ici.
        </p>
        <a href="/login" class="cta-button">Commencer l'Expérience</a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p class="footer-text">© 2025 Médiathèque Premium - Collection Exclusive</p>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(0, 0, 0, 0.95)';
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.9)';
            }
        });
    </script>
</body>

</html>