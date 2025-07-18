<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab🧪Terminale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1e3a8a;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            background: white;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            margin: 20px;
            overflow: hidden;
        }

        .left-section {
            flex: 1;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9), rgba(0, 0, 0, 0.7)),
                        url('{{ asset('images/labterminale.jpg') }}') center center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(30, 58, 138, 0.8), rgba(0, 0, 0, 0.6));
            z-index: 1;
        }

        .left-content {
            text-align: center;
            color: white;
            position: relative;
            z-index: 2;
            max-width: 500px;
        }

        .app-logo {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .app-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            font-weight: 300;
            opacity: 0.9;
        }

        .app-description {
            font-size: 1.1rem;
            line-height: 1.6;
            opacity: 0.8;
            margin-bottom: 40px;
        }

        .features-list {
            list-style: none;
            text-align: left;
        }

        .features-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .features-list i {
            margin-right: 15px;
            color: #4ecdc4;
            font-size: 1.2rem;
            width: 20px;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            background: white;
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-input:focus {
            outline: none;
            border-color: #1e3a8a;
            background: white;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
        }

        .form-input:focus + .input-icon {
            color: #1e3a8a;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            accent-color: #1e3a8a;
        }

        .remember-me label {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-password a {
            color: #1e3a8a;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #4ecdc4;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1e3a8a, #4ecdc4);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .register-link a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            color: #4ecdc4;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.9rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .error-message i {
            margin-right: 5px;
        }

        .success-message {
            color: #059669;
            font-size: 0.9rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .success-message i {
            margin-right: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 10px;
                border-radius: 15px;
            }

            .left-section {
                padding: 40px 20px;
                min-height: 300px;
            }

            .app-logo {
                font-size: 2.5rem;
            }

            .app-subtitle {
                font-size: 1.2rem;
            }

            .right-section {
                padding: 40px 20px;
            }

            .form-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 5px;
            }

            .left-section {
                padding: 30px 15px;
            }

            .right-section {
                padding: 30px 15px;
            }

            .app-logo {
                font-size: 2rem;
            }

            .form-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Section gauche avec image d'arrière-plan -->
        <div class="left-section">
            <div class="floating-elements">
                <div class="floating-element">
                    <i class="fas fa-flask" style="font-size: 3rem; color:rgb(14, 7, 82);"></i>
                </div>
                <div class="floating-element">
                    <i class="fas fa-atom" style="font-size: 2.5rem; color: #4ecdc4;"></i>
                </div>
                <div class="floating-element">
                    <i class="fas fa-microscope" style="font-size: 2rem; color: #4ecdc4;"></i>
                </div>
            </div>
            
            <div class="left-content">
                <h1 class="app-logo">
                    <i class="fas fa-flask"></i> Lab🧪Terminale
                </h1>
                <p class="app-subtitle">Simulation Interactive de Chimie</p>
                <p class="app-description">
                    Découvrez la chimie de manière interactive et immersive. 
                    Expérimentez avec des simulations 3D réalistes et apprenez 
                    les concepts fondamentaux de la chimie.
                </p>
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> Simulations 3D interactives</li>
                    <li><i class="fas fa-check-circle"></i> Expériences de laboratoire virtuelles</li>
                    <li><i class="fas fa-check-circle"></i> Apprentissage par l'expérimentation</li>
                    <li><i class="fas fa-check-circle"></i> Interface intuitive et moderne</li>
                </ul>
            </div>
        </div>

        <!-- Section droite avec formulaire -->
        <div class="right-section">
            <div class="login-form-container">
                <div class="form-header">
                    <h2 class="form-title">Connexion</h2>
                    <p class="form-subtitle">Accédez à votre espace de travail</p>
                </div>

                <!-- Messages d'erreur et de succès -->
                @if (session('status'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('loginRequest') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Adresse email
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="form-input" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="Entrez votre email"
                        >
                        <i class="fas fa-envelope input-icon"></i>
                        @if ($errors->get('email'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Mot de passe
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            required 
                            autocomplete="current-password"
                            placeholder="Entrez votre mot de passe"
                        >
                        <i class="fas fa-lock input-icon"></i>
                        @if ($errors->get('password'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Se souvenir de moi</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    @endif

                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </button>
                </form>

                @if (Route::has('register'))
                    <div class="register-link">
                        Pas encore de compte ? 
                        <a href="{{ route('register') }}">Creer un compte</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
