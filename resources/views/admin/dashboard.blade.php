@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

@section('content')
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
                                    <h4 class="mb-0 fw-bold">{{ $totalUsers }}</h4>
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
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info">
                <h5><i class="fas fa-info-circle me-2"></i>Statistiques actuelles :</h5>
                <ul class="mb-0">
                    <li><i class="fas fa-user-graduate me-2 text-primary"></i><strong>Élèves :</strong> {{ $elevesCount }} utilisateurs</li>
                    <li><i class="fas fa-chalkboard-teacher me-2 text-success"></i><strong>Professeurs :</strong> {{ $profsCount }} utilisateurs</li>
                    <li><i class="fas fa-user-shield me-2 text-warning"></i><strong>Administrateurs :</strong> {{ $adminCount }} utilisateurs</li>
                    <li><i class="fas fa-users me-2 text-info"></i><strong>Total :</strong> {{ $totalUsers }} utilisateurs</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques principales -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-lg h-100 stats-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm me-4" style="width:60px; height:60px;">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted text-uppercase fw-bold">
                                <i class="fas fa-user-graduate me-1"></i>Élèves
                            </h6>
                            <h2 class="mb-0 text-primary fw-bold">
                                <i class="fas fa-user-graduate me-2"></i>{{ $elevesCount }}
                            </h2>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                {{ $totalUsers > 0 ? round(($elevesCount / $totalUsers) * 100, 1) : 0 }}% du total
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
                        <div class="icon-container bg-gradient-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm me-4" style="width:60px; height:60px;">
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted text-uppercase fw-bold">
                                <i class="fas fa-chalkboard-teacher me-1"></i>Professeurs
                            </h6>
                            <h2 class="mb-0 text-success fw-bold">
                                <i class="fas fa-chalkboard-teacher me-2"></i>{{ $profsCount }}
                            </h2>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                {{ $totalUsers > 0 ? round(($profsCount / $totalUsers) * 100, 1) : 0 }}% du total
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
                            <h2 class="mb-0 text-warning fw-bold">
                                <i class="fas fa-user-shield me-2"></i>{{ $adminCount }}
                            </h2>
                            <small class="text-warning">
                                <i class="fas fa-shield-alt me-1"></i>
                                Accès complet
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques en barres et en ligne -->
    <div class="row mb-4">
        <!-- Graphique en barres - Répartition par établissement -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                        Répartition par Établissement
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="establishmentChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique en ligne - Évolution des inscriptions -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-line me-2 text-success"></i>
                        Évolution Mensuelle
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="evolutionChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques circulaires améliorés -->
    <div class="row mb-4">
        <!-- Graphique circulaire - Répartition des rôles -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-pie me-2 text-warning"></i>
                        Répartition par Rôle
                    </h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="position: relative; width: 300px; height: 300px;">
                        <canvas id="rolePieChart"></canvas>
                        <div class="chart-center-stats">
                            <div class="text-center">
                                <h3 class="mb-0 fw-bold text-warning">{{ $totalUsers }}</h3>
                                <small class="text-muted">Total Utilisateurs</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphique en anneau - Répartition élèves/professeurs -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-doughnut me-2 text-info"></i>
                        Répartition Élèves/Professeurs
                    </h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="position: relative; width: 300px; height: 300px;">
                        <canvas id="doughnutChart"></canvas>
                        <div class="chart-center-stats">
                            <div class="text-center">
                                <h3 class="mb-0 fw-bold text-info">{{ $elevesCount + $profsCount }}</h3>
                                <small class="text-muted">Élèves + Profs</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique radar - Statistiques détaillées -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-chart-radar me-2 text-danger"></i>
                        Analyse Détaillée de la Plateforme
                    </h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="width: 400px; height: 400px;">
                        <canvas id="radarChart"></canvas>
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
                        Récapitulatif Détaillé par Adresse
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-map-marker-alt me-2"></i>Adresse</th>
                                    <th><i class="fas fa-user-graduate me-2"></i>Élèves</th>
                                    <th><i class="fas fa-chalkboard-teacher me-2"></i>Professeurs</th>
                                    <th><i class="fas fa-users me-2"></i>Total</th>
                                    <th><i class="fas fa-percentage me-2"></i>Pourcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topAddresses as $address)
                                <tr>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <strong>{{ $address['adresse'] }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $address['eleves'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $address['profs'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $address['total'] }}</span>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-gradient-primary" 
                                                 style="width: {{ $address['percentage'] }}%">
                                                {{ round($address['percentage'], 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard script loaded');
    
    // Vérifier si Chart.js est chargé
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded!');
        document.body.innerHTML += '<div style="background:red;color:white;padding:20px;text-align:center;">ERREUR: Chart.js non chargé</div>';
        return;
    }
    
    console.log('Chart.js loaded successfully');
    
    // Configuration globale de Chart.js
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#6c757d';

    // Données pour les graphiques
    const establishmentData = @json($topAddresses);
    console.log('Establishment data:', establishmentData);
    
    const labels = establishmentData.map(item => item.adresse);
    const elevesData = establishmentData.map(item => item.eleves);
    const profsData = establishmentData.map(item => item.profs);
    
    console.log('Labels:', labels);
    console.log('Eleves data:', elevesData);
    console.log('Profs data:', profsData);

    // Vérifier si les canvas existent
    const establishmentCanvas = document.getElementById('establishmentChart');
    const evolutionCanvas = document.getElementById('evolutionChart');
    const rolePieCanvas = document.getElementById('rolePieChart');
    const doughnutCanvas = document.getElementById('doughnutChart');
    const radarCanvas = document.getElementById('radarChart');
    
    console.log('Canvas elements:', {
        establishment: establishmentCanvas,
        evolution: evolutionCanvas,
        rolePie: rolePieCanvas,
        doughnut: doughnutCanvas,
        radar: radarCanvas
    });

    // Graphique en barres - Répartition par établissement
    if (establishmentCanvas) {
        const establishmentCtx = establishmentCanvas.getContext('2d');
        console.log('Creating establishment chart...');
        new Chart(establishmentCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Élèves',
                    data: elevesData,
                    backgroundColor: 'rgba(40, 167, 69, 0.8)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }, {
                    label: 'Professeurs',
                    data: profsData,
                    backgroundColor: 'rgba(255, 193, 7, 0.8)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        console.log('Establishment chart created successfully');
    } else {
        console.error('Establishment canvas not found');
    }

    // Graphique en ligne - Évolution mensuelle (simulé)
    if (evolutionCanvas) {
        const evolutionCtx = evolutionCanvas.getContext('2d');
        const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        const evolutionData = [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45];
        
        console.log('Creating evolution chart...');
        new Chart(evolutionCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Nouveaux utilisateurs',
                    data: evolutionData,
                    borderColor: 'rgba(220, 53, 69, 1)',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(220, 53, 69, 1)',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        console.log('Evolution chart created successfully');
    } else {
        console.error('Evolution canvas not found');
    }

    // Graphique circulaire - Répartition des rôles
    if (rolePieCanvas) {
        const rolePieCtx = rolePieCanvas.getContext('2d');
        // Récupérer les données, forcer à 0 si null ou undefined
        const eleves = Number.isFinite({{ $elevesCount ?? 0 }}) ? {{ $elevesCount ?? 0 }} : 0;
        const profs = Number.isFinite({{ $profsCount ?? 0 }}) ? {{ $profsCount ?? 0 }} : 0;
        const admins = Number.isFinite({{ $adminCount ?? 0 }}) ? {{ $adminCount ?? 0 }} : 0;
        try {
            new Chart(rolePieCtx, {
                type: 'pie',
                data: {
                    labels: ['Élèves', 'Professeurs', 'Administrateurs'],
                    datasets: [{
                        data: [eleves, profs, admins],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(220, 53, 69, 1)'
                        ],
                        borderWidth: 3,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white'
                        }
                    }
                }
            });
            console.log('Role pie chart created successfully');
        } catch (e) {
            console.error('Erreur lors de la création du diagramme circulaire :', e);
            const errorDiv = document.createElement('div');
            errorDiv.style.background = 'red';
            errorDiv.style.color = 'white';
            errorDiv.style.padding = '20px';
            errorDiv.style.textAlign = 'center';
            errorDiv.innerText = 'Erreur : le diagramme circulaire n\'a pas pu être généré.';
            rolePieCanvas.parentNode.appendChild(errorDiv);
        }
    } else {
        console.error('Role pie canvas not found');
    }

    // Graphique en anneau - Répartition élèves/professeurs
    if (doughnutCanvas) {
        const doughnutCtx = doughnutCanvas.getContext('2d');
        console.log('Creating doughnut chart...');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Élèves', 'Professeurs'],
                datasets: [{
                    data: [{{ $elevesCount }}, {{ $profsCount }}],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
                        'rgba(255, 193, 7, 1)'
                    ],
                    borderWidth: 3,
                    cutout: '60%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white'
                    }
                }
            }
        });
        console.log('Doughnut chart created successfully');
    } else {
        console.error('Doughnut canvas not found');
    }

    // Graphique radar - Analyse détaillée
    if (radarCanvas) {
        const radarCtx = radarCanvas.getContext('2d');
        console.log('Creating radar chart...');
        new Chart(radarCtx, {
            type: 'radar',
            data: {
                labels: ['Élèves', 'Professeurs', 'Administrateurs', 'Établissements', 'Âge Moyen', 'Engagement'],
                datasets: [{
                    label: 'Métriques actuelles',
                    data: [
                        {{ $elevesCount }},
                        {{ $profsCount }},
                        {{ $adminCount }},
                        {{ count($topAddresses) }},
                        {{ $averageAge }},
                        85 // Engagement simulé
                    ],
                    backgroundColor: 'rgba(220, 53, 69, 0.2)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(220, 53, 69, 1)',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white'
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        pointLabels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
        console.log('Radar chart created successfully');
    } else {
        console.error('Radar canvas not found');
    }
    
    console.log('All charts initialization completed');
});
</script>

<style>
.stats-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.chart-center-stats {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    pointer-events: none;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #198754, #157347);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #0dcaf0, #0aa2c0);
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #bb2d3b);
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    border-radius: 10px;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-size: 0.875em;
    padding: 0.5em 0.75em;
}
</style>
@endsection