# Projet Espoir

<p align="center">
<img src="public/img/logo.png" width="200" alt="Logo Espoir">
</p>

<p align="center">
Une plateforme solidaire de vente en ligne permettant aux entrepreneurs locaux de créer et gérer leurs stands virtuels.
</p>

## À propos du projet Espoir

Espoir est une application web développée avec Laravel qui met en relation des entrepreneurs locaux et des clients souhaitant acheter des produits éthiques et solidaires. Le projet permet :

- Aux entrepreneurs de créer et gérer un stand virtuel
- Aux administrateurs d'approuver les nouveaux stands
- Aux clients de parcourir les stands et d'acheter des produits
- La gestion complète des commandes et produits

## Fonctionnalités principales

- **Gestion des utilisateurs** avec trois rôles principaux : admin, entrepreneur en attente, entrepreneur approuvé
- **Système d'approbation** des entrepreneurs par les administrateurs
- **Gestion des stands** avec upload d'images, description détaillée et statut
- **Catalogue de produits** organisé par catégories et par stands
- **Système de panier d'achat** avec paiement (simulé)
- **Notifications par email** pour les commandes et approbations
- **Tableaux de bord** spécifiques selon le rôle de l'utilisateur

## Configuration requise

- PHP 8.1 ou supérieur
- Composer
- MySQL ou MariaDB
- Node.js et npm pour la compilation des assets
- Serveur SMTP pour l'envoi d'emails (Gmail recommandé)

## Installation

1. Clonez le dépôt :
```bash
git clone https://github.com/votre-compte/espoir.git
cd espoir
```

2. Installez les dépendances PHP :
```bash
composer install
```

3. Installez les dépendances JavaScript :
```bash
npm install && npm run dev
```

4. Copiez le fichier d'environnement et générez la clé d'application :
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurez votre base de données dans le fichier .env :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=espoir
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

6. Configurez les paramètres SMTP pour l'envoi d'emails (avec Gmail) :
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-application
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre-email@gmail.com
MAIL_FROM_NAME="Espoir"
```

> **Note**: Pour Gmail, vous devez créer un mot de passe d'application dans les paramètres de sécurité de votre compte Google.

7. Exécutez les migrations et les seeders pour initialiser la base de données :
```bash
php artisan migrate --seed
```

8. Créez un lien symbolique pour le stockage :
```bash
php artisan storage:link
```

9. Démarrez le serveur de développement :
```bash
php artisan serve
```

## Comptes utilisateurs par défaut

Après avoir exécuté les seeders, les comptes suivants seront disponibles :

- **Administrateur** : admin@espoir.com / password
- **Entrepreneur approuvé** : entrepreneur@espoir.com / password
- **Entrepreneur en attente** : attente@espoir.com / password
- **Client** : client@espoir.com / password

## Structure du projet

- **`app/Http/Controllers`** : Contrôleurs pour chaque section (Admin, Entrepreneur, Public, etc.)
- **`app/Http/Middleware`** : Middlewares pour la gestion des rôles
- **`app/Models`** : Modèles de données
- **`resources/views`** : Vues Blade organisées par rôle
- **`routes/web.php`** : Définition des routes

## Déploiement en production

Pour déployer l'application en production, suivez ces étapes supplémentaires :

1. Optimisez les autoloaders de Composer :
```bash
composer install --optimize-autoloader --no-dev
```

2. Optimisez la configuration :
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. Assurez-vous que les permissions des répertoires sont correctement configurées :
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Licence

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).

## Contact

Pour toute question ou suggestion, veuillez contacter l'équipe Espoir à contact@espoir.com
