@extends('layouts.application')

@section('title', 'Éditer Intervenant')
<style>
    /* --- Container et layout --- */
.main-content {
    flex: 1;
    padding: 30px 40px;
    overflow-y: auto;
    color: #fff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

/* --- Statistiques --- */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}
.stat-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}
.stat-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 140, 66, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff8c42;
    font-size: 24px;
}
.stat-info h3 {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.6);
    margin-bottom: 5px;
    font-weight: normal;
}
.stat-info p {
    font-size: 32px;
    font-weight: bold;
}

/* --- Formulaires --- */
form input[type="text"],
form input[type="email"],
form input[type="time"],
form input[type="date"],
form select,
form input[type="file"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.05);
    color: #fff;
    font-size: 14px;
    margin-top: 5px;
}
form label {
    font-size: 14px;
    font-weight: 500;
}
form button.add-btn {
    padding: 10px 20px;
    background: #ff8c42;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}
form button.add-btn:hover {
    background: #ff7a28;
    transform: translateY(-2px);
}

/* --- Tableaux --- */
.table-container {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 30px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
thead {
    background: rgba(255, 255, 255, 0.05);
}
th, td {
    padding: 15px;
    font-size: 14px;
    color: #fff;
}
th {
    text-align: left;
    font-weight: 500;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s;
}
tbody tr:hover {
    background: rgba(255, 255, 255, 0.03);
}

/* --- Utilitaires --- */
.user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}
.user-avatar-small {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    overflow: hidden;
}
.user-avatar-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.user-details h4 {
    font-size: 14px;
    margin-bottom: 2px;
}
.user-details p {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.5);
}

/* --- Badges --- */
.badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}
.badge.artiste { background: rgba(255, 140, 66, 0.2); color: #ff8c42; }
.badge.animateur { background: rgba(52, 152, 219, 0.2); color: #3498db; }
.badge.dj { background: rgba(155, 89, 182, 0.2); color: #9b59b6; }

.status-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 500;
}
.status-badge.confirme { background: rgba(46, 204, 113, 0.2); color: #2ecc71; }
.status-badge.en-attente { background: rgba(149, 165, 166, 0.2); color: #95a5a6; }

/* --- Actions --- */
.actions {
    display: flex;
    gap: 10px;
}
.action-btn {
    width: 30px;
    height: 30px;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.05);
    border: none;
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}
.action-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}

/* --- Pagination --- */
.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.page-btn {
    width: 35px;
    height: 35px;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.05);
    border: none;
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}
.page-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}

/* --- Boutons principaux --- */
.add-btn {
    padding: 10px 20px;
    background: #ff8c42;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}
.add-btn:hover {
    background: #ff7a28;
    transform: translateY(-2px);
}

</style>
@section('content')

@if(session('success'))
<div style="background:#2ecc71;padding:12px;border-radius:5px;margin-bottom:20px">
    {{ session('success') }}
</div>
@endif

<div class="flex container">
    <main class="main-content">
        <div class="header">
            <h1>Éditer l'intervenant</h1>
            <p>Modifier les informations de l'intervenant</p>
        </div>

        <div class="table-container" style="padding: 20px;">
            <form action="{{ route('intervenants.update', $intervenant) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div style="margin-bottom: 15px;">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $intervenant->nom) }}" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                    @error('nom') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: 15px;">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $intervenant->email) }}" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                    @error('email') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <!-- Rôle -->
                <div style="margin-bottom: 15px;">
                    <label for="role">Rôle</label>
                    <select name="role" id="role" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                        <option value="artiste" {{ old('role', $intervenant->role) == 'artiste' ? 'selected' : '' }}>Artiste</option>
                        <option value="animateur" {{ old('role', $intervenant->role) == 'animateur' ? 'selected' : '' }}>Animateur</option>
                        <option value="dj" {{ old('role', $intervenant->role) == 'dj' ? 'selected' : '' }}>DJ</option>
                    </select>
                    @error('role') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <!-- Statut -->
                <div style="margin-bottom: 15px;">
                    <label for="statut">Statut</label>
                    <select name="statut" id="statut" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                        <option value="en-attente" {{ old('statut', $intervenant->statut) == 'en-attente' ? 'selected' : '' }}>En attente</option>
                        <option value="confirme" {{ old('statut', $intervenant->statut) == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                    </select>
                    @error('statut') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                <!-- Vote Actif -->
                <div style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" name="vote_actif" {{ $intervenant->vote_actif ? 'checked' : '' }}>
                        Vote actif
                    </label>
                </div>

                <!-- Horaires -->
                <div style="margin-bottom: 15px;">
                    <label for="heure_debut">Heure de début</label>
                    <input type="time" name="heure_debut" id="heure_debut" value="{{ old('heure_debut', $intervenant->heure_debut) }}" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                </div>

                <!-- Date de début -->
                <div style="margin-bottom: 15px;">
                    <label for="date_debut">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $intervenant->date_debut ? $intervenant->date_debut->format('Y-m-d') : '') }}" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                </div>

                <!-- Photo -->
                <div style="margin-bottom: 15px;">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" style="width:100%;padding:10px;border-radius:5px;border:1px solid rgba(255,255,255,0.1);background: rgba(255,255,255,0.05);color:#fff;">
                    @if($intervenant->photo)
                    <div style="margin-top:10px;">
                        <img src="{{ asset('storage/'.$intervenant->photo) }}" alt="Photo" style="width:100px;height:100px;object-fit:cover;border-radius:5px;">
                    </div>
                    @endif
                </div>

                <button type="submit" class="add-btn">
                    <i class="fas fa-save"></i>
                    Enregistrer les modifications
                </button>
            </form>
        </div>
    </main>
</div>

@endsection
