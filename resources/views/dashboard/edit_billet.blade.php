@extends('layouts.application')

@section('title', 'billets_streaming')
<style>
    /* Container principal */
    .main-content {
        flex: 1;
        padding: 40px;
        overflow-y: auto;
        background-color: #0f172a;
        color: #fff;
    }

    /* Header de la page */
    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 30px;
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
        text-decoration: none;
    }
    .breadcrumb:hover {
        color: #fff;
    }

    /* Formulaire */
    .form-container {
        background: rgba(255, 255, 255, 0.03);
        padding: 30px;
        border-radius: 12px;
        max-width: 600px;
        margin-bottom: 40px;
    }

    .form-container label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .form-container input,
    .form-container select,
    .form-container textarea {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    .form-container input:focus,
    .form-container select:focus,
    .form-container textarea:focus {
        border-color: #3b82f6;
        outline: none;
    }

    .error {
        color: #ef4444;
        font-size: 12px;
    }

    /* Bouton */
    .btn-submit {
        padding: 12px 20px;
        background: #ff6b35;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-submit:hover {
        background: #ff8555;
    }

    /* Ticket preview */
    .ticket-preview {
        margin-top: 20px;
        background: rgba(255, 255, 255, 0.03);
        padding: 20px;
        border-radius: 12px;
        max-width: 500px;
    }

    .ticket-preview h2 {
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: 600;
    }

    .ticket {
        display: flex;
        justify-content: space-between;
        background: #1e293b;
        border-radius: 12px;
        overflow: hidden;
    }

    .ticket-left, .ticket-right {
        padding: 20px;
    }

    .ticket-header {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 10px;
        color: #fbbf24;
    }

    .ticket-body p {
        margin-bottom: 6px;
        font-size: 14px;
    }

    /* QR code */
    .qr-code {
        width: 100px;
        height: 100px;
        background: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 12px;
    }

    /* Boutons PDF / Print */
    .actions-pdf {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .btn-download,
    .btn-print {
        padding: 8px 14px;
        border-radius: 6px;
        background: #3b82f6;
        color: #fff;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.3s;
    }

    .btn-download:hover,
    .btn-print:hover {
        background: #2563eb;
    }
</style>

@section('content')
<main class="main-content">
    <div class="header">
        <h1>Modifier le Billet PASS 🎫</h1>
    </div>

    <div class="form-and-preview">
        <!-- Formulaire -->
        <div class="form-container">
            <form action="{{ route('billets.update', $billet) }}" method="POST" class="ticket-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom">Nom du billet</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $billet->nom) }}" required>
                    @error('nom') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="type">Type de billet</label>
                    <select name="type" id="type" required>
                        <option value="VIP" {{ old('type', $billet->type) == 'VIP' ? 'selected' : '' }}>VIP</option>
                        <option value="Standard" {{ old('type', $billet->type) == 'Standard' ? 'selected' : '' }}>Standard</option>
                        <option value="Early Bird" {{ old('type', $billet->type) == 'Early Bird' ? 'selected' : '' }}>Early Bird</option>
                    </select>
                    @error('type') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="prix_vente">Prix (€)</label>
                    <input type="number" step="0.01" min="0" name="prix_vente" id="prix_vente" value="{{ old('prix_vente', $billet->prix_vente) }}" required>
                    @error('prix_vente') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="ventes_max">Nombre maximum de billets</label>
                    <input type="number" min="1" name="ventes_max" id="ventes_max" value="{{ old('ventes_max', $billet->ventes_max) }}" required>
                    @error('ventes_max') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="date_evenement">Date de l'événement</label>
                    <input type="datetime-local" name="date_evenement" id="date_evenement" value="{{ old('date_evenement', $billet->date_evenement ? $billet->date_evenement->format('Y-m-d\TH:i') : '') }}">
                    @error('date_evenement') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="3">{{ old('description', $billet->description) }}</textarea>
                    @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-submit">Mettre à jour le Billet PASS</button>
                </div>
            </form>
        </div>

        <!-- Aperçu Ticket -->
        <div class="ticket-preview">
            <h2>Aperçu du ticket</h2>
            <div class="actions-pdf">
                <a href="{{ route('billets.pdf', $billet) }}" target="_blank" class="btn-download">Télécharger PDF</a>
                <button onclick="window.print();" class="btn-print">Imprimer</button>
            </div>

            <div class="ticket" id="ticket-preview">
                <div class="ticket-left">
                    <div class="ticket-header" id="ticket-type">{{ $billet->type }}</div>
                    <div class="ticket-body">
                        <p><strong>Nom :</strong> {{ $billet->nom }}</p>
                        <p><strong>Prix :</strong> €{{ number_format($billet->prix_vente, 2) }}</p>
                        <p><strong>Date :</strong> {{ $billet->date_evenement ? $billet->date_evenement->format('d/m/Y H:i') : '--/--/----' }}</p>
                        <p><strong>Type :</strong> {{ $billet->type }}</p>
                    </div>
                </div>
                <div class="ticket-right">
                    <div class="qr-code" id="qr-code"></div>
                    <div class="perforation"></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
    @push('scripts')
@endpush