@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
    .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            cursor: pointer;
        }

        .breadcrumb:hover {
            color: #fff;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .search-bar {
            width: 100%;
            padding: 12px 20px;
            padding-left: 45px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }

        .search-bar::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .search-icon {
            position: absolute;
            left: 56px;
            top: 188px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Table */
        .table-container {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(255, 255, 255, 0.05);
        }

        th {
            padding: 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        tbody tr {
            transition: background 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .participant-info h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .participant-info p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .badge-warning {
            background: rgba(251, 146, 60, 0.2);
            color: #fb923c;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-utilisé {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-non-utilisé {
            background: rgba(251, 146, 60, 0.15);
            color: #fb923c;
            border: 1px solid rgba(251, 146, 60, 0.3);
        }

        .status-bloqué {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-link {
            color: #ff6b35;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .action-link:hover {
            color: #ff8555;
            text-decoration: underline;
        }

        .divider {
            color: rgba(255, 255, 255, 0.3);
            margin: 0 4px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .btn-primary {
            background: #ff6b35;
            border-color: #ff6b35;
        }

        .btn-primary:hover {
            background: #ff8555;
            border-color: #ff8555;
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                padding: 20px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 12px 8px;
            }
        }
</style>
        {{-- Main Content --}}
<div class=" p-8">
    <!-- Main Content -->
        <main class="main-content">
            

            <div class="page-header">
                <h1 class="page-title">Participants Live : [Nom du Billet] - Festival WeLovEya</h1>
                <div class="breadcrumb">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour à la Gestion des Billets Live Streaming</span>
                </div>
                <div style="position: relative;">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-bar" placeholder="Rechercher par Nom, Email, Code...">
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NOM/EMAIL DU CLIENT</th>
                            <th>BILLET ACHETÉ</th>
                            <th>CONFIRMATION DE PAIEMENT</th>
                            <th>CODE D'ACCÈS</th>
                            <th>STATUT D'UTILISATION</th>
                            <th>DATE DE PREMIÈRE CONNEXION</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="participant-info">
                                    <h4>Jean Dupont</h4>
                                    <p>jean.dupont@email.com</p>
                                </div>
                            </td>
                            <td>Jour 1</td>
                            <td><span class="badge badge-success">Payé: TXS2356789</span></td>
                            <td>A8B3-F5R2-C0L1</td>
                            <td><span class="status-badge status-utilisé">Utilisé</span></td>
                            <td>2023-10-28 09:05:12</td>
                            <td>
                                <div class="actions">
                                    <a href="#" class="action-link">Renouveler le Code</a>
                                    <span class="divider">|</span>
                                    <a href="#" class="action-link">Bloquer l'Accès</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="participant-info">
                                    <h4>Marie Curie</h4>
                                    <p>marie.curie@email.com</p>
                                </div>
                            </td>
                            <td>Jour 2</td>
                            <td><span class="badge badge-success">Payé: TXB8765433</span></td>
                            <td>G4H7-J3K6-P7R9</td>
                            <td><span class="status-badge status-non-utilisé">Non utilisé</span></td>
                            <td>-</td>
                            <td>
                                <div class="actions">
                                    <a href="#" class="action-link">Renouveler le Code</a>
                                    <span class="divider">|</span>
                                    <a href="#" class="action-link">Bloquer l'Accès</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="participant-info">
                                    <h4>Louis Pasteur</h4>
                                    <p>louis.pasteur@email.com</p>
                                </div>
                            </td>
                            <td>Jour 1</td>
                            <td><span class="badge badge-success">Payé: YX99644433</span></td>
                            <td>Z6X4-Y7N6-Q9H1</td>
                            <td><span class="status-badge status-bloqué">Bloqué</span></td>
                            <td>2023-10-28 08:30:00</td>
                            <td>
                                <div class="actions">
                                    <a href="#" class="action-link">Renouveler le Code</a>
                                    <span class="divider">|</span>
                                    <a href="#" class="action-link">Bloquer l'Accès</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="participant-info">
                                    <h4>Ada Lovelace</h4>
                                    <p>ada.lovelace@email.com</p>
                                </div>
                            </td>
                            <td>Pass VIP</td>
                            <td><span class="badge badge-success">Payé: TK90000001</span></td>
                            <td>L9V4-C3B7-A2H1</td>
                            <td><span class="status-badge status-non-utilisé">Non utilisé</span></td>
                            <td>-</td>
                            <td>
                                <div class="actions">
                                    <a href="#" class="action-link">Renouveler le Code</a>
                                    <span class="divider">|</span>
                                    <a href="#" class="action-link">Bloquer l'Accès</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <button class="btn">Précédent</button>
                <button class="btn btn-primary">Suivant</button>
            </div>
        </main>
    </div>

    


@endsection
    <script>
        // Menu interaction
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        const searchBar = document.querySelector('.search-bar');
        searchBar.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Action links
        document.querySelectorAll('.action-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.textContent;
                const row = this.closest('tr');
                const name = row.querySelector('.participant-info h4').textContent;
                
                alert(`Action "${action}" pour ${name}`);
            });
        });

        // Pagination
        document.querySelectorAll('.pagination .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                console.log('Pagination:', this.textContent);
            });
        });
    </script> 
    @push('scripts')
@endpush