<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Billet PASS - {{ $billet->nom }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .ticket {
            width: 400px;
            border: 2px dashed #333;
            border-radius: 12px;
            padding: 20px;
            margin: auto;
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: #fff;
        }
        .ticket h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .ticket p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h2>{{ $billet->type }} PASS</h2>
        <p><strong>Nom :</strong> {{ $billet->nom }}</p>
        <p><strong>Prix :</strong> €{{ number_format($billet->prix_vente, 2) }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($billet->date_evenement)->format('d/m/Y H:i') }}</p>
        <p><strong>Billets vendus :</strong> {{ $billet->billets_vendus }}/{{ $billet->ventes_max }}</p>
        <div class="footer">Accès Live Streaming - {{ $billet->type }} Ticket</div>
    </div>
</body>
</html>
