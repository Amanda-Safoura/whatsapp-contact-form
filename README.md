# Projet Laravel - Formulaire de contact avec envoi de fichiers

Ce projet Laravel permet à un utilisateur de remplir un formulaire pour envoyer un message à un destinataire spécifique via WhatsApp. Le formulaire contient les champs suivants :

- **Nom du receveur** : pour personnaliser le message.
- **Numéro de téléphone** : numéro de téléphone du receveur.
- **Message** : texte à envoyer.
- **Fichiers (PDF ou image)** : option pour envoyer un fichier, soit un PDF, soit une image. *L'un des deux champs, message ou fichier, est obligatoire.*

## Fonctionnalités

- **Envoi de message via WhatsApp API Cloud** : intégration de l'API WhatsApp pour envoyer des messages et fichiers.
- **Envoi via Twilio** : alternative avec Twilio pour envoyer des messages et fichiers.
- **Contrôles de validation** : 
  - Le nom du receveur et le numéro de téléphone sont des champs obligatoires.
  - Au moins un des deux champs, message ou fichier, doit être rempli.

## Prérequis

Avant de commencer, assurez-vous que vous avez installé les outils suivants :

- PHP >= 8.0
- Composer
- Laravel
- Un serveur pour héberger l'application (local ou en production)
- Comptes WhatsApp API Cloud et Twilio configurés pour l'intégration

## Installation

1. Clonez le dépôt du projet :
   ```bash
   git clone https://github.com/Amanda-Safoura/whatsapp-contact-form.git
   ```

2. Installez les dépendances :
   ```bash
   cd whatsapp-contact-form
   composer install
   ```

3. Configurez votre fichier `.env` :
   - Ajoutez vos clés API pour WhatsApp Cloud et Twilio.
   - Configurez votre base de données si nécessaire.

4. Exécutez les migrations si des tables sont nécessaires :
   ```bash
   php artisan migrate
   ```

5. Démarrez le serveur Laravel :
   ```bash
   php artisan serve
   ```

## Utilisation

Accédez à l'application via votre navigateur et remplissez le formulaire. Vous pourrez envoyer un message avec ou sans fichier en pièce jointe via l'API WhatsApp ou Twilio.

## Structure du projet

- **app/Http/Controllers** :
  - `WhatsAppCloudAPIController.php` : gestion de l'envoi via WhatsApp.
  - `TwilioWhatsAppController.php` : gestion de l'envoi via Twilio.
- **resources/views** :
  - `form.blade.php` : Vue contenant le formulaire de contact.
- **routes/web.php** : définition des routes pour afficher et traiter le formulaire.

## Contribuer

Si vous souhaitez contribuer à ce projet, vous pouvez fork ce dépôt, faire vos modifications et soumettre une pull request.

## Licence

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).

---

Si tu veux personnaliser certains détails, comme la description, ou ajouter des informations supplémentaires, n’hésite pas à me le dire !