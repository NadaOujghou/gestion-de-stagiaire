<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Configuration de l'email de l'entreprise
define('ENTREPRISE_EMAIL', 'entreprise@example.com'); // Remplacez par l'email de l'entreprise
define('ENTREPRISE_NOM', 'Nom de l\'Entreprise'); // Remplacez par le nom de l'entreprise

function sendDocumentsEmail($stagiaire_info, $files) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'votre_email@gmail.com'; // Remplacez par votre email
        $mail->Password = 'votre_mot_de_passe'; // Remplacez par votre mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom('votre_email@gmail.com', 'Système de Gestion des Stages');
        $mail->addAddress(ENTREPRISE_EMAIL, ENTREPRISE_NOM);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Documents de stage - ' . $stagiaire_info['nom'] . ' ' . $stagiaire_info['prenom'];
        
        // Corps du message
        $message = "
            <h2>Documents de stage</h2>
            <p>Bonjour,</p>
            <p>Veuillez trouver ci-joint les documents de stage de :</p>
            <ul>
                <li><strong>Nom :</strong> {$stagiaire_info['nom']} {$stagiaire_info['prenom']}</li>
                <li><strong>Email :</strong> {$stagiaire_info['email']}</li>
                <li><strong>Filière :</strong> {$stagiaire_info['filiere']}</li>
                <li><strong>Niveau :</strong> {$stagiaire_info['niveau']}</li>
                <li><strong>Période de stage :</strong> {$stagiaire_info['date_debut']} à {$stagiaire_info['date_fin']}</li>
            </ul>
            <p>Cordialement,<br>Système de Gestion des Stages</p>
        ";
        
        $mail->Body = $message;

        // Ajout des pièces jointes
        foreach ($files as $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $mail->addAttachment(
                    $file['tmp_name'],
                    $file['name']
                );
            }
        }

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?> 