<?php

require_once __DIR__ . '/../vendor/PEAR2_Net_RouterOS-1.0.0b6.phar'; 
 // Inclure la bibliothèque MikroTik

use PEAR2\Net\RouterOS\Client;
use PEAR2\Net\RouterOS\Request;

// Fonction pour créer un ticket Wi-Fi
function createWifiTicket($amount) {
    $client = new Client(MIKROTIK_IP, MIKROTIK_USERNAME, MIKROTIK_PASSWORD);

    // Déterminer le profil et l'expiration en fonction du montant
    $profile = getProfileForAmount($amount);
    $expiration = getExpirationForAmount($amount);

    // Générer un nom d'utilisateur et un mot de passe aléatoires
    $username = 'user-' . generateRandomCode();
    $password = generateRandomCode();

    // Créer l'utilisateur hotspot
    $request = new Request('/ip/hotspot/user/add');
    $request->setArgument('name', $username);
    $request->setArgument('password', $password);
    $request->setArgument('profile', $profile);
    $request->setArgument('limit-uptime', $expiration);
    $client->sendSync($request);

    // Rediriger vers la page du ticket
    header('Location: ' . WIFI_ZONE_URL . '?username=' . urlencode($username) . '&password=' . urlencode($password));
    exit();
}

// Fonction pour obtenir le profil en fonction du montant
function getProfileForAmount($amount) {
    switch ($amount) {
        case 100:
            return '2h-100';
        case 200:
            return '5h-200';
        case 300:
            return '24h-300';
        case 500:
            return '48h-500';
        case 2500:
            return '1w-2500';
        case 8000:
            return '1m-8000';
        default:
            throw new Exception('Montant invalide');
    }
}

// Fonction pour obtenir l'expiration en fonction du montant
function getExpirationForAmount($amount) {
    switch ($amount) {
        case 100:
            return EXPIRATION_100;
        case 250:
            return EXPIRATION_200;
        case 500:
            return EXPIRATION_300;
        case 1000:
            return EXPIRATION_500;
        case 2500:
            return EXPIRATION_2500;
        case 8000:
            return EXPIRATION_8000;
        default:
            throw new Exception('Montant invalide');
    }
}
