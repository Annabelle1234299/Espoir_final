<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre commande</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .header img {
            max-height: 60px;
        }
        .content {
            padding: 20px 0;
        }
        h1 {
            color: #4f46e5;
            font-weight: 600;
            margin-bottom: 20px;
        }
        h2 {
            color: #4f46e5;
            font-size: 1.2em;
            margin-top: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f8fafc;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9em;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 15px;
        }
        .total {
            font-weight: bold;
            font-size: 1.1em;
        }
        .address {
            margin-top: 15px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 6px;
        }
        .highlight {
            background-color: #eff6ff;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Espoir</h1>
        </div>
        
        <div class="content">
            <h1>Confirmation de commande #{{ $commande->id }}</h1>
            
            <p>Bonjour {{ $user->name }},</p>
            
            <p>Nous vous remercions pour votre commande sur la plateforme Espoir. Voici un récapitulatif de votre commande :</p>
            
            <div class="highlight">
                <p><strong>Numéro de commande :</strong> #{{ $commande->id }}</p>
                <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                <p><strong>Stand :</strong> {{ $commande->stand->nom }}</p>
                <p><strong>Statut :</strong> <span style="color: #4f46e5;">{{ $commande->status }}</span></p>
            </div>
            
            <h2>Détails de la commande</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $produits = collect(json_decode($commande->details));
                    @endphp
                    
                    @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->quantite }}</td>
                        <td>{{ number_format($produit->prix_unitaire, 2) }} €</td>
                        <td>{{ number_format($produit->prix_unitaire * $produit->quantite, 2) }} €</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <p class="total">Total de la commande : {{ number_format($commande->total, 2) }} €</p>
            
            <p>Vous pouvez suivre l'évolution de votre commande en cliquant sur le bouton ci-dessous :</p>
            
            <div style="text-align: center;">
                <a href="{{ route('public.orders.show', $commande->id) }}" class="button">Suivre ma commande</a>
            </div>
            
            <p>Si vous avez des questions concernant votre commande, n'hésitez pas à contacter directement le stand ou notre équipe de support.</p>
        </div>
        
        <div class="footer">
            <p>Merci d'avoir choisi Espoir pour vos achats éthiques et solidaires.</p>
            <p>© {{ date('Y') }} Espoir - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
