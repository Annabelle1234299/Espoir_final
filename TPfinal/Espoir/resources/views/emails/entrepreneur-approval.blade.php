<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre stand a été approuvé</title>
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
        .stand-details {
            margin-top: 15px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 6px;
        }
        .highlight {
            background-color: #dbeafe;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            border-left: 4px solid #4f46e5;
        }
        .steps {
            margin: 25px 0;
            padding: 0;
        }
        .step {
            background-color: #f8fafc;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            position: relative;
            padding-left: 40px;
        }
        .step:before {
            content: attr(data-number);
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
            height: 25px;
            background-color: #4f46e5;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Espoir</h1>
        </div>
        
        <div class="content">
            <h1>Félicitations ! Votre stand a été approuvé</h1>
            
            <p>Bonjour {{ $user->name }},</p>
            
            <p>Nous sommes ravis de vous annoncer que votre stand <strong>"{{ $stand->nom }}"</strong> a été approuvé par notre équipe et est maintenant visible sur la plateforme Espoir !</p>
            
            <div class="highlight">
                <p>Vous pouvez dès à présent commencer à ajouter vos produits et gérer votre stand en tant qu'entrepreneur certifié.</p>
            </div>
            
            <h2>Détails de votre stand</h2>
            
            <div class="stand-details">
                <p><strong>Nom du stand :</strong> {{ $stand->nom }}</p>
                <p><strong>Emplacement :</strong> {{ $stand->emplacement }}</p>
                <p><strong>Type de produits :</strong> {{ ucfirst($stand->type_produits) }}</p>
                <p><strong>Date d'approbation :</strong> {{ now()->format('d/m/Y') }}</p>
            </div>
            
            <h2>Prochaines étapes</h2>
            
            <div class="steps">
                <div class="step" data-number="1">
                    Connectez-vous à votre espace entrepreneur
                </div>
                <div class="step" data-number="2">
                    Ajoutez des produits à votre stand pour commencer à vendre
                </div>
                <div class="step" data-number="3">
                    Personnalisez davantage votre profil et votre stand
                </div>
                <div class="step" data-number="4">
                    Commencez à recevoir et à gérer vos commandes
                </div>
            </div>
            
            <p>Vous pouvez accéder à votre tableau de bord en cliquant sur le bouton ci-dessous :</p>
            
            <div style="text-align: center;">
                <a href="{{ route('entrepreneur.dashboard') }}" class="button">Accéder à mon espace entrepreneur</a>
            </div>
            
            <p>Notre équipe est à votre disposition pour vous aider dans vos débuts sur Espoir. N'hésitez pas à nous contacter si vous avez des questions ou besoin d'assistance.</p>
        </div>
        
        <div class="footer">
            <p>Nous vous souhaitons beaucoup de succès dans votre aventure entrepreneuriale avec Espoir !</p>
            <p>© {{ date('Y') }} Espoir - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
