@extends('layouts.application')

@section('title', 'Détail Intervenant')

<style>
.main-content { flex: 1; padding: 30px 40px; }
.header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
.back-link { color: #4a90e2; text-decoration: none; display: flex; align-items: center; gap: 8px; font-size: 14px; margin-bottom: 15px; }
.header-title h1 { font-size: 32px; margin-bottom: 5px; }
.header-subtitle { color: #6b7785; font-size: 14px; }
.header-actions { display: flex; gap: 12px; }
.btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.3s; }
.btn-secondary { background: rgba(255, 255, 255, 0.1); color: #fff; border: 1px solid rgba(255, 255, 255, 0.2); }
.btn-primary { background: #ff8c42; color: #fff; }
.btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(255, 140, 66, 0.3); }
/* Cards */
.cards-container { display: grid; grid-template-columns: 1fr 1.5fr; gap: 25px; }
.card { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 30px; }
.card-title { font-size: 18px; font-weight: 600; margin-bottom: 25px; }
/* Profile Card */
.profile-header { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
.profile-avatar { width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid rgba(255, 140, 66, 0.3); }
.profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
.profile-info h3 { font-size: 22px; margin-bottom: 8px; }
.status-badge { display: inline-block; padding: 4px 12px; background: #ff8c42; color: #fff; border-radius: 20px; font-size: 12px; font-weight: 600; }
.contact-info { margin-top: 20px; }
.contact-item { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; color: #8b9aab; font-size: 14px; }
.contact-item i { color: #4a90e2; width: 20px; }
/* Logistics Card */
.logistics-grid { display: grid; gap: 25px; }
.logistics-item { display: flex; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
.logistics-item:last-child { border-bottom: none; padding-bottom: 0; }
.logistics-label { display: flex; align-items: center; gap: 8px; color: #8b9aab; font-size: 14px; }
.logistics-label i { color: #c94727ff; }
.logistics-value { font-weight: 600; font-size: 15px; }
</style>

@section('content')
<main class="main-content">
    <div class="header">
        <div class="header-title">
            <a href="{{ route('intervenants.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Retour à la liste
            </a>
            <h1>Détails de l'Intervenant : {{ $intervenant->nom }}</h1>
            <p class="header-subtitle">Informations complètes et logistique</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary">
                <i class="fas fa-download"></i>
                Télécharger la fiche
            </button>
            <a href="{{ route('intervenants.edit', $intervenant) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Modifier
            </a>
        </div>
    </div>

    <div class="cards-container">
        <!-- Identification Card -->
        <div class="card">
            <h2 class="card-title">Identification</h2>
            
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($intervenant->photo)
                        <img src="{{ asset('storage/' . $intervenant->photo) }}" alt="{{ $intervenant->nom }}">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Pas de photo">
                    @endif
                </div>
                <div class="profile-info">
                    <h3>{{ $intervenant->nom }}</h3>
                    <span class="status-badge">{{ $intervenant->statut }}</span>
                </div>
            </div>

            <div class="contact-info">
                @if($intervenant->email)
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $intervenant->email }}</span>
                </div>
                @endif
                @if($intervenant->telephone)
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>{{ $intervenant->telephone }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Logistics Card -->
        <div class="card">
            <h2 class="card-title">Logistique et Planning</h2>
            
            <div class="logistics-grid">
                <div class="logistics-item">
                    <div class="logistics-label">
                        <i class="fas fa-calendar-alt"></i>
                        Date de début
                    </div>
                    <div class="logistics-value">{{ $intervenant->date_debut ? $intervenant->date_debut->format('d/m/Y') : '-' }}</div>
                </div>

                <div class="logistics-item">
                    <div class="logistics-label">
                        <i class="fas fa-clock"></i>
                        Créneau
                    </div>
                    <div class="logistics-value">
                        {{ $intervenant->heure_debut ?? '-' }} - {{ $intervenant->heure_fin ?? '-' }}
                    </div>
                </div>

                <div class="logistics-item">
                    <div class="logistics-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Région / Pays
                    </div>
                    <div class="logistics-value">{{ $intervenant->region ?? '' }} / {{ $intervenant->pays ?? '' }}</div>
                </div>

                <div class="logistics-item">
                    <div class="logistics-label">
                        <i class="fas fa-vote-yea"></i>
                        Vote actif
                    </div>
                    <div class="logistics-value">{{ $intervenant->vote_actif ? 'Oui' : 'Non' }}</div>
                </div>

                @if($intervenant->vote_actif)
                <div class="logistics-item">
                    <div class="logistics-label">
                        <i class="fas fa-calendar-check"></i>
                        Date limite vote
                    </div>
                    <div class="logistics-value">{{ $intervenant->date_limite_vote ? $intervenant->date_limite_vote->format('d/m/Y') : '-' }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
