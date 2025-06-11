<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$database = "gestionstagiare";

$conn = new mysqli($host, $user, $password, $database);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}
?>