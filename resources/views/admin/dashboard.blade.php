@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex" style="min-height: 100vh;">
    <!-- Barre latérale -->
    <div class="bg-dark text-white p-3" style="width: 250px;">
        <h2>Menu Admin</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="dashboard">Tableau de bord</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Simulations</a></li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                    Gestion des Utilisateurs
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="container mt-4">
        <h1 class="text-white text-center">Bienvenue sur le Tableau de bord</h1>

        <div class="row">
            <!-- Bloc infos -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mt-4">Nombre d'Élèves</h5>
                        <p class="card-text">{{ $elevesCount }}</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de Professeurs</h5>
                        <p class="card-text">{{ $profsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Bloc diagramme circulaire -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 250px;">
                        <canvas id="userPieChart" width="180" height="180"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bloc graphique linéaire -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title text-center">Inscriptions par établissement</h5>
                <canvas id="lineChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Scripts graphiques -->
<canvas id="lineChart" width="400" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const lineCtx = document.getElementById("lineChart").getContext("2d");

    new Chart(lineCtx, {
        type: 'radar',
        data: {
            labels: [
                @foreach($stats as $item)
                    "{{ $item['adresse'] }}",
                @endforeach
            ],
            datasets: [
                {
                    label: 'Élèves',
                    data: [
                        @foreach($stats as $item)
                            {{ $item['eleves'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(66, 165, 245, 0.4)',
                    borderColor: '#42a5f5',
                    pointBackgroundColor: '#42a5f5'
                },
                {
                    label: 'Professeurs',
                    data: [
                        @foreach($stats as $item)
                            {{ $item['profs'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(102, 187, 106, 0.4)',
                    borderColor: '#66bb6a',
                    pointBackgroundColor: '#66bb6a'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            elements: {
                line: {
                    borderWidth: 2
                }
            }
        }
    });
</script>
<script>
    const pieCtx = document.getElementById('userPieChart').getContext('2d');

    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Élèves', 'Professeurs'],
            datasets: [{
                data: [{{ $elevesCount }}, {{ $profsCount }}],
                backgroundColor: ['#42a5f5', '#66bb6a'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            },
            maintainAspectRatio: false,
        }
    });
</script>


@endsection
