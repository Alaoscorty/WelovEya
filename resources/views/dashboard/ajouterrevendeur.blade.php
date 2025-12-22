@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<main class="ml-2 w-full p-8">
    <!-- Header Alert -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 mb-8 shadow-lg">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user-plus text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold mb-1">Nouveau Revendeur</h2>
                <p class="text-white/90 text-sm">
                    Remplissez les informations pour créer une nouvelle fiche revendeur.
                </p>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <form action="{{ route('resellers.store') }}" method="POST" id="revendeurForm" class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl border border-gray-700 p-8">
        @csrf

        <!-- Section I: Informations de base -->
        <div class="mb-10">
            <h3 class="text-lg font-bold mb-6 text-orange-500">I. Informations de base</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Nom complet*</label>
                    <input
                        type="text"
                        name="nom_complet"
                        id="nomComplet"
                        placeholder="Ex: Roy Dupont"
                        required
                        class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"
                    />
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Ex: Roy@gmail.com"
                        class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"
                    />
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-2">Téléphone</label>
                    <input
                        type="tel"
                        name="telephone"
                        id="telephone"
                        placeholder="+229 XX XX XX XX"
                        class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"
                    />
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-2">Date d'Adhésion</label>
                    <input
                        type="date"
                        name="date_adhesion"
                        id="dateAdhesion"
                        value="{{ date('Y-m-d') }}"
                        class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"
                    />
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-400 mb-2">Statut Initial</label>
                    <select
                        name="statut"
                        id="statut"
                        class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-orange-500 transition appearance-none cursor-pointer"
                    >
                        <option value="ACTIF" selected>ACTIF</option>
                        <option value="INACTIF">INACTIF</option>
                        <option value="SUSPENDU">SUSPENDU</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Section II: Barème de Commission -->
        <div class="mb-10">
            <h3 class="text-lg font-bold mb-6 text-orange-500">II. Barème de Commission</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Commission Standard</label>
                    <input type="number" name="commission_standard" value="150" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Commission Premium</label>
                    <input type="number" name="commission_premium" value="100" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Commission VIP</label>
                    <input type="number" name="commission_vip" value="1000" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Commission Elite</label>
                    <input type="number" name="commission_elite" value="2000" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
            </div>
        </div>

        <!-- Section III: Allocation initial de Stock -->
        <div class="mb-8">
            <h3 class="text-lg font-bold mb-6 text-orange-500">III. Allocation initial de Stock</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Stock Initial Standard</label>
                    <input type="number" name="stock_standard" value="0" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Stock Initial Premium</label>
                    <input type="number" name="stock_premium" value="0" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Stock Initial VIP</label>
                    <input type="number" name="stock_vip" value="0" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Stock Initial Elite</label>
                    <input type="number" name="stock_elite" value="0" class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-orange-500 transition"/>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-4 pt-6 border-t border-gray-700">
            <button type="button" onclick="annuler()" class="px-8 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition">
                Annuler
            </button>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold rounded-lg transition shadow-lg">
                Créer le Revendeur
            </button>
        </div>
    </form>
</main>
@endsection
@push('scripts')
<script>
    // Fonction d'annulation
    function annuler() {
        if (confirm('Voulez-vous vraiment annuler ? Toutes les données non enregistrées seront perdues.')) {
            window.location.href = '{{ route("resellers.index") }}';
        }
    }

    // Validation en temps réel du téléphone
    document.getElementById('telephone').addEventListener('input', function(e) {
        let value = e.target.value;
        if (!value.startsWith('+229') && value.length > 0) {
            e.target.value = '+229 ' + value.replace(/\D/g, '');
        }
    });

    // Empêcher les valeurs négatives pour les commissions et stocks
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            if (e.target.value < 0) e.target.value = 0;
        });
    });
</script>
@endpush
