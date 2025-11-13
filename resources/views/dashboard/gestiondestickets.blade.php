@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<div class="flex">


  <!-- Main Content -->
  <main class="ml-64 p-8 w-full">

    <h1 class="text-2xl font-bold mb-1">Gestion des tickets</h1>
    <p class="text-gray-400 text-sm mb-8">Visualiser et gérer tous vos tickets d'événements.</p>

    <div class="bg-gray-800/60 border border-gray-700 rounded-2xl p-8">

      <!-- Search -->
      <form method="GET" class="mb-6">
        <input type="text" name="search" placeholder="Rechercher..." 
               class="w-full bg-blue-900/30 border border-blue-800/50 rounded-lg px-4 py-3 focus:border-orange-500">
      </form>

      <!-- Table -->
      <table class="w-full">
        <thead>
          <tr class="border-b border-gray-700">
            <th></th>
            <th>Type</th><th>Prix</th><th>Total</th><th>Statut</th><th>Vendus</th><th>Exclusions</th><th></th>
          </tr>
        </thead>
        <tbody>
        <!-- @foreach($tickets as $ticket)-->
          <tr class="border-b border-gray-700/50 hover:bg-blue-900/20 transition">
            <!-- <td><input type="checkbox"></td>
            <td>{{ $ticket['type'] }}</td>
            <td>{{ $ticket['prix'] }}</td>
            <td>{{ $ticket['nombreTotal'] }}</td>
            <td>
              <span class="px-3 py-1 rounded-full text-xs border
                @if($ticket['statut']=='Actif') bg-green-500/20 text-green-400 border-green-500/30
                @elseif($ticket['statut']=='Épuisé') bg-gray-500/20 text-gray-400 border-gray-500/30
                @else bg-yellow-500/20 text-yellow-400 border-yellow-500/30
                @endif
              ">{{ $ticket['statut'] }}</span>
            </td>
            <td>{{ $ticket['vendus'] }}</td>
            <td>{{ $ticket['exclusions'] }}</td>
            <td class="flex gap-2">
              <button class="hover:bg-gray-700 p-2 rounded">Voir</button>
              <button class="hover:bg-gray-700 p-2 rounded">Modifier</button>
              <button class="hover:bg-gray-700 p-2 rounded">Supprimer</button>
            </td>
          </tr>
        @endforeach -->
        </tbody>
      </table>

    </div>
  </main>
</div>
@endsection

    @push('scripts')
    @endpush
