<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab🧪Terminale<</title>
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

        .register-container {
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
            overflow-y: auto;
        }

        .register-form-container {
            width: 100%;
            max-width: 450px;
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

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
            flex: 1;
        }

        .form-group.full-width {
            flex: none;
            width: 100%;
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



        .register-btn {
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

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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

        .error-summary {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            color: #dc2626;
        }

        .error-summary h4 {
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .error-summary ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-summary li {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .error-summary li:before {
            content: "•";
            margin-right: 8px;
            color: #dc2626;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-container {
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

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .register-container {
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
    <div class="register-container">
        <!-- Section gauche avec image d'arrière-plan -->
        <div class="left-section">
            <div class="floating-elements">
                <div class="floating-element">
                    <i class="fas fa-flask" style="font-size: 3rem; color: #4ecdc4;"></i>
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
                    <i class="fas fa-flask"></i>Lab🧪Terminale
                </h1>
                <p class="app-subtitle">Rejoignez l'Aventure Scientifique</p>
                <p class="app-description">
                    Créez votre compte et accédez à un monde d'expérimentations 
                    virtuelles. Découvrez la chimie de manière interactive et 
                    immersive avec nos simulations 3D avancées.
                </p>
                <ul class="features-list">
                    <li><i class="fas fa-check-circle"></i> Accès à toutes les simulations</li>
                    <li><i class="fas fa-check-circle"></i> Progression personnalisée</li>
                    <li><i class="fas fa-check-circle"></i> Expériences de laboratoire virtuelles</li>
                    <li><i class="fas fa-check-circle"></i> Communauté d'apprenants</li>
                </ul>
            </div>
        </div>

        <!-- Section droite avec formulaire -->
        <div class="right-section">
            <div class="register-form-container">
                <div class="form-header">
                    <h2 class="form-title">Inscription</h2>
                    <p class="form-subtitle">Créez votre compte pour commencer</p>
                </div>

                <!-- Messages d'erreur et de succès -->
                @if (session('status'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-summary">
                        <h4><i class="fas fa-exclamation-triangle"></i> Erreurs de validation</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('registerRequest') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="prenom" class="form-label">
                                <i class="fas fa-user"></i> Prénom
                            </label>
                            <input 
                                id="prenom" 
                                type="text" 
                                name="prenom" 
                                value="{{ old('prenom') }}" 
                                class="form-input" 
                                required 
                                autofocus 
                                autocomplete="given-name"
                                placeholder="Votre prénom"
                            >
                            <i class="fas fa-user input-icon"></i>
                            @if ($errors->get('prenom'))
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first('prenom') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nom" class="form-label">
                                <i class="fas fa-user"></i> Nom
                            </label>
                            <input 
                                id="nom" 
                                type="text" 
                                name="nom" 
                                value="{{ old('nom') }}" 
                                class="form-input" 
                                required 
                                autocomplete="family-name"
                                placeholder="Votre nom"
                            >
                            <i class="fas fa-user input-icon"></i>
                            @if ($errors->get('nom'))
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first('nom') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group full-width">
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
                            autocomplete="email"
                            placeholder="votre.email@exemple.com"
                        >
                        <i class="fas fa-envelope input-icon"></i>
                        @if ($errors->get('email'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group full-width">
                        <label for="adresse" class="form-label">
                            <i class="fas fa-school"></i> Établissement
                        </label>
                        <input 
                            id="adresse" 
                            type="text" 
                            name="adresse" 
                            value="{{ old('adresse') }}" 
                            class="form-input" 
                            required 
                            autocomplete="organization"
                            placeholder="Nom de votre établissement"
                        >
                        <i class="fas fa-school input-icon"></i>
                        @if ($errors->get('adresse'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('adresse') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group full-width">
                        <label for="dateNaissance" class="form-label">
                            <i class="fas fa-calendar"></i> Date de naissance
                        </label>
                        <input 
                            id="dateNaissance" 
                            type="date" 
                            name="dateNaissance" 
                            value="{{ old('dateNaissance') }}" 
                            class="form-input" 
                            required 
                            autocomplete="bday"
                        >
                        <i class="fas fa-calendar input-icon"></i>
                        @if ($errors->get('dateNaissance'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('dateNaissance') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group full-width">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Mot de passe
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            required 
                            autocomplete="new-password"
                            placeholder="Créez votre mot de passe"
                        >
                        <i class="fas fa-lock input-icon"></i>
                        @if ($errors->get('password'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group full-width">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock"></i> Confirmer le mot de passe
                        </label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            class="form-input" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirmez votre mot de passe"
                        >
                        <i class="fas fa-lock input-icon"></i>
                        @if ($errors->get('password_confirmation'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="register-btn">
                        <i class="fas fa-user-plus"></i> Créer mon compte
                    </button>
                </form>

                @if (Route::has('login'))
                    <div class="login-link">
                        Déjà un compte ? 
                        <a href="{{ route('loginPage') }}">Se connecter</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

