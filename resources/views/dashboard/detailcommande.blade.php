@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

    {{-- MAIN CONTENT --}}
    <div class="ml-64 pl-8">

        <div class="mb-6">
            <h1 class="text-white text-2xl font-bold mb-1">Commandes • Primary</h1>
        </div>

        {{-- Command Card --}}
        <div class="bg-slate-900/50 border border-blue-900/50 rounded-2xl p-6 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <i class="fas fa-terminal text-blue-400"></i>
                <span class="text-white font-medium">Commande CDE-001</span>
            </div>

            <div class="inline-flex items-center gap-2 bg-green-500/20 text-green-400 px-4 py-2 rounded-full">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">Validée</span>
            </div>
        </div>

        {{-- TWO CARDS --}}
        <div class="grid grid-cols-2 gap-6 mb-6">

            {{-- Client --}}
            <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-6">
                <h2 class="text-white font-semibold mb-4">Détails Clients</h2>

                <div class="space-y-4">
                    <div>
                        <label class="text-slate-500 text-sm mb-1 block">Nom</label>
                        <p class="text-white font-medium">Jean Dupont</p>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm mb-1 block">Email</label>
                        <p class="text-white">jean.dupont@email.com</p>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm mb-1 block">Téléphone</label>
                        <p class="text-white">+229 01 23456789</p>
                    </div>
                </div>
            </div>

            {{-- Paiement --}}
            <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-6">
                <h2 class="text-white font-semibold mb-4">Détails Paiement</h2>

                <div class="space-y-4">
                    <div>
                        <label class="text-slate-500 text-sm mb-1 block">Date de création</label>
                        <p class="text-white font-medium">15 Octobre 2025</p>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm mb-1 block">Méthode de paiement</label>
                        <p class="text-white">Carte bancaire</p>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm mb-1 block">Total payé</label>
                        <p class="text-white font-bold text-xl">73 000 FCFA</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Articles --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-6">

            <h2 class="text-white font-semibold mb-4">Liste des articles</h2>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="border-b border-slate-800">
                        <th class="text-left text-slate-400 text-sm pb-3 px-4"><i class="fas fa-hashtag mr-2"></i>ID Article</th>
                        <th class="text-left text-slate-400 text-sm pb-3 px-4">Nom</th>
                        <th class="text-left text-slate-400 text-sm pb-3 px-4">Type</th>
                        <th class="text-left text-slate-400 text-sm pb-3 px-4">Prix</th>
                        <th class="text-left text-slate-400 text-sm pb-3 px-4">Statut</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="border-b border-slate-800/50">
                        <td class="py-4 px-4 text-slate-300">ART-001</td>
                        <td class="py-4 px-4 text-white">Ticket</td>
                        <td class="py-4 px-4 text-slate-300">Standard</td>
                        <td class="py-4 px-4 text-white">15 000 F</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-2 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-check-circle text-xs"></i> Validée
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b border-slate-800/50">
                        <td class="py-4 px-4 text-slate-300">ART-002</td>
                        <td class="py-4 px-4 text-white">Casquette</td>
                        <td class="py-4 px-4 text-slate-300">Taille Unique (red)</td>
                        <td class="py-4 px-4 text-white">8 000 F</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-2 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-check-circle text-xs"></i> Validée
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="py-4 px-4 text-slate-300">ART-003</td>
                        <td class="py-4 px-4 text-white">T-shirt</td>
                        <td class="py-4 px-4 text-slate-300">Standard</td>
                        <td class="py-4 px-4 text-white">50 000 F</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-2 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-check-circle text-xs"></i> Validée
                            </span>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>
@endsection

    @push('scripts')
@endpush
