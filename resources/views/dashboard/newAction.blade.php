@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
            flex: 1;
            background: linear-gradient(180deg, #1a3a6b 0%, #0a0e27 100%);
            padding: 50px;
            overflow-y: auto;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ff7849 0%, #ff9966 100%);
            color: #fff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 120, 73, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
        }

</style>
@section('content')

    {{-- MAIN CONTENT --}}
    <main class="main-content">
            <h1 class="page-title">Créer une nouvelle Action</h1>

            <form 
    class="form-container" 
    id="actionForm"
    method="POST"
    action="{{ route('actions.store') }}"
>
    @csrf

        <!-- Identification Section -->
        <div class="form-section">
            <h2 class="section-title">Identification</h2>
            
            <div class="form-group">
                <input 
                    type="text" 
                    class="form-input" 
                    
                    required
                >
                
                Nom de l'Action</label>
                <input 
                    type="text" 
                    name="title"
                    class="form-input" 
                    placeholder="Ex: Nettoyage de la plage de la Concurrence"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea 
                    name="description"
                    class="form-textarea" 
                    placeholder="Décrivez la mission pour le public..."
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Lieu Exact</label>
                <input 
                    type="text" 
                    name="location"
                    class="form-input" 
                    placeholder="Ex: 123 Rue du Port, 17000 La Rochelle"
                    required
                >
            </div>
        </div>

        <!-- Planning & Quota Section -->
        <div class="form-section">
            <h2 class="section-title">Planning & Quota</h2>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Date & Heure</label>
                    <input 
                        type="datetime-local" 
                        name="date_time"
                        class="form-input"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Durée estimée</label>
                    <select class="form-select" name="duration" required>
                        <option value="">Sélectionner</option>
                        <option value="1h">1h</option>
                        <option value="2h">2h</option>
                        <option value="3h">3h</option>
                        <option value="4h">4h</option>
                        <option value="5h">5h</option>
                        <option value="6h+">6h+</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre de Places</label>
                    <input 
                        type="number" 
                        name="slots"
                        class="form-input" 
                        placeholder="Ex: 20"
                        min="1"
                        required
                    >
                </div>
            </div>
        </div>

        <!-- Récompenses & Visibilité Section -->
        <div class="form-section" >
            <h2 class="section-title">Récompenses & Visibilité</h2>
            
            <div class="form-group">
                <label class="form-label">Type de Récompense</label>
                <select class="form-select" name="reward" required>
                    <option value="">Sélectionner une récompense</option>
                    <option value="billet-jour-1">Billet Jour 1</option>
                    <option value="billet-jour-2">Billet Jour 2</option>
                    <option value="billet-jour-3">Billet Jour 3</option>
                    <option value="pass-3-jours">Pass 3 Jours</option>
                    <option value="pass-vip">Pass VIP</option>
                    <option value="merchandise">Merchandise</option>
                </select>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="cancelForm()">
                Annuler
            </button>
            <button type="submit" class="btn btn-primary">
                Créer l'Action
            </button>
        </div>
    </form>
</main>
@endsection
    
    <script>

        // Cancel form
        function cancelForm() {
            if (confirm('Êtes-vous sûr de vouloir annuler? Toutes les données seront perdues.')) {
                document.getElementById('actionForm').reset();
                window.history.back();
            }
        }

        // Menu item clicks
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-box input');
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            console.log('Recherche:', searchTerm);
        });

        // Form validation feedback
        const inputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.required && !this.value) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = 'rgba(255, 255, 255, 0.15)';
                }
            });

            input.addEventListener('input', function() {
                if (this.style.borderColor === 'rgb(239, 68, 68)') {
                    this.style.borderColor = 'rgba(255, 255, 255, 0.15)';
                }
            });
        });  
    </script>
    @push('scripts')
@endpush
