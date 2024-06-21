<?php

// Configuration de Fedapay
define('FEDAPAY_API_KEY', 'wh_sandbox_7Oq3aUZ9bBkr44ueqCoC_j6e'); // Remplacez par votre clé API Fedapay
define('FEDAPAY_WEBHOOK_SECRET', 'wh_sandbox_7Oq3aUZ9bBkr44ueqCoC_j6e'); // Remplacez par votre secret webhook Fedapay

// Configuration du routeur Mikrotik
define('MIKROTIK_IP', 'https://5473-102-38-154-155.ngrok-free.app/'); // Remplacez par l'adresse IP de votre routeur
define('MIKROTIK_USERNAME', 'admin'); // Remplacez par le nom d'utilisateur
define('MIKROTIK_PASSWORD', 'Fernand0'); // Remplacez par le mot de passe

// Autres paramètres
define('WIFI_ZONE_URL', 'http://10.10.0.1/login'); // URL de la page de connexion Wi-Fi

// Durée de validité des codes Wi-Fi en fonction du montant (en secondes)
define('EXPIRATION_100', 86400);   // 1 jour
define('EXPIRATION_200', 86400);  // 1 jours
define('EXPIRATION_300', 86400);  // 2 jours
define('EXPIRATION_500', 172800); // 5 jours
define('EXPIRATION_2500', 604800); // 7 jours
define('EXPIRATION_8000', 2592000); // 30 jours
