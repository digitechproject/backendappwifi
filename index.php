<?php

require_once 'config.php';
require_once 'lib/fedapay.php';
require_once 'lib/mikrotik.php';
require_once 'vendor/PEAR2_Net_RouterOS-1.0.0b6.phar';

use PEAR2\Net\RouterOS\Client;

// Route pour le webhook Fedapay (à adapter selon votre configuration)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification de la signature Fedapay
    if (!verifyFedapaySignature($_POST, $_SERVER['HTTP_X_FEDAPAY_SIGNATURE'])) {
        http_response_code(400); // Bad Request
        die('Signature invalide');
    }

    // Traitement de la notification de paiement
    $paymentId = $_POST['id'];
    $amount = $_POST['amount'];
    handlePaymentNotification($paymentId, $amount);

    http_response_code(200); // OK
    die();
}

// Route pour la page du ticket Wi-Fi
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/') {
    // Récupération des informations du ticket (username, password) depuis la requête
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Affichage de la page du ticket
    require_once 'templates/ticket.php';
    die();
}

// Gestion des autres routes (erreur 404)
http_response_code(404); // Not Found
die('Page non trouvée');
