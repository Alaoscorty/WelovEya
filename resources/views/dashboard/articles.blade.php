@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
    .main-content {
            flex: 1;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #b8c5d6;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #0d1b2a;
            padding: 20px;
            border-radius: 12px;
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
            font-size: 22px;
        }

        .stat-icon.orange {
            background: rgba(255, 140, 66, 0.2);
            color: #ff8c42;
        }

        .stat-icon.blue {
            background: rgba(74, 144, 226, 0.2);
            color: #4a90e2;
        }

        .stat-icon.green {
            background: rgba(39, 174, 96, 0.2);
            color: #27ae60;
        }

        .stat-details h3 {
            font-size: 12px;
            color: #b8c5d6;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .stat-details p {
            font-size: 24px;
            font-weight: 700;
        }

        /* Table Section */
        .table-section {
            background: #0d1b2a;
            border-radius: 12px;
            padding: 20px;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-filter {
            display: flex;
            gap: 15px;
            flex: 1;
            max-width: 600px;
        }

        .search-input {
            flex: 1;
            position: relative;
        }

        .search-input input {
            width: 100%;
            padding: 10px 15px 10px 35px;
            background: #1a2842;
            border: 1px solid #2a3f5f;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }

        .search-input i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c7a89;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper select {
            padding: 10px 35px 10px 15px;
            background: #1a2842;
            border: 1px solid #2a3f5f;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            appearance: none;
        }

        .select-wrapper i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c7a89;
            pointer-events: none;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add {
            background: linear-gradient(135deg, #ff8c42 0%, #d35400 100%);
            color: #fff;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 140, 66, 0.3);
        }

        .btn-export {
            background: transparent;
            color: #b8c5d6;
            border: 1px solid #2a3f5f;
        }

        .btn-export:hover {
            background: #1a2842;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #1a2842;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 13px;
            color: #b8c5d6;
            font-weight: 600;
            white-space: nowrap;
        }

        th i {
            margin-left: 5px;
            font-size: 12px;
            cursor: pointer;
        }

        tbody tr {
            border-bottom: 1px solid #1a2842;
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: rgba(255, 140, 66, 0.05);
        }

        td {
            padding: 15px;
            font-size: 14px;
            color: #e0e6ed;
        }

        .checkbox-cell {
            width: 40px;
        }

        .checkbox-cell input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.disponible {
            background: rgba(39, 174, 96, 0.2);
            color: #27ae60;
        }

        .badge.epuise {
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        .badge.stock-bas {
            background: rgba(241, 196, 15, 0.2);
            color: #f1c40f;
        }

        .variant-info {
            font-size: 12px;
            color: #6c7a89;
            margin-top: 3px;
        }

        .action-cell {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-action {
            padding: 8px 15px;
            background: #1a2842;
            border: 1px solid #2a3f5f;
            border-radius: 6px;
            color: #b8c5d6;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .btn-action:hover {
            background: #ff8c42;
            color: #fff;
            border-color: #ff8c42;
        }

        .icon-button {
            width: 35px;
            height: 35px;
            border: none;
            background: #1a2842;
            color: #b8c5d6;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .icon-button:hover {
            background: #2a3f5f;
            color: #fff;
        }
        
</style>
{{-- Main Content --}}
<div class=" p-8">
    <main class="main-content">
            <div class="page-header">
                <h1>Gestion des articles</h1>
                <p>Visualisez et gérez tous vos articles</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-cube"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Total Articles suivi</h3>
                        <p>{{ $totalArticles }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Stock Total actuel</h3>
                        <p>{{ $stockTotal }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Revenus générés</h3>
                        <p>{{ number_format($revenusGeneres, 0, ',', ' ') }} F</p>
                    </div>
                </div>
            </div>


            <!-- Table Section -->
            <div class="table-section">
                <div class="table-controls">
                    <div class="search-filter">
                        <div class="search-input">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Rechercher par type de, prix....">
                        </div>
                        <div class="select-wrapper">
                            <select id="categoryFilter">
                                <option>Catégorie</option>
                                <option>Vêtements</option>
                                <option>Accessoires</option>
                                <option>Électronique</option>
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="{{route ('ajoutArticles')}}"class="btn btn-add " id="addArticleBtn">
                            <i class="fas fa-plus"></i>
                            Ajouter un nouvel article
                        </a>
                        
                        <button class="btn btn-export">
                            <i class="fas fa-download"></i>
                            Exporter
                        </button>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="checkbox-cell">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>ID Article <i class="fas fa-sort"></i></th>
                                <th>Nom de l'Article <i class="fas fa-sort"></i></th>
                                <th>Prix de Vente <i class="fas fa-sort"></i></th>
                                <th>Statut <i class="fas fa-sort"></i></th>
                                <th>Stock global <i class="fas fa-sort"></i></th>
                                <th>nº de variantes</th>
                                <th>Catégorie <i class="fas fa-sort"></i></th>
                                <th>Description <i class="fas fa-sort"></i></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($produits as $produit)
                                <tr>
                                    <td class="checkbox-cell"><input type="checkbox"></td>
                                    <td>{{ $produit->id }}</td>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ number_format($produit->prix, 0, ',', ' ') }} F</td>
                                    <td>
                                        @if($produit->stock == 0)
                                            <span class="badge epuise">Épuisé</span>
                                        @elseif($produit->stock < 20)
                                            <span class="badge stock-bas">Stock bas</span>
                                        @else
                                            <span class="badge disponible">Disponible</span>
                                        @endif
                                    </td>
                                    <td>{{ $produit->stock }}</td>
                                    <td>
                                        {{-- Exemple : variantes (tu peux adapter selon ta table variantes) --}}
                                        0
                                    </td>
                                    <td>{{ $produit->categorie }}</td>
                                    <td>{{ $produit->description }}</td>
                                    <td class="action-cell">
                                        <button class="icon-button">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" action="{{ route('produits.destroy', $produit->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </main>
</div>

@endsection
@push('scripts')
<script>
    // Select All Checkbox
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Search functionality
    const searchInput = document.querySelector('.search-input input');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Category filter
    document.getElementById('categoryFilter').addEventListener('change', function() {
        const category = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        if (category === 'catégorie') {
            rows.forEach(row => row.style.display = '');
            return;
        }
        
        rows.forEach(row => {
            const rowCategory = row.cells[7].textContent.toLowerCase();
            row.style.display = rowCategory.includes(category) ? '' : 'none';
        });
    });

    // Sort functionality
    document.querySelectorAll('th i.fa-sort').forEach(icon => {
        icon.addEventListener('click', function() {
            const th = this.parentElement;
            const table = th.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const columnIndex = Array.from(th.parentElement.children).indexOf(th);
            
            const isAscending = this.classList.contains('sorted-asc');
            
            rows.sort((a, b) => {
                const aValue = a.cells[columnIndex].textContent.trim();
                const bValue = b.cells[columnIndex].textContent.trim();
                
                if (isAscending) {
                    return bValue.localeCompare(aValue, 'fr', { numeric: true });
                } else {
                    return aValue.localeCompare(bValue, 'fr', { numeric: true });
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
            
            document.querySelectorAll('th i.fa-sort').forEach(i => {
                i.classList.remove('sorted-asc', 'sorted-desc');
            });
            
            if (isAscending) {
                this.classList.remove('sorted-asc');
                this.classList.add('sorted-desc');
            } else {
                this.classList.remove('sorted-desc');
                this.classList.add('sorted-asc');
            }
        });
    });

    // Delete button functionality
    document.querySelectorAll('.icon-button .fa-trash').forEach(button => {
        button.parentElement.addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
                this.closest('tr').remove();
            }
        });
    });
        
</script>
    
@endpush