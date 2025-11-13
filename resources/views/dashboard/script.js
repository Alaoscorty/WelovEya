// Configuration du graphique
const ctx = document.getElementById('revenueChart').getContext('2d');

// Données du graphique
const chartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
        {
            label: 'Revenus',
            data: [45000, 55000, 48000, 60000, 75000, 85000, 95000, 110000, 125000, 140000, 155000, 175000],
            borderColor: '#ff8c42',
            backgroundColor: (context) => {
                const ctx = context.chart.ctx;
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(255, 140, 66, 0.3)');
                gradient.addColorStop(0.5, 'rgba(255, 140, 66, 0.15)');
                gradient.addColorStop(1, 'rgba(255, 140, 66, 0.05)');
                return gradient;
            },
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 0,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#ff8c42',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 2
        },
        {
            label: 'Dépenses',
            data: [30000, 38000, 42000, 48000, 52000, 58000, 65000, 72000, 80000, 88000, 95000, 105000],
            borderColor: '#a855f7',
            backgroundColor: (context) => {
                const ctx = context.chart.ctx;
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(168, 85, 247, 0.3)');
                gradient.addColorStop(0.5, 'rgba(168, 85, 247, 0.15)');
                gradient.addColorStop(1, 'rgba(168, 85, 247, 0.05)');
                return gradient;
            },
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 0,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#a855f7',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 2,
            hidden: true
        }
    ]
};

// Configuration du graphique
const config = {
    type: 'line',
    data: chartData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: true,
                backgroundColor: '#1a1f3a',
                titleColor: '#fff',
                bodyColor: '#9ca3af',
                borderColor: '#2a2f4a',
                borderWidth: 1,
                padding: 12,
                displayColors: true,
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += context.parsed.y.toLocaleString() + ' FCFA';
                        }
                        return label;
                    },
                    afterLabel: function(context) {
                        const date = 'Novembre 21, 2024';
                        return date;
                    }
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 11
                    }
                }
            },
            y: {
                beginAtZero: true,
                max: 250000,
                grid: {
                    color: 'rgba(255, 255, 255, 0.05)',
                    drawBorder: false
                },
                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 11
                    },
                    stepSize: 50000,
                    callback: function(value) {
                        return value / 1000 + 'k';
                    }
                }
            }
        }
    }
};

// Créer le graphique
const revenueChart = new Chart(ctx, config);

// Gestion des boutons de légende
const legendButtons = document.querySelectorAll('.legend-btn');

legendButtons.forEach((btn, index) => {
    btn.addEventListener('click', function() {
        // Retirer la classe active de tous les boutons
        legendButtons.forEach(b => b.classList.remove('active'));
        
        // Ajouter la classe active au bouton cliqué
        this.classList.add('active');
        
        // Afficher/masquer les datasets
        revenueChart.data.datasets.forEach((dataset, i) => {
            dataset.hidden = (i !== index);
        });
        
        revenueChart.update();
    });
});

// Animation au chargement
window.addEventListener('load', function() {
    revenueChart.update('show');
});