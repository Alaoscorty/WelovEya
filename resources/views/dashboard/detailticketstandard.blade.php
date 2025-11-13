@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
    <!-- Main Content -->
    <div class="ml-64 p-8">

        <!-- Header -->
        <div class="bg-slate-900/50 border border-blue-900/50 rounded-2xl p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="history.back()" class="w-10 h-10 flex items-center justify-center hover:bg-slate-800 rounded-lg transition">
                        <i class="fas fa-arrow-left text-white"></i>
                    </button>
                    <h1 class="text-white text-2xl font-bold">Détail du Ticket: Standard</h1>
                </div>

                <button class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg font-medium transition">
                    <i class="fas fa-edit"></i> Modifier
                </button>
            </div>

            <div class="mt-4">
                <span class="inline-flex items-center gap-2 bg-orange-500/20 text-orange-400 px-4 py-2 rounded-full text-sm font-medium">
                    Actif
                </span>
            </div>
        </div>

        <!-- Configuration -->
        <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-8 mb-8">
            <h2 class="text-white text-xl font-semibold mb-8">Configuration et paramètre du ticket</h2>

            <div class="grid grid-cols-2 gap-8">

                <div class="space-y-6">
                    <div>
                        <label class="block text-slate-400 text-sm mb-2">Type de ticket</label>
                        <p class="text-white text-lg font-medium">Standard</p>
                    </div>

                    <div>
                        <label class="block text-slate-400 text-sm mb-3">Description</label>
                        <ul class="space-y-2 text-white">
                            <li class="flex gap-2"><i class="fas fa-check text-orange-500"></i> Accès de deux jours au festival</li>
                            <li class="flex gap-2"><i class="fas fa-check text-orange-500"></i> Accès au village Amazone</li>
                            <li class="flex gap-2"><i class="fas fa-check text-orange-500"></i> Accès avec un bracelet</li>
                        </ul>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-slate-400 text-sm mb-2">Stock Actuel</label>
                        <p class="text-white text-lg font-medium">250 tickets</p>
                    </div>

                    <div>
                        <label class="block text-slate-400 text-sm mb-2">Prix de Vente</label>
                        <p class="text-white text-lg font-medium">15 000 FCFA</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Performance -->
        <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-8">
            <h2 class="text-white text-xl font-semibold mb-6">Performance et inventaire</h2>

            <div class="grid grid-cols-3 gap-6">

                <div class="bg-slate-950/50 border border-slate-800 rounded-xl p-6">
                    <div class="flex justify-between mb-4">
                        <span class="text-slate-400 text-sm">Tickets Vendus</span>
                        <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-orange-500"></i>
                        </div>
                    </div>
                    <div class="text-white text-3xl font-bold mb-1">90</div>
                    <div class="text-slate-500 text-xs">Sur 100 disponibles</div>
                </div>

                <div class="bg-slate-950/50 border border-slate-800 rounded-xl p-6">
                    <div class="flex justify-between mb-4">
                        <span class="text-slate-400 text-sm">Stock restant</span>
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-blue-500"></i>
                        </div>
                    </div>
                    <div class="text-white text-3xl font-bold mb-1">10</div>
                    <div class="text-slate-500 text-xs">Tickets disponibles</div>
                </div>

                <div class="bg-slate-950/50 border border-slate-800 rounded-xl p-6">
                    <div class="flex justify-between mb-4">
                        <span class="text-slate-400 text-sm">Revenus Générés</span>
                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-wallet text-purple-500"></i>
                        </div>
                    </div>
                    <div class="text-white text-3xl font-bold mb-1">450000 F</div>
                    <div class="text-slate-500 text-xs">90 x 15 000 F</div>
                </div>

            </div>
        </div>

    </div>
@endsection

    @push('scripts')
@endpush
