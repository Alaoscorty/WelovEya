@extends('layouts.application')

@section('title', 'Éditer Jeu')

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Modifier le Jeu-Concours</h1>
        <a href="{{ route('suivi_jeux') }}" class="btn-add">
            <i class="fas fa-arrow-left"></i>
            Retour à la liste
        </a>
    </div>

    <form action="{{ route('ajout_jeux.update', $jeu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom_du_jeu">Nom du jeu</label>
            <input type="text" name="nom_du_jeu" value="{{ old('nom_du_jeu', $jeu->nom_du_jeu) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" required>{{ old('description', $jeu->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="partenaire">Partenaire</label>
            <input type="text" name="partenaire" value="{{ old('partenaire', $jeu->partenaire) }}" required>
        </div>

        <div class="form-group">
            <label for="type_de_jeu">Type de jeu</label>
            <input type="text" name="type_de_jeu" value="{{ old('type_de_jeu', $jeu->type_de_jeu) }}" required>
        </div>

        <div class="form-group">
            <label for="reseau_social">Réseau social</label>
            <select name="reseau_social" required>
                <option value="facebook" @if($jeu->reseau_social=='facebook') selected @endif>Facebook</option>
                <option value="instagram" @if($jeu->reseau_social=='instagram') selected @endif>Instagram</option>
                <option value="tiktok" @if($jeu->reseau_social=='tiktok') selected @endif>TikTok</option>
                <option value="twitter" @if($jeu->reseau_social=='twitter') selected @endif>Twitter</option>
                <option value="youtube" @if($jeu->reseau_social=='youtube') selected @endif>YouTube</option>
                <option value="linkedin" @if($jeu->reseau_social=='linkedin') selected @endif>LinkedIn</option>
            </select>
        </div>

        <div class="form-group">
            <label for="lien">Lien</label>
            <input type="url" name="lien" value="{{ old('lien', $jeu->lien) }}" required>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" value="{{ old('date_debut', $jeu->date_debut->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" value="{{ old('date_fin', $jeu->date_fin->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="recompense">Récompense</label>
            <input type="text" name="recompense" value="{{ old('recompense', $jeu->recompense) }}" required>
        </div>

        <div class="form-group">
            <label for="nombre_gagnants">Nombre de gagnants</label>
            <input type="number" name="nombre_gagnants" value="{{ old('nombre_gagnants', $jeu->nombre_gagnants) }}" required>
        </div>

        <button type="submit" class="btn-add">Modifier le jeu</button>
    </form>
</div>
@endsection
