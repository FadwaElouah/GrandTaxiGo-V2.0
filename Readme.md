# GrandTaxiGo

## Description
GrandTaxiGo est une plateforme de réservation de grands taxis pour des trajets interurbains. Elle permet aux passagers de réserver des trajets et aux chauffeurs de publier leurs disponibilités et gérer leurs trajets en toute simplicité.

## Fonctionnalités

### Authentification et gestion des comptes
- Inscription des utilisateurs (passagers et chauffeurs) avec une photo de profil obligatoire.
- Connexion sécurisée via identifiants.
- Gestion du profil utilisateur.

### Réservation et gestion des trajets
- Les passagers peuvent réserver un taxi en spécifiant la date, le lieu de prise en charge et la destination.
- Consultation de l'historique des trajets :
  - Passagers : réservations effectuées.
  - Chauffeurs : courses effectuées.
- Annulation d’une réservation avant une heure de départ.
- Filtrage des chauffeurs par localisation et disponibilité.
- Acceptation ou refus des réservations par les chauffeurs.
- Annulation automatique des réservations non confirmées après leur heure de départ.
- Mise à jour des disponibilités des chauffeurs (avec option d'automatisation).

## Installation et Configuration
### Prérequis
- PHP 8+
- MySQL / MariaDB
- Composer
- Laravel (si framework utilisé)
- Node.js et npm (si besoin de gestion de dépendances front-end)

### Étapes d'installation
1. **Cloner le projet**
   ```bash
   git clone https://github.com/FadwaElouah/GrandTaxi.git
   cd GrandTaxi
   ```
2. **Installer les dépendances**
   ```bash
   composer install
   npm install
   ```
3. **Configurer l'environnement**
   - Copier le fichier `.env.example` en `.env` et configurer les variables (base de données, clés API...)
   ```bash
   cp .env.example .env
   ```
   - Générer la clé d'application Laravel (si applicable) :
   ```bash
   php artisan key:generate
   ```
4. **Créer la base de données et exécuter les migrations**
   ```bash
   php artisan migrate
   ```
5. **Lancer le serveur local**
   ```bash
   php artisan serve
   ```
   Ou pour le front-end (si applicable) :
   ```bash
   npm run dev
   ```

## Contribution
1. Forker le dépôt.
2. Créer une branche pour vos modifications.
3. Faire une Pull Request avec une description détaillée.

## Licence
Ce projet est sous licence MIT.

## Auteurs
- [Fadwa Elouah](https://github.com/FadwaElouah)

---
GrandTaxiGo 🚖 - Simplifiez vos trajets interurbains !

