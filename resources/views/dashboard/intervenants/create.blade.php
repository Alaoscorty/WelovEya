@extends('layouts.application')

@section('title', 'Ajouter un intervenant')

<style>
/* Garde tout ton style existant */
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
.header-banner h1 { font-size: 20px; font-weight: 600; }
.header-banner p { font-size: 14px; opacity: 0.9; margin-top: 8px; }

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
<div class="flex container">
    <main class="main-content">

        <div class="header-banner">
            <h1>Ajouter un intervenant</h1>
            <p>Artiste, Animateur ou DJ</p>
        </div>

        <div class="form-container">

            @if(session('success'))
                <div style="color:lightgreen">{{ session('success') }}</div>
            @endif

            <form action="{{ route('intervenants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- I. INFOS DE BASE -->
                <div class="form-section">
                    <h2 class="section-title">I. Informations de base</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom *</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="tel" name="telephone">
                        </div>

                        <div class="form-group">
                            <label>Région / Ville</label>
                            <input type="text" name="region">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pays</label>
                            <select name="pays">
                                <option value="">-- Choisir --</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Bénin">Bénin</option>
                                <option value="Togo">Togo</option>
                                <option value="France">France</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date de début</label>
                            <input type="date" name="date_debut">
                        </div>
                    </div>

                    <!-- NOUVEAU CHAMP PHOTO -->
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Photo de l'intervenant</label>
                            <input type="file" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- II. PROGRAMMATION -->
                <div class="form-section">
                    <h2 class="section-title">II. Logistique & Programmation</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jour de l'événement</label>
                            <select name="jour_evenement">
                                <option value="Jour 1">Jour 1</option>
                                <option value="Jour 2">Jour 2</option>
                                <option value="Jour 3">Jour 3</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Heure de début</label>
                            <input type="time" name="heure_debut">
                        </div>

                        <div class="form-group">
                            <label>Heure de fin</label>
                            <input type="time" name="heure_fin">
                        </div>
                    </div>
                </div>

                <!-- III. VOTE -->
                <div class="form-section vote-section">
                    <h2 class="section-title">III. Vote interactif</h2>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="voteToggle" name="vote_actif">
                            Activer le vote public
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Date limite du vote</label>
                        <input type="date" name="date_limite_vote" id="dateVote" >
                    </div>

                    <h4>Fichiers Paroles</h4>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Classiques</label>
                            <input type="file" name="paroles_classiques" accept=".pdf,.doc,.docx">
                        </div>

                        <div class="form-group">
                            <label>Hits</label>
                            <input type="file" name="paroles_hits" accept=".pdf,.doc,.docx">
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="action-buttons">
                    <a href="{{ url()->previous() }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">Enregistrer</button>
                </div>

            </form>
        </div>
    </main>
</div>

@endsection

<script>
document.getElementById('voteToggle').addEventListener('change', function () {
    document.getElementById('dateVote').disabled = !this.checked;
});
</script>

@push('scripts')
@endpush
