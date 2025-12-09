@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            padding: 0;
            overflow-y: auto;
        }

        .header-banner {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c5a 100%);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-banner i {
            font-size: 24px;
        }

        .header-banner h1 {
            font-size: 20px;
            font-weight: 600;
        }

        .header-banner p {
            font-size: 13px;
            opacity: 0.9;
            margin-top: 3px;
        }

        .form-container {
            padding: 30px;
            max-width: 1000px;
        }

        /* Section Styles */
        .form-section {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            width: 3px;
            height: 20px;
            background: #ff6b35;
            border-radius: 2px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ff6b35;
            background: rgba(255, 255, 255, 0.08);
        }

        .form-group select {
            cursor: pointer;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        /* Interactive Vote Section */
        .vote-section {
            background: rgba(70, 130, 180, 0.1);
            border: 1px solid rgba(70, 130, 180, 0.3);
            border-radius: 12px;
            padding: 20px;
        }

        .vote-description {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.8);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ff6b35;
        }

        .checkbox-group label {
            font-size: 14px;
            cursor: pointer;
        }

        .date-limit-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 15px;
            align-items: end;
            margin-bottom: 20px;
        }

        .calendar-icon {
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .calendar-icon:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .calendar-icon i {
            color: #4dabf7;
        }

        .vote-note {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            font-style: italic;
            margin-bottom: 15px;
        }

        .options-list {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            padding: 15px;
        }

        .options-list ol {
            margin-left: 20px;
        }

        .options-list li {
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Paroles Section */
        .paroles-section {
            margin-top: 20px;
        }

        .paroles-header {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .paroles-options {
            display: grid;
            gap: 15px;
        }

        .parole-option {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
        }

        .parole-option-header {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.9);
        }

        .parole-option-description {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 12px;
        }

        .parole-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-secondary {
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel {
            padding: 12px 30px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-2px);
        }

        .btn-submit {
            padding: 12px 40px;
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c5a 100%);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }
</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
            <div class="header-banner">
                <i class="fas fa-edit"></i>
                <div>
                    <h1>Ajouter un nouvel l'intervenant</h1>
                    <p>Modifiez les informations de l'intervenant "INFANDE"</p>
                </div>
            </div>

            <div class="form-container">
                <!-- Information de base -->
                <div class="form-section">
                    <h2 class="section-title">I. Informations de base</h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom de l'intervenant*</label>
                            <input type="text" value="INFANDE" placeholder="Nom de l'intervenant">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="Infan@gmail.com" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="tel" placeholder="Téléphone">
                        </div>
                        <div class="form-group">
                            <label>Région/ville (optionnel)</label>
                            <input type="text" placeholder="Région/ville">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pays</label>
                            <select>
                                <option>Côte</option>
                                <option>Bénin</option>
                                <option>Togo</option>
                                <option>France</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date de Début</label>
                            <input type="text" value="Jeudi 10/04/2025" placeholder="Date">
                        </div>
                    </div>
                </div>

                <!-- Logistique et Programmation -->
                <div class="form-section">
                    <h2 class="section-title">II. Logistique et Programmation</h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jour de l'événement</label>
                            <select>
                                <option>Jour 2</option>
                                <option>Jour 1</option>
                                <option>Jour 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Heure de début</label>
                            <input type="time" value="19:30">
                        </div>
                        <div class="form-group">
                            <label>Heure de fin</label>
                            <input type="time" value="20:45">
                        </div>
                    </div>
                </div>

                <!-- Gestion du vote interactif -->
                <div class="form-section vote-section">
                    <h2 class="section-title">III. Gestion du vote interactif</h2>
                    
                    <div class="vote-description">
                        Cette section permet d'activer un vote public pour que votre audience choisisse l'option de répertoire de la performance.
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="activerVote" checked>
                        <label for="activerVote">Activer le vote public</label>
                    </div>

                    <div class="date-limit-row">
                        <div class="form-group">
                            <label>Date Limite du Vote</label>
                            <input type="text" placeholder="Sélectionnez une date">
                        </div>
                        <div class="calendar-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>

                    <div class="vote-note">
                        CRITIQUE : Une analyse claire sera envoyée après clôture (Date limite)
                    </div>

                    <div class="options-list">
                        <ol>
                            <li>  1.Classiques et Ballades</li>
                            <li>  2.Hits Rythmés et Daniel</li>
                        </ol>
                    </div>

                    <!-- Paroles Section -->
                    <div class="paroles-section">
                        <div class="paroles-header">Télécharger/gérer les fiches de Paroles</div>
                        
                        <div class="paroles-options">
                            <div class="parole-option">
                                <div class="parole-option-header">HIP #01 - Classiques</div>
                                <div class="parole-option-description">
                                    Fichier non présent dans l'option "Classiques"
                                </div>
                                <div class="parole-buttons">
                                    <button class="btn-secondary">
                                        <i class="fas fa-upload"></i>
                                        Choisir un fichier
                                    </button>
                                    <button class="btn-secondary">
                                        <i class="fas fa-trash"></i>
                                        Aucun fichier choisi
                                    </button>
                                </div>
                            </div>

                            <div class="parole-option">
                                <div class="parole-option-header">HIP #02 - Hits</div>
                                <div class="parole-option-description">
                                    Fichier non représenté dans l'option "Hits/PCD"
                                </div>
                                <div class="parole-buttons">
                                    <button class="btn-secondary">
                                        <i class="fas fa-upload"></i>
                                        Choisir un fichier
                                    </button>
                                    <button class="btn-secondary">
                                        <i class="fas fa-trash"></i>
                                        Aucun fichier choisi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-cancel">Annuler</button>
                    <button class="btn-submit">Sauvegarder les Modifications</button>
                </div>
            </div>
        </main>
@endsection
    
        <script>
        // File upload handling
        const fileButtons = document.querySelectorAll('.parole-buttons .btn-secondary');
        fileButtons.forEach((btn, index) => {
            if (btn.textContent.includes('Choisir')) {
                btn.addEventListener('click', function() {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = '.pdf,.doc,.docx';
                    input.onchange = function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            alert(`Fichier sélectionné: ${file.name}`);
                        }
                    };
                    input.click();
                });
            }
        });

        // Calendar icon click
        document.querySelector('.calendar-icon').addEventListener('click', function() {
            const dateInput = this.previousElementSibling.querySelector('input');
            dateInput.type = 'date';
            dateInput.focus();
        });

        // Checkbox toggle
        document.getElementById('activerVote').addEventListener('change', function() {
            const voteSection = this.closest('.vote-section');
            if (!this.checked) {
                voteSection.style.opacity = '0.5';
            } else {
                voteSection.style.opacity = '1';
            }
        });

        // Cancel button
        document.querySelector('.btn-cancel').addEventListener('click', function() {
            if (confirm('Voulez-vous vraiment annuler les modifications?')) {
                window.history.back();
            }
        });

        // Submit button
        document.querySelector('.btn-submit').addEventListener('click', function() {
            alert('Modifications sauvegardées avec succès!');
        });

        // Form validation
        const requiredInputs = document.querySelectorAll('input[type="text"], input[type="email"]');
        requiredInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '' && this.previousElementSibling.textContent.includes('*')) {
                    this.style.borderColor = '#dc3545';
                } else {
                    this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                }
            });
        });
    </script>
    @push('scripts')
@endpush
