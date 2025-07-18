<div class="container-fluid py-4">
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

        <!-- Stats cards -->
        <div class="container-fluid p-4">
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm stat-card">
                        <div class="card-body text-center">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <h3 class="mt-3 mb-1">{{ $users->where('role', '!=', 'admin')->count() ?? 0 }}</h3>
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
                            <h3 class="mt-3 mb-1">{{ $users->where('role', 'eleve')->count() ?? 0 }}</h3>
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
                            <h3 class="mt-3 mb-1">{{ $users->where('role', 'professeur')->count() ?? 0 }}</h3>
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
                            <h3 class="mt-3 mb-1">{{ $users->where('role', '!=', 'admin')->pluck('adresse')->unique()->count() ?? 0 }}</h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                Établissements
                            </p>
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
                                @if(isset($users) && $users->count() > 0)
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
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                                    <i class="fas fa-edit me-1"></i>
                                                    Modifier
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                    <i class="fas fa-trash me-1"></i>
                                                    Supprimer
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Aucun utilisateur trouvé</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 