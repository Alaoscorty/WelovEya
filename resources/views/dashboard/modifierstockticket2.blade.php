@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

<!-- MAIN CONTENT -->
<div class="ml-64 p-8">
  <div class="max-w-2xl">

    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-t-2xl p-6">
      <div class="flex items-center gap-3 mb-2">
        <i class="fas fa-edit text-white text-xl"></i>
        <h1 class="text-white text-2xl font-bold">Modifier un stock de ticket</h1>
      </div>
      <p class="text-orange-100 text-sm">
        Définissez les détails du type de ticket pour votre événement.
      </p>
    </div>

    <form action="{{ route('tickets.premium.update') }}" method="POST">
      @csrf

      <div class="bg-gradient-to-b from-blue-950 to-slate-950 border-x border-b border-slate-800 rounded-b-2xl p-8">
        <h2 class="text-white text-lg font-semibold mb-6">Informations de base</h2>

        <div class="space-y-6">

          <div>
            <label class="block text-slate-300 text-sm mb-2">Type de ticket concerné</label>
            <input type="text" id="ticketType" value="{{ $formData['ticketType'] }}" class="w-full bg-blue-900/30 text-white px-4 py-3 rounded-lg border border-blue-800/50">
          </div>

          <div>
            <label class="block text-slate-300 text-sm mb-2">Stock actuel</label>
            <input type="number" id="currentStock" value="{{ $formData['currentStock'] }}" class="stock-input w-full bg-blue-900/30 text-white px-4 py-3 rounded-lg border border-blue-800/50">
          </div>

          <div>
            <label class="block text-slate-300 text-sm mb-2">Quantité à ajouter</label>
            <input type="number" id="quantityToAdd" value="500" class="stock-input w-full bg-blue-900/30 text-white px-4 py-3 rounded-lg border border-blue-800/50">
          </div>

          <div>
            <label class="block text-slate-300 text-sm mb-2">Nouveau Stock Total</label>
            <input type="number" id="newTotalStock" readonly class="w-full bg-blue-900/30 text-white px-4 py-3 rounded-lg border border-blue-800/50 opacity-75 cursor-not-allowed">
          </div>
        </div>

        <!-- BUTTONS -->
        <div class="flex justify-end gap-4 mt-8">
          <button type="button" id="resetBtn" class="px-8 py-3 border border-slate-600 text-slate-300 rounded-lg">Annuler</button>
          <button class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg shadow-lg">Modifier</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function calculateStock() {
  let current = parseInt(document.getElementById('currentStock').value) || 0;
  let toAdd = parseInt(document.getElementById('quantityToAdd').value) || 0;
  document.getElementById('newTotalStock').value = current + toAdd;
}

document.querySelectorAll('.stock-input').forEach(input => {
  input.addEventListener('input', calculateStock);
});

document.getElementById('resetBtn').onclick = () => {
  document.getElementById('currentStock').value = "{{ $formData['currentStock'] }}";
  document.getElementById('quantityToAdd').value = 500;
  calculateStock();
}

calculateStock();
</script>
@endsection

    @push('scripts')
@endpush
