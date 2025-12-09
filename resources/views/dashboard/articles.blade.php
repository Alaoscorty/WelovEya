{{-- Sur cette page je dois gérer l'apparition du modal lorsqu'on clique sur le bouton ajouter une nouvelle article --}}
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
        .modal-container {
            background: white;
            border-radius: 12px;
            max-width: 650px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            display: none;
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-header {
            background: linear-gradient(135deg, #d35400 0%, #e67e22 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-header i {
            font-size: 22px;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .subtitle {
            background: #e8f4f8;
            color: #004080;
            padding: 12px 25px;
            font-size: 13px;
        }

        .form-section {
            background: #001f3f;
            padding: 30px 25px;
        }

        .section-title {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: white;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e67e22;
            background: rgba(255, 255, 255, 0.15);
        }

        .form-group select {
            cursor: pointer;
        }

        .form-group select option {
            background: #001f3f;
            color: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 35px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .btn-submit {
            background: linear-gradient(135deg, #d35400 0%, #e67e22 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 126, 34, 0.6);
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
                        <p>26</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Stock Total actuel</h3>
                        <p>1857</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Revenus générés</h3>
                        <p>45000 F</p>
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
                        <a href="{{ route ('ajout_variantes')}}"  class="btn btn-add " id="addArticleBtn">
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
                            <tr>
                                <td class="checkbox-cell"><input type="checkbox"></td>
                                <td>ARCL-001</td>
                                <td>T-shirt Logo/Maillard</td>
                                <td>10 000 F</td>
                                <td><span class="badge disponible">Disponible</span></td>
                                <td>333</td>
                                <td>
                                    3 (S bleu)<br>
                                    <span class="variant-info">(S) bleu; M blanc</span>
                                </td>
                                <td>Vêtement</td>
                                <td>Call center customized standard collection</td>
                                <td class="action-cell">
                                    <a href="{{ route ('gestion_variantes') }}"
                                    class="btn-action">
                                        <i class="fas fa-eye"></i> Gérer les variantes
    </a>
                                    <button class="icon-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="checkbox-cell"><input type="checkbox"></td>
                                <td>PROD-002</td>
                                <td>Casquette</td>
                                <td>8 000 F</td>
                                <td><span class="badge epuise">Épuisé</span></td>
                                <td>70</td>
                                <td>
                                    2 (S<br>
                                    <span class="variant-info">Noir/Marron)</span>
                                </td>
                                <td>Accessoire</td>
                                <td>Mlm casquette ajustable en coton avec 5 lettres</td>
                                <td class="action-cell">
                                    <a href="{{ route ('gestionCasquette')}}" class="btn-action">
                                        <i class="fas fa-eye"></i> Gérer les variantes
    </a>
                                    <button class="icon-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="checkbox-cell"><input type="checkbox"></td>
                                <td>PROD-003</td>
                                <td>Sac, Side-bag</td>
                                <td>13 000 F</td>
                                <td><span class="badge stock-bas">Stock bas</span></td>
                                <td>25</td>
                                <td>
                                    2 (S<br>
                                    <span class="variant-info">noir/marron)</span>
                                </td>
                                <td>Accessoire</td>
                                <td>Sac bandoulière d'affaires street wear en cuir simple</td>
                                <td class="action-cell">
                                    <a href="{{route('gestionSac')}}" class="btn-action">
                                        <i class="fas fa-eye"></i> Gérer les variantes
                                    </a>
                                    <button class="icon-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="checkbox-cell"><input type="checkbox"></td>
                                <td>PROD-004</td>
                                <td>Monture</td>
                                <td>10 000 F</td>
                                <td><span class="badge disponible">Disponible</span></td>
                                <td>18</td>
                                <td>
                                    2 (S<br>
                                    <span class="variant-info">bleu/marron)</span>
                                </td>
                                <td>Accessoire</td>
                                <td>10 articles d'informations sans pour sans reflets dispo</td>
                                <td class="action-cell">
                                    <button class="btn-action">
                                        <i class="fas fa-eye"></i> Gérer les variantes
                                    </button>
                                    <button class="icon-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <div class="modal-container" id="orderModal">
        <div class="modal-header">
            <h2>
                <i class="fas fa-plus-circle"></i>
                Ajouter un nouvel article
            </h2>
            <button class="close-btn" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="subtitle">
            Remplissez les informations sur votre article
        </div>

        <div class="form-section">
            <h3 class="section-title">Informations de base</h3>

            <form id="articleForm">
                <div class="form-group">
                    <label for="articleName">Nom de l'article</label>
                    <input type="text" id="articleName" placeholder="Entrez le nom de l'article" required>
                </div>

                <div class="form-group">
                    <label for="price">Prix de Vente</label>
                    <input type="number" id="price" placeholder="0.00" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select id="category" required>
                        <option value="">Ex: Vêtement</option>
                        <option value="vetement">Vêtement</option>
                        <option value="electronique">Électronique</option>
                        <option value="alimentaire">Alimentaire</option>
                        <option value="maison">Maison & Jardin</option>
                        <option value="sport">Sport</option>
                        <option value="livres">Livres</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Description détaillée de l'article" required></textarea>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-cancel" id="cancelBtn" onclick="cancelForm()">
                        <i class="fas fa-times-circle"></i>
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-check-circle"></i>
                        Ajouter l'article
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter un stock
                </div>
                <button class="close-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <span>Stock ajouté avec succès !</span>
                </div>

                <div class="section-title">Informations de base</div>

                <div class="form-group">
                    <label class="form-label">Article concerné</label>
                    <div class="input-wrapper">
                        <i class="fas fa-tag input-icon"></i>
                        <input type="text" class="form-input" id="article" value="T-Shirt Logo Événement" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Stock actuel</label>
                    <div class="input-wrapper">
                        <i class="fas fa-box input-icon"></i>
                        <input type="number" class="form-input calculated-field" id="currentStock" value="20" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Quantité à ajouter</label>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity()">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" class="quantity-input" id="quantity" value="20" min="0" oninput="calculateTotal()">
                        <button class="quantity-btn" onclick="increaseQuantity()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nouveau Stock Total</label>
                    <div class="input-wrapper">
                        <i class="fas fa-calculator input-icon"></i>
                        <input type="number" class="form-input calculated-field" id="newStock" value="40" readonly>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                    Annuler
                </button>
                <button class="btn btn-confirm" onclick="confirmStock()">
                    <i class="fas fa-check"></i>
                    Confirmer l'ajout de Stock
                </button>
            </div>
        </div>
</div>
@endsection
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
        //gestionnaire du modal
        const form = document.getElementById('articleForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const articleData = {
                name: document.getElementById('articleName').value,
                price: document.getElementById('price').value,
                category: document.getElementById('category').value,
                description: document.getElementById('description').value
            };

            console.log('Article ajouté:', articleData);
            
            alert('Article ajouté avec succès!\n\n' + 
                  'Nom: ' + articleData.name + '\n' +
                  'Prix: ' + articleData.price + ' €\n' +
                  'Catégorie: ' + articleData.category + '\n' +
                  'Description: ' + articleData.description);
            
            form.reset();
        });

        function closeModal() {
            if (confirm('Voulez-vous vraiment fermer? Les modifications non enregistrées seront perdues.')) {
                window.close();
            }
        }

        function cancelForm() {
            if (confirm('Voulez-vous annuler? Toutes les données saisies seront perdues.')) {
                form.reset();
            }
        }
        // Modal functionality
        document.getElementById('addArticleBtn').addEventListener('click', function() {
            document.getElementById('orderModal').classList.add('show');
        });

        document.getElementById('cancelBtn').addEventListener('click', function() {
            document.getElementById('orderModal').classList.remove('show');
        });
        function calculateTotal() {
            const currentStock = parseInt(document.getElementById('currentStock').value) || 0;
            const quantity = parseInt(document.getElementById('quantity').value) || 0;
            const newStock = currentStock + quantity;
            document.getElementById('newStock').value = newStock;
        }

        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            calculateTotal();
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 0) {
                quantityInput.value = currentValue - 1;
                calculateTotal();
            }
        }

        function confirmStock() {
            const successMessage = document.getElementById('successMessage');
            successMessage.classList.add('show');
            
            setTimeout(() => {
                successMessage.classList.remove('show');
            }, 3000);
        }

        function closeModal() {
            const modal = document.querySelector('.modal');
            modal.style.animation = 'slideOut 0.3s ease-out';
            
            setTimeout(() => {
                alert('Modal fermée');
            }, 300);
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    transform: translateY(0);
                    opacity: 1;
                }
                to {
                    transform: translateY(-50px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    @push('scripts')
@endpush