{{-- Sur cette page je dois gérer l'apparition du modal lorsqu'on clique sur le bouton ajouter une nouvelle commandes --}}
@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
  .main-content {
            flex: 1;
            padding: 30px 40px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            color: #8b95a5;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #1a2642 0%, #0d1b2a 100%);
            border: 1px solid #2a3f5f;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-icon.orange {
            background: rgba(255, 107, 53, 0.2);
            color: #ff6b35;
        }

        .stat-icon.green {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .stat-icon.yellow {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .stat-icon.red {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .stat-info h3 {
            font-size: 13px;
            color: #8b95a5;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-info p {
            font-size: 24px;
            font-weight: 700;
        }

        /* Table Section */
        .table-section {
            background: linear-gradient(135deg, #1a2642 0%, #0d1b2a 100%);
            border: 1px solid #2a3f5f;
            border-radius: 12px;
            padding: 25px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-search {
            background: #0d1b2a;
            padding: 10px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            max-width: 400px;
            border: 1px solid #2a3f5f;
        }

        .table-search input {
            background: none;
            border: none;
            color: #fff;
            outline: none;
            width: 100%;
            font-size: 14px;
        }

        .table-search input::placeholder {
            color: #6c7a89;
        }

        .table-search i {
            color: #6c7a89;
        }

        .add-btn {
            background: #ff6b35;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .add-btn:hover {
            background: #ff5722;
        }

        .pagination-info {
            color: #8b95a5;
            font-size: 13px;
        }

        /* Table */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .orders-table thead th {
            text-align: left;
            padding: 15px 10px;
            color: #8b95a5;
            font-weight: 500;
            font-size: 13px;
            border-bottom: 1px solid #2a3f5f;
        }

        .orders-table thead th i {
            margin-left: 5px;
            font-size: 10px;
            cursor: pointer;
        }

        .orders-table tbody tr {
            border-bottom: 1px solid #1a2642;
            transition: all 0.3s;
        }

        .orders-table tbody tr:hover {
            background: rgba(255, 107, 53, 0.05);
        }

        .orders-table tbody td {
            padding: 18px 10px;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #2a3f5f;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }

        .order-id {
            color: #fff;
            font-weight: 500;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .customer-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #2a3f5f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .customer-details h4 {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .customer-details p {
            font-size: 12px;
            color: #6c7a89;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge.validee {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .badge.attente {
            background: rgba(99, 102, 241, 0.2);
            color: #6366f1;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            color: #8b95a5;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: rgba(255, 107, 53, 0.2);
            color: #ff6b35;
        }
  .modal-content {
            flex: 1;
            margin: 30px;
            overflow-y: auto;
            background: #0d1b2e;
            border-radius: 10px;
            border: 1px solid #1e3a5f;
            padding-bottom: 15px;
        }

        .alert {
            background: linear-gradient(135deg, #d97638 0%, #c55a20 100%);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert i {
            font-size: 20px;
        }

        .alert-content h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .alert-content p {
            font-size: 13px;
            opacity: 0.9;
        }

        .form-section {
            background: #0d1b2e;
            padding: 25px;

        }

        .section-title {
            font-size: 16px;
            margin-bottom: 20px;
            color: #fff;
            font-weight: 600;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13px;
            color: #8ba3bf;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            padding: 10px 15px;
            background: #0a1628;
            border: 1px solid #1e3a5f;
            border-radius: 5px;
            color: #fff;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4a9eff;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #0a1628;
        }

        th {
            padding: 12px;
            text-align: left;
            font-size: 13px;
            color: #8ba3bf;
            font-weight: 600;
            border-bottom: 1px solid #1e3a5f;
        }

        td {
            padding: 15px 12px;
            font-size: 14px;
            border-bottom: 1px solid #1e3a5f;
        }

        tbody tr:hover {
            background: #0a1628;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        /* Payment Section */
        .payment-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .payment-group h4 {
            font-size: 13px;
            color: #8ba3bf;
            margin-bottom: 15px;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-option label {
            font-size: 14px;
            cursor: pointer;
        }

        .total-display {
            background: #0a1628;
            padding: 15px;
            border-radius: 5px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        /* Buttons */
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-secondary {
            background: transparent;
            color: #8ba3bf;
            border: 1px solid #1e3a5f;
        }

        .btn-secondary:hover {
            background: #1a2f4a;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d97638 0%, #c55a20 100%);
            color: #fff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(217, 118, 56, 0.4);
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
</style>
  <!-- Main -->
  <div class="ml-5 p-8">
        <main class="main-content">
            <div class="header">
                <h1>Gestion des commandes</h1>
                <p>Visualisez et gérez toutes les commandes</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Articles Vendus</h3>
                        <p>2847</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Commandes</h3>
                        <p>2456</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon yellow">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Commandes en attente</h3>
                        <p>391</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Revenus Générés</h3>
                        <p>450000 F</p>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <div class="table-header">
                    <div class="table-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher une commande ....">
                    </div>
                    <span class="pagination-info">1 - 10 sur</span>
                    <button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Ajouter une commande
                    </button>
                </div>

                <table class="orders-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkbox"></th>
                            <th>ID Commande <i class="fas fa-sort"></i></th>
                            <th>Acheteur <i class="fas fa-sort"></i></th>
                            <th>Articles achetés <i class="fas fa-sort"></i></th>
                            <th>Statut <i class="fas fa-sort"></i></th>
                            <th>Revenus générés <i class="fas fa-sort"></i></th>
                            <th>Date <i class="fas fa-sort"></i></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td class="order-id">CDE-001</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>3</td>
                            <td><span class="badge validee"><i class="fas fa-check-circle"></i> Validée</span></td>
                            <td>13700 F</td>
                            <td>15 Novembre 2024</td>
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
                            <td class="order-id">CDE-002</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">MM</div>
                                    <div class="customer-details">
                                        <h4>Marie Martin</h4>
                                        <p>mariemartin@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td><span class="badge attente"><i class="fas fa-clock"></i> En attente</span></td>
                            <td>15000 F</td>
                            <td>15 Novembre 2023</td>
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
                            <td class="order-id">CDE-003</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">SD</div>
                                    <div class="customer-details">
                                        <h4>Sophie Dubois</h4>
                                        <p>sophiedubois@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span class="badge attente"><i class="fas fa-clock"></i> En attente</span></td>
                            <td>5675 F</td>
                            <td>10 Décembre 2023</td>
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
                            <td class="order-id">CDE-004</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">EB</div>
                                    <div class="customer-details">
                                        <h4>Emma Bernard</h4>
                                        <p>emmab@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>5</td>
                            <td><span class="badge validee"><i class="fas fa-check-circle"></i> Validée</span></td>
                            <td>3375 F</td>
                            <td>29 Novembre 2024</td>
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
                            <td class="order-id">CDE-005</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>4</td>
                            <td><span class="badge attente"><i class="fas fa-clock"></i> En attente</span></td>
                            <td>13293 F</td>
                            <td>17 Décembre 2024</td>
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
                            <td class="order-id">CDE-006</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span class="badge validee"><i class="fas fa-check-circle"></i> Validée</span></td>
                            <td>10000 F</td>
                            <td>07 Novembre 2024</td>
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
                            <td class="order-id">CDE-007</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td><span class="badge attente"><i class="fas fa-clock"></i> En attente</span></td>
                            <td>8100 F</td>
                            <td>04 Novembre 2023</td>
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
                            <td class="order-id">CDE-008</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td><span class="badge validee"><i class="fas fa-check-circle"></i> Validée</span></td>
                            <td>11700 F</td>
                            <td>06 Décembre 2023</td>
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
                            <td class="order-id">CDE-009</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span class="badge attente"><i class="fas fa-clock"></i> En attente</span></td>
                            <td>19200 F</td>
                            <td>08 Novembre 2024</td>
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
                            <td class="order-id">CDE-010</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">JD</div>
                                    <div class="customer-details">
                                        <h4>Jean Dupont</h4>
                                        <p>jeandupont@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>5</td>
                            <td><span class="badge attente"><i class="fas fa-clock"></i> En attente</span></td>
                            <td>15000 F</td>
                            <td>10 Décembre 2024</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
</div>
  </div>
  <!-- Modal de gestion des commandes -->
   <main class="modal-content">
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                <div class="alert-content">
                    <h4>Nouvelle Commande</h4>
                    <p>Remplissez les informations pour créer une nouvelle commande</p>
                </div>
            </div>

            <!-- Section 1: Informations de base -->
            <div class="form-section">
                <h3 class="section-title">I. Informations de base</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom de l'acheteur</label>
                        <input type="text" placeholder="Nom complet">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="example@email.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" placeholder="+225 XX XX XX XX">
                    </div>
                    <div class="form-group">
                        <label>Date de la commande</label>
                        <input type="date" value="2025-01-07">
                    </div>
                </div>
            </div>

            <!-- Section 2: Articles à commander -->
            <div class="form-section">
                <h3 class="section-title">II. Articles à commander</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkbox"></th>
                                <th>Nom d'article</th>
                                <th>Type d'article</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>Biscuit</td>
                                <td>Biscuit</td>
                                <td>0.040 F</td>
                                <td>8</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>Crapolet</td>
                                <td>Ville cloisette_test</td>
                                <td>5.305 F</td>
                                <td>6</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>T-shirt</td>
                                <td>Textile de test</td>
                                <td>0.020 F</td>
                                <td>0</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>T-shirt</td>
                                <td>Textile de test</td>
                                <td>0.450 F</td>
                                <td>0</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>Bananes</td>
                                <td>Bananes</td>
                                <td>25.000 F</td>
                                <td>0</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>Chemise</td>
                                <td>Textile de test</td>
                                <td>0.000 F</td>
                                <td>8</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section 3: Récapitulatif et paiement -->
            <div class="form-section">
                <h3 class="section-title">III. Récapitulatif et paiement</h3>
                <div class="payment-row">
                    <div>
                        <h4>TOTAL À PAYER</h4>
                        <div class="total-display">0</div>
                    </div>
                    <div>
                        <div style="margin-bottom: 25px;">
                            <h4>Méthode de paiement</h4>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" name="payment" id="espece" checked>
                                    <label for="espece">Espèce</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="payment" id="carte">
                                    <label for="carte">Carte</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="payment" id="cheque">
                                    <label for="cheque">Chèque</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Statut du paiement</h4>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" name="status" id="paye" checked>
                                    <label for="paye">Payé</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="status" id="enattente">
                                    <label for="enattente">En attente</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="status" id="annule">
                                    <label for="annule">Annulé</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button class="btn btn-secondary">Annuler</button>
                <button class="btn btn-primary" onclick="createOrder()">Créer la commande</button>
            </div>
        </main>
<script>
// Checkbox functionality
        document.querySelectorAll('.checkbox').forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                if (this.style.background) {
                    this.style.background = '';
                } else {
                    this.style.background = '#ff6b35';
                }
            });
        });

        // Menu navigation
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Sort functionality
        document.querySelectorAll('.orders-table thead th i').forEach(icon => {
            icon.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelectorAll('.orders-table thead th i').forEach(i => {
                    i.classList.remove('fa-sort-up', 'fa-sort-down');
                    i.classList.add('fa-sort');
                });
                
                this.classList.remove('fa-sort');
                this.classList.add('fa-sort-up');
            });
        });

        // Search functionality
        const searchInputs = document.querySelectorAll('input[type="text"]');
        searchInputs.forEach(input => {
            input.addEventListener('input', function() {
                console.log('Searching for:', this.value);
            });
        });
// Calculate total when quantities change
        function calculateTotal() {
            const rows = document.querySelectorAll('#tableBody tr');
            let total = 0;

            rows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"]');
                if (checkbox.checked) {
                    const priceText = row.cells[3].textContent.replace(' F', '').replace('.', '');
                    const quantity = parseInt(row.cells[4].textContent);
                    const price = parseFloat(priceText);
                    const itemTotal = price * quantity;
                    total += itemTotal;
                    row.cells[5].textContent = itemTotal.toFixed(3) + ' F';
                } else {
                    row.cells[5].textContent = '-';
                }
            });

            document.querySelector('.total-display').textContent = total.toFixed(3) + ' F';
        }

        // Add event listeners to checkboxes
        document.querySelectorAll('#tableBody input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });

        // Select all checkbox functionality
        document.querySelector('thead input[type="checkbox"]').addEventListener('change', function() {
            document.querySelectorAll('#tableBody input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            calculateTotal();
        });

        function createOrder() {
            alert('Commande créée avec succès!');
        }

        // Initial calculation
        calculateTotal();
</script>
@endsection

    @push('scripts')
@endpush