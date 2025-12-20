@extends('layouts.application')

@section('title', 'Gérer Action')
<style>
/* Conteneur principal */
.main-content {
    flex: 1;
    background: linear-gradient(180deg, #0f1c3f 0%, #0a0e1a 100%);
    padding: 40px 20px;
    min-height: 100vh;
    align-items: center;
}


.detail-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    color: #fff;
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
    <div class="detail-item">
        <p><strong>Description :</strong> {{ $action->description }}</p>
        <p><strong>Lieu :</strong> {{ $action->location }}</p>
        <p><strong>Date & Heure :</strong> {{ $action->date_time->format('d/m/Y H:i') }}</p>
        <p><strong>Durée :</strong> {{ $action->duration }}</p>
        <p><strong>Places :</strong> {{ $action->registered }} / {{ $action->slots }}</p>
        <p><strong>Récompense :</strong> {{ $action->reward }}</p>
    </div>

    

    <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-primary ">Modifier l'action</a>
</main>
@endsection
