@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
    <div class="flex min-h-screen">

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 lg:p-10 overflow-y-auto bg-[#0a0d1f]">
            <!-- Header -->
            <header class="mb-7">
                <h1 class="text-2xl md:text-3xl font-bold mb-1.5 text-white">Tableau de bord</h1>
                <p class="text-gray-400 text-xs md:text-sm">Vue d'ensemble de l'événement et de vos performance</p>
            </header>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-7">
                <!-- Stat Card 1 -->
                <div class="bg-[#141938] p-5 rounded-xl border border-white/5">
                    <div class="flex justify-between items-center mb-3.5">
                        <span class="text-xs text-gray-400 font-medium">Tickets Vendus</span>
                        <i class="fas fa-ticket-alt text-lg text-[#ff8c42]"></i>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="text-2xl font-bold text-white">{{ $ticketsSold ?? '2,847' }}</span>
                        <span class="text-[11px] font-semibold px-2 py-1 rounded-md text-[#10b981] bg-[#10b981]/15">+24%</span>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-[#141938] p-5 rounded-xl border border-white/5">
                    <div class="flex justify-between items-center mb-3.5">
                        <span class="text-xs text-gray-400 font-medium">Revendeurs Actifs</span>
                        <i class="fas fa-users text-lg text-[#ff8c42]"></i>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="text-2xl font-bold text-white">{{ $activeResellers ?? '156' }}</span>
                        <span class="text-[11px] font-semibold px-2 py-1 rounded-md text-[#10b981] bg-[#10b981]/15">+24%</span>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-[#141938] p-5 rounded-xl border border-white/5">
                    <div class="flex justify-between items-center mb-3.5">
                        <span class="text-xs text-gray-400 font-medium">Revenus Totaux</span>
                        <i class="fas fa-coins text-lg text-[#ff8c42]"></i>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="text-2xl font-bold text-white">{{ $totalRevenue ?? '200 000' }} FCFA</span>
                        <span class="text-[11px] font-semibold px-2 py-1 rounded-md text-[#10b981] bg-[#10b981]/15">+24%</span>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-[#141938] p-5 rounded-xl border border-white/5">
                    <div class="flex justify-between items-center mb-3.5">
                        <span class="text-xs text-gray-400 font-medium">Bénéfices</span>
                        <i class="fas fa-chart-line text-lg text-[#ff8c42]"></i>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="text-2xl font-bold text-white">{{ $benefits ?? '150 000' }} FCFA</span>
                        <span class="text-[11px] font-semibold px-2 py-1 rounded-md text-[#10b981] bg-[#10b981]/15">+24%</span>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-[#141938] p-7 rounded-xl border border-white/5">
                <div class="flex flex-col lg:flex-row justify-between items-start mb-6 gap-4">
                    <!-- Chart Title Section -->
                    <div class="flex flex-col gap-2">
                        <h2 class="text-base font-semibold text-white mb-2">Evolution des revenus</h2>
                        <div class="flex items-center gap-2.5">
                            <span class="text-[26px] font-bold text-white">240000 FCFA</span>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-md text-[#10b981] bg-[#10b981]/15">+43%</span>
                        </div>
                    </div>

                    <!-- Chart Controls -->
                    <div class="flex gap-2.5 items-center flex-wrap">
                        <button class="flex items-center gap-2 px-3.5 py-2 bg-[#1a1f3a] border border-[#667eea] rounded-lg text-white text-xs transition-all">
                            <span class="w-2 h-2 rounded-full bg-[#ff8c42]"></span>
                            Revenus
                        </button>
                        <button class="flex items-center gap-2 px-3.5 py-2 bg-transparent border border-[#2a2f4a] rounded-lg text-gray-400 text-xs transition-all hover:bg-[#1a1f3a]">
                            <span class="w-2 h-2 rounded-full bg-[#a855f7]"></span>
                            Dépenses
                        </button>
                        <select class="px-3.5 py-2 bg-[#1a1f3a] border border-[#2a2f4a] rounded-lg text-white text-xs cursor-pointer focus:outline-none focus:border-[#667eea]">
                            <option value="jan-dec-2024">Jan 2024 - Dec 2024</option>
                            <option value="jan-jun-2024">Jan 2024 - Jun 2024</option>
                        </select>
                    </div>
                </div>

                <!-- Chart Canvas -->
                <div class="h-96 relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    
@endsection

    @push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Chart.js Configuration
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Revenus',
                    data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000, 45000],
                    borderColor: '#ff8c42',
                    backgroundColor: 'rgba(255, 140, 66, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#ff8c42',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
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
                        backgroundColor: '#1a1f3a',
                        titleColor: '#fff',
                        bodyColor: '#9ca3af',
                        borderColor: '#2a2f4a',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' FCFA';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return value.toLocaleString() + ' FCFA';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
