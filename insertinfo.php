<?php
require 'connection.php';

if(isset($_POST['submit'])){

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);
$adresse = $_POST['adresse'];
$date_naissance = $_POST['date_naissance'];
$genre = $_POST['genre'];
$filiere = $_POST['filiere'];
$niveau = $_POST['niveau'];
$etablissement = $_POST['etablissement'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
$sujet_stage = $_POST['sujet_stage'];

$sql = "INSERT INTO stagiaires 
(nom, prenom, email, telephone, adresse, mot_de_passe, date_naissance, genre, filiere, niveau, etablissement, date_debut, date_fin, sujet_stage)
VALUES 
('$nom', '$prenom', '$email', '$telephone', '$adresse', '$mot_de_passe', '$date_naissance', '$genre', '$filiere', '$niveau', '$etablissement', '$date_debut', '$date_fin', '$sujet_stage')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registration successful ! !'); window.location.href='accueil.php';</script>";
} else {
    echo "Erreur during registration : " . mysqli_error($conn);
}

mysqli_close($conn);
}
?>

