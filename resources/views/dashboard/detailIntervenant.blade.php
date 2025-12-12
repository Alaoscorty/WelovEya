@extends('layouts.application')

@section('title', 'Artistes')
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

        .close-vote-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

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

        .vote-actif {
            background: #ff6b35;
            color: #fff;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .date-limite {
            font-size: 13px;
            opacity: 0.9;
        }

        /* Charts Section */
        .charts-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
        }

        .chart-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .chart-header i {
            color: #4dabf7;
        }

        .chart-header h3 {
            font-size: 16px;
            font-weight: 600;
        }

        /* Pie Chart */
        .pie-chart {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 30px auto;
        }

        .legend {
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .legend-label {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .total-votes {
            
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
        }

        .total-votes strong {
            color: #f75e44ff;
            font-size: 20px;
            display: block;
            margin-top: 5px;
        }

        /* Bar Chart */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 250px;
            margin-top: 30px;
            position: relative;
        }

        .bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .bars {
            display: flex;
            gap: 5px;
            align-items: flex-end;
            height: 200px;
        }

        .bar {
            width: 20px;
            border-radius: 4px 4px 0 0;
            transition: all 0.3s;
        }

        .bar.classique {
            background: #4dabf7;
        }

        .bar.hits {
            background: #ff6b35;
        }

        .bar-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            transform: rotate(-45deg);
            white-space: nowrap;
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            font-size: 13px;
        }

        .chart-legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Control Section */
        .control-section {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .control-section h3 {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .playlists {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .playlist-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .playlist-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .playlist-card i {
            font-size: 24px;
            color: #f0f2f3ff;
        }

        .playlist-info h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .playlist-info p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .time-limit {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
        }

        .time-limit-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .extend-btn {
            background: #ff6b35;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .extend-btn:hover {
            background: #e55a2b;
            transform: translateY(-2px);
        }

        /* Publication Section */
        .publication-section {
            background: linear-gradient(135deg, #8b4513 0%, #654321 100%);
            border-radius: 15px;
            padding: 25px;
        }

        .publication-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .publication-section p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .publish-btn {
            background: #ff6b35;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .publish-btn:hover {
            background: #e55a2b;
            transform: translateY(-2px);
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
            <div class="header">
                <a href="{{route ('intervenants')}}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Votes pour : Nom_artiste
                </a>
                <button class="close-vote-btn">
                    <i class="fas fa-times-circle"></i>
                    Clôturer le Vote
                </button>
            </div>

            <!-- Status Card -->
            <div class="status-card">
                <div class="status-info">
                    <i class="fas fa-poll" style="font-size: 24px;"></i>
                    <div>
                        <div style="font-weight: bold; margin-bottom: 5px;">Statut</div>
                        <span class="vote-actif">Vote actif</span>
                    </div>
                </div>
                <div class="date-limite">
                    Date limite<br>
                    <strong>26 Décembre 2025 à 23:59</strong>
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
                            <span>95 Votes</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-label">
                                <span class="legend-color" style="background: #4dabf7;"></span>
                                <span>Hits</span>
                            </div>
                            <span>105 Votes</span>
                        </div>
                    </div>

                    <div class="total-votes">
                        Total des votes
                        <strong>200</strong>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <i class="fas fa-chart-bar"></i>
                        <h3>Évolution des votes</h3>
                    </div>

                    <div class="bar-chart" id="barChart"></div>

                    <div class="chart-legend">
                        <div class="chart-legend-item">
                            <span class="legend-color" style="background: #4dabf7;"></span>
                            <span>Classique</span>
                        </div>
                        <div class="chart-legend-item">
                            <span class="legend-color" style="background: #ff6b35;"></span>
                            <span>Hits</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Control Section -->
            <div class="control-section">
                <h3>Gestion et Contrôle</h3>
                
                <div style="font-size: 14px; margin-bottom: 15px; color: rgba(255, 255, 255, 0.7);">
                    Fiches de Paroles
                </div>

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

                <div style="font-size: 14px; margin-bottom: 15px; color: rgba(255, 255, 255, 0.7);">
                    Date/Heure limite du Vote
                </div>

                <div class="time-limit">
                    <span class="time-limit-label">26 Décembre 2025</span>
                    <button class="extend-btn">
                        <i class="fas fa-calendar-plus"></i>
                        Mettre à jour
                    </button>
                </div>
            </div>

            <!-- Publication Section -->
            <div class="publication-section">
                <h3>Publication des Paroles</h3>
                <p>
                    En publiant, les paroles de l'option gagnante 'Hits Rythmés et Danse' seront automatiquement affichées sur la page publique de l'artiste.
                </p>
                <button class="publish-btn">
                    <i class="fas fa-upload"></i>
                    Publier les paroles de "Hits"
                </button>
            </div>
        </main>
@endsection
    
<script>
         // Pie Chart
        const pieCanvas = document.getElementById('pieChart');
        const pieCtx = pieCanvas.getContext('2d');
        pieCanvas.width = 200;
        pieCanvas.height = 200;

        const classiquesVotes = 95;
        const hitsVotes = 105;
        const total = classiquesVotes + hitsVotes;

        const classiquesAngle = (classiquesVotes / total) * 2 * Math.PI;
        const hitsAngle = (hitsVotes / total) * 2 * Math.PI;

        const centerX = 100;
        const centerY = 100;
        const radius = 80;

        // Draw Classiques (orange)
        pieCtx.beginPath();
        pieCtx.arc(centerX, centerY, radius, 0, classiquesAngle);
        pieCtx.lineTo(centerX, centerY);
        pieCtx.fillStyle = '#ff6b35';
        pieCtx.fill();

        // Draw Hits (blue)
        pieCtx.beginPath();
        pieCtx.arc(centerX, centerY, radius, classiquesAngle, classiquesAngle + hitsAngle);
        pieCtx.lineTo(centerX, centerY);
        pieCtx.fillStyle = '#4dabf7';
        pieCtx.fill();

        // Bar Chart
        const barChartData = [
            { label: '2024', classique: 60, hits: 40 },
            { label: '2025', classique: 80, hits: 70 },
            { label: 'Q1', classique: 50, hits: 90 },
            { label: 'Q2', classique: 70, hits: 60 },
            { label: 'Q3', classique: 90, hits: 100 }
        ];

        const barChart = document.getElementById('barChart');
        const maxValue = 100;

        barChartData.forEach(data => {
            const barGroup = document.createElement('div');
            barGroup.className = 'bar-group';

            const bars = document.createElement('div');
            bars.className = 'bars';

            const classiqueBar = document.createElement('div');
            classiqueBar.className = 'bar classique';
            classiqueBar.style.height = `${(data.classique / maxValue) * 200}px`;

            const hitsBar = document.createElement('div');
            hitsBar.className = 'bar hits';
            hitsBar.style.height = `${(data.hits / maxValue) * 200}px`;

            bars.appendChild(classiqueBar);
            bars.appendChild(hitsBar);

            const label = document.createElement('div');
            label.className = 'bar-label';
            label.textContent = data.label;

            barGroup.appendChild(bars);
            barGroup.appendChild(label);
            barChart.appendChild(barGroup);
        });

        // Button interactions
        document.querySelector('.close-vote-btn').addEventListener('click', function() {
            alert('Vote clôturé !');
        });

        document.querySelector('.extend-btn').addEventListener('click', function() {
            alert('Extension de date demandée');
        });

        document.querySelector('.publish-btn').addEventListener('click', function() {
            alert('Paroles publiées avec succès !');
        });
    </script>
    @push('scripts')
@endpush
