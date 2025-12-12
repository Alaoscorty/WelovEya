@extends('layouts.application')

@section('title', 'Artistes')
<style>
.modal-container {
    background: white;
    border-radius: 12px;
    width: 100%;
    max-width: 650px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    overflow: hidden;
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
@section('content')

    {{-- MAIN CONTENT --}}
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
                    <button type="button" class="btn btn-cancel" onclick="cancelForm()">
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
@endsection
<script>
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
    </script>
    @push('scripts')
@endpush
