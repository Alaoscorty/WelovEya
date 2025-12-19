@extends('layouts.application')
@section('title', 'Détails Intervenant')

<style>
.main-content {
    flex: 1;
    padding: 30px;
    overflow-y: auto;
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.back-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
}
.close-vote-btn {
    background: #dc3545;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    transition: all 0.3s;
}
.close-vote-btn:hover { background: #c82333; transform: translateY(-2px); }

/* Status Card */
.status-card {
    background: linear-gradient(135deg, #8b4513 0%, #654321 100%);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.status-info {
    display: flex;
    align-items: center;
    gap: 15px;
}
.vote-actif { background: #ff6b35; color: #fff; padding: 8px 20px; border-radius: 20px; font-size: 13px; font-weight: bold; }
.date-limite { font-size: 13px; opacity: 0.9; }

/* Charts Section */
.charts-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 30px;
}
.chart-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 25px;
}
.chart-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}
.chart-header i { color: #4dabf7; }
.chart-header h3 { font-size: 16px; font-weight: 600; }

.pie-chart { position: relative; width: 200px; height: 200px; margin: 30px auto; }
.legend { margin-top: 20px; }
.legend-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 14px; }
.legend-label { display: flex; align-items: center; gap: 10px; }
.legend-color { width: 12px; height: 12px; border-radius: 50%; }
.total-votes { text-align: center; margin-top: 15px; font-size: 13px; color: rgba(255,255,255,0.6); }
.total-votes strong { color: #f75e44ff; font-size: 20px; display: block; margin-top: 5px; }

/* Control Section */
.control-section {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
}
.control-section h3 { font-size: 16px; margin-bottom: 20px; }
.playlists { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px; }
.playlist-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: all 0.3s;
}
.playlist-card:hover { background: rgba(255,255,255,0.08); transform: translateY(-2px); }
.playlist-card i { font-size: 24px; color: #f0f2f3ff; }
.playlist-info h4 { font-size: 14px; font-weight: 600; margin-bottom: 3px; }
.playlist-info p { font-size: 12px; color: rgba(255,255,255,0.5); }
.time-limit { display: flex; align-items: center; justify-content: space-between; padding: 20px; background: rgba(255,255,255,0.03); border-radius: 10px; }
.time-limit-label { font-size: 14px; color: rgba(255,255,255,0.7); }
.extend-btn { background: #ff6b35; color: #fff; border: none; padding: 10px 25px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.3s; }
.extend-btn:hover { background: #e55a2b; transform: translateY(-2px); }
</style>
@section('content')
<main class="main-content">
    <!-- HEADER -->
    <div class="header">
        <a href="{{ route('dashboard.intervenants') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Votes pour : {{ $intervenant->nom }}
        </a>
        @if($intervenant->vote_actif)
        <form action="{{ route('votes.close', $intervenant->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="close-vote-btn">
                <i class="fas fa-times-circle"></i>
                Clôturer le Vote
            </button>
        </form>
        @endif
    </div>

    <!-- STATUS CARD -->
    <div class="status-card">
        <div class="status-info">
            <i class="fas fa-poll" style="font-size: 24px;"></i>
            <div>
                <div style="font-weight: bold; margin-bottom: 5px;">Statut</div>
                <span class="vote-actif">{{ $intervenant->vote_actif ? 'Vote actif' : 'Vote clos' }}</span>
            </div>
        </div>
        <div class="date-limite">
            Date limite<br>
            <strong>{{ $intervenant->date_limite?->format('d F Y à H:i') ?? 'Non définie' }}</strong>
        </div>
    </div>

    <!-- CHARTS ROW -->
    <div class="charts-row">
        <!-- PIE CHART -->
        <div class="chart-card">
            <div class="chart-header">
                <i class="fas fa-chart-pie"></i>
                <h3>Répartition des votes</h3>
            </div>
            
            <div class="pie-chart">
                <canvas id="pieChart"></canvas>
            </div>

            <div class="legend">
                @foreach($votesByOption as $option => $count)
                <div class="legend-item">
                    <div class="legend-label">
                        <span class="legend-color" style="background: {{ $colors[$option] ?? '#000' }}"></span>
                        <span>{{ $option }}</span>
                    </div>
                    <span>{{ $count }} Votes</span>
                </div>
                @endforeach
            </div>

            <div class="total-votes">
                Total des votes
                <strong>{{ array_sum($votesByOption) }}</strong>
            </div>
        </div>

        <!-- BAR CHART -->
        <div class="chart-card">
            <div class="chart-header">
                <i class="fas fa-chart-bar"></i>
                <h3>Évolution des votes</h3>
            </div>

            <div class="bar-chart" id="barChart"></div>

            <div class="chart-legend">
                @foreach($votesByOption as $option => $count)
                <div class="chart-legend-item">
                    <span class="legend-color" style="background: {{ $colors[$option] ?? '#000' }}"></span>
                    <span>{{ $option }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CONTROL SECTION -->
    <div class="control-section">
        <h3>Gestion et Contrôle</h3>
        
        <div style="font-size: 14px; margin-bottom: 15px; color: rgba(255, 255, 255, 0.7);">
            Fiches de Paroles
        </div>

        <div class="playlists">
            @foreach($options as $option)
            <div class="playlist-card">
                <i class="{{ $option['icon'] }}"></i>
                <div class="playlist-info">
                    <h4>{{ $option['name'] }}</h4>
                    <p>{{ $option['file'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div style="font-size: 14px; margin-bottom: 15px; color: rgba(255, 255, 255, 0.7);">
            Date/Heure limite du Vote
        </div>

        <div class="time-limit">
            <span class="time-limit-label">{{ $intervenant->date_limite?->format('d F Y') ?? 'Non définie' }}</span>
            <button class="extend-btn">
                <i class="fas fa-calendar-plus"></i>
                Étendre la date
            </button>
        </div>
    </div>

    <!-- PUBLICATION SECTION -->
    <div class="publication-section">
        <h3>Publication des Paroles</h3>
        <p>
            En publiant, les paroles de l'option gagnante '{{ $winningOption }}' seront automatiquement affichées sur la page publique de l'artiste.
        </p>
        <button class="publish-btn">
            <i class="fas fa-upload"></i>
            Publier les paroles de "{{ $winningOption }}"
        </button>
    </div>
</main>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Données pour Pie Chart
    const pieData = {
        labels: {!! json_encode(array_keys($votesByOption)) !!},
        datasets: [{
            data: {!! json_encode(array_values($votesByOption)) !!},
            backgroundColor: {!! json_encode(array_values($colors)) !!}
        }]
    };

    const pieConfig = {
        type: 'pie',
        data: pieData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        },
    };

    new Chart(
        document.getElementById('pieChart'),
        pieConfig
    );

    // Données pour Bar Chart (simple exemple)
    const barData = {
        labels: {!! json_encode(array_keys($votesByOption)) !!},
        datasets: [{
            label: 'Votes',
            data: {!! json_encode(array_values($votesByOption)) !!},
            backgroundColor: {!! json_encode(array_values($colors)) !!}
        }]
    };

    const barConfig = {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        },
    };

    new Chart(
        document.getElementById('barChart'),
        barConfig
    );
</script>
@endsection
