# Nimba SMS Package for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aristech/nimbasms.svg?style=flat-square)](https://packagist.org/packages/aristech/nimbasms)
[![Total Downloads](https://img.shields.io/packagist/dt/aristech/nimbasms.svg?style=flat-square)](https://packagist.org/packages/aristech/nimbasms)
[![License](https://img.shields.io/packagist/l/aristech/nimbasms.svg?style=flat-square)](https://packagist.org/packages/aristech/nimbasms)

Un package Laravel élégant pour intégrer l'API Nimba SMS, permettant l'envoi de SMS, la gestion des contacts et groupes, les vérifications par code, et bien plus encore.

## Fonctionnalités

- 📱 Envoi de SMS simple et programmé
- 👥 Gestion complète des contacts et groupes
- ✅ Système de vérification par code
- 📊 Rapports de livraison
- 🔄 Gestion des erreurs robuste
- 🛡️ Compatible avec Laravel 10.x et 11.x

## Prérequis

- PHP 8.x
- Laravel 10.x ou 11.x
- Compte Nimba SMS avec identifiants API

## Installation

1. Installez le package via Composer :

```bash
composer require aristech/nimbasms
```

2. Publiez le fichier de configuration :

```bash
php artisan vendor:publish --tag=config
```

## Configuration

1. Ajoutez vos identifiants Nimba SMS dans votre fichier `.env` :

```env
NIMBA_SMS_SERVICE_ID=votre_service_id
NIMBA_SMS_SECRET=votre_secret
NIMBA_SMS_BASE_URL=https://api.nimbasms.com/
```

2. Le fichier de configuration `config/nimbasms.php` est disponible pour personnalisation :

```php
return [
    'serviceId' => env('NIMBA_SMS_SERVICE_ID', ''),
    'secret'    => env('NIMBA_SMS_SECRET', ''),
    'baseUrl'   => env('NIMBA_SMS_BASE_URL', 'https://api.nimbasms.com/'),
];
```

## Utilisation

### Injection de Dépendance

Le package utilise l'injection de dépendance de Laravel. Vous pouvez injecter le client SMS via l'interface :

```php
use Aristech\NimbaSms\Contracts\SmsClientInterface;

class SmsController extends Controller
{
    protected SmsClientInterface $smsClient;

    public function __construct(SmsClientInterface $smsClient)
    {
        $this->smsClient = $smsClient;
    }
}
```

### Envoi de SMS

```php
try {
    $response = $this->smsClient->send(
        'MonEntreprise',           // Nom de l'expéditeur
        ['+22457123456'],         // Liste des destinataires
        'Votre message ici'       // Contenu du message
    );
    
    // Traitement de la réponse
    return response()->json($response);
    
} catch (NimbaSmsException $e) {
    // Gestion des erreurs
    return response()->json([
        'error' => $e->getMessage(),
        'details' => $e->getErrorDetails()
    ], 400);
}
```

### Gestion des Contacts

```php
// Création d'un contact
$response = $smsClient->createContact(
    'John Doe',                    // Nom
    ['Clients', 'VIP'],           // Groupes
    '+22457123456'                // Numéro
);

// Mise à jour d'un contact
$response = $smsClient->updateContact(
    'contact_id',
    'John Doe Updated',
    ['Clients'],
    '+22457123456'
);

// Suppression d'un contact
$response = $smsClient->deleteContact('contact_id');

// Liste des contacts
$contacts = $smsClient->getContacts();
```

### Gestion des Groupes

```php
// Création d'un groupe
$response = $smsClient->createGroup('Nouveau Groupe');

// Mise à jour d'un groupe
$response = $smsClient->updateGroup('group_id', 'Nouveau Nom');

// Suppression d'un groupe
$response = $smsClient->deleteGroup('group_id');

// Liste des groupes
$groups = $smsClient->getGroups();
```

### Vérification par Code

```php
// Envoi d'un code de vérification
$response = $smsClient->createVerification('+22457123456');

// Validation du code
$response = $smsClient->validateVerification(
    '+22457123456',              // Numéro
    '123456'                     // Code reçu
);
```

### SMS Programmés

```php
$response = $smsClient->scheduleSms(
    'MonEntreprise',             // Expéditeur
    ['+22457123456'],           // Destinataires
    'Message programmé',         // Contenu
    '2024-12-31 23:59:59'       // Date d'envoi
);
```

### Rapports

```php
// Détails d'un message
$message = $smsClient->getMessageById('message_id');

// Rapport de livraison
$report = $smsClient->getDeliveryReport('message_id');

// Liste des messages
$messages = $smsClient->getMessages();
```

## Gestion des Erreurs

Le package inclut une gestion des erreurs robuste via `NimbaSmsException` :

```php
try {
    $response = $smsClient->send($sender, $recipients, $message);
} catch (NimbaSmsException $e) {
    // Code d'erreur spécifique
    $errorCode = $e->getErrorCode();
    
    // Détails supplémentaires
    $details = $e->getErrorDetails();
    
    // Message d'erreur
    $message = $e->getMessage();
    
    // Log de l'erreur
    Log::error('Erreur Nimba SMS', [
        'message' => $message,
        'code' => $errorCode,
        'details' => $details
    ]);
}
```

## Tests

```bash
composer test
```

## Changelog

Consultez [CHANGELOG.md](CHANGELOG.md) pour les détails des changements récents.

## Contribution

Les contributions sont les bienvenues ! Consultez [CONTRIBUTING.md](CONTRIBUTING.md) pour les détails.

## Sécurité

Si vous découvrez une faille de sécurité, merci d'envoyer un email à [aristechdev@gmail.com](mailto:aristechdev@gmail.com).

## Crédits

- [ArisTech](https://github.com/aristech)
- [Tous les contributeurs](../../contributors)

## Licence

Le package Nimba SMS est un logiciel open-source sous licence [MIT](LICENSE.md).

## Support

Pour toute question ou assistance :
- 📧 Email: aristechdev@gmail.com
- 📚 [Documentation officielle Nimba SMS](https://developers.nimbasms.com/)