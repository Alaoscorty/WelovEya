@extends('layouts.application')

@section('title', 'Artistes')

@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Orbitron:wght@400;600;700&display=swap");
    * {
    transition: background-color 0.3s ease, color 0.3s ease;
    }
    .container {
        display: flex;
        min-height: 100vh;
    }


    /* Ticket Section */
    .ticket-section {
        display: flex;
        gap: 2rem;
        margin: 3rem 0;
    }

    .ticket-image {
        flex: 1;
    }

    .ticket-image img {
        width: 100%;
        border: 1px solid #333;
        border-radius: 8px;
    }

    .ticket-info {
        flex: 1;
    }

    .price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #FFFFFF;
        margin: 1rem 0;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        margin-top: 1.5rem;
    }

    .quantity-btn {
        background-color: white;
        color: black;
        border: none;
        width: 30px;
        height: 30px;
        cursor: pointer;
    }

    .quantity-input {
    width: 50px;
    height: 30px;
    text-align: center;
    background-color: white;
    color: black;
    border-right: 1px solid black;
    border-left: 1px solid black;
    }
    .add-to-cart{
    margin-left: 5vh;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-top: 3vh; 
    margin-left: 10vh;
    padding: 8px;
    }
    .main-content {
        flex: 1;
        padding: 40px;
        width: 100%;
    }

    .header-banner {
        background: linear-gradient(135deg, #ff8c42 0%, #d35400 100%);
        padding: 25px 30px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .header-banner h1 {
        font-size: 24px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-banner p {
        font-size: 14px;
        opacity: 0.95;
    }

    .form-section {
        background: #0d1b2a;
        padding: 30px;
        border-radius: 12px;
    }

    .section-title {
        font-size: 18px;
        margin-bottom: 25px;
        color: #fff;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
        color: #b8c5d6;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 14px 18px;
        background: #1a2842;
        border: 1px solid #2a3f5f;
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #ff8c42;
    }

    .form-group input::placeholder {
        color: #4a5f7f;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-cancel {
        background: transparent;
        color: #b8c5d6;
        border: 1px solid #2a3f5f;
    }

    .btn-cancel:hover {
        background: #1a2842;
    }

    .btn-submit {
        background: linear-gradient(135deg, #ff8c42 0%, #d35400 100%);
        color: #fff;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 140, 66, 0.3);
    }
</style>
<div class="flex container">
  <!-- Main Content -->
 <main class="main-content">
            <div class="header-banner">
                <h1>
                    <i class="fas fa-plus"></i>
                    Ajouter un stock de ticket
                </h1>
                <p>Définissez les détails du type de ticket pour votre événement.</p>
            </div>

            <div class="form-section">
                <h2 class="section-title">Informations de base</h2>
                
                <form id="ticketForm">
                    <div class="form-group">
                        <label for="ticketType">Type de ticket concerné</label>
                        <input type="text" id="ticketType" placeholder="Ex: Standard, Premium, VIP">
                    </div>

                    <div class="form-group">
                        <label for="currentStock">Stock actuel</label>
                        <input type="number" id="currentStock" placeholder="Entrez le stock actuel">
                    </div>

                    <div class="form-group">
                        <label for="quantityToAdd">Quantité à ajouter</label>
                        <input type="number" id="quantityToAdd" placeholder="Entrez la quantité à ajouter">
                    </div>

                    <div class="form-group">
                        <label for="newTotalStock">Nouveau Stock Total</label>
                        <input type="number" id="newTotalStock" placeholder="Calculé automatiquement" readonly>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel">Annuler</button>
                        <button type="submit" class="btn btn-submit">Confirmer l'ajout de Stock</button>
                    </div>
                </form>
            </div>
        </main>
</div>
@endsection
<script>
    // Calcul automatique du nouveau stock total
    const currentStockInput = document.getElementById('currentStock');
    const quantityToAddInput = document.getElementById('quantityToAdd');
    const newTotalStockInput = document.getElementById('newTotalStock');

    function calculateNewStock() {
        const currentStock = parseFloat(currentStockInput.value) || 0;
        const quantityToAdd = parseFloat(quantityToAddInput.value) || 0;
        newTotalStockInput.value = currentStock + quantityToAdd;
    }

    currentStockInput.addEventListener('input', calculateNewStock);
    quantityToAddInput.addEventListener('input', calculateNewStock);

    // Gestion du formulaire
    document.getElementById('ticketForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const ticketType = document.getElementById('ticketType').value;
        const currentStock = document.getElementById('currentStock').value;
        const quantityToAdd = document.getElementById('quantityToAdd').value;
        const newTotalStock = document.getElementById('newTotalStock').value;

        if (!ticketType || !currentStock || !quantityToAdd) {
            alert('Veuillez remplir tous les champs obligatoires');
            return;
        }

        alert(`Stock ajouté avec succès!\n\nType: ${ticketType}\nStock actuel: ${currentStock}\nQuantité ajoutée: ${quantityToAdd}\nNouveau total: ${newTotalStock}`);
        
        // Réinitialiser le formulaire
        this.reset();
        newTotalStockInput.value = '';
    });

    // Bouton annuler
    document.querySelector('.btn-cancel').addEventListener('click', function() {
        if (confirm('Voulez-vous vraiment annuler? Toutes les données saisies seront perdues.')) {
            document.getElementById('ticketForm').reset();
            newTotalStockInput.value = '';
        }
    });
</script>
    @push('scripts')
    @endpush
