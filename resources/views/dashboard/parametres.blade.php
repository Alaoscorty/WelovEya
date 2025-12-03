{{-- Sur cette page je dois gérer le css du paramètres --}}
@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<div class="flex container">
        <div class="main-content">
            <div class="content-wrapper">
                <div class="header">
                    <h1>Paramètres du Festival & du Compte</h1>
                    <p>Gérez les informations de votre compte et les paramètres de site web.</p>
                </div>

                <!-- Profile Section -->
                <div class="section">
                    <h3 class="section-title">Profil du Compte</h3>
                    
                    <h4 style="font-size: 14px; margin-bottom: 15px; font-weight: 500;">Photo de Profil</h4>
                    <div class="photo-upload">
                        <div class="photo-placeholder">
                            <i class="far fa-image"></i>
                        </div>
                        <div class="photo-info">
                            <p>Glissez-déposez une image ou cliquez pour télécharger: PNG, JPG jusqu'à 5MB.</p>
                            <button class="upload-btn">Télécharger l'image</button>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom d'Utilisateur</label>
                            <input type="text" value="admin.festival">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="contact@festival.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" placeholder="Ex: +33 6 12 34 56 78">
                    </div>

                    <button class="save-btn">Sauvegarder les Modifications</button>
                    <div style="clear: both;"></div>
                </div>

                <!-- Security Section -->
                <div class="security-section">
                    <h3 class="section-title">Sécurité & Accès</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Mot de Passe Actuel</label>
                            <input type="password" value="************">
                        </div>
                        <div class="form-group">
                            <label>Nouveau Mot de Passe</label>
                            <input type="password" value="************">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Double Authentification (2FA)</label>
                        <div class="toggle-container">
                            <div class="toggle-info">
                                <h4>Activée</h4>
                                <p>Ajoutez une couche de sécurité supplémentaire à votre compte.</p>
                            </div>
                            <div class="toggle-switch" onclick="toggleSwitch(this)"></div>
                        </div>
                    </div>

                    <button class="security-btn">Mettre à Jour la Sécurité</button>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="bottom-bar">
        <button class="bottom-btn">
            <i class="fas fa-play"></i>
        </button>
        <button class="bottom-btn">
            <i class="far fa-hand-paper"></i>
        </button>
        <button class="bottom-btn">
            <i class="far fa-comment"></i>
        </button>
        <button class="bottom-btn primary">
            <span>Ask to edit</span>
        </button>
        <span class="version">v.1135</span>
    </div>

    @endsection
    <script>
        function toggleSwitch(element) {
            element.classList.toggle('off');
        }

        // Form validation
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#ff6b35';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
            });
        });

        // Save button animation
        document.querySelectorAll('.save-btn, .security-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check"></i> Sauvegardé!';
                setTimeout(() => {
                    if(this.classList.contains('save-btn')) {
                        this.innerHTML = 'Sauvegarder les Modifications';
                    } else {
                        this.innerHTML = 'Mettre à Jour la Sécurité';
                    }
                }, 2000);
            });
        });
    </script>  
        @push('scripts')
    @endpush
