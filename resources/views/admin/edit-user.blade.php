<!-- Contenu de modification d'utilisateur -->
<div class="container-fluid">
    <div class="row" style="min-height: 100vh;">
        <!-- Main content -->
        <div class="col-12 p-0">
            <div class="main-content" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
                <!-- Header -->
                <div class="content-header bg-white shadow-sm border-bottom p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-1 text-dark">
                                <i class="fas fa-user-edit me-2 text-primary"></i>
                                Modifier l'utilisateur
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" onclick="loadContent('dashboard')" class="text-decoration-none">Accueil</a></li>
                                    <li class="breadcrumb-item"><a href="#" onclick="loadContent('users')" class="text-decoration-none">Utilisateurs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="#" onclick="loadContent('users')" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Retour
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form content -->
                <div class="container-fluid px-4 pb-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-3">
                                <div class="card-header bg-gradient-primary text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-user-circle me-2"></i>
                                        Informations utilisateur
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Informations personnelles -->
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <h6 class="text-muted mb-3">
                                                    <i class="fas fa-user me-2"></i>
                                                    Informations personnelles
                                                </h6>
                                                <hr class="mb-4">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="prenom" class="form-label fw-bold">
                                                    <i class="fas fa-user me-1 text-primary"></i>
                                                    Prénom
                                                </label>
                                                <input type="text" 
                                                       name="prenom" 
                                                       id="prenom"
                                                       value="{{ $user->prenom }}" 
                                                       class="form-control form-control-lg border-0 shadow-sm" 
                                                       style="background-color: #f8f9fa;"
                                                       required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nom" class="form-label fw-bold">
                                                    <i class="fas fa-user me-1 text-primary"></i>
                                                    Nom
                                                </label>
                                                <input type="text" 
                                                       name="nom" 
                                                       id="nom"
                                                       value="{{ $user->nom }}" 
                                                       class="form-control form-control-lg border-0 shadow-sm" 
                                                       style="background-color: #f8f9fa;"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label fw-bold">
                                                    <i class="fas fa-envelope me-1 text-primary"></i>
                                                    Email
                                                </label>
                                                <input type="email" 
                                                       name="email" 
                                                       id="email"
                                                       value="{{ $user->email }}" 
                                                       class="form-control form-control-lg border-0 shadow-sm" 
                                                       style="background-color: #f8f9fa;"
                                                       required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dateNaissance" class="form-label fw-bold">
                                                    <i class="fas fa-calendar me-1 text-primary"></i>
                                                    Date de Naissance
                                                </label>
                                                <input type="date" 
                                                       name="dateNaissance" 
                                                       id="dateNaissance"
                                                       value="{{ $user->dateNaissance }}" 
                                                       class="form-control form-control-lg border-0 shadow-sm" 
                                                       style="background-color: #f8f9fa;"
                                                       required>
                                            </div>
                                        </div>

                                        <!-- Informations professionnelles -->
                                        <div class="row mb-4 mt-5">
                                            <div class="col-12">
                                                <h6 class="text-muted mb-3">
                                                    <i class="fas fa-building me-2"></i>
                                                    Informations professionnelles
                                                </h6>
                                                <hr class="mb-4">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adresse" class="form-label fw-bold">
                                                    <i class="fas fa-school me-1 text-primary"></i>
                                                    Établissement
                                                </label>
                                                <input type="text" 
                                                       name="adresse" 
                                                       id="adresse"
                                                       value="{{ $user->adresse }}" 
                                                       class="form-control form-control-lg border-0 shadow-sm" 
                                                       style="background-color: #f8f9fa;"
                                                       required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="role" class="form-label fw-bold">
                                                    <i class="fas fa-user-tag me-1 text-primary"></i>
                                                    Rôle
                                                </label>
                                                <select name="role" 
                                                        id="role"
                                                        class="form-select form-select-lg border-0 shadow-sm" 
                                                        style="background-color: #f8f9fa;">
                                                    <option value="eleve" {{ $user->role == 'eleve' ? 'selected' : '' }}>
                                                        <i class="fas fa-graduation-cap"></i> Élève
                                                    </option>
                                                    <option value="professeur" {{ $user->role == 'professeur' ? 'selected' : '' }}>
                                                        <i class="fas fa-chalkboard-teacher"></i> Professeur
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Boutons d'action -->
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <hr class="mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <a href="#" onclick="loadContent('users')" 
                                                       class="btn btn-outline-secondary btn-lg px-4">
                                                        <i class="fas fa-times me-2"></i>
                                                        Annuler
                                                    </a>
                                                    <button type="submit" 
                                                <a href="#" onclick="loadContent('users')" 
                                                            class="btn btn-primary btn-lg px-4 shadow" 
                                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                                        <i class="fas fa-save me-2"></i>
                                                        Enregistrer les modifications e
                                                         </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sidebar-link {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        border-left-color: #fff;
        transform: translateX(5px);
    }
    
    .sidebar-link.active {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border-left-color: #fff;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        color: #6c757d;
    }
</style>