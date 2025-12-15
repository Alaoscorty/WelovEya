@extends('layouts.application')

@section('title', 'Gérer Action')
<style>
/* Conteneur principal */
.main-content {
    flex: 1;
    background: linear-gradient(180deg, #0f1c3f 0%, #0a0e1a 100%);
    padding: 40px 20px;
    min-height: 100vh;
}

/* Wrapper du contenu */
.content-wrapper {
    background: linear-gradient(135deg, #12255a91 0%, #1e40af 100%);
    padding: 30px 25px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    max-width: 900px;
    margin: 0 auto;
}

/* Header de la page */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.header h1 {
    font-size: 22px;
    font-weight: 600;
    color: #fff;
}

/* Sections des détails */
.detail-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
}
.detail-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #fff;
}
.detail-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    color: #fff;
}
.detail-item span.label {
    font-weight: 500;
    color: rgba(255, 255, 255, 0.8);
}
.detail-item span.value {
    font-weight: 600;
    color: #fff;
}

/* Boutons */
.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 20px;
}
.btn {
    padding: 12px 25px;
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

/* Status badge */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}
.status-ouvert {
    background: rgba(34, 197, 94, 0.2);
    color: #4ade80;
    border: 1px solid rgba(34, 197, 94, 0.3);
}
.status-complet {
    background: rgba(239, 68, 68, 0.2);
    color: #f87171;
    border: 1px solid rgba(239, 68, 68, 0.3);
}
.status-termine {
    background: rgba(147, 51, 234, 0.2);
    color: #a78bfa;
    border: 1px solid rgba(147, 51, 234, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .detail-item {
        flex-direction: column;
        gap: 4px;
    }
    .action-buttons {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@section('content')
<main class="main-content">
    <h1>Gérer l'action : {{ $action->title }}</h1>

    <p><strong>Description :</strong> {{ $action->description }}</p>
    <p><strong>Lieu :</strong> {{ $action->location }}</p>
    <p><strong>Date & Heure :</strong> {{ $action->date_time->format('d/m/Y H:i') }}</p>
    <p><strong>Durée :</strong> {{ $action->duration }}</p>
    <p><strong>Places :</strong> {{ $action->registered }} / {{ $action->slots }}</p>
    <p><strong>Récompense :</strong> {{ $action->reward }}</p>

    <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary">Modifier l'action</a>
</main>
@endsection
