@extends('layouts.application')

@section('title', 'Ajouter un intervenant')

<style>
    .main-content {
        flex: 1;
        padding: 30px 40px;
    }

    .header {
        margin-bottom: 30px;
    }

    .header h1 {
        font-size: 28px;
        margin-bottom: 5px;
    }

    .header p {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 30px;
        max-width: 900px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-group.full {
        grid-column: span 2;
    }

    label {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.7);
    }

    input, select {
        padding: 12px 15px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
    }

    select option {
        color: #000;
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .btn {
        padding: 12px 20px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .btn-primary {
        background: #ff8c42;
        color: #fff;
    }

    .btn-primary:hover {
        background: #ff7a28;
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.15);
    }
</style>

@section('content')
<div class="flex container">
    <main class="main-content">

        <!-- Header -->
        <div class="header">
            <h1>Ajouter un intervenant</h1>
            <p>Artiste, Animateur ou DJ</p>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form action="{{ route('intervenants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Nom complet</label>
                        <input type="text" name="nom" placeholder="Nom de l’intervenant">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@exemple.com">
                    </div>

                    <div class="form-group">
                        <label>Rôle</label>
                        <select name="role">
                            <option value="">Sélectionner</option>
                            <option value="artiste">Artiste</option>
                            <option value="animateur">Animateur</option>
                            <option value="dj">DJ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut">
                            <option value="en_attente">En attente</option>
                            <option value="confirme">Confirmé</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Heure de passage</label>
                        <input type="time" name="heure">
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date">
                    </div>

                    <div class="form-group full">
                        <label>Photo de profil</label>
                        <input type="file" name="photo">
                    </div>

                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
@endsection
