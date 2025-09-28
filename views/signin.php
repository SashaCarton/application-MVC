<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | MÉDIATHÈQUE</title>
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

        .logo:hover {
            opacity: 0.8;
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
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.02) 100%);
        }

        .signup-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        .signup-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 300;
            margin-bottom: 15px;
            letter-spacing: 2px;
            text-align: center;
        }

        .signup-subtitle {
            font-size: 16px;
            color: #aaa;
            text-align: center;
            margin-bottom: 40px;
            letter-spacing: 1px;
            font-weight: 300;
        }

        /* Error Message */
        .error-message {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #dc3545;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 0;
            font-size: 14px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* Form Styling */
        .signup-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
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

        .submit-btn {
            width: 100%;
            padding: 20px;
            background: #fff;
            color: #000;
            border: none;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #aaa;
        }

        .login-link a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .main-container {
                flex-direction: column;
                height: calc(100vh - 60px);
                margin-top: 60px;
            }

            .image-section {
                height: 40%;
            }

            .form-section {
                height: 60%;
                padding: 20px;
            }

            .signup-container {
                padding: 20px;
            }

            .signup-title {
                font-size: 2.5rem;
            }

            .image-title {
                font-size: 2rem;
            }

            .image-content {
                padding: 0 30px;
            }
        }

        @media (max-width: 480px) {
            .signup-title {
                font-size: 2rem;
            }

            .form-input {
                padding: 15px 0;
            }

            .submit-btn {
                padding: 18px;
            }
        }

        /* Animation */
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

        .signup-container {
            animation: fadeInUp 0.8s ease-out;
        }

        .image-content {
            animation: fadeInUp 1s ease-out 0.2s both;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <a href="/" class="logo">MÉDIATHÈQUE</a>
            <a href="/login" class="nav-link">Se Connecter</a>
        </nav>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Left Image Section -->
        <div class="image-section">
            <div class="image-overlay"></div>
            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                alt="Library" class="hero-image">
            <div class="image-content">
                <h1 class="image-title">Rejoignez-Nous</h1>
                <p class="image-subtitle">
                    Créez votre compte pour accéder à notre collection exclusive de ressources culturelles et
                    littéraires.
                </p>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="form-section">
            <div class="signup-container">
                <h1 class="signup-title">Inscription</h1>
                <p class="signup-subtitle">Créer votre Compte</p>

                <?php if (isset($error) && !empty($error)): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/signin" class="signup-form">
                    <div class="form-group">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" class="form-input"
                            placeholder="Votre nom d'utilisateur" required
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

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

                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirmer le Mot de Passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-input"
                            placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="submit-btn">Créer mon Compte</button>
                </form>

                <div class="login-link">
                    <p>Déjà un compte ? <a href="/login">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animation au chargement
        document.addEventListener('DOMContentLoaded', function () {
            // Animation des champs de formulaire
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach((input, index) => {
                input.style.animationDelay = (index * 0.1) + 's';
                input.style.animation = 'fadeInUp 0.6s ease-out both';
            });

            // Effet de focus sur les inputs
            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    this.parentElement.style.transform = 'scale(1.02)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });

                input.addEventListener('blur', function () {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Animation du bouton submit
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.addEventListener('mouseenter', function () {
                this.style.boxShadow = '0 10px 25px rgba(255, 255, 255, 0.1)';
            });

            submitBtn.addEventListener('mouseleave', function () {
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>

</html>