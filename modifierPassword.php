<?php
include 'connection.php'; // Assure-toi que $conn est bien initialisé

$token = $_GET['token'] ?? '';
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // Vérifie le token
        $token = $conn->real_escape_string($token);
        $query = "SELECT email FROM password_resets WHERE token = '$token' AND expires_at > NOW() LIMIT 1";
        $result = $conn->query($query);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $email = $row['email'];

            // Hasher le mot de passe
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Mise à jour du mot de passe dans la table stagiaires
            $update = "UPDATE stagiaires SET mot_de_passe = '$hashed_password' WHERE email = '$email'";
            if ($conn->query($update)) {
                // Supprimer le token après usage
                $conn->query("DELETE FROM password_resets WHERE email = '$email'");
                $success_message = "Password updated successfully. You can now <a href='login.php'>login</a>.";
            } else {
                $error_message = "Database error: " . $conn->error;
            }
        } else {
            $error_message = "Invalid or expired token.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #aaa;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .message {
            margin-bottom: 15px;
            color: green;
        }
        .error {
            margin-bottom: 15px;
            color: red;
        }
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #1a2940;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #f39c12;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>

    <?php if (!empty($success_message)): ?>
        <div class="message"><?= $success_message ?></div>
    <?php elseif (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (empty($success_message)): ?>
    <form method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Change Password</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
