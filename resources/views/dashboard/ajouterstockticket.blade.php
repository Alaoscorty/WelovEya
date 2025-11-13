@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

        {{-- Main Content --}}
        <div class="ml-64 p-8">
            {{-- Form Card --}}
            <div class="max-w-2xl">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-t-2xl p-6 mb-0">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-plus-circle text-white text-xl"></i>
                        <h1 class="text-white text-2xl font-bold">Ajouter un stock de ticket</h1>
                    </div>
                    <p class="text-orange-100 text-sm">
                        Définissez les détails du type de ticket pour votre événement.
                    </p>
                </div>

                {{-- Form Content --}}
                <div class="bg-slate-900/95 border-x border-b border-slate-800 rounded-b-2xl p-8">
                    <h2 class="text-white text-lg font-semibold mb-6">Informations de base</h2>
                    
                    <form id="addStockForm" action="{{ route('tickets.add-stock') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-6">
                            {{-- Type de ticket concerné --}}
                            <div>
                                <label class="block text-slate-300 text-sm font-medium mb-2">
                                    Type de ticket concerné
                                </label>
                                <select
                                    id="ticketType"
                                    name="ticket_type"
                                    class="w-full bg-slate-950 text-slate-400 px-4 py-3 rounded-lg border border-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    required
                                >
                                    <option value="">Ex: Standard, Premium, VIP</option>
                                    <option value="standard">Standard</option>
                                    <option value="premium">Premium</option>
                                    <option value="vip">VIP</option>
                                </select>
                            </div>

                            {{-- Stock actuel --}}
                            <div>
                                <label class="block text-slate-300 text-sm font-medium mb-2">
                                    Stock actuel
                                </label>
                                <input
                                    type="number"
                                    id="currentStock"
                                    name="current_stock"
                                    placeholder=""
                                    class="w-full bg-slate-950 text-slate-300 px-4 py-3 rounded-lg border border-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    readonly
                                />
                            </div>

                            {{-- Quantité à ajouter --}}
                            <div>
                                <label class="block text-slate-300 text-sm font-medium mb-2">
                                    Quantité à ajouter
                                </label>
                                <input
                                    type="number"
                                    id="quantityToAdd"
                                    name="quantity_to_add"
                                    placeholder=""
                                    class="w-full bg-slate-950 text-slate-300 px-4 py-3 rounded-lg border border-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    min="1"
                                    required
                                />
                            </div>

                            {{-- Nouveau stock total --}}
                            <div>
                                <label class="block text-slate-300 text-sm font-medium mb-2">
                                    Nouveau stock total
                                </label>
                                <input
                                    type="number"
                                    id="newTotalStock"
                                    name="new_total_stock"
                                    placeholder=""
                                    class="w-full bg-slate-950 text-slate-300 px-4 py-3 rounded-lg border border-slate-800 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    readonly
                                />
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
                            <button
                                type="button"
                                id="cancelBtn"
                                class="px-6 py-2.5 text-slate-300 hover:text-white border border-slate-700 hover:border-slate-600 rounded-lg transition font-medium"
                            >
                                Annuler
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg transition font-medium shadow-lg shadow-orange-500/20"
                            >
                                Confirmer l'ajout de stock
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Données de stock simulées (à remplacer par des données de l'API)
        const ticketStocks = {
            'standard': 100,
            'premium': 50,
            'vip': 25
        };

        const ticketTypeSelect = document.getElementById('ticketType');
        const currentStockInput = document.getElementById('currentStock');
        const quantityToAddInput = document.getElementById('quantityToAdd');
        const newTotalStockInput = document.getElementById('newTotalStock');
        const cancelBtn = document.getElementById('cancelBtn');
        const form = document.getElementById('addStockForm');

        // Mettre à jour le stock actuel quand le type de ticket change
        ticketTypeSelect.addEventListener('change', function() {
            const selectedType = this.value;
            if (selectedType && ticketStocks[selectedType] !== undefined) {
                currentStockInput.value = ticketStocks[selectedType];
                calculateNewTotal();
            } else {
                currentStockInput.value = '';
                newTotalStockInput.value = '';
            }
        });

        // Calculer le nouveau stock total quand la quantité change
        quantityToAddInput.addEventListener('input', calculateNewTotal);

        function calculateNewTotal() {
            const current = parseInt(currentStockInput.value) || 0;
            const toAdd = parseInt(quantityToAddInput.value) || 0;
            newTotalStockInput.value = current + toAdd;
        }

        // Bouton Annuler
        cancelBtn.addEventListener('click', function() {
            form.reset();
            currentStockInput.value = '';
            newTotalStockInput.value = '';
        });

        // Validation du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // Ici vous pouvez envoyer les données via AJAX
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Stock ajouté avec succès!');
                    form.reset();
                    currentStockInput.value = '';
                    newTotalStockInput.value = '';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            });
        });
    </script>
@endsection

    @push('scripts')
@endpush