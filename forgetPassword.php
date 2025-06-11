<?php
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address.";
    } else {
        $email = $conn->real_escape_string($email);

        $sql_check = "SELECT id FROM stagiaires WHERE email = '$email'";
        $result = $conn->query($sql_check);

        if (!$result) {
            $error_message = "SQL Error: " . $conn->error;
        } elseif ($result->num_rows === 0) {
            $error_message = "No trainee found with this email address.";
        } else {
            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

            $conn->query("DELETE FROM password_resets WHERE email = '$email'");

            $token_safe = $conn->real_escape_string($token);
            $expires_safe = $conn->real_escape_string($expires);
            $sql_insert = "INSERT INTO password_resets (email, token, expires_at) 
                           VALUES ('$email', '$token_safe', '$expires_safe')";
            $conn->query($sql_insert);

            $resetLink = "http://localhost/gestion_stagiares/modifierPassword.php?token=" . urlencode($token);

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'hidayanada83@gmail.com';
                $mail->Password = 'uldq qsvo bbtd lonv';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('hidayanada83@gmail.com', 'Competence Center');
                $mail->addAddress($email);

                $mail->Subject = 'Password Reset';
                $mail->Body = "Hello,\nClick here to reset your password: $resetLink";

                $mail->send();
                $success_message = "Email sent to $email.";
            } catch (Exception $e) {
                $error_message = "Sending error: {$mail->ErrorInfo}";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px #1a2940;
            width: 100%;
            max-width: 400px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
            border: 1px solid #c3e6cb;
            font-weight: bold;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
            border: 1px solid #f5c6cb;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #1a2940;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        button:hover {
            background-color: #f39c12;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #1a2940;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            box-sizing: border-box;
        }
        .btn:hover {
            background-color: #f39c12;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <h2>Forgot Password</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email address">
            </div>
            <button type="submit">Reset Password</button>
            <a href="login.php" class="btn">Back to Login</a>
        </form>
    </div>
</body>
</html>
