@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

  <!-- Main Content -->
  <div class="ml-64 p-8">

    <div class="max-w-2xl">

      <!-- Header -->
      <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-t-2xl p-6">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-edit text-white text-xl"></i>
          <h1 class="text-white text-2xl font-bold">Modifier un stock de ticket</h1>
        </div>
        <p class="text-orange-100 text-sm">Définissez les détails du type de ticket.</p>
      </div>

      <!-- Form -->
      <form class="bg-gradient-to-b from-blue-900/40 via-blue-950/60 to-blue-950/80 border-x border-b border-slate-800 rounded-b-2xl p-8">

        <h2 class="text-white text-lg font-semibold mb-6">Informations de base</h2>

        <div class="space-y-6">

          <div>
            <label class="text-slate-300 text-sm mb-2 block">Type de ticket</label>
            <input type="text" id="ticketType" value="Elite"
              class="w-full bg-blue-950/70 text-white px-4 py-3 rounded-lg border border-blue-900/60 focus:outline-none" />
          </div>

          <div>
            <label class="text-slate-300 text-sm mb-2 block">Stock actuel</label>
            <input type="number" id="currentStock" value="50"
              class="w-full bg-blue-950/70 text-white px-4 py-3 rounded-lg border border-blue-900/60" />
          </div>

          <div>
            <label class="text-slate-300 text-sm mb-2 block">Quantité à ajouter</label>
            <input type="number" id="quantityToAdd" value="600"
              class="w-full bg-blue-950/70 text-white px-4 py-3 rounded-lg border border-blue-900/60" />
          </div>

          <div>
            <label class="text-slate-300 text-sm mb-2 block">Nouveau stock total</label>
            <input type="text" id="newTotalStock" value="650" readonly
              class="w-full bg-blue-950/50 text-white px-4 py-3 rounded-lg border border-blue-900/60 opacity-75" />
          </div>

        </div>

        <div class="flex justify-end gap-4 mt-8">
          <button type="reset" class="px-8 py-3 text-slate-300 border border-blue-800/60 rounded-lg">
            Annuler
          </button>
          <button class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg shadow-lg">
            Modifier
          </button>
        </div>

      </form>
    </div>
  </div>

  <!-- Script calcul auto -->
  <script>
    const stock = document.getElementById("currentStock");
    const add = document.getElementById("quantityToAdd");
    const total = document.getElementById("newTotalStock");

    function update() {
      total.value = (parseInt(stock.value || 0) + parseInt(add.value || 0));
    }

    stock.oninput = add.oninput = update;
  </script>
@endsection

    @push('scripts')
@endpush
