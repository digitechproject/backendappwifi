<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Inclure le fichier autoload de la bibliothèque FedaPay

use FedaPay\FedaPay;
use FedaPay\Webhook;

// Initialisation de FedaPay
FedaPay::setApiKey(FEDAPAY_API_KEY);

// Fonction pour vérifier la signature Fedapay
function verifyFedapaySignature($payload, $signatureHeader) {
    $secret = FEDAPAY_WEBHOOK_SECRET;
    $signature = hash_hmac('sha256', $payload, $secret);
    return hash_equals($signature, $signatureHeader);
}

// Fonction pour gérer la notification de webhook Fedapay
function handleWebhookNotification($payload) {
    $event = Webhook::constructEvent($payload, $_SERVER['HTTP_X_FEDAPAY_SIGNATURE'], FEDAPAY_WEBHOOK_SECRET);

    switch ($event->name) {
        case 'charge.succeeded':
            $transaction = $event->data['object'];
            $amount = $transaction['amount'];
            $currency = $transaction['currency']['iso'];

            // Vérifier que la devise est correcte (par exemple, XOF)
            if ($currency !== 'XOF') {
                error_log('Devise non prise en charge : ' . $currency);
                return;
            }

            // Créer le ticket Wi-Fi
            createWifiTicket($amount);
            break;

        // Gérer d'autres types d'événements si nécessaire
        case 'charge.failed':
            // ...
            break;

        default:
            error_log('Type d\'événement inconnu : ' . $event->type);
    }
}

// Route pour le webhook Fedapay
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = file_get_contents('php://input');

    if (verifyFedapaySignature($payload, $_SERVER['HTTP_X_FEDAPAY_SIGNATURE'])) {
        handleWebhookNotification($payload);
        http_response_code(200); // OK
    } else {
        http_response_code(400); // Bad Request
        error_log('Signature invalide pour la notification de paiement');
    }

    die();
}

// ... (autres routes)
