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
    <div class="header">
        <a href="{{ route('dashboard.intervenants') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour aux intervenants
        </a>
        <button class="close-vote-btn">
            <i class="fas fa-times-circle"></i> Clôturer le Vote
        </button>
    </div>

    <!-- Status Card -->
    <div class="status-card">
        <div class="status-info">
            <i class="fas fa-poll" style="font-size: 24px;"></i>
            <div>
                <div style="font-weight: bold; margin-bottom: 5px;">Statut</div>
                <span class="vote-actif">{{ $intervenant->statut == 'confirme' ? 'Vote actif' : 'En attente' }}</span>
            </div>
        </div>
        <div class="date-limite">
            Date limite<br>
            <strong>{{ \Carbon\Carbon::parse($intervenant->date ?? now())->format('d M Y à H:i') }}</strong>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="charts-row">
        <!-- Pie Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <i class="fas fa-chart-pie"></i>
                <h3>Répartition des votes</h3>
            </div>

            <div class="pie-chart">
                <canvas id="pieChart"></canvas>
            </div>

            <div class="legend">
                <div class="legend-item">
                    <div class="legend-label">
                        <span class="legend-color" style="background: #ff6b35;"></span>
                        <span>Classiques</span>
                    </div>
                    <span>{{ $stats['votes_classiques'] }}</span>
                </div>
                <div class="legend-item">
                    <div class="legend-label">
                        <span class="legend-color" style="background: #4dabf7;"></span>
                        <span>Hits</span>
                    </div>
                    <span>{{ $stats['votes_hits'] }}</span>
                </div>
            </div>

            <div class="total-votes">
                Total des votes
                <strong>{{ $stats['votes_classiques'] + $stats['votes_hits'] }}</strong>
            </div>
        </div>
    </div>

    <!-- Control Section -->
    <div class="control-section">
        <h3>Gestion et Contrôle</h3>

        <div class="playlists">
            <div class="playlist-card">
                <i class="fas fa-download"></i>
                <div class="playlist-info">
                    <h4>Classique</h4>
                    <p>PDF de paroles</p>
                </div>
            </div>
            <div class="playlist-card">
                <i class="fas fa-music"></i>
                <div class="playlist-info">
                    <h4>Hits</h4>
                    <p>PDF de paroles</p>
                </div>
            </div>
        </div>

        <div class="time-limit">
            <span class="time-limit-label">{{ \Carbon\Carbon::parse($intervenant->date ?? now())->format('d M Y') }}</span>
            <button class="extend-btn">
                <i class="fas fa-calendar-plus"></i>
                Mettre à jour
            </button>
        </div>
    </div>
</main>

@endsection

@push('scripts')
<script>
    // Pie Chart
    const pieCanvas = document.getElementById('pieChart');
    const pieCtx = pieCanvas.getContext('2d');
    pieCanvas.width = 200; pieCanvas.height = 200;

    const classiquesVotes = {{ $stats['votes_classiques'] }};
    const hitsVotes = {{ $stats['votes_hits'] }};
    const total = classiquesVotes + hitsVotes;

    const classiquesAngle = (classiquesVotes / total) * 2 * Math.PI;
    const hitsAngle = (hitsVotes / total) * 2 * Math.PI;

    const centerX = 100, centerY = 100, radius = 80;

    // Draw Classiques
    pieCtx.beginPath();
    pieCtx.arc(centerX, centerY, radius, 0, classiquesAngle);
    pieCtx.lineTo(centerX, centerY);
    pieCtx.fillStyle = '#ff6b35';
    pieCtx.fill();

    // Draw Hits
    pieCtx.beginPath();
    pieCtx.arc(centerX, centerY, radius, classiquesAngle, classiquesAngle + hitsAngle);
    pieCtx.lineTo(centerX, centerY);
    pieCtx.fillStyle = '#4dabf7';
    pieCtx.fill();
</script>
@endpush
