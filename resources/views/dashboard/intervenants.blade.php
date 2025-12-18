{{--  --}}
@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
        flex: 1;
        padding: 30px 40px;
        overflow-y: auto;
    }

    .header {
        margin-bottom: 30px;
    }

    .header h1 {
        font-size: 28px;
        margin-bottom: 5px;
    }

    .header p {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }

    /* Stats cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 140, 66, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff8c42;
        font-size: 24px;
    }

    .stat-info h3 {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 5px;
        font-weight: normal;
    }

    .stat-info p {
        font-size: 32px;
        font-weight: bold;
    }

    /* Table controls */
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 20px;
    }

    .search-icon {
        flex: 1;
        max-width: 400px;
    }

    .search-icon input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
    }

    .search-icon {
        position: relative;
        
    }

    .search-icon i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.4);
    }

    .filters {
        display: flex;
        gap: 15px;
        align-items: center;
        padding:5px;
    }
    .filters option{
        color:black;
    }

    select {
        padding: 10px 35px 10px 15px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23fff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    .add-btn {
        padding: 10px 20px;
        background: #ff8c42;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .add-btn:hover {
        background: #ff7a28;
        transform: translateY(-2px);
    }

    .pagination-info {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }

    /* Table */
    .table-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: rgba(255, 255, 255, 0.05);
    }

    th {
        padding: 15px;
        text-align: left;
        font-size: 13px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.7);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    th i {
        margin-left: 5px;
        font-size: 10px;
        opacity: 0.5;
    }

    tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s;
    }

    tbody tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    td {
        padding: 15px;
        font-size: 14px;
    }

    .checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar-small {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        overflow: hidden;
    }

    .user-avatar-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-details h4 {
        font-size: 14px;
        margin-bottom: 2px;
    }

    .user-details p {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
    }

    .badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge.artiste {
        background: rgba(255, 140, 66, 0.2);
        color: #ff8c42;
    }

    .badge.animateur {
        background: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }

    .badge.dj {
        background: rgba(155, 89, 182, 0.2);
        color: #9b59b6;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-badge.confirme {
        background: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
    }

    .status-badge.en-attente {
        background: rgba(149, 165, 166, 0.2);
        color: #95a5a6;
    }

    .status-badge.en-relation {
        background: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }

    .chart-cell {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chart-icon {
        color: rgba(255, 255, 255, 0.4);
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .action-btn {
        width: 30px;
        height: 30px;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.05);
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .pagination-left {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.6);
    }

    .pagination-right {
        display: flex;
        gap: 10px;
    }

    .page-btn {
        width: 35px;
        height: 35px;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.05);
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .page-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

</style>
@section('content')
@if(session('success'))
<div style="background:#2ecc71;padding:12px;border-radius:5px;margin-bottom:20px">
    {{ session('success') }}
</div>
@endif

<div class="flex container">
        <main class="main-content">
            <div class="header">
                <h1>Gestion des intervenants</h1>
                <p>Artistes, Animateurs, DJs</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Artistes</h3>
                        <p>{{ $stats['artistes'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-microphone"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Animateurs</h3>
                        <p>{{ $stats['animateurs'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-headphones"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total DJs</h3>
                        <p>{{ $stats['djs'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Table Controls -->
            <div class="table-controls">
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search" placeholder="Rechercher...">

                </div>

                <div class="filters">
                    <select>
                        <option>Jour</option>
                        <option>Semaine</option>
                        <option>Mois</option>
                    </select>

                    <select>
                        <option>Catégorie</option>
                        <option>Artiste</option>
                        <option>Animateur</option>
                        <option>DJ</option>
                    </select>

                    <a href="{{ route('ajouter_intervenants') }}" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Ajouter un intervenant
                    </a>


                    <span class="pagination-info"><span class="text-orange-600">1 - 10</span> sur 156</span>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
    <thead>
        <tr>
            <th><input type="checkbox" class="checkbox"></th>
            <th><i class="fas fa-hashtag"></i> Intervenants <i class="fas fa-sort"></i></th>
            <th>Nom <i class="fas fa-sort"></i></th>
            <th>Rôle <i class="fas fa-sort"></i></th>
            <th><i class="fas fa-signal"></i> Statut</th>
            <th>Voir Acti <i class="fas fa-sort"></i></th>
            <th>Nombre</th>
            <th><i class="fas fa-calendar"></i> Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            @if($intervenants->count())
                @foreach($intervenants as $intervenant)
                <a href="{{ route('detailIntervenants', $intervenant) }}">
                    <tr>
                    <td><input type="checkbox"></td>
                    <td>{{ $intervenant->code }}</td>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-small">
                                <img src="{{ $intervenant->photo ? asset('storage/'.$intervenant->photo) : 'https://i.pravatar.cc/150' }}">
                            </div>
                            <div class="user-details">
                                <h4>{{ strtoupper($intervenant->nom) }}</h4>
                                <p>{{ $intervenant->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $intervenant->role }}">
                            {{ ucfirst($intervenant->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge {{ $intervenant->statut }}">
                            {{ $intervenant->statut == 'confirme' ? '✓ Confirmé' : '✕ En attente' }}
                        </span>
                    </td>
                    <td>{{ $intervenant->heure ?? '-' }}</td>
                    <td>
                        {{-- Calcul du nombre de votes depuis la relation ou table votes --}}
                        {{ $intervenant->votes_count ?? 0 }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($intervenant->date)->format('d M Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('intervenants.show', $intervenant) }}" class="action-btn">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('intervenants.edit', $intervenant) }}" class="action-btn">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('intervenants.destroy', $intervenant) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="action-btn" type="submit">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                </a>
                @endforeach
            @else
                <tr>
                    <td colspan="9" style="text-align:center;color:gray">
                        Aucun intervenant trouvé
                    </td>
                </tr>
            @endif
        </tbody>
</table>

            </div>
        </main>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            fetch(`/intervenants/search/ajax?q=${this.value}`)
                .then(res => res.json())
                .then(data => console.log(data))
        });
    </script>


    @endsection 
        @push('scripts')
    @endpush
