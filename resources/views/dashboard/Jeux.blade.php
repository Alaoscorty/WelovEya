@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
        }

        .btn-add {
            background: linear-gradient(90deg, #ff6b35 0%, #ff8c5a 100%);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        /* Filters */
        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            align-items: center;
        }

        .search-filter {
            flex: 1;
            position: relative;
        }

        .search-filter input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 12px 15px 12px 45px;
            color: #fff;
            font-size: 14px;
            outline: none;
        }

        .search-filter i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Table */
        .table-container {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
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
            padding: 16px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        td {
            padding: 20px;
            font-size: 14px;
            vertical-align: middle;
        }

        .social-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .social-badge.facebook {
            background: rgba(24, 119, 242, 0.15);
            color: #1877f2;
        }

        .social-badge.instagram {
            background: rgba(225, 48, 108, 0.15);
            color: #e1306c;
        }

        .social-badge.tiktok {
            background: rgba(0, 242, 234, 0.15);
            color: #00f2ea;
        }

        .social-badge i {
            font-size: 16px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.en-cours {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }

        .status-badge.termine {
            background: rgba(156, 163, 175, 0.15);
            color: #9ca3af;
        }

        .link-btn {
            color: #60a5fa;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            transition: all 0.3s;
        }

        .link-btn:hover {
            color: #93c5fd;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .action-btn.edit:hover {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }

        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <div class="header">
            <h1>Suivi des Jeux-Concours</h1>
            <a href="{{ route('ajout_jeux') }}" class="btn-add">
                <i class="fas fa-plus"></i>
                Ajouter un Jeu
            </a>
        </div>

        <div class="filters">
            <div class="search-filter">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher par nom, partenaire...">
            </div>
            <div class="filter-group">
                <button class="filter-btn active">Tous les statuts</button>
                <button class="filter-btn">En cours</button>
                <button class="filter-btn">Terminé</button>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NOM DU JEU</th>
                        <th>PARTENAIRE</th>
                        <th>RÉSEAU SOCIAL</th>
                        <th>STATUT</th>
                        <th>PÉRIODE</th>
                        <th>LIEN</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Concours d'été</strong></td>
                        <td>Marque A</td>
                        <td>
                            <span class="social-badge facebook">
                                <i class="fab fa-facebook-f"></i>
                                Facebook
                            </span>
                        </td>
                        <td>
                            <span class="status-badge en-cours">En cours</span>
                        </td>
                        <td>Se termine le 31/08/2024</td>
                        <td>
                            <a href="#" class="link-btn">
                                Visiter <i class="fas fa-external-link-alt"></i>
                            </a>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Jeu de la rentrée</strong></td>
                        <td>Marque B</td>
                        <td>
                            <span class="social-badge instagram">
                                <i class="fab fa-instagram"></i>
                                Instagram
                            </span>
                        </td>
                        <td>
                            <span class="status-badge en-cours">En cours</span>
                        </td>
                        <td>Se termine le 15/09/2024</td>
                        <td>
                            <a href="#" class="link-btn">
                                Visiter <i class="fas fa-external-link-alt"></i>
                            </a>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Concours de Noël</strong></td>
                        <td>Marque C</td>
                        <td>
                            <span class="social-badge tiktok">
                                <i class="fab fa-tiktok"></i>
                                TikTok
                            </span>
                        </td>
                        <td>
                            <span class="status-badge termine">Terminé</span>
                        </td>
                        <td>Terminé le 25/12/2023</td>
                        <td>
                            <a href="#" class="link-btn">
                                Visiter <i class="fas fa-external-link-alt"></i>
                            </a>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
    
    <script>
        // Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-filter input');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Action buttons
        document.querySelectorAll('.action-btn.edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const gameName = row.querySelector('td:first-child strong').textContent;
                alert(`Modifier: ${gameName}`);
            });
        });

        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const gameName = row.querySelector('td:first-child strong').textContent;
                if (confirm(`Êtes-vous sûr de vouloir supprimer "${gameName}" ?`)) {
                    row.remove();
                }
            });
        });

        // Add button
        document.querySelector('.btn-add').addEventListener('click', function() {
            alert('Redirection vers le formulaire de création d\'un jeu-concours');
        });
    </script>
    @push('scripts')
@endpush
