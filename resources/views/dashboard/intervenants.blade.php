{{-- Sur cette page je dois gérer le css du paramètres --}}
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

        .search-filter {
            flex: 1;
            max-width: 400px;
        }

        .search-filter input {
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
                        <p>28</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-microphone"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Animateurs</h3>
                        <p>28</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-headphones"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total DJs</h3>
                        <p>28</p>
                    </div>
                </div>
            </div>

            <!-- Table Controls -->
            <div class="table-controls">
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher un intervenant...">
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

                    <button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Ajouter un intervenant
                    </button>

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
                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-001</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=1" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>NUBADA</h4>
                                        <p>nubada@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge artiste">Artiste</span></td>
                            <td><span class="status-badge confirme">✓ Confirmé</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Oui</span>
                                </div>
                            </td>
                            <td>15:00</td>
                            <td>27 Décembre 2025</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-002</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=2" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>TDJAMI</h4>
                                        <p>tdjami@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge artiste">Artiste</span></td>
                            <td><span class="status-badge en-attente">✕ En attente</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Oui</span>
                                </div>
                            </td>
                            <td>18:00</td>
                            <td>27 Décembre 2025</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-003</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=3" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>LIONEL KOFFI</h4>
                                        <p>lionel@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge animateur">Animateur</span></td>
                            <td><span class="status-badge en-attente">✕ En attente</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Non</span>
                                </div>
                            </td>
                            <td>19:00</td>
                            <td>27 Décembre 2025</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-004</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=4" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>NINNI TOURE</h4>
                                        <p>ninnitoure@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge animateur">Animateur</span></td>
                            <td><span class="status-badge confirme">✓ Confirmé</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Non</span>
                                </div>
                            </td>
                            <td>20:00</td>
                            <td>27 Décembre 2024</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-005</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=5" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>MOI</h4>
                                        <p>moi@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge dj">DJs</span></td>
                            <td><span class="status-badge en-attente">✕ En attente</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Non</span>
                                </div>
                            </td>
                            <td>16:00</td>
                            <td>28 Décembre 2024</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-006</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=6" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>QUALASE</h4>
                                        <p>qualase@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge animateur">Animateur</span></td>
                            <td><span class="status-badge confirme">✓ Confirmé</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Non</span>
                                </div>
                            </td>
                            <td>21:00</td>
                            <td>28 Décembre 2024</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>INT-007</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">
                                        <img src="https://i.pravatar.cc/150?img=7" alt="Avatar">
                                    </div>
                                    <div class="user-details">
                                        <h4>PEET</h4>
                                        <p>peet@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge dj">DJs</span></td>
                            <td><span class="status-badge en-attente">✕ En attente</span></td>
                            <td>
                                <div class="chart-cell">
                                    <i class="fas fa-chart-bar chart-icon"></i>
                                    <span>Non</span>
                                </div>
                            </td>
                            <td>21:00</td>
        </main>
    </div>

    

    @endsection 
        @push('scripts')
    @endpush
