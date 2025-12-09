@extends('layouts.application')

@section('title', 'Artistes')
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
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header-info {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Table Container */
        .table-container {
            background: rgba(15, 29, 51, 0.5);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 25px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-add {
            background: #ff6b35;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-add:hover {
            background: #ff7e4d;
            transform: translateY(-2px);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(255, 255, 255, 0.03);
        }

        th {
            padding: 15px 20px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th i {
            margin-left: 5px;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.4);
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        td {
            padding: 20px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.9);
        }

        td:first-child {
            width: 40px;
        }

        .checkbox-cell {
            display: flex;
            align-items: center;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ff6b35;
        }

        .variant-image {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .variant-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-stock {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-stock:hover {
            border-color: #ff6b35;
            background: rgba(255, 107, 53, 0.1);
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .action-btn.edit:hover {
            background: rgba(52, 152, 219, 0.2);
            color: #3498db;
        }

        .action-btn.delete:hover {
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        <div class="header">
            <h1>Gestion des variantes - Casquette</h1>
            <p class="header-info">ID Produit: PROD-002 | Stock global : 120 unités</p>
        </div>

        <div class="table-container">
            <div class="table-header">
                <button class="btn-add" onclick="addVariant()">
                    <i class="fas fa-plus"></i>
                    Ajouter une nouvelle variante
                </button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>ID Article <i class="fas fa-sort"></i></th>
                        <th>Variante <i class="fas fa-sort"></i></th>
                        <th>Option 1 <i class="fas fa-sort"></i></th>
                        <th>Option 2 <i class="fas fa-sort"></i></th>
                        <th>Stock global <i class="fas fa-sort"></i></th>
                        <th>Image <i class="fas fa-sort"></i></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox">
                        </td>
                        <td>TSRI-001</td>
                        <td>Taille: Unique, Blanc</td>
                        <td>Taille: S</td>
                        <td>Couleur: Vert, Bleu</td>
                        <td>20</td>
                        <td>
                            <div class="variant-image">
                                <i class="fas fa-baseball-cap" style="font-size: 24px; color: #0a1628;"></i>
                            </div>
                        </td>
                        <td>
                            <button class="btn-stock" onclick="manageStock(1)">
                                <i class="fas fa-plus"></i>
                                Stock
                            </button>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit" onclick="editVariant(1)">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn delete" onclick="deleteVariant(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox">
                        </td>
                        <td>CAP-002</td>
                        <td>Taille: Unique, Noir</td>
                        <td>Taille: Unique</td>
                        <td>Couleur: Noir, Blanc</td>
                        <td>30</td>
                        <td>
                            <div class="variant-image">
                                <i class="fas fa-hat-cowboy" style="font-size: 24px; color: #0a1628;"></i>
                            </div>
                        </td>
                        <td>
                            <button class="btn-stock" onclick="manageStock(2)">
                                <i class="fas fa-plus"></i>
                                Stock
                            </button>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit" onclick="editVariant(2)">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn delete" onclick="deleteVariant(2)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox">
                        </td>
                        <td>CAP-003</td>
                        <td>Taille: Unique, Blanc</td>
                        <td>Taille: Unique</td>
                        <td>Couleur: Blanc, Bleu</td>
                        <td>25</td>
                        <td>
                            <div class="variant-image">
                                <i class="fas fa-graduation-cap" style="font-size: 24px; color: #0a1628;"></i>
                            </div>
                        </td>
                        <td>
                            <button class="btn-stock" onclick="manageStock(3)">
                                <i class="fas fa-plus"></i>
                                Stock
                            </button>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="action-btn edit" onclick="editVariant(3)">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="action-btn delete" onclick="deleteVariant(3)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
    
    <script>
        // Toggle select all checkboxes
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }

        // Add new variant
        function addVariant() {
            alert('Ouvrir le formulaire d\'ajout de variante');
            console.log('Add new variant clicked');
        }

        // Manage stock
        function manageStock(id) {
            alert(`Gérer le stock pour la variante #${id}`);
            console.log(`Manage stock for variant ${id}`);
        }

        // Edit variant
        function editVariant(id) {
            alert(`Modifier la variante #${id}`);
            console.log(`Edit variant ${id}`);
        }

        // Delete variant
        function deleteVariant(id) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer cette variante ?`)) {
                alert(`Variante #${id} supprimée`);
                console.log(`Delete variant ${id}`);
            }
        }

        // Menu item click handler
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
    @push('scripts')
@endpush
