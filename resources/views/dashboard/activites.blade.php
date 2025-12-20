@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            padding: 0;
        }

        .content-wrapper {
            background: linear-gradient(135deg, #12255a91 0%, #1e40af 100%);
            padding: 20px;
            margin: 10px;
            margin:top 20px;
            padding-bottom: 40px;
            border-radius: 8px;
        }

        @media (min-width: 768px) {
            .content-wrapper {
                padding: 30px 40px;
                margin: 20px;
            }
        }

        .header {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        @media (min-width: 768px) {
            .header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .header h1 {
            font-size: 20px;
            font-weight: 600;
        }

        @media (min-width: 768px) {
            .header h1 {
                font-size: 24px;
            }
        }

        .btn-create {
            padding: 10px 15px;
            background: #ff8c42;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            width: 100%;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .btn-create {
                width: auto;
                padding: 10px 20px;
                font-size: 13px;
            }
        }

        .btn-create:hover {
            background: #ff7a2e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 66, 0.4);
        }

        .filters {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 25px;
        }

        @media (min-width: 768px) {
            .filters {
                flex-direction: row;
            }
        }

        .search-filter {
            flex: 1;
            position: relative;
        }

        .search-filter input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 13px;
        }

        .search-filter input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-filter i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
        }

        .status-filter {
            position: relative;
        }

        .status-filter select {
            padding: 10px 40px 10px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            appearance: none;
            width: 100%;
        }

        @media (min-width: 768px) {
            .status-filter select {
                width: auto;
            }
        }

        .status-filter i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-export {
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .btn-export {
                font-size: 13px;
                padding: 10px 20px;
            }
        }

        .btn-export:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Table */
        .table-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead {
            background: rgba(0, 0, 0, 0.2);
        }

        th {
            padding: 12px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (min-width: 768px) {
            th {
                padding: 15px;
                font-size: 12px;
            }
        }

        td {
            padding: 12px 8px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 12px;
        }

        @media (min-width: 768px) {
            td {
                padding: 18px 15px;
                font-size: 13px;
            }
        }

        tbody tr {
            transition: all 0.2s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .action-name {
            font-weight: 600;
            color: #fff;
        }

        .status-badge {
            padding: 5px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
        }

        @media (min-width: 768px) {
            .status-badge {
                padding: 5px 12px;
                font-size: 11px;
            }
        }

        .status-ouvert {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-complet {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .status-termine {
            background: rgba(147, 51, 234, 0.2);
            color: #a78bfa;
            border: 1px solid rgba(147, 51, 234, 0.3);
        }

        .actions-buttons {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .btn-action {
            padding: 6px 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s;
        }

        @media (min-width: 768px) {
            .btn-action {
                padding: 6px 14px;
                font-size: 12px;
            }
        }

        .btn-action:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        <div class="content-wrapper">
            <div class="header">
                <h1>Gestion des Actions Sociales & Récompenses (RSE)</h1>
                <a href="{{route ('newAction')}}" class="btn-create">
                    <i class="fas fa-plus-circle"></i>
                    Créer une nouvelle Action
                </a>
            </div>

            <div class="filters">
                <div class="search-filter">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher par nom...">
                </div>

                <div class="status-filter">
                    <select id="statusFilter">
                        <option value="all">Tous les statuts</option>
                        <option value="ouvert">Ouvert</option>
                        <option value="complet">Complet</option>
                        <option value="termine">Terminé</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <button class="btn-export">
                    <i class="fas fa-file-export"></i>
                    Exporter vers Sheets
                </button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            
                            <th>ID</th>
                            <th>NOM DE L'ACTION</th>
                            <th>DATE & HEURE</th>
                            <th>LIEU</th>
                            <th>INSCRIPTIONS</th>
                            <th>STATUT</th>
                            <th>RÉCOMPENSE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="actionsTable">
                        
                        @foreach($actions as $action)
                        <tr>
                            <td>{{ $action->id }}</td>
                            <td class="action-name">{{ $action->title }}</td>
                            <td>{{ $action->date_time->format('d/m/Y') }} à<br>{{ $action->date_time->format('H:i') }}</td>
                            <td>{{ $action->location }}</td>
                            <td>{{ $action->registered }} / {{ $action->slots }} places</td>
                            <td><span class="status-badge {{ $action->status_class }}">{{ ucfirst($action->status) }}</span></td>
                            <td>{{ $action->reward }}</td>
                            <td>
                                <div class="actions-buttons">
                                    <a href="{{ route('actions.show', $action->id) }}" class="btn-action">Gérer</a>
                                    <a href="{{ route('actions.edit', $action->id) }}" class="btn-action">Modifier</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </main>
@endsection
    
<script>
        // Menu interactif
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Animation des boutons
        document.querySelectorAll('.btn-action, .btn-create, .btn-export').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Animation de la barre de recherche
        const searchInput = document.querySelector('.search-filter input');
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.borderColor = 'rgba(255, 255, 255, 0.4)';
        });
        searchInput.addEventListener('blur', function() {
            this.parentElement.style.borderColor = 'rgba(255, 255, 255, 0.2)';
        });

        // Filtrage par statut
        const statusSelect = document.querySelector('.status-filter select');
        statusSelect.addEventListener('change', function() {
            console.log('Filtre changé:', this.value);
        });

        // Animation des lignes du tableau
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Bouton créer action
        document.querySelector('.btn-create').addEventListener('click', function() {
            alert('Ouvrir le formulaire de création d\'action');
        });

        // Bouton exporter
        document.querySelector('.btn-export').addEventListener('click', function() {
            alert('Export vers Google Sheets en cours...');
        });

        // Boutons d'action dans le tableau
        document.querySelectorAll('.btn-action').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.textContent;
                const row = this.closest('tr');
                const actionName = row.querySelector('.action-name').textContent;
                alert(`${action}: ${actionName}`);
            });
        });
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const actionsTable = document.getElementById('actionsTable');

        function filterActions() {
            const term = searchInput.value.toLowerCase();
            const status = statusFilter.value;

            Array.from(actionsTable.getElementsByTagName('tr')).forEach(row => {
                const title = row.querySelector('.action-name').textContent.toLowerCase();
                const statusBadge = row.querySelector('.status-badge');
                let rowStatus = '';

                if (statusBadge.classList.contains('status-ouvert')) rowStatus = 'ouvert';
                if (statusBadge.classList.contains('status-complet')) rowStatus = 'complet';
                if (statusBadge.classList.contains('status-termine')) rowStatus = 'termine';

                // Vérifie si la ligne correspond au terme ET au statut
                const matchesTerm = title.includes(term);
                const matchesStatus = (status === 'all') || (rowStatus === status);

                if (matchesTerm && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Événements
        searchInput.addEventListener('input', filterActions);
        statusFilter.addEventListener('change', filterActions);

    </script>
    @push('scripts')
@endpush
