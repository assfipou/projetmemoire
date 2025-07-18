<div class="container-fluid py-4">
    <!-- En-tête du dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fas fa-tachometer-alt me-3"></i>
                                Tableau de Bord Administrateur
                            </h1>
                            <p class="lead mb-0">Gestion et analyse de votre plateforme éducative</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="me-3">
                                    <h4 class="mb-0 fw-bold">{{ $totalUsers ?? 0 }}</h4>
                                    <small>Utilisateurs totaux</small>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message d'information avec les nombres -->
   
    <!-- Cartes de statistiques principales -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg h-100 stats-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:60px; height:60px;">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted text-uppercase fw-bold">
                                <i class="fas fa-user-graduate me-1"></i>Élèves
                            </h6>
                            <h2 class="mb-0 text-primary fw-bold">{{ $elevesCount ?? 0 }}</h2>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                {{ $totalUsers > 0 ? round((($elevesCount ?? 0) / $totalUsers) * 100, 1) : 0 }}% du total
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg h-100 stats-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-gradient-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:60px; height:60px;">
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted text-uppercase fw-bold">
                                <i class="fas fa-chalkboard-teacher me-1"></i>Professeurs
                            </h6>
                            <h2 class="mb-0 text-success fw-bold">{{ $profsCount ?? 0 }}</h2>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                {{ $totalUsers > 0 ? round((($profsCount ?? 0) / $totalUsers) * 100, 1) : 0 }}% du total
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg h-100 stats-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-gradient-warning text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:60px; height:60px;">
                            <i class="fas fa-user-shield fa-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted text-uppercase fw-bold">
                                <i class="fas fa-user-shield me-1"></i>Administrateurs
                            </h6>
                            <h2 class="mb-0 text-warning fw-bold">{{ $adminCount ?? 0 }}</h2>
                            <small class="text-warning">
                                <i class="fas fa-shield-alt me-1"></i>
                                Accès complet
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- Graphique circulaire - Répartition des rôles -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>
                        Répartition des Rôles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Affichage simple des données -->
                        <div class="col-md-6 text-center">
                            <div class="data-display">
                                <h5 class="fw-bold text-primary mb-4">
                                    <i class="fas fa-chart-pie me-2"></i>
                                    Répartition des Rôles
                                </h5>
                                
                                @php
                                    $elevesPercent = $totalUsers > 0 ? ($elevesCount / $totalUsers) * 100 : 0;
                                    $profsPercent = $totalUsers > 0 ? ($profsCount / $totalUsers) * 100 : 0;
                                    $adminsPercent = $totalUsers > 0 ? ($adminCount / $totalUsers) * 100 : 0;
                                @endphp
                                
                                <!-- Carte Élèves -->
                                <div class="data-card eleves mb-3">
                                    <div class="data-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="data-content">
                                        <h4 class="mb-1">{{ $elevesCount ?? 0 }}</h4>
                                        <p class="mb-0">Élèves</p>
                                        <small class="text-muted">{{ round($elevesPercent, 1) }}% du total</small>
                                    </div>
                                </div>
                                
                                <!-- Carte Professeurs -->
                                <div class="data-card profs mb-3">
                                    <div class="data-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="data-content">
                                        <h4 class="mb-1">{{ $profsCount ?? 0 }}</h4>
                                        <p class="mb-0">Professeurs</p>
                                        <small class="text-muted">{{ round($profsPercent, 1) }}% du total</small>
                                    </div>
                                </div>
                                
                                <!-- Carte Administrateurs -->
                                <div class="data-card admins mb-3">
                                    <div class="data-icon">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <div class="data-content">
                                        <h4 class="mb-1">{{ $adminCount ?? 0 }}</h4>
                                        <p class="mb-0">Administrateurs</p>
                                        <small class="text-muted">{{ round($adminsPercent, 1) }}% du total</small>
                                    </div>
                                </div>
                                
                                <!-- Total -->
                                <div class="total-display mt-4">
                                    <div class="total-circle">
                                        <h3 class="mb-0 fw-bold text-white">{{ $totalUsers ?? 0 }}</h3>
                                        <small class="text-white-50">Total Utilisateurs</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Légende -->
                        <div class="col-md-6">
                            <div class="legend-container">
                                <div class="legend-item">
                                    <div class="legend-color eleves"></div>
                                    <div class="legend-text">
                                        <strong>Élèves</strong>
                                        <br>
                                        <span class="text-muted">{{ $elevesCount ?? 0 }} utilisateurs ({{ round($elevesPercent, 1) }}%)</span>
                                    </div>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color profs"></div>
                                    <div class="legend-text">
                                        <strong>Professeurs</strong>
                                        <br>
                                        <span class="text-muted">{{ $profsCount ?? 0 }} utilisateurs ({{ round($profsPercent, 1) }}%)</span>
                                    </div>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color admins"></div>
                                    <div class="legend-text">
                                        <strong>Administrateurs</strong>
                                        <br>
                                        <span class="text-muted">{{ $adminCount ?? 0 }} utilisateurs ({{ round($adminsPercent, 1) }}%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau récapitulatif -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table me-2"></i>
                        Récapitulatif Détaillé par Établissement
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-building me-2"></i>Établissement</th>
                                    <th><i class="fas fa-user-graduate me-2"></i>Élèves</th>
                                    <th><i class="fas fa-chalkboard-teacher me-2"></i>Professeurs</th>
                                    <th><i class="fas fa-users me-2"></i>Total</th>
                                    <th><i class="fas fa-percentage me-2"></i>Pourcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($topAddresses) && $topAddresses->count() > 0)
                                    @foreach($topAddresses as $address)
                                    <tr>
                                        <td>
                                            <i class="fas fa-building text-primary me-2"></i>
                                            <strong>{{ $address['adresse'] }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary fs-6">{{ $address['eleves'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success fs-6">{{ $address['profs'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info fs-6">{{ $address['eleves'] + $address['profs'] }}</span>
                                        </td>
                                        <td>
                                            {{ $totalUsers > 0 ? round((($address['eleves'] + $address['profs']) / $totalUsers) * 100, 1) : 0 }}%
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Aucune donnée d'établissement disponible</p>
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

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stats-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    
    .icon-container {
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover .icon-container {
        transform: scale(1.1);
    }
    
    .chart-center-stats {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 10;
    }
    
    .stat-item {
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        background-color: #f8f9fa;
        transform: translateY(-3px);
    }
    
    .card {
        border-radius: 15px;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
    }
    
    .badge {
        font-size: 0.9em !important;
    }
    
    /* Styles pour l'affichage des données */
    .data-display {
        padding: 20px;
    }
    
    .data-card {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 15px;
    }
    
    .data-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .data-card.eleves {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .data-card.profs {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: white;
    }
    
    .data-card.admins {
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
    }
    
    .data-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.5em;
    }
    
    .data-content {
        flex-grow: 1;
    }
    
    .data-content h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8em;
    }
    
    .data-content p {
        margin: 0;
        font-weight: 600;
        font-size: 1.1em;
    }
    
    .data-content small {
        opacity: 0.8;
    }
    
    .legend-container {
        padding: 20px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    
    .legend-item:hover {
        background-color: #f8f9fa;
    }
    
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .legend-color.eleves {
        background-color: #667eea;
    }
    
    .legend-color.profs {
        background-color: #4facfe;
    }
    
    .legend-color.admins {
        background-color: #f093fb;
    }
    
    .legend-text {
        flex-grow: 1;
    }
    
    .legend-text strong {
        color: #333;
        font-size: 1.1em;
    }
    
    .legend-text .text-muted {
        font-size: 0.9em;
    }
</style>

<script>
// Script simple pour confirmer le chargement
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard content loaded with data cards');
});
</script> 