@extends('layouts.application')

@section('title', 'Artistes')
<style>
    .main-content {
        max-width: 1100px;
        margin: 2rem auto;
        font-family: 'Poppins', sans-serif;
    }

    .header h1 {
        text-align: center;
        margin-bottom: 2rem;
        color: #1a2942;
    }

    .form-and-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .form-container {
        flex: 1 1 400px;
        padding: 2rem;
        border-radius: 12px;
    }

    .ticket-preview {
        flex: 1 1 400px;
        text-align: center;
    }
    .ticket {
        display: flex;
        width: 350px;
        border-radius: 12px;
        color: #fff;
        overflow: hidden;
        font-family: monospace;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .ticket-left, .ticket-right {
        padding: 1rem;
    }

    .ticket-left {
        flex: 2;
    }

    .ticket-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        background: #1a2942;
        position: relative;
    }

    .ticket-header {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .ticket-body p {
        margin: 0.3rem 0;
    }

    .ticket-footer {
        text-align: center;
        padding: 0.5rem;
    }

    .qr-code canvas {
        margin-top: 1rem;
    }

    .perforation {
        width: 100%;
        height: 4px;
        border-top: 2px dashed #fff;
        margin-top: 1rem;
    }
    .actions-pdf {
        margin-top: 1rem;
        display: flex;
        gap: 10px;
    }
    .btn-download, .btn-print {
        padding: 0.5rem 1rem;
        background: #e7482cff;
        color: #fff;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-print {
        background: #10b981;
    }

    /* Form styles */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.3rem;
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.5rem;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
    }

    .btn-submit {
        background: #f6703bff;
        color: white;
        padding: 0.7rem 1.5rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-submit:hover {
        background: #2563eb;
    }

    .error {
        color: red;
        font-size: 0.85rem;
    }
</style>
@section('content')
<main class="main-content">
    <div class="header">
        <h1>Créer un Billet</h1>
    </div>

    <div class="form-and-preview">
        <!-- Formulaire -->
        <div class="form-container">
            <form action="{{ route('billets.store') }}" method="POST" class="ticket-form">
                @csrf

                <div class="form-group">
                    <label for="nom">Nom du billet</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required>
                    @error('nom') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="type">Type de billet</label>
                    <select name="type" id="type" required>
                        <option value="VIP" {{ old('type')=='VIP'?'selected':'' }}>VIP</option>
                        <option value="Standard" {{ old('type')=='Standard'?'selected':'' }}>Standard</option>
                        <option value="Early Bird" {{ old('type')=='Early Bird'?'selected':'' }}>Early Bird</option>
                    </select>
                    @error('type') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="prix_vente">Prix (€)</label>
                    <input type="number" step="0.01" min="0" name="prix_vente" id="prix_vente" value="{{ old('prix_vente') }}" required>
                    @error('prix_vente') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="ventes_max">Nombre maximum de billets</label>
                    <input type="number" min="1" name="ventes_max" id="ventes_max" value="{{ old('ventes_max') }}" required>
                    @error('ventes_max') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="date_evenement">Date de l'événement</label>
                    <input type="datetime-local" name="date_evenement" id="date_evenement" value="{{ old('date_evenement') }}">
                    @error('date_evenement') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-submit">Créer le Billet PASS</button>
                </div>
            </form>
        </div>

        <!-- Aperçu Ticket Ultra Premium -->
        <div class="ticket-preview">
            <h2>Aperçu du ticket</h2>
            <div class="actions-pdf">
                
                <button onclick="window.print();" class="btn-print">Imprimer</button>
            </div>
            <div class="ticket" id="ticket-preview">
                <div class="ticket-left">
                    <div class="ticket-header" id="ticket-type">VIP</div>
                    <div class="ticket-body">
                        <p><strong>Nom :</strong> <span id="preview-nom">Nom du billet</span></p>
                        <p><strong>Prix :</strong> <span id="preview-prix">0.00 €</span></p>
                        <p><strong>Date :</strong> <span id="preview-date">--/--/----</span></p>
                        <p><strong>Type :</strong> <span id="preview-type">VIP</span></p>
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
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nomInput = document.getElementById('nom');
    const prixInput = document.getElementById('prix_vente');
    const dateInput = document.getElementById('date_evenement');
    const typeSelect = document.getElementById('type');
    const ticketHeader = document.getElementById('ticket-type');
    const qrCodeContainer = document.getElementById('qr-code');

    function updateQRCode() {
        const data = `Billet: ${nomInput.value || 'Nom du billet'} | Type: ${typeSelect.value} | Prix: ${prixInput.value || 0}€ | Date: ${dateInput.value || '---'}`;
        QRCode.toCanvas(qrCodeContainer, data, { width: 100 });
    }

    nomInput.addEventListener('input', () => {
        document.getElementById('preview-nom').textContent = nomInput.value || 'Nom du billet';
        updateQRCode();
    });

    prixInput.addEventListener('input', () => {
        document.getElementById('preview-prix').textContent = prixInput.value ? prixInput.value + ' €' : '0.00 €';
        updateQRCode();
    });

    dateInput.addEventListener('input', () => {
        document.getElementById('preview-date').textContent = dateInput.value ? new Date(dateInput.value).toLocaleString() : '--/--/----';
        updateQRCode();
    });

    typeSelect.addEventListener('change', () => {
        const type = typeSelect.value;
        document.getElementById('preview-type').textContent = type;
        ticketHeader.textContent = type;

        const ticket = document.getElementById('ticket-preview');
        if(type === 'VIP') ticket.style.background = 'linear-gradient(135deg, #fbbf24, #f97316)';
        else if(type === 'Standard') ticket.style.background = 'linear-gradient(135deg, #3b82f6, #60a5fa)';
        else ticket.style.background = 'linear-gradient(135deg, #10b981, #34d399)';

        updateQRCode();
    });

    updateQRCode(); // initial QR code
});
</script>


@endpush