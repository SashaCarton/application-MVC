<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | MÉDIATHÈQUE</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;700;900&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            font-family: 'Inter', sans-serif;
            background: #000;
            color: #fff;
            height: 100vh;
            overflow: hidden;
        }

        /* Main Container */
        .main-container {
            display: flex;
            width: 100%;
            height: calc(100vh - 80px);
            margin-top: 80px;
        }

        /* Left Image Section */
        .image-section {
            flex: 1;
            position: relative;
            background: linear-gradient(45deg, #000 0%, #1a1a1a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%) brightness(0.7);
        }

        .image-content {
            position: absolute;
            z-index: 3;
            text-align: center;
            padding: 0 60px;
            max-width: 500px;
        }

        .image-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 3px;
            line-height: 1.1;
        }

        .image-subtitle {
            font-size: 18px;
            font-weight: 300;
            color: #ccc;
            line-height: 1.6;
            letter-spacing: 1px;
        }

        /* Right Form Section */
        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #000;
            position: relative;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            z-index: 1;
        }

        /* Header Navigation */
        .header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 20px 50px;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            height: 80px;
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

        .nav-link {
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

        .nav-link:hover {
            background: #fff;
            color: #000;
            transform: translateY(-2px);
        }

        /* Login Container */
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 0;
            background: transparent;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 300;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #aaa;
            margin-bottom: 50px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 300;
        }

        /* Form Styles */
        .login-form {
            text-align: left;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #ccc;
        }

        .form-input {
            width: 100%;
            padding: 18px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid #333;
            color: #fff;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-bottom-color: #fff;
        }

        .form-input::placeholder {
            color: #666;
            font-weight: 300;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 18px;
            background: #fff;
            color: #000;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Error Message */
        .error-message {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b6b;
            padding: 15px;
            margin-bottom: 30px;
            font-size: 14px;
            text-align: center;
            border-radius: 0;
        }

        /* Links */
        .form-links {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #333;
        }

        .form-link {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            font-weight: 300;
            transition: color 0.3s ease;
        }

        .form-link:hover {
            color: #fff;
        }


        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .image-section {
                min-height: 40vh;
                flex: none;
            }

            .form-section {
                flex: 1;
                padding: 20px;
            }

            .header {
                padding: 15px 20px;
            }

            .login-title {
                font-size: 32px;
            }

            .image-title {
                font-size: 2rem;
            }

            .image-content {
                padding: 0 30px;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 15px;
            }

            .login-container {
                max-width: 100%;
            }
        }

        /* Animation on load */
        .login-container {
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <a href="/" class="logo">MÉDIATHÈQUE</a>
            <a href="/" class="nav-link">Retour à l'Accueil</a>
        </nav>
    </header>

    <div class="main-container">
        <!-- Left Image Section -->
        <div class="image-section">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1200&h=1600&fit=crop&crop=center&auto=format&q=80"
                alt="Médiathèque" class="hero-image">
            <div class="image-overlay"></div>
            <div class="image-content">
                <h2 class="image-title">COLLECTION EXCLUSIVE</h2>
                <p class="image-subtitle">
                    Accédez à notre univers raffiné de culture et de découvertes.
                    Une expérience premium vous attend.
                </p>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="form-section">
            <!-- Login Container -->
            <div class="login-container">
                <h1 class="login-title">Connexion</h1>
                <p class="login-subtitle">Accès à la Collection</p>

                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="login-form">
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="votre@email.com"
                            required
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Mot de Passe</label>
                        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••"
                            required>
                    </div>

                    <button type="submit" class="submit-btn">
                        Se Connecter
                    </button>
                </form>

                <div class="form-links">
                    <a href="#" class="form-link">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Subtle form interactions
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.form-input');

            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    this.parentElement.style.transform = 'translateX(5px)';
                });

                input.addEventListener('blur', function () {
                    this.parentElement.style.transform = 'translateX(0)';
                });
            });

            // Form submission animation
            const form = document.querySelector('.login-form');
            const submitBtn = document.querySelector('.submit-btn');

            if (form && submitBtn) {
                form.addEventListener('submit', function () {
                    submitBtn.textContent = 'Connexion...';
                    submitBtn.style.opacity = '0.7';
                });
            }
        });
    </script>
</body>

</html>