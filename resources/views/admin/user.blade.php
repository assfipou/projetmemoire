<!-- Contenu de gestion des utilisateurs -->

    <!-- Main content -->
    <div class="flex-grow-1" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
        <!-- Header -->
        <div class="content-header bg-white shadow-sm border-bottom p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark">
                        <i class="fas fa-users me-2 text-primary"></i>
                        Gestion des Utilisateurs
                    </h1>
                    <p class="text-muted mb-0">Gérez les comptes utilisateurs de votre plateforme</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-download me-1"></i>
                        Exporter
                    </button>
                    <button class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <i class="fas fa-user-plus me-1"></i>
                        Nouvel Utilisateur
                    </button>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 mx-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Stats cards -->
        <div class="container-fluid p-4">
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm stat-card">
                        <div class="card-body text-center">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <h3 class="mt-3 mb-1">{{ $users->where('role', '!=', 'admin')->count() }}</h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-chart-bar me-1"></i>
                                Total Utilisateurs
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm stat-card">
                        <div class="card-body text-center">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-graduation-cap text-white"></i>
                            </div>
                            <h3 class="mt-3 mb-1">{{ $users->where('role', 'eleve')->count() }}</h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-book me-1"></i>
                                Élèves
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm stat-card">
                        <div class="card-body text-center">
                            <div class="stat-icon bg-warning">
                                <i class="fas fa-chalkboard-teacher text-white"></i>
                            </div>
                            <h3 class="mt-3 mb-1">{{ $users->where('role', 'professeur')->count() }}</h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-chalkboard me-1"></i>
                                Professeurs
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm stat-card">
                        <div class="card-body text-center">
                            <div class="stat-icon bg-info">
                                <i class="fas fa-building text-white"></i>
                            </div>
                            <h3 class="mt-3 mb-1">{{ $users->where('role', '!=', 'admin')->pluck('adresse')->unique()->count() }}</h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                Établissements
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-0 bg-light" placeholder="Rechercher un utilisateur..." id="searchInput">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select border-0 bg-light" id="roleFilter">
                                        <option value="">Tous les rôles</option>
                                        <option value="eleve">Élèves</option>
                                        <option value="professeur">Professeurs</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select border-0 bg-light" id="establishmentFilter">
                                        <option value="">Tous les établissements</option>
                                        @foreach($users->where('role', '!=', 'admin')->pluck('adresse')->unique()->filter() as $etablissement)
                                            <option value="{{ $etablissement }}">{{ $etablissement }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                                        <i class="fas fa-times me-1"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-table me-2 text-primary"></i>
                        Liste des Utilisateurs
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="usersTable">
                            <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <tr class="text-white">
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user me-1"></i>
                                        Prénom
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user me-1"></i>
                                        Nom
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-calendar me-1"></i>
                                        Date de naissance
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-envelope me-1"></i>
                                        Email
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user-tag me-1"></i>
                                        Rôle
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-school me-1"></i>
                                        Établissement
                                    </th>
                                    <th class="border-0 py-3 text-center">
                                        <i class="fas fa-cogs me-1"></i>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @if($user->role !== 'admin')
                                <tr class="user-row">
                                    <td class="align-middle py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">
                                                {{ strtoupper(substr($user->prenom, 0, 1)) }}
                                            </div>
                                            <strong>{{ $user->prenom }}</strong>
                                        </div>
                                    </td>
                                    <td class="align-middle py-3">
                                        <strong>{{ $user->nom }}</strong>
                                    </td>
                                    <td class="align-middle py-3">
                                        <span class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $user->dateNaissance }}
                                        </span>
                                    </td>
                                    <td class="align-middle py-3">
                                        <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                            <i class="fas fa-envelope me-1 text-muted"></i>
                                            {{ $user->email }}
                                        </a>
                                    </td>
                                    <td class="align-middle py-3">
                                        @if($user->role == 'eleve')
                                            <span class="badge bg-success rounded-pill">
                                                <i class="fas fa-graduation-cap me-1"></i>
                                                Élève
                                            </span>
                                        @elseif($user->role == 'professeur')
                                            <span class="badge bg-warning rounded-pill">
                                                <i class="fas fa-chalkboard-teacher me-1"></i>
                                                Professeur
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle py-3">
                                        <span class="text-muted">
                                            <i class="fas fa-building me-1"></i>
                                            {{ $user->adresse }}
                                        </span>
                                    </td>
                                    <td class="align-middle py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" onclick="loadContent('admin/edit-user/{{ $user->id }}')" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Modifier">
                                                <i class="fas fa-edit me-1"></i>
                                                Modifier
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger" 
                                                    title="Supprimer"
                                                    onclick="deleteUser({{ $user->id }}, '{{ $user->prenom }} {{ $user->nom }}')">
                                                <i class="fas fa-trash me-1"></i>
                                                Supprimer
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
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
    
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 15px;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 1.5rem;
    }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.9rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
    }
    
    .btn-group .btn {
        transition: all 0.3s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
    }
    
    .card {
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
    }
</style>

<script>
    // Fonction de recherche
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterTable();
    });
    
    document.getElementById('roleFilter').addEventListener('change', function() {
        filterTable();
    });
    
    document.getElementById('establishmentFilter').addEventListener('change', function() {
        filterTable();
    });
    
    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;
        const establishmentFilter = document.getElementById('establishmentFilter').value;
        const rows = document.querySelectorAll('#usersTable tbody tr');
        
        rows.forEach(row => {
            const prenom = row.cells[0].textContent.toLowerCase();
            const nom = row.cells[1].textContent.toLowerCase();
            const email = row.cells[3].textContent.toLowerCase();
            const role = row.cells[4].textContent.toLowerCase();
            const etablissement = row.cells[5].textContent.toLowerCase();
            
            const matchesSearch = prenom.includes(searchTerm) || 
                                nom.includes(searchTerm) || 
                                email.includes(searchTerm);
            
            const matchesRole = !roleFilter || role.includes(roleFilter);
            const matchesEstablishment = !establishmentFilter || etablissement.includes(establishmentFilter.toLowerCase());
            
            if (matchesSearch && matchesRole && matchesEstablishment) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('roleFilter').value = '';
        document.getElementById('establishmentFilter').value = '';
        filterTable();
    }
    
    // Fonction de suppression d'utilisateur
    function deleteUser(userId, userName) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur "${userName}" ?`)) {
            // Afficher un indicateur de chargement
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Suppression...';
            button.disabled = true;
            
            // Envoyer la requête AJAX
            fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Afficher un message de succès
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    
                    // Insérer l'alerte en haut de la page
                    document.querySelector('.content-header').insertAdjacentElement('afterend', alertDiv);
                    
                    // Recharger la liste des utilisateurs
                    setTimeout(() => {
                        loadContent('users');
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Erreur lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                
                // Afficher un message d'erreur
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                alertDiv.innerHTML = `
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Erreur: ${error.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                // Insérer l'alerte en haut de la page
                document.querySelector('.content-header').insertAdjacentElement('afterend', alertDiv);
                
                // Restaurer le bouton
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }
    }
</script>