@extends('layouts.application')

@section('title', 'Artistes')
<style>
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 40px 60px;
            }
        }

        .page-header {
            margin-bottom: 10px;
        }

        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        @media (min-width: 768px) {
            .page-header h1 {
                font-size: 32px;
            }
        }

        .page-header p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }

        .form-container {
            max-width: 100%;
            margin: 30px auto 0;
        }

        @media (min-width: 768px) {
            .form-container {
                max-width: 900px;
            }
        }

        .form-section {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 25px;
        }

        @media (min-width: 768px) {
            .form-section {
                padding: 30px;
            }
        }

        .form-section h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 12px 16px;
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23fff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        .form-group input[type="date"] {
            position: relative;
            cursor: pointer;
        }

        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-row-3 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .form-row-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .btn-submit {
            background: linear-gradient(90deg, #ff6b35 0%, #ff8c5a 100%);
            color: #fff;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
            float: none;
            margin-top: 20px;
            width: 100%;
        }

        @media (min-width: 768px) {
            .btn-submit {
                float: right;
                width: auto;
                padding: 14px 40px;
            }
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        .date-input-wrapper {
            position: relative;
        }

        .date-input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            pointer-events: none;
        }

        .date-input-wrapper input {
            padding-left: 45px;
        }

</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <div class="page-header">
            <h1>Ajouter un nouveau Jeu-Concours</h1>
            <p>Remplissez les champs ci-dessous pour lancer votre concours</p>
        </div>

        <form class="form-container" id="contestForm">
            <!-- Identification Section -->
            <div class="form-section">
                <h2>Identification</h2>
                <div class="form-group">
                    <label>Nom du Jeu</label>
                    <input type="text" placeholder="Ex: Grand Concours de l'Été" required>
                </div>
                <div class="form-group">
                    <label>Description du Jeu</label>
                    <textarea placeholder="Décrivez brièvement le jeu, ses règles et son objectif." required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Partenaire Associé</label>
                        <select required>
                            <option value="">Rechercher ou sélectionner</option>
                            <option value="marque-a">Marque A</option>
                            <option value="marque-b">Marque B</option>
                            <option value="marque-c">Marque C</option>
                            <option value="sponsor-x">Sponsor X</option>
                            <option value="partenaire-y">Partenaire Y</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type de Jeu</label>
                        <select required>
                            <option value="">Sélectionner un type</option>
                            <option value="tirage">Tirage au sort</option>
                            <option value="quiz">Quiz</option>
                            <option value="photo">Concours photo</option>
                            <option value="video">Concours vidéo</option>
                            <option value="creative">Challenge créatif</option>
                            <option value="instant">Jeu instantané</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Liens et Réseaux Section -->
            <div class="form-section">
                <h2>Liens et Réseaux</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Réseau Social Principal</label>
                        <select required>
                            <option value="">Sélectionner un réseau</option>
                            <option value="facebook">
                                <i class="fab fa-facebook"></i> Facebook
                            </option>
                            <option value="instagram">
                                <i class="fab fa-instagram"></i> Instagram
                            </option>
                            <option value="tiktok">
                                <i class="fab fa-tiktok"></i> TikTok
                            </option>
                            <option value="twitter">
                                <i class="fab fa-twitter"></i> Twitter / X
                            </option>
                            <option value="youtube">
                                <i class="fab fa-youtube"></i> YouTube
                            </option>
                            <option value="linkedin">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lien du Jeu (URL)</label>
                        <input type="url" placeholder="https://example.com/concours" required>
                    </div>
                </div>
            </div>

            <!-- Date de Début / Fin Section -->
            <div class="form-section">
                <h2>Date de Début / Fin</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date de début</label>
                        <div class="date-input-wrapper">
                            <i class="far fa-calendar"></i>
                            <input type="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date de fin</label>
                        <div class="date-input-wrapper">
                            <i class="far fa-calendar"></i>
                            <input type="date" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Récompense Section -->
            <div class="form-section">
                <h2>Récompense</h2>
                <div class="form-row-3">
                    <div class="form-group">
                        <label>Récompense / Lot</label>
                        <input type="text" placeholder="Ex: 2 Billets VIP" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de Gagnants</label>
                        <input type="number" min="1" value="1" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Créer le Jeu</button>
        </form>
    </div>

    
@endsection
    
        <script>
        // Form submission
        document.getElementById('contestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const formData = new FormData(this);
            
            // Show success message
            alert('Jeu-Concours créé avec succès ! 🎉');
            
            // Optional: Reset form
            // this.reset();
            
            // Optional: Redirect to list page
            // window.location.href = '/jeux-concours';
        });

        // Date validation (end date must be after start date)
        const startDateInput = document.querySelector('input[type="date"]:first-of-type');
        const endDateInput = document.querySelector('input[type="date"]:last-of-type');

        endDateInput.addEventListener('change', function() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(this.value);
            
            if (endDate <= startDate) {
                alert('La date de fin doit être postérieure à la date de début');
                this.value = '';
            }
        });

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);
    </script>
    @push('scripts')
@endpush
