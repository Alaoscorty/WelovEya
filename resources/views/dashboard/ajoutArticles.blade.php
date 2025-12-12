@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
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

        .modal-container.show {
            display: flex;
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
    @endsection
    <script>
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

        // Edit button functionality
        document.querySelectorAll('.icon-button .fa-edit').forEach(button => {
            button.parentElement.addEventListener('click', function() {
                const row = this.closest('tr');
                const cells = row.querySelectorAll('td');

                // Extract data from the row
                const id = cells[1].textContent.trim();
                const name = cells[2].textContent.trim();
                const price = cells[3].textContent.trim();
                const category = cells[7].textContent.trim();
                const description = cells[8].textContent.trim();

                // Populate the edit modal
                document.getElementById('editArticleName').value = name;
                document.getElementById('editPrice').value = price;
                document.getElementById('editCategory').value = category.toLowerCase().replace(' ', '');
                document.getElementById('editDescription').value = description;

                // Update modal title with article ID
                document.getElementById('editModalTitle').textContent = `Modifier l'article ${id}`;

                // Show the edit modal
                document.getElementById('editModal').classList.add('show');
            });
        });

        // Close edit modal function
        function closeEditModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        // Edit form submission
        document.getElementById('editArticleForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const updatedData = {
                name: document.getElementById('editArticleName').value,
                price: document.getElementById('editPrice').value,
                category: document.getElementById('editCategory').value,
                description: document.getElementById('editDescription').value
            };

            console.log('Article modifié:', updatedData);

            alert('Article modifié avec succès!\n\n' +
                  'Nom: ' + updatedData.name + '\n' +
                  'Prix: ' + updatedData.price + '\n' +
                  'Catégorie: ' + updatedData.category + '\n' +
                  'Description: ' + updatedData.description);

            closeEditModal();
        });
    </script>
    @push('scripts')
@endpush