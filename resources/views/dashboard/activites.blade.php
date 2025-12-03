@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            background: linear-gradient(180deg, #0f1c3f 0%, #0a0e1a 100%);
            padding: 0;
        }

        .content-wrapper {
            background: linear-gradient(135deg, #12255a91 0%, #1e40af 100%);
            padding: 30px 40px;
            margin: 20px;
            padding-bottom: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
        }

        .btn-create {
            padding: 10px 20px;
            background: #ff8c42;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-create:hover {
            background: #ff7a2e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 66, 0.4);
        }

        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
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
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-export:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Table */
        .table-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(0, 0, 0, 0.2);
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 18px 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 13px;
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
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
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
            gap: 8px;
        }

        .btn-action {
            padding: 6px 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
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
                    <button class="btn-create">
                        <i class="fas fa-plus-circle"></i>
                        Créer une nouvelle Action
                    </button>
                </div>

                <div class="filters">
                    <div class="search-filter">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher par nom...">
                    </div>
                    <div class="status-filter">
                        <select>
                            <option>Statut: Ouvert</option>
                            <option>Statut: Complet</option>
                            <option>Statut: Terminé</option>
                            <option>Tous les statuts</option>
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
                                <th>NOM DE L'ACTION</th>
                                <th>DATE & HEURE</th>
                                <th>LIEU</th>
                                <th>INSCRIPTIONS</th>
                                <th>STATUT</th>
                                <th>RÉCOMPENSE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="action-name">Nettoyage de l'École A</td>
                                <td>18/12/2025 à<br>14:00</td>
                                <td>Parc de la Villette,<br>Paris</td>
                                <td>15 / 20 places</td>
                                <td><span class="status-badge status-ouvert">Ouvert</span></td>
                                <td>2 Billets Jour 1</td>
                                <td>
                                    <div class="actions-buttons">
                                        <button class="btn-action">Gérer</button>
                                        <button class="btn-action">Modifier</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="action-name">Collecte de fonds pour le refuge</td>
                                <td>22/01/2026 à<br>09:00</td>
                                <td>Siège social, Lyon</td>
                                <td>30 / 30<br>places</td>
                                <td><span class="status-badge status-complet">Complet</span></td>
                                <td>1 Bon d'achat de<br>20€</td>
                                <td>
                                    <div class="actions-buttons">
                                        <button class="btn-action">Gérer</button>
                                        <button class="btn-action">Modifier</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="action-name">Atelier de sensibilisation</td>
                                <td>05/11/2025 à<br>18:00</td>
                                <td>En ligne (Zoom)</td>
                                <td>48 / 50<br>places</td>
                                <td><span class="status-badge status-termine">Terminé</span></td>
                                <td>Points de<br>bénévolat</td>
                                <td>
                                    <div class="actions-buttons">
                                        <button class="btn-action">Gérer</button>
                                        <button class="btn-action">Modifier</button>
                                    </div>
                                </td>
                            </tr>
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
    </script>
    @push('scripts')
@endpush
