<div class="container-fluid py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fas fa-flask me-3"></i>
                                Gestion des Simulations
                            </h1>
                            <p class="lead mb-0">Administrez et configurez les simulations disponibles</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="me-3">
                                    <h4 class="mb-0 fw-bold">5</h4>
                                    <small>Simulations actives</small>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                    <i class="fas fa-flask fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des simulations -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body text-center">
                    <div class="icon-container bg-gradient-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width:60px; height:60px; margin: 0 auto;">
                        <i class="fas fa-play fa-2x"></i>
                    </div>
                    <h3 class="mb-1 fw-bold text-success">5</h3>
                    <p class="text-muted mb-0">Simulations Actives</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body text-center">
                    <div class="icon-container bg-gradient-info text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width:60px; height:60px; margin: 0 auto;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="mb-1 fw-bold text-info">1,247</h3>
                    <p class="text-muted mb-0">Utilisations Totales</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body text-center">
                    <div class="icon-container bg-gradient-warning text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width:60px; height:60px; margin: 0 auto;">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <h3 class="mb-1 fw-bold text-warning">4.8</h3>
                    <p class="text-muted mb-0">Note Moyenne</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-body text-center">
                    <div class="icon-container bg-gradient-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm mb-3" style="width:60px; height:60px; margin: 0 auto;">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h3 class="mb-1 fw-bold text-danger">2</h3>
                    <p class="text-muted mb-0">En Maintenance</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des simulations -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Simulations Disponibles
                        </h5>
                        <button class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="fas fa-plus me-1"></i>
                            Nouvelle Simulation
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <tr class="text-white">
                                    <th class="border-0 py-3">
                                        <i class="fas fa-flask me-1"></i>
                                        Nom de la Simulation
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-tag me-1"></i>
                                        Catégorie
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-users me-1"></i>
                                        Utilisations
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-star me-1"></i>
                                        Note
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-toggle-on me-1"></i>
                                        Statut
                                    </th>
                                    <th class="border-0 py-3 text-center">
                                        <i class="fas fa-cogs me-1"></i>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="simulation-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                                <i class="fas fa-flask text-white"></i>
                                            </div>
                                            <div>
                                                <strong>Simulation Acide-Base</strong>
                                                <br><small class="text-muted">Titrage et pH</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle py-3">
                                        <span class="badge bg-primary rounded-pill">Chimie Générale</span>
                                    </td>
                                    <td class="align-middle py-3">
                                        <span class="text-muted">
                                            <i class="fas fa-users me-1"></i>
                                            342 utilisations
                                        </span>
                                    </td>
                                    <td class="align-middle py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            <span class="fw-bold">4.9</span>
                                        </div>
                                    </td>
                                    <td class="align-middle py-3">
                                        <span class="badge bg-success rounded-pill">
                                            <i class="fas fa-check me-1"></i>
                                            Actif
                                        </span>
                                    </td>
                                    <td class="align-middle py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Désactiver">
                                                <i class="fas fa-pause"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 