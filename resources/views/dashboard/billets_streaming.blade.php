@extends('layouts.application')

@section('title', 'billets_streaming')
<style>
    .main-content {
            flex: 1;
            padding: 40px 50px;
        }

        .header {
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, #1e3a5f 0%, #2a4a6f 100%);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-label {
            font-size: 14px;
            color: #8b9db5;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 13px;
            color: #4ade80;
        }

        .stat-change i {
            margin-right: 5px;
        }

        /* Table */
        .table-container {
            background: linear-gradient(135deg, #1e3a5f 0%, #2a4a6f 100%);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #8b9db5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .edit-icon {
            color: #6b7f99;
            cursor: pointer;
            margin-left: 5px;
        }

        .edit-icon:hover {
            color: #fff;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-modifier {
            background-color: #3b82f6;
            color: #fff;
        }

        .btn-modifier:hover {
            background-color: #2563eb;
        }

        .btn-voir {
            background-color: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .btn-voir:hover {
            background-color: rgba(59, 130, 246, 0.3);
        }

</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
            <div class="header">
                <h1>Gestion des Billets Live Streaming</h1>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-label">Revenus Totaux</div>
                    <div class="stat-value">€1,125.00</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-up"></i> +5.2% vs. hier
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total des Billets Vendus</div>
                    <div class="stat-value">75</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-up"></i> +8.1% vs. hier
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Taux de Remplissage</div>
                    <div class="stat-value">37.5%</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-up"></i> +1.5% vs. hier
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NOM DU BILLET</th>
                            <th>PRIX DE VENTE</th>
                            <th>VENTES MAX. AUTORISÉES</th>
                            <th>BILLETS VENDUS</th>
                            <th>REVENUS GÉNÉRÉS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Billet Streaming Jour 1</td>
                            <td>€15.00</td>
                            <td>
                                100 
                                <i class="fas fa-edit edit-icon"></i>
                            </td>
                            <td>50</td>
                            <td>€750.00</td>
                            <td>
                                <div class="actions">
                                    <button class="btn btn-modifier">Modifier</button>
                                    <a href="{{ route ('billets streaming')}}" class="btn btn-voir">Voir Participants</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Billet Streaming Jour 2</td>
                            <td>€15.00</td>
                            <td>
                                100 
                                <i class="fas fa-edit edit-icon"></i>
                            </td>
                            <td>25</td>
                            <td>€375.00</td>
                            <td>
                                <div class="actions">
                                    <button class="btn btn-modifier">Modifier</button>
                                    <a href="{{ route ('billets streaming')}}" class="btn btn-voir">Voir Participants</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
@endsection
    
    <script>
        // Fonction pour éditer les ventes max autorisées
        document.querySelectorAll('.edit-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const cell = this.parentElement;
                const currentValue = cell.textContent.trim().split(' ')[0];
                
                const input = document.createElement('input');
                input.type = 'number';
                input.value = currentValue;
                input.style.cssText = 'width: 80px; padding: 5px; background: #1a2942; border: 1px solid #3b82f6; color: #fff; border-radius: 4px;';
                
                cell.innerHTML = '';
                cell.appendChild(input);
                input.focus();
                
                input.addEventListener('blur', function() {
                    cell.innerHTML = this.value + ' <i class="fas fa-edit edit-icon"></i>';
                    // Réattacher l'événement
                    cell.querySelector('.edit-icon').addEventListener('click', arguments.callee);
                });
                
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        this.blur();
                    }
                });
            });
        });

        // Fonction pour les boutons Modifier
        document.querySelectorAll('.btn-modifier').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Fonction de modification à implémenter');
            });
        });

        // Fonction pour les boutons Voir Participants
        document.querySelectorAll('.btn-voir').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Liste des participants à afficher');
            });
        });

        // Animation au survol des cartes de stats
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
    @push('scripts')
@endpush
