@php
$tickets = [
    ['id' => 'CDE-001','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 3,'status' => 'Validée','total' => '15710 F','date' => '15 Novembre 2024'],
    ['id' => 'CDE-002','client' => 'Marie Martin','email' => 'mariemartin@gmail.com','articles' => 1,'status' => 'En Attente','total' => '16000 F','date' => '18 Novembre 2025'],
    ['id' => 'CDE-003','client' => 'Sophia Dubois','email' => 'sophiadubois@gmail.com','articles' => 2,'status' => 'En Attente','total' => '6678 F','date' => '17 Décembre 2025'],
    ['id' => 'CDE-004','client' => 'Emma Bernard','email' => 'emmab@gmail.com','articles' => 3,'status' => 'Validée','total' => '3476 F','date' => '20 Novembre 2024'],
    ['id' => 'CDE-005','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 4,'status' => 'En Attente','total' => '13320 F','date' => '17 Novembre 2026'],
    ['id' => 'CDE-006','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 3,'status' => 'Validée','total' => '10650 F','date' => '12 Novembre 2024'],
    ['id' => 'CDE-007','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 1,'status' => 'En Attente','total' => '6656 F','date' => '14 Novembre 2025'],
    ['id' => 'CDE-008','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 1,'status' => 'Validée','total' => '3126 F','date' => '05 Novembre 2025'],
    ['id' => 'CDE-009','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 2,'status' => 'En Attente','total' => '6346 F','date' => '08 Novembre 2024'],
    ['id' => 'CDE-010','client' => 'Jean Dupont','email' => 'jeandupont@gmail.com','articles' => 5,'status' => 'En Attente','total' => '9325 F','date' => '10 Décembre 2024'],
];
@endphp

@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
  <!-- Main -->
  <div class="ml-64 p-8">

    <h1 class="text-white text-2xl font-bold mb-6">Gestion des Tickets</h1>

    <div class="bg-slate-900/80 border border-slate-800 rounded-xl p-6">

      <div class="flex items-center justify-between mb-6">
        <div class="relative max-w-md w-full">
          <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-500"></i>
          <input id="searchInput" type="text" placeholder="Rechercher une commande..." class="w-full bg-slate-950 text-slate-300 pl-10 pr-4 py-2 rounded-lg border border-slate-800">
        </div>

        <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">Ajouter une commande</button>
      </div>

      <div class="space-y-2" id="ticketList">
        @foreach($tickets as $t)
        <div class="ticket-item flex items-center gap-4 py-3 px-4 hover:bg-slate-800/50 rounded-lg transition">
          
          <div class="w-24 text-slate-300 text-sm">{{ $t['id'] }}</div>

          <div class="flex-1">
            <div class="text-white font-medium text-sm">{{ $t['client'] }}</div>
            <div class="text-slate-400 text-xs">{{ $t['email'] }}</div>
          </div>

          <div class="w-20 text-center text-slate-300 text-sm">{{ $t['articles'] }}</div>

          <div class="w-32">
            <span class="inline-flex items-center px-3 py-1 text-xs rounded-full font-medium
              {{ $t['status'] == 'Validée' ? 'bg-green-500/20 text-green-400' : 'bg-slate-700 text-slate-300' }}">
              {{ $t['status'] }}
            </span>
          </div>

          <div class="w-28 text-white font-medium text-sm">{{ $t['total'] }}</div>
          <div class="w-40 text-slate-400 text-sm">{{ $t['date'] }}</div>
        </div>
        @endforeach
      </div>

    </div>
  </div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
  const q = this.value.toLowerCase();
  document.querySelectorAll(".ticket-item").forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(q) ? "" : "none";
  });
});
</script>
@endsection

    @push('scripts')
@endpush