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

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            max-height: 80vh;
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
                    <p>{{ $commandes->sum(fn($c)=>$c->articles->sum('quantite')) }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Commandes</h3>
                    <p>{{ $commandes->count() }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>Commandes en attente</h3>
                    <p>{{ $commandes->where('statut','En attente')->count() }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>Revenus Générés</h3>
                    <p>{{ $commandes->sum('total') }} F</p>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="table-header">
                <div class="table-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher une commande ...." id="searchInput">
                </div>
                <span class="pagination-info">1 - 10 sur {{ $commandes->count() }}</span>
                <button class="add-btn" id="addOrderBtn">
                    <i class="fas fa-plus"></i> Ajouter une commande
                </button>
            </div>

            <table class="orders-table">
                <thead>
                    <tr>
                        <th><input id="selectAll" type="checkbox" class="checkbox"></th>
                        <th>ID Commande <i class="fas fa-sort"></i></th>
                        <th>Acheteur <i class="fas fa-sort"></i></th>
                        <th>Articles achetés <i class="fas fa-sort"></i></th>
                        <th>Statut <i class="fas fa-sort"></i></th>
                        <th>Revenus générés <i class="fas fa-sort"></i></th>
                        <th>Date <i class="fas fa-sort"></i></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="ordersBody">
                    @foreach($commandes as $cmd)
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td class="order-id">CDE-{{ $cmd->id }}</td>
                        <td>
                            <div class="customer-info">
                                <div class="customer-avatar">{{ substr($cmd->nom_acheteur,0,2) }}</div>
                                <div class="customer-details">
                                    <h4>{{ $cmd->nom_acheteur }}</h4>
                                    <p>{{ $cmd->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $cmd->articles->sum('quantite') }}</td>
                        <td><span class="badge {{ $cmd->statut=='Payé' ? 'validee':'attente' }}">{{ $cmd->statut }}</span></td>
                        <td>{{ $cmd->total }} F</td>
                        <td>{{ $cmd->date_commande }}</td>
                        <td>
                            <div class="actions">
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                                <button class="action-btn"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Modal de création -->
<div class="modal" id="orderModal">
    <main class="modal-content">
        <form id="orderForm" method="POST" action="{{ route('commandes.store') }}">
            @csrf
            <!-- Section informations de base -->
            <div class="form-section">
                <h3>I. Informations de base</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom de l'acheteur</label>
                        <input type="text" name="nom_acheteur" placeholder="Nom complet" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="example@email.com" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" placeholder="+225 XX XX XX XX" required>
                    </div>
                    <div class="form-group">
                        <label>Date de la commande</label>
                        <input type="date" name="date_commande" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
            </div>

            <!-- Section Articles -->
            <div class="form-section">
                <h3>II. Articles à commander</h3>
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
                                <td>0.040</td>
                                <td contenteditable="true">1</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox"></td>
                                <td>Crapolet</td>
                                <td>Ville cloisette_test</td>
                                <td>5.305</td>
                                <td contenteditable="true">1</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section paiement -->
            <div class="form-section">
                <h3>III. Récapitulatif et paiement</h3>
                <div class="payment-row">
                    <div>
                        <h4>TOTAL À PAYER</h4>
                        <div class="total-display">0</div>
                    </div>
                    <div>
                        <h4>Méthode de paiement</h4>
                        <select name="methode_paiement">
                            <option value="Espèce">Espèce</option>
                            <option value="Carte">Carte</option>
                            <option value="Chèque">Chèque</option>
                        </select>
                        <h4>Statut du paiement</h4>
                        <select name="statut">
                            <option value="Payé">Payé</option>
                            <option value="En attente">En attente</option>
                            <option value="Annulé">Annulé</option>
                        </select>
                    </div>
                </div>
            </div>

            <input type="hidden" name="articles_data" id="articles_data">

            <div class="button-group">
                <button type="button" class="btn btn-secondary" id="cancelBtn">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer la commande</button>
            </div>
        </form>
    </main>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    // Calcul total
    function calculateTotal(){
        const rows = document.querySelectorAll('#tableBody tr');
        let total = 0;
        rows.forEach(row => {
            const checkbox = row.querySelector('input[type="checkbox"]');
            if(checkbox.checked){
                const price = parseFloat(row.cells[3].textContent);
                const qty = parseInt(row.cells[4].textContent);
                const itemTotal = price*qty;
                total += itemTotal;
                row.cells[5].textContent = itemTotal.toFixed(3);
            } else {
                row.cells[5].textContent = '-';
            }
        });
        document.querySelector('.total-display').textContent = total.toFixed(3);
    }

    // Event listener
    document.querySelectorAll('#tableBody input[type="checkbox"], #tableBody td[contenteditable="true"]').forEach(el=>{
        el.addEventListener('input', calculateTotal);
        el.addEventListener('change', calculateTotal);
    });

    // Form submission
    document.getElementById('orderForm').addEventListener('submit', function(){
        const rows = document.querySelectorAll('#tableBody tr');
        let articles = [];
        rows.forEach(row => {
            const checkbox = row.querySelector('input[type="checkbox"]');
            if(checkbox.checked){
                articles.push({
                    nom_article: row.cells[1].textContent,
                    type_article: row.cells[2].textContent,
                    prix: parseFloat(row.cells[3].textContent),
                    quantite: parseInt(row.cells[4].textContent)
                });
            }
        });
        document.getElementById('articles_data').value = JSON.stringify(articles);
    });
    // Modal functionality
            document.getElementById('addOrderBtn').addEventListener('click', function() {
                document.getElementById('orderModal').classList.add('show');
            });

            document.getElementById('cancelBtn').addEventListener('click', function() {
                document.getElementById('orderModal').classList.remove('show');
            });

</script>
@endpush