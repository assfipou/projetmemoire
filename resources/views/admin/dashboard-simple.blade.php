@extends('layouts.app')

@section('title', 'Dashboard Simple')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Dashboard Simple - Test</h1>
    
    <!-- Affichage des données brutes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Données brutes</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li><strong>Élèves :</strong> {{ $elevesCount ?? 'Non défini' }}</li>
                        <li><strong>Professeurs :</strong> {{ $profsCount ?? 'Non défini' }}</li>
                        <li><strong>Administrateurs :</strong> {{ $adminCount ?? 'Non défini' }}</li>
                        <li><strong>Total :</strong> {{ $totalUsers ?? 'Non défini' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes simples -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h3>{{ $elevesCount ?? 0 }}</h3>
                    <p>Élèves</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h3>{{ $profsCount ?? 0 }}</h3>
                    <p>Professeurs</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body text-center">
                    <h3>{{ $adminCount ?? 0 }}</h3>
                    <p>Administrateurs</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body text-center">
                    <h3>{{ $totalUsers ?? 0 }}</h3>
                    <p>Total</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Test de graphique simple -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Graphique simple</h5>
                </div>
                <div class="card-body">
                    <canvas id="simpleChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('Dashboard Simple - Données reçues:', {
        elevesCount: {{ $elevesCount ?? 0 }},
        profsCount: {{ $profsCount ?? 0 }},
        adminCount: {{ $adminCount ?? 0 }},
        totalUsers: {{ $totalUsers ?? 0 }}
    });
    
    const ctx = document.getElementById('simpleChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Élèves', 'Professeurs', 'Administrateurs'],
                datasets: [{
                    label: 'Nombre d\'utilisateurs',
                    data: [{{ $elevesCount ?? 0 }}, {{ $profsCount ?? 0 }}, {{ $adminCount ?? 0 }}],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        console.log('Graphique simple créé avec succès');
    } else {
        console.error('Canvas simpleChart non trouvé');
    }
});
</script>
@endpush 