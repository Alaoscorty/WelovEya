@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            padding: 40px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .product-info {
            font-size: 14px;
            color: #888;
        }

        .content-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-btn {
            background: #ff6b35;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .add-btn:hover {
            background: #ff8555;
            transform: translateY(-2px);
        }

        /* Table */
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
            font-weight: 600;
            color: #aaa;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th i {
            margin-left: 5px;
            font-size: 10px;
        }

        td {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        tbody tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            background: rgba(255, 255, 255, 0.1);
        }

        .stock-badge {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid #3b82f6;
            border-radius: 6px;
            color: #60a5fa;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .stock-badge:hover {
            background: rgba(59, 130, 246, 0.3);
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .action-btn.edit:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .action-btn.delete:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        <div class="header">
            <h1>Gestion des variantes - T-shirt Logo Évènement</h1>
            <p class="product-info">ID Produit: PRCO-OC-1 | Stock global : 120 unités</p>
        </div>

        <div class="content-box">
            <div class="table-header">
                <div></div>
                <a href="{{ route ('ajout_variantes')}}" class="add-btn">
                    <i class="fas fa-plus"></i>
                    Ajouter une nouvelle variante
    </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" class="checkbox"></th>
                        <th>ID Variante <i class="fas fa-sort"></i></th>
                        <th>Variante <i class="fas fa-sort"></i></th>
                        <th>Option 1 <i class="fas fa-sort"></i></th>
                        <th>Option 2 <i class="fas fa-sort"></i></th>
                        <th>Stock global <i class="fas fa-sort"></i></th>
                        <th>Image <i class="fas fa-sort"></i></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td>TSH-001</td>
                        <td>Taille S, Noir</td>
                        <td>Taille S</td>
                        <td>Couleur : Noir</td>
                        <td>20</td>
                        <td><img src="" alt="" class="product-image"></td>
                        <td>
                            <div class="actions">
                                <span class="stock-badge"><i class="fas fa-box"></i> Stock</span>
                                <button class="action-btn edit"><i class="fas fa-pen"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td>TSH-002</td>
                        <td>Taille M, Noir</td>
                        <td>Taille M</td>
                        <td>Couleur : Noir</td>
                        <td>30</td>
                        <td><img src="" alt="" class="product-image"></td>
                        <td>
                            <div class="actions">
                                <span class="stock-badge"><i class="fas fa-box"></i> Stock</span>
                                <button class="action-btn edit"><i class="fas fa-pen"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td>TSH-003</td>
                        <td>Taille L, Noir</td>
                        <td>Taille L</td>
                        <td>Couleur : Noir</td>
                        <td>25</td>
                        <td><img src="" alt="" class="product-image"></td>
                        <td>
                            <div class="actions">
                                <span class="stock-badge"><i class="fas fa-box"></i> Stock</span>
                                <button class="action-btn edit"><i class="fas fa-pen"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td>TSH-004</td>
                        <td>Taille S, Blanc</td>
                        <td>Taille S</td>
                        <td>Couleur : Blanc</td>
                        <td>15</td>
                        <td><img src="" alt="" class="product-image"></td>
                        <td>
                            <div class="actions">
                                <span class="stock-badge"><i class="fas fa-box"></i> Stock</span>
                                <button class="action-btn edit"><i class="fas fa-pen"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td>TSH-005</td>
                        <td>Taille M, Blanc</td>
                        <td>Taille M</td>
                        <td>Couleur : Blanc</td>
                        <td>20</td>
                        <td><img src="" alt="" class="product-image"></td>
                        <td>
                            <div class="actions">
                                <span class="stock-badge"><i class="fas fa-box"></i> Stock</span>
                                <button class="action-btn edit"><i class="fas fa-pen"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td>TSH-004</td>
                        <td>Taille L, Blanc</td>
                        <td>Taille L</td>
                        <td>Couleur : Blanc</td>
                        <td>10</td>
                        <td><img src="" alt="" class="product-image"></td>
                        <td>
                            <div class="actions">
                                <span class="stock-badge"><i class="fas fa-box"></i> Stock</span>
                                <button class="action-btn edit"><i class="fas fa-pen"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
    
    <script>
        // Gestion des boutons d'action
        document.querySelectorAll('.action-btn.edit').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Fonction d\'édition - À implémenter');
            });
        });

        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if(confirm('Êtes-vous sûr de vouloir supprimer cette variante ?')) {
                    this.closest('tr').remove();
                }
            });
        });

        document.querySelectorAll('.stock-badge').forEach(badge => {
            badge.addEventListener('click', function() {
                alert('Gérer le stock - À implémenter');
            });
        });

        // Bouton ajouter
        document.querySelector('.add-btn').addEventListener('click', function() {
            alert('Ajouter une nouvelle variante - À implémenter');
        });

        // Recherche
        document.querySelector('.search-box input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
    @push('scripts')
@endpush
