@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .modal {
            background: #0a1e3d;
            color: white;
            border-radius: 8px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #d97339 0%, #c85a28 100%);
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

        .modal-header .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .modal-header .close-btn:hover {
            transform: scale(1.1);
        }

        .modal-description {
            background: #c85a28;
            padding: 12px 25px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .modal-body {
            padding: 30px 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            background: #1a2f4d;
            border: 1px solid #2d4a6d;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #d97339;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .file-upload {
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload-btn {
            background: #1a2f4d;
            border: 1px solid #2d4a6d;
            padding: 12px 20px;
            border-radius: 4px;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .file-upload-btn:hover {
            background: #2d4a6d;
            color: white;
        }

        .file-name {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .section-divider {
            margin: 30px 0 25px 0;
            padding-top: 25px;
            border-top: 1px solid #2d4a6d;
        }

        .modal-footer {
            padding: 20px 25px;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            border-top: 1px solid #2d4a6d;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel {
            background: transparent;
            color: white;
            border: 1px solid #2d4a6d;
        }

        .btn-cancel:hover {
            background: #1a2f4d;
        }

        .btn-submit {
            background: linear-gradient(135deg, #d97339 0%, #c85a28 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(217, 115, 57, 0.4);
        }

        select option {
            background: #1a2f4d;
            color: white;
        }

        @media (max-width: 768px) {
            .modal {
                margin: 10px;
            }

            .modal-header h2 {
                font-size: 18px;
            }

            .modal-body {
                padding: 20px 15px;
            }

            .modal-footer {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <div class="modal">
        <div class="modal-header">
            <h2>
                <i class="fas fa-plus-circle"></i>
                Ajouter une nouvelle variante
            </h2>
            <button class="close-btn" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-description">
            Définissez les options de votre produit pour générer les combinaisons uniques
        </div>

        <div class="modal-body">
            <div class="section-title">I. Informations de base</div>
            
            <div class="form-group">
                <label>Article concerné</label>
                <input type="text" value="T-Shirt Logo Evènement" readonly>
            </div>

            <div class="form-group">
                <label>Image de l'article</label>
                <div class="file-upload">
                    <label for="fileInput" class="file-upload-btn">
                        <i class="fas fa-upload"></i> Choisir un fichier
                    </label>
                    <input type="file" id="fileInput" accept="image/*" onchange="updateFileName(this)">
                    <span class="file-name" id="fileName">Aucun fichier choisi</span>
                </div>
            </div>

            <div class="section-divider">
                <div class="section-title">II. Options</div>
            </div>

            <div class="form-group">
                <label>Taille</label>
                <input type="text" placeholder="Ex: S, L, M, N, XL">
            </div>

            <div class="form-group">
                <label>Couleur</label>
                <input type="text" placeholder="Ex: Noir, Blanc">
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-cancel" onclick="closeModal()">Annuler</button>
            <button class="btn btn-submit" onclick="saveOptions()">
                <i class="fas fa-save"></i> Enregistrez les options
            </button>
        </div>
    </div>
@endsection
    
<script>
        function updateFileName(input) {
            const fileName = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
            } else {
                fileName.textContent = 'Aucun fichier choisi';
            }
        }

        function closeModal() {
            if (confirm('Voulez-vous vraiment fermer sans enregistrer ?')) {
                document.querySelector('.modal').style.animation = 'fadeOut 0.3s';
                setTimeout(() => {
                    alert('Modal fermé');
                }, 300);
            }
        }

        function saveOptions() {
            const taille = document.querySelectorAll('input[type="text"]')[1].value;
            const couleur = document.querySelectorAll('input[type="text"]')[2].value;
            const file = document.getElementById('fileInput').files[0];

            if (!taille || !couleur) {
                alert('Veuillez remplir tous les champs obligatoires');
                return;
            }

            alert(`Options enregistrées !\nTaille: ${taille}\nCouleur: ${couleur}\nImage: ${file ? file.name : 'Aucune'}`);
        }

        // Animation d'entrée
        window.addEventListener('load', () => {
            const modal = document.querySelector('.modal');
            modal.style.animation = 'fadeIn 0.3s';
        });
    </script>
    @push('scripts')
@endpush
