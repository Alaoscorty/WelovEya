@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
    .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            background: linear-gradient(135deg, #1e3b8a81 0%, #1e40af6e 100%);
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #8892b0;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 25px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            pointer-events: none;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 500;
        }

        .stat-icon {
            width: 35px;
            height: 35px;
            background: rgba(255,255,255,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #ff6b35;
        }

        /* Table Section */
        .table-section {
            padding: 30px;
        }

        .table-header {
            margin-bottom: 25px;
        }

        .table-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            padding: 15px;
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        tbody td {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 14px;
        }

        tbody tr:hover {
            background: rgba(255,255,255,0.03);
        }

        .category-name {
            font-weight: 600;
        }

        .profit-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
        }

        .profit-high {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .profit-medium {
            background: rgba(234, 179, 8, 0.2);
            color: #eab308;
        }

        .btn-details {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: #60a5fa;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .btn-details:hover {
            background: rgba(96, 165, 250, 0.1);
            border-color: #60a5fa;
        }

        /* Bottom Actions */
        .bottom-actions {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 15px;
            background: #1e293b;
            padding: 15px 20px;
            border-radius: 50px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .action-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s;
        }

        .action-btn.primary {
            background: #6366f1;
            color: #fff;
        }

        .action-btn.secondary {
            background: transparent;
            color: #cbd5e1;
            border: 2px solid #334155;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #6366f1;
            color: #fff;
            padding: 12px 30px;
            border-radius: 25px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-edit:hover {
            background: #4f46e5;
            transform: translateY(-2px);
        }
</style>
{{-- Main Content --}}
<div class=" p-8">
    <div class="main-content">
            <div class="header">
                <h1>Tableau de Bord de Rentabilité Ciblée</h1>
                <p>Festival WeLovEya</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Revenu Brut Total</span>
                        <div class="stat-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="stat-value">500 000 €</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Coûts Directs Totaux</span>
                        <div class="stat-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                    </div>
                    <div class="stat-value">175 000 €</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Bénéfice Net Global</span>
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="stat-value">325 000 €</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Marge Opérationnelle (%)</span>
                        <div class="stat-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                    </div>
                    <div class="stat-value">65%</div>
                </div>
            </div>

            <div class="table-section">
                <div class="table-header">
                    <h2>Détail de la Rentabilité par Catégorie</h2>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>CATÉGORIE DE REVENU</th>
                            <th>REVENUS GÉNÉRÉS</th>
                            <th>COÛTS DIRECTS</th>
                            <th>BÉNÉFICE NET</th>
                            <th>MARGE (%)</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="category-name">Tickets Festival</td>
                            <td>350 000 €</td>
                            <td>70 000 €</td>
                            <td>280 000 €</td>
                            <td><span class="profit-badge profit-high">80%</span></td>
                            <td>
                                <button class="btn-details">
                                    <i class="fas fa-eye"></i>
                                    Voir Détails
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="category-name">Billets Streaming</td>
                            <td>100 000 €</td>
                            <td>25 000 €</td>
                            <td>75 000 €</td>
                            <td><span class="profit-badge profit-high">75%</span></td>
                            <td>
                                <button class="btn-details">
                                    <i class="fas fa-eye"></i>
                                    Voir Détails
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="category-name">Merchandising</td>
                            <td>50 000 €</td>
                            <td>30 000 €</td>
                            <td>20 000 €</td>
                            <td><span class="profit-badge profit-medium">40%</span></td>
                            <td>
                                <button class="btn-details">
                                    <i class="fas fa-eye"></i>
                                    Voir Détails
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bottom-actions">
            <button class="action-btn primary">
                <i class="fas fa-play"></i>
            </button>
            <button class="action-btn secondary">
                <i class="fas fa-hand-pointer"></i>
            </button>
            <button class="action-btn secondary">
                <i class="far fa-comment"></i>
            </button>
            <button class="btn-edit">Ask to edit</button>
        </div>
    </div>
</div>
@endsection
<script>
    // Add interactivity
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    document.querySelectorAll('.btn-details').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const category = row.querySelector('.category-name').textContent;
            alert(`Affichage des détails pour: ${category}`);
        });
    });

    document.querySelector('.btn-edit').addEventListener('click', function() {
        alert('Mode édition activé');
    });
</script>
    @push('scripts')
@endpush