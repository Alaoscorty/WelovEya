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
            margin-bottom: 5px;
        }

        .breadcrumb {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }

        .content-box {
            background: #0a1629;
            border-radius: 8px;
            padding: 25px;
            border: 1px solid #1a2f4d;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-variant-btn {
            background: linear-gradient(135deg, #d97339, #c85a28);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.3s;
        }

        .add-variant-btn:hover {
            transform: translateY(-2px);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #0f1e33;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid #1a2f4d;
        }

        th i {
            margin-left: 5px;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.5);
        }

        tbody tr {
            border-bottom: 1px solid #1a2f4d;
            transition: background 0.3s;
        }

        tbody tr:hover {
            background: #0f1e33;
        }

        td {
            padding: 15px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }

        .checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit: cover;
        }

        .stock-btn {
            background: transparent;
            border: 1px solid #3b82f6;
            color: #3b82f6;
            padding: 6px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .stock-btn:hover {
            background: #3b82f6;
            color: white;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 16px;
            padding: 5px;
            transition: color 0.3s;
        }

        .action-btn:hover {
            color: white;
        }

        .action-btn.delete:hover {
            color: #ef4444;
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
            <div class="header">
                <h1>Gestion des variantes - Sac Totebag</h1>
                <div class="breadcrumb">
                    <span>10 Produit</span> • 
                    <span>PRIX: 0.0721</span> • 
                    <span>Stock global : 156 unités</span>
                </div>
            </div>

            <div class="content-box">
                <div class="table-header">
                    <div></div>
                    <button class="add-variant-btn">
                        <i class="fas fa-plus"></i>
                        Ajouter une variante
                    </button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkbox"></th>
                            <th>ID Article <i class="fas fa-sort"></i></th>
                            <th>Variante <i class="fas fa-sort"></i></th>
                            <th>Option 1 <i class="fas fa-sort"></i></th>
                            <th>Option 2 <i class="fas fa-sort"></i></th>
                            <th>Stock global <i class="fas fa-sort"></i></th>
                            <th>Image <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>SAC-030</td>
                            <td>Totbag Unique, Noir</td>
                            <td>Taille: Unique</td>
                            <td>Couleur: Noir, Blanc</td>
                            <td>39</td>
                            <td><img src="" alt="Produit" class="product-image"></td>
                            <td>
                                <button class="stock-btn">
                                    <i class="fas fa-box"></i>
                                    Stock
                                </button>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>SAC-031</td>
                            <td>Totbag Unique, Noir</td>
                            <td>Taille: Unique</td>
                            <td>Couleur: Noir,Blanc</td>
                            <td>58</td>
                            <td><img src="" alt="Produit" class="product-image"></td>
                            <td>
                                <button class="stock-btn">
                                    <i class="fas fa-box"></i>
                                    Stock
                                </button>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="checkbox"></td>
                            <td>SAC-032</td>
                            <td>Totbag Unique, Blanc</td>
                            <td>Taille: Unique</td>
                            <td>Couleur: Blanc, Bleu</td>
                            <td>22</td>
                            <td><img src="" alt="Produit" class="product-image"></td>
                            <td>
                                <button class="stock-btn">
                                    <i class="fas fa-box"></i>
                                    Stock
                                </button>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
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
      // Toggle sidebar on mobile
        const menuToggle = document.createElement('button');
        menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
        menuToggle.style.cssText = 'position: fixed; top: 20px; left: 20px; background: #d97339; border: none; color: white; padding: 10px 15px; border-radius: 6px; cursor: pointer; z-index: 1001; display: none;';
        
        if (window.innerWidth <= 768) {
            menuToggle.style.display = 'block';
            document.body.appendChild(menuToggle);
        }

        menuToggle.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('open');
        });

        // Add variant button
        document.querySelector('.add-variant-btn').addEventListener('click', () => {
            alert('Ouverture du formulaire d\'ajout de variante');
        });

        // Stock buttons
        document.querySelectorAll('.stock-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                alert('Gestion du stock');
            });
        });

        // Edit buttons
        document.querySelectorAll('.action-btn:not(.delete)').forEach(btn => {
            btn.addEventListener('click', () => {
                alert('Modification de la variante');
            });
        });

        // Delete buttons
        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm('Voulez-vous vraiment supprimer cette variante ?')) {
                    btn.closest('tr').remove();
                }
            });
        });

        // Checkbox selection
        const mainCheckbox = document.querySelector('thead input[type="checkbox"]');
        const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

        mainCheckbox.addEventListener('change', () => {
            rowCheckboxes.forEach(cb => cb.checked = mainCheckbox.checked);
        });

        // Sort functionality
        document.querySelectorAll('th i.fa-sort').forEach(icon => {
            icon.parentElement.style.cursor = 'pointer';
            icon.parentElement.addEventListener('click', () => {
                alert('Tri en cours...');
            });
        });  
    </script>
    @push('scripts')
@endpush
