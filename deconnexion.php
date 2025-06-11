<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - EPG</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgba(0, 0, 0, 0.5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .confirmation-dialog {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }

        .confirmation-dialog h3 {
            margin-top: 0;
            color: #1a2940;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .confirmation-dialog p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-confirm {
            background-color: #dc3545;
            color: white;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="confirmation-dialog">
        <h3>Confirmer la déconnexion</h3>
        <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
        <div class="button-group">
            <button class="btn btn-cancel" onclick="window.history.back()">Annuler</button>
            <button class="btn btn-confirm" onclick="window.location.href='logout.php'">Déconnexion</button>
        </div>
    </div>
</body>
</html>
