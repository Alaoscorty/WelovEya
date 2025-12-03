@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
  .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #9ca3af;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #1a1f3a;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #2a2f4a;
            display: flex;
            align-items: center;
            gap: 20px;
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

        .stat-icon.blue {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .stat-icon.purple {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
        }

        .stat-info h3 {
            font-size: 14px;
            color: #9ca3af;
            margin-bottom: 8px;
            font-weight: normal;
        }

        .stat-info p {
            font-size: 32px;
            font-weight: bold;
        }

        /* Table Section */
        .table-section {
            background: #1a1f3a;
            border-radius: 12px;
            border: 1px solid #2a2f4a;
            padding: 25px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-search {
            flex: 1;
            max-width: 400px;
        }

        .table-search input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            background: #0d1129;
            border: 1px solid #2a2f4a;
            border-radius: 8px;
            color: #fff;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .add-btn {
            background: #ff6b35;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .add-btn:hover {
            background: #ff5722;
        }

        .table-filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
            font-size: 14px;
            flex-wrap: wrap;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #9ca3af;
        }

        .filter-item i {
            font-size: 12px;
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 15px 10px;
            color: #9ca3af;
            font-weight: 500;
            font-size: 13px;
            border-bottom: 1px solid #2a2f4a;
        }

        .data-table td {
            padding: 18px 10px;
            border-bottom: 1px solid #2a2f4a;
            font-size: 14px;
        }

        .data-table tr:hover {
            background: #0d1129;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: #ff6b35;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .user-avatar.simple {
            background: transparent;
            border: 2px solid #2a2f4a;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 500;
        }

        .user-email {
            color: #6b7280;
            font-size: 13px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .badge.actif {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .badge.inactif {
            background: rgba(107, 114, 128, 0.2);
            color: #6b7280;
        }

        .badge.suspendu {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .badge.restreint {
            background: rgba(249, 115, 22, 0.2);
            color: #f97316;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }

        .status-badge.actif {
            background: rgba(34, 197, 94, 0.3);
            color: #22c55e;
            border: 1px solid #22c55e;
        }

        .status-badge.inactif {
            background: rgba(107, 114, 128, 0.3);
            color: #9ca3af;
            border: 1px solid #6b7280;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            background: #0d1129;
            border: 1px solid #2a2f4a;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: #2a2f4a;
            color: #fff;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .pagination-info {
            color: #9ca3af;
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .page-select {
            padding: 8px 12px;
            background: #0d1129;
            border: 1px solid #2a2f4a;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
        }

        .page-btn {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            background: #0d1129;
            border: 1px solid #2a2f4a;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            transition: all 0.3s;
        }

        .page-btn:hover {
            background: #2a2f4a;
            color: #fff;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #1a1f3a;
            border-radius: 10px;
            margin-top: auto;
            cursor: pointer;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .profile-info h4 {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .profile-info p {
            font-size: 12px;
            color: #6b7280;
        }
</style>

<div className="ml-56 p-8">
    <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Gestion des revendeurs</h1>
                <p>Gérez vos partenaires et leurs performances</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total revendeurs</h3>
                        <p>156</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Actifs ce mois</h3>
                        <p>134</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Commission Moyenne</h3>
                        <p>14.3 %</p>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <div class="table-header">
                    <div style="position: relative;">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Rechercher un revendeur..." style="padding-left: 40px; width: 350px; padding: 10px 15px 10px 40px; background: #0d1129; border: 1px solid #2a2f4a; border-radius: 8px; color: #fff;">
                    </div>
                    <button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Ajouter un revendeur
                    </button>
                </div>

                <div class="table-filters">
                    <span style="color: #fff; font-weight: 500;"><i class="fas fa-filter"></i> 5 filtres</span>
                    <span class="filter-item"><i class="fas fa-phone"></i> Téléphone <i class="fas fa-chevron-down"></i></span>
                    <span class="filter-item"><i class="fas fa-toggle-on"></i> Statuts vendus <i class="fas fa-chevron-down"></i></span>
                    <span class="filter-item"><i class="fas fa-ban"></i> Commission <i class="fas fa-chevron-down"></i></span>
                    <span class="filter-item"><i class="fas fa-calendar"></i> Statut <i class="fas fa-chevron-down"></i></span>
                    <span class="filter-item"><i class="fas fa-award"></i> Paiement général <i class="fas fa-chevron-down"></i></span>
                    <span class="filter-item"><i class="fas fa-ban"></i> Membre depuis <i class="fas fa-chevron-down"></i></span>
                    <span class="filter-item"><i class="fas fa-ellipsis-h"></i> Date d'inscription <i class="fas fa-chevron-down"></i></span>
                    <span style="color: #ff6b35; margin-left: 10px; cursor: pointer;">Réinitialiser <i class="fas fa-redo"></i></span>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Nom</th>
                            <th><i class="fas fa-phone"></i> Téléphone</th>
                            <th><i class="fas fa-toggle-on"></i> Statuts vendus</th>
                            <th><i class="fas fa-ban"></i> Commission</th>
                            <th><i class="fas fa-calendar"></i> Statut</th>
                            <th><i class="fas fa-id-card"></i> Paiement général</th>
                            <th><i class="fas fa-award"></i> Membre depuis</th>
                            <th><i class="fas fa-chart-bar"></i> Stock attribué</th>
                            <th><i class="fas fa-percentage"></i> Taux d'abonnement</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">LR</div>
                                    <div class="user-info">
                                        <span class="user-name">LE ROI AZEEZ</span>
                                        <span class="user-email">leroidesabonne@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>+22963456870</td>
                            <td>183</td>
                            <td><span class="badge restreint">RESTREINT</span></td>
                            <td><span class="status-badge actif">ACTIF</span></td>
                            <td>ID667</td>
                            <td>Novembre 2024</td>
                            <td>200</td>
                            <td>99%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar simple">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">ICI C'EST POPADOM</span>
                                        <span class="user-email">icicpopadom@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[404] 404 - 4477</td>
                            <td>303</td>
                            <td><span class="badge actif">ACTIF</span></td>
                            <td><span class="status-badge inactif">INACTIF</span></td>
                            <td>ID2067</td>
                            <td>Novembre 2023</td>
                            <td>100</td>
                            <td>100%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">LR</div>
                                    <div class="user-info">
                                        <span class="user-name">LE ROI AZEEZ7</span>
                                        <span class="user-email">azeez7@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[299] 415 - 5100</td>
                            <td>89</td>
                            <td><span class="badge restreint">RESTREINT</span></td>
                            <td><span class="status-badge inactif">INACTIF</span></td>
                            <td>ID187</td>
                            <td>Décembre 2020</td>
                            <td>50</td>
                            <td>92%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar simple">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">ICI C'EST OFFICIEL</span>
                                        <span class="user-email">icicest@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[356] 647 - 4009</td>
                            <td>48</td>
                            <td><span class="badge suspendu">SUSPENDU</span></td>
                            <td><span class="status-badge actif">ACTIF</span></td>
                            <td>IT107</td>
                            <td>Novembre 2024</td>
                            <td>250</td>
                            <td>77%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar simple">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">ICI C'EST OFFICIEL</span>
                                        <span class="user-email">theuniverse2@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[284] 443 - 2876</td>
                            <td>116</td>
                            <td><span class="badge restreint">RESTREINT</span></td>
                            <td><span class="status-badge inactif">INACTIF</span></td>
                            <td>ID187</td>
                            <td>Décembre 2024</td>
                            <td>0</td>
                            <td>0%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">LR</div>
                                    <div class="user-info">
                                        <span class="user-name">LE ROI AZEEZ</span>
                                        <span class="user-email">leroideesabon@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[504] 415 - 4600</td>
                            <td>104</td>
                            <td><span class="badge restreint">RESTREINT</span></td>
                            <td><span class="status-badge actif">ACTIF</span></td>
                            <td>ID2067</td>
                            <td>Novembre 2024</td>
                            <td>020</td>
                            <td>98%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar simple">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">LE BOSS DOKIT</span>
                                        <span class="user-email">dankidneed.it@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[407] 915 - 7770</td>
                            <td>93</td>
                            <td><span class="badge actif">ACTIF</span></td>
                            <td><span class="status-badge inactif">INACTIF</span></td>
                            <td>IT607</td>
                            <td>Novembre 2025</td>
                            <td>100</td>
                            <td>100%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">LR</div>
                                    <div class="user-info">
                                        <span class="user-name">LE ROI AZEEZ</span>
                                        <span class="user-email">larocakev@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[7262] 853 - 6792</td>
                            <td>105</td>
                            <td><span class="badge restreint">RESTREINT</span></td>
                            <td><span class="status-badge actif">ACTIF</span></td>
                            <td>IT3357</td>
                            <td>Décembre 2023</td>
                            <td>450</td>
                            <td>70%</td>
                            <td>
                                <div class="actions">
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar simple">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">LE BOSS DOKIT</span>
                                        <span class="user-email">doonkeet31@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>[911] 347 - 8472</td>
                            <td>223</td>
                            <td><span class="badge restreint">RESTREINT</span></td>
                            <td><span class="status-badge inactif">INACTIF</span></td>
                            <td>IT207F</td>


</div>
@endsection

    @push('scripts')
  <script>
    // =======================
    //  RECHERCHE EN TEMPS RÉEL
    // =======================
    const searchInput = document.querySelector('.table-header input[type="text"]');
    const rows = document.querySelectorAll('.data-table tbody tr');

    searchInput.addEventListener('keyup', function () {
        let value = this.value.toLowerCase().trim();

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(value) ? "" : "none";
        });
    });

    // =======================
    //  COCHER / DÉCOCHER TOUT
    // =======================
    const mainCheckbox = document.querySelector('thead th input[type="checkbox"]');
    const allCheckboxes = document.querySelectorAll('tbody td input[type="checkbox"]');

    mainCheckbox.addEventListener('change', function () {
        allCheckboxes.forEach(cb => cb.checked = mainCheckbox.checked);
    });

    // =======================
    //  ACTIONS : VOIR / EDIT / SUPPRIMER
    // =======================
    const actionButtons = document.querySelectorAll('.action-btn');

    actionButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const icon = this.querySelector('i').classList;

            if (icon.contains('fa-eye')) {
                alert("👁 Voir le profil du revendeur");
            } 
            else if (icon.contains('fa-edit')) {
                alert("✏ Modifier le revendeur");
            } 
            else if (icon.contains('fa-trash')) {
                if (confirm("⚠ Voulez-vous vraiment supprimer ce revendeur ?")) {
                    this.closest('tr').remove();
                }
            }
        });
    });

    // =======================
    //  AJOUTER UN REVENDEUR (DEMO)
    // =======================
    const addBtn = document.querySelector('.add-btn');

    addBtn.addEventListener('click', function () {
        alert("Formulaire d'ajout à ouvrir ici ");
    });
</script>
@endpush
