<!DOCTYPE html>
<html>
<head>
    <title>Ticket Wi-Fi</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        h1 { margin-top: 50px; }
        .ticket-info { background-color: #f0f0f0; padding: 20px; margin: 20px auto; max-width: 400px; border-radius: 5px; }
        .button { display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Votre ticket Wi-Fi</h1>

    <div class="ticket-info">
        <p>Nom d'utilisateur : <?php echo $username; ?></p>
        <p>Mot de passe : <?php echo $password; ?></p>
        <button class="button" onclick="redirectToWifiZone('<?php echo $username; ?>', '<?php echo $password; ?>')">Connexion automatique</button>
    </div>

    <script>
        function redirectToWifiZone(username, password) {
            window.location.href = '<?php echo WIFI_ZONE_URL; ?>?username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
        }
    </script>
</body>
</html>
