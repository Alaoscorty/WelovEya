@extends('layouts.application')

@section('title', 'Artistes')

@section('content')

<div class="flex">
  <!-- Main Content -->
   <main class="ml-64 p-8 w-full">
      <div class="max-w-2xl">
      <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-t-2xl p-6">
        <div class="flex items-center gap-3 mb-2">
          <i class="fas fa-edit text-white text-xl"></i>
          <h1 class="text-white text-2xl font-bold">Modifier un stock de ticket</h1>
        </div>
        <p class="text-orange-100 text-sm">Définissez les détails du type de ticket pour votre événement.</p>
      </div>

      <div class="bg-slate-900/95 border-x border-b border-slate-800 rounded-b-2xl p-8">
        
        <h2 class="text-white text-lg font-semibold mb-6">Informations de base</h2>

        <form>
          <div class="space-y-6">

            <div>
              <label class="block text-slate-300 text-sm font-medium mb-2">Type de ticket concerné</label>
              <input type="text" id="ticketType" value="Standard"
                class="w-full bg-blue-950/50 text-white px-4 py-3 rounded-lg border border-blue-900/50 focus:border-blue-500"/>
            </div>

            <div>
              <label class="block text-slate-300 text-sm font-medium mb-2">Stock actuel</label>
              <input type="number" id="currentStock" value="90"
                class="w-full bg-blue-950/50 text-white px-4 py-3 rounded-lg border border-blue-900/50 focus:border-blue-500"/>
            </div>

            <div>
              <label class="block text-slate-300 text-sm font-medium mb-2">Quantité à ajouter</label>
              <input type="number" id="quantityToAdd" value="500"
                class="w-full bg-blue-950/50 text-white px-4 py-3 rounded-lg border border-blue-900/50 focus:border-blue-500"/>
            </div>

            <div>
              <label class="block text-slate-300 text-sm font-medium mb-2">Nouveau Stock Total</label>
              <input type="text" id="newTotalStock" value="590" readonly
                class="w-full bg-blue-950/50 text-white px-4 py-3 rounded-lg border border-blue-900/50 opacity-75 cursor-not-allowed"/>
            </div>

          </div>

          <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
            <button type="reset" class="px-8 py-3 text-slate-300 border border-slate-700 rounded-lg hover:text-white hover:border-slate-600">Annuler</button>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg shadow-lg shadow-orange-500/20">
              Modifier
            </button>
          </div>

        </form>

      </div>
    </div>
   </main>
    
</div>
@endsection

    @push('scripts')
<script>
  function updateStock() {
    const current = parseInt(document.getElementById("currentStock").value) || 0;
    const add = parseInt(document.getElementById("quantityToAdd").value) || 0;
    document.getElementById("newTotalStock").value = current + add;
  }

  document.getElementById("currentStock").addEventListener("input", updateStock);
  document.getElementById("quantityToAdd").addEventListener("input", updateStock);
</script>
@endpush
