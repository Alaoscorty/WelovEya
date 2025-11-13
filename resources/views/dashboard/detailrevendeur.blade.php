@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

    <!-- MAIN CONTENT -->
    <div class="ml-5 p-8">

        <h1 class="text-2xl font-bold mb-1">Fiche Revendeur : LE ROY AGENCY</h1>
        <p class="text-gray-400 text-sm mb-8">leroyagency@gmail.com</p>

        <!-- STATS -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <p class="text-gray-400 mb-1">Total Tickets Vendus</p>
                <p class="text-3xl font-bold">156</p>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <p class="text-gray-400 mb-1">Taux d'écoulement</p>
                <p class="text-3xl font-bold">78%</p>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <p class="text-gray-400 mb-1">Revenus Générés</p>
                <p class="text-3xl font-bold">450 000 F</p>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <p class="text-gray-400 mb-1">Stock restant</p>
                <p class="text-3xl font-bold">44</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6">

            <!-- FORM DECLARATION -->
            <div class="col-span-2 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-8">

                <h2 class="text-2xl font-bold mb-8">Gestion du stock</h2>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-sm opacity-90 mb-2">Total attribué :</p>
                        <div class="bg-white/20 px-4 py-3 rounded-lg text-2xl font-bold">200</div>
                    </div>
                    <div>
                        <p class="text-sm opacity-90 mb-2">Reste :</p>
                        <div class="bg-white/20 px-4 py-3 rounded-lg text-2xl font-bold">44</div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-4">Déclaration de Vente</h3>

                <div class="space-y-4 mb-6">
                    <input type="number" placeholder="Tickets Standard Vendus" class="w-full bg-white/20 px-4 py-3 rounded-lg text-white">
                    <input type="number" placeholder="Tickets Premium Vendus" class="w-full bg-white/20 px-4 py-3 rounded-lg text-white">
                    <input type="number" placeholder="Tickets VIP Vendus" class="w-full bg-white/20 px-4 py-3 rounded-lg text-white">
                </div>

                <button class="w-full bg-orange-700 hover:bg-orange-800 py-3 rounded-lg font-bold">
                    Enregistrer la déclaration
                </button>
            </div>

            <!-- PERFORMANCE -->
            <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-xl font-bold mb-6">Performance & Paiement</h2>
                <p class="text-gray-300">Commissions dues : <span class="font-bold text-red-400">18 000 F</span></p>
            </div>

        </div>
    </div>

@endsection

    @push('scripts')
@endpush
