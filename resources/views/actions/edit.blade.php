@extends('layouts.application')

@section('title', 'Modifier Action')

<style>
/* Conteneur principal */
.main-content {
    flex: 1;
    background: linear-gradient(180deg, #1a3a6b 0%, #0a0e27 100%);
    padding: 50px;
    overflow-y: auto;
}

/* Titre de la page */
.page-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 40px;
    text-align: center;
    color: #fff;
}

/* Conteneur du formulaire */
.form-container {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Sections du formulaire */
.form-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 30px;
}

/* Titres des sections */
.section-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #fff;
}

/* Groupes de champs */
.form-group {
    margin-bottom: 20px;
}
.form-group:last-child {
    margin-bottom: 0;
}

/* Labels */
.form-label {
    display: block;
    font-size: 14px;
    margin-bottom: 8px;
    color: rgba(255, 255, 255, 0.8);
}

/* Champs du formulaire */
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

/* Focus */
.form-input:focus,
.form-textarea:focus,
.form-select:focus {
    outline: none;
    border-color: rgba(255, 255, 255, 0.3);
}

/* Placeholder */
.form-input::placeholder,
.form-textarea::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

/* Textarea */
.form-textarea {
    min-height: 100px;
    resize: vertical;
}

/* Select avec flèche */
.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
    cursor: pointer;
}

/* Ligne du formulaire pour plusieurs colonnes */
.form-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* Actions du formulaire */
.form-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

/* Boutons */
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

/* Validation */
input:invalid,
textarea:invalid,
select:invalid {
    border-color: #ef4444;
}

/* Responsive */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

@section('content')
<main class="main-content">
    <h1>Modifier l'action :  {{ $action->title }}</h1>

    <form action="{{ route('actions.update', $action->id) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nom de l'action</label>
            <input type="text" name="title" value="{{ $action->title }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" required class="form-textarea">{{ $action->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Lieu</label>
            <input type="text" name="location" value="{{ $action->location }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Date & Heure</label>
            <input type="datetime-local" name="date_time" value="{{ $action->date_time->format('Y-m-d\TH:i') }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Durée</label>
            <input type="text" name="duration" value="{{ $action->duration }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Places</label>
            <input type="number" name="slots" value="{{ $action->slots }}" min="1" required class="form-input">
        </div>

        <div class="form-group">
            <label>Récompense</label>
            <input type="text" name="reward" value="{{ $action->reward }}" required class="form-input">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</main>
@endsection
