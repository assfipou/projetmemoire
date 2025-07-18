<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Labo Chimie</title>
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

        .profile-header {
            position: relative;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            min-height: 300px;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9), rgba(0, 0, 0, 0.7)),
                        url('{{ asset('images/labterminale.jpg') }}') center center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-header-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 40px 20px;
        }

        .profile-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .profile-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .user-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 2rem;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, #1e3a8a, #4ecdc4);
            color: white;
            padding: 25px 30px;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
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

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            flex: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3a8a, #4ecdc4);
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        }

        .btn-secondary {
            background: #6b7280;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-2px);
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

        .warning-box {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            color: #92400e;
        }

        .danger-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            color: #dc2626;
        }

        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            color: #1e3a8a;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-title {
                font-size: 2rem;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .section-content {
                padding: 20px;
            }

            .back-button {
                top: 10px;
                left: 10px;
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i> Retour
    </button>

    <div class="profile-header">
        <div class="profile-header-content">
            <h1 class="profile-title">
                <i class="fas fa-user-circle"></i> Mon Profil
            </h1>
            <p class="profile-subtitle">Gérez vos informations personnelles et vos paramètres de compte</p>
            
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h3>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h3>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="profile-container">
        <!-- Section Informations du Profil -->
        <div class="profile-section">
            <div class="section-header">
                <i class="fas fa-user-edit"></i>
                Informations du Profil
            </div>
            <div class="section-content">
                <!-- Debug: Afficher toutes les erreurs -->
                @if ($errors->any())
                    <div class="danger-box">
                        <h4><i class="fas fa-exclamation-triangle"></i> Erreurs de validation :</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-row">
                        <div class="form-group">
                            <label for="prenom" class="form-label">
                                <i class="fas fa-user"></i> Prénom
                            </label>
                            <input 
                                id="prenom" 
                                name="prenom" 
                                type="text" 
                                class="form-input" 
                                value="{{ old('prenom', $user->prenom) }}" 
                                required 
                                autocomplete="given-name"
                                placeholder="Votre prénom"
                            >
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
                                name="nom" 
                                type="text" 
                                class="form-input" 
                                value="{{ old('nom', $user->nom) }}" 
                                required 
                                autocomplete="family-name"
                                placeholder="Votre nom"
                            >
                            @if ($errors->get('nom'))
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first('nom') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Adresse email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            class="form-input" 
                            value="{{ old('email', $user->email) }}" 
                            required 
                            autocomplete="email"
                            placeholder="votre.email@exemple.com"
                        >
                        @if ($errors->get('email'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="warning-box">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Email non vérifié</strong><br>
                                Votre adresse email n'est pas vérifiée.
                                <button form="send-verification" class="btn btn-secondary" style="margin-top: 10px;">
                                    <i class="fas fa-paper-plane"></i> Renvoyer l'email de vérification
                                </button>
                            </div>

                            @if (session('status') === 'verification-link-sent')
                                <div class="success-message">
                                    <i class="fas fa-check-circle"></i>
                                    Un nouveau lien de vérification a été envoyé à votre adresse email.
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="adresse" class="form-label">
                            <i class="fas fa-school"></i> Établissement
                        </label>
                        <input 
                            id="adresse" 
                            name="adresse" 
                            type="text" 
                            class="form-input" 
                            value="{{ old('adresse', $user->adresse) }}" 
                            required 
                            autocomplete="organization"
                            placeholder="Nom de votre établissement"
                        >
                        @if ($errors->get('adresse'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('adresse') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="dateNaissance" class="form-label">
                            <i class="fas fa-calendar"></i> Date de naissance
                        </label>
                        <input 
                            id="dateNaissance" 
                            name="dateNaissance" 
                            type="date" 
                            class="form-input" 
                            value="{{ old('dateNaissance', $user->dateNaissance) }}" 
                            required 
                            autocomplete="bday"
                        >
                        @if ($errors->get('dateNaissance'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('dateNaissance') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Sauvegarder les modifications
                    </button>

                    @if (session('status') === 'profile-updated')
                        <div class="success-message" style="margin-top: 15px;">
                            <i class="fas fa-check-circle"></i>
                            Profil mis à jour avec succès !
                        </div>
                    @endif
                </form>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Section Mot de Passe -->
        <div class="profile-section">
            <div class="section-header">
                <i class="fas fa-lock"></i>
                Modifier le Mot de Passe
            </div>
            <div class="section-content">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="current_password" class="form-label">
                            <i class="fas fa-key"></i> Mot de passe actuel
                        </label>
                        <input 
                            id="current_password" 
                            name="current_password" 
                            type="password" 
                            class="form-input" 
                            required 
                            autocomplete="current-password"
                            placeholder="Votre mot de passe actuel"
                        >
                        @if ($errors->get('current_password'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('current_password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Nouveau mot de passe
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            class="form-input" 
                            required 
                            autocomplete="new-password"
                            placeholder="Votre nouveau mot de passe"
                        >
                        @if ($errors->get('password'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock"></i> Confirmer le nouveau mot de passe
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            class="form-input" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirmez votre nouveau mot de passe"
                        >
                        @if ($errors->get('password_confirmation'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-key"></i> Mettre à jour le mot de passe
                    </button>

                    @if (session('status') === 'password-updated')
                        <div class="success-message" style="margin-top: 15px;">
                            <i class="fas fa-check-circle"></i>
                            Mot de passe mis à jour avec succès !
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Section Supprimer le Compte -->
        <div class="profile-section">
            <div class="section-header">
                <i class="fas fa-trash-alt"></i>
                Supprimer le Compte
            </div>
            <div class="section-content">
                <div class="danger-box">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Attention !</strong> Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
                </div>

                <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Mot de passe
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            class="form-input" 
                            required 
                            placeholder="Entrez votre mot de passe pour confirmer"
                        >
                        @if ($errors->get('password'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn-danger">
                        <i class="fas fa-trash-alt"></i> Supprimer définitivement le compte
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Debug: Log la soumission du formulaire
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route("profile.update") }}"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('Formulaire soumis');
                    console.log('Méthode:', this.method);
                    console.log('Action:', this.action);
                    
                    // Log les données du formulaire
                    const formData = new FormData(this);
                    for (let [key, value] of formData.entries()) {
                        console.log(key + ': ' + value);
                    }
                });
            }
        });
    </script>
</body>
</html>
