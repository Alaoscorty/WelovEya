{{-- Sur cette page je dois gérer le css du paramètres --}}
@extends('layouts.application')

@section('title', 'Artistes')
    <style>
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .settings-header {
            margin-bottom: 30px;
        }

        .settings-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .settings-header p {
            color: rgba(255, 255, 255, 0.6);
        }

        .settings-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Photo Upload */
        .photo-upload {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px dashed rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s;
            overflow: hidden;
        }

        .photo-preview:hover {
            border-color: #ff6b35;
            background: rgba(255, 107, 53, 0.1);
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-info {
            flex: 1;
        }

        .photo-info p {
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 10px;
            font-size: 14px;
        }

        .upload-btn {
            background: #ff6b35;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .upload-btn:hover {
            background: #ff5722;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        /* Form Groups */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff6b35;
            background: rgba(255, 255, 255, 0.08);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        /* Save Button */
        .save-btn {
            background: #ff6b35;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            float: right;
        }

        .save-btn:hover {
            background: #ff5722;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        /* 2FA Toggle */
        .toggle-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .toggle-info h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .toggle-info p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .toggle-switch {
            position: relative;
            width: 50px;
            height: 26px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 13px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .toggle-switch.active {
            background: #ff6b35;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: all 0.3s;
        }

        .toggle-switch.active::after {
            left: 27px;
        }

        .security-btn {
            background: #ff6b35;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            float: right;
        }

        .security-btn:hover {
            background: #ff5722;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        /* Hidden File Input */
        #photoInput {
            display: none;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4caf50;
            color: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            display: none;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .notification.show {
            display: flex;
        }
    </style>
@section('content')
<div class="flex container">
        <div class="main-content">
            <div class="settings-header">
                <h1>Paramètres du Festival & du Compte</h1>
                <p>Gérez les informations de votre compte et les paramètres du site web.</p>
            </div>

            <!-- Profile Section -->
            <div class="settings-card">
                <h2 class="section-title">
                    <i class="fas fa-user-circle"></i>
                    Profil du Compte
                </h2>

                <div class="form-group">
                    <label>Photo de Profil</label>
                    <div class="photo-upload">
                        <div class="photo-preview" id="photoPreview" onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="photo-info">
                            <p>Glissez-déposez une image ou cliquez pour télécharger. PNG, JPG jusqu'à 5MB.</p>
                            <button class="upload-btn" onclick="document.getElementById('photoInput').click()">
                                <i class="fas fa-upload"></i>
                                Télécharger l'image
                            </button>
                            <input type="file" id="photoInput" accept="image/png, image/jpeg, image/jpg" onchange="handleImageUpload(event)">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nom d'Utilisateur</label>
                        <input type="text" value="admin.festival" id="username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="contact@festival.com" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" placeholder="Ex: +33 6 12 34 56 78" id="phone">
                </div>

                <button class="save-btn" onclick="saveProfile()">
                    <i class="fas fa-save"></i>
                    Sauvegarder les Modifications
                </button>
                <div style="clear: both;"></div>
            </div>

            <!-- Security Section -->
            <div class="settings-card">
                <h2 class="section-title">
                    <i class="fas fa-shield-alt"></i>
                    Sécurité & Accès
                </h2>

                <div class="form-group">
                    <label>Mot de Passe Actuel</label>
                    <input type="password" placeholder="••••••••••" id="currentPassword">
                </div>

                <div class="form-group">
                    <label>Nouveau Mot de Passe</label>
                    <input type="password" placeholder="••••••••••" id="newPassword">
                </div>

                <div class="toggle-container">
                    <div class="toggle-info">
                        <h4>Double Authentification (2FA)</h4>
                        <p>Ajoutez une couche de sécurité supplémentaire à votre compte.</p>
                    </div>
                    <div class="toggle-switch active" id="toggle2FA" onclick="toggle2FA()"></div>
                </div>

                <button class="security-btn" onclick="updateSecurity()">
                    <i class="fas fa-lock"></i>
                    Mettre à Jour la Sécurité
                </button>
                <div style="clear: both;"></div>
            </div>

            <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Modifications sauvegardées avec succès!</span>
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
        // Image Upload Handler
        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    showNotification('Le fichier est trop volumineux. Maximum 5MB.', false);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Profile Photo">`;
                };
                reader.readAsDataURL(file);
            }
        }

        // 2FA Toggle
        let is2FAActive = true;
        function toggle2FA() {
            is2FAActive = !is2FAActive;
            const toggle = document.getElementById('toggle2FA');
            if (is2FAActive) {
                toggle.classList.add('active');
            } else {
                toggle.classList.remove('active');
            }
        }

        // Save Profile
        function saveProfile() {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            if (!username || !email) {
                showNotification('Veuillez remplir tous les champs obligatoires.', false);
                return;
            }

            // Simulate API call
            setTimeout(() => {
                showNotification('Profil mis à jour avec succès!');
            }, 500);
        }

        // Update Security
        function updateSecurity() {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;

            if (currentPassword || newPassword) {
                if (!currentPassword || !newPassword) {
                    showNotification('Veuillez remplir les deux champs de mot de passe.', false);
                    return;
                }
            }

            // Simulate API call
            setTimeout(() => {
                showNotification('Paramètres de sécurité mis à jour!');
                document.getElementById('currentPassword').value = '';
                document.getElementById('newPassword').value = '';
            }, 500);
        }

        // Show Notification
        function showNotification(message, success = true) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = message;
            notification.style.background = success ? '#4caf50' : '#f44336';
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Menu item click handlers
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script> 
        @push('scripts')
    @endpush
