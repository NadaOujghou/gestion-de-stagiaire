<?php
require 'connection.php';
require 'check_session.php';
require 'send_email.php';

// Récupérer les informations du stagiaire
$id_stagiaire = $_SESSION['id_stagiaire'];
$sql = "SELECT * FROM stagiaires WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_stagiaire);
$stmt->execute();
$result = $stmt->get_result();
$stagiaire = $result->fetch_assoc();

if (!$stagiaire) {
    header('Location: deconnexion.php');
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id_stagiaire = 1; // ID fixe pour le test
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $date_naissance = $_POST['date_naissance'];
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];
    $etablissement = $_POST['etablissement'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $sujet_stage = $_POST['sujet_stage'];

    // Mise à jour des informations dans la base de données
    $sql = "UPDATE stagiaires SET 
            nom = '$nom',
            prenom = '$prenom',
            email = '$email',
            telephone = '$telephone',
            adresse = '$adresse',
            date_naissance = '$date_naissance',
            filiere = '$filiere',
            niveau = '$niveau',
            etablissement = '$etablissement',
            date_debut = '$date_debut',
            date_fin = '$date_fin',
            sujet_stage = '$sujet_stage'
            WHERE id = $id_stagiaire";

    if ($conn->query($sql) === TRUE) {
        // Préparation des informations pour l'email
        $stagiaire_info = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'filiere' => $filiere,
            'niveau' => $niveau,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ];

        // Préparation des fichiers pour l'email
        $files = [];
        $file_fields = ['cv', 'lettre_motivation', 'demande_stage', 'assurance', 'convocation'];
        
        foreach ($file_fields as $field) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                $files[] = $_FILES[$field];
            }
        }

        // Ajout des fichiers supplémentaires
        if (isset($_FILES['autres_fichiers'])) {
            foreach ($_FILES['autres_fichiers']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['autres_fichiers']['error'][$key] === UPLOAD_ERR_OK) {
                    $files[] = [
                        'name' => $_FILES['autres_fichiers']['name'][$key],
                        'type' => $_FILES['autres_fichiers']['type'][$key],
                        'tmp_name' => $tmp_name,
                        'error' => $_FILES['autres_fichiers']['error'][$key],
                        'size' => $_FILES['autres_fichiers']['size'][$key]
                    ];
                }
            }
        }

        // Envoi de l'email
        if (sendDocumentsEmail($stagiaire_info, $files)) {
            header('Location: MonEspace.php?success=1');
        } else {
            header('Location: MonEspace.php?error=1');
        }
    } else {
        header('Location: MonEspace.php?error=1');
    }
} else {
    header('Location: MonEspace.php');
}
?> 