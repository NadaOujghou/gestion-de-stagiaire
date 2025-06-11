<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_stagiaire'])) {
    header('Location: login.php');
    exit();
}

// Vérifier si la session n'a pas expiré (30 minutes)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header('Location: login.php?expired=1');
    exit();
}

// Mettre à jour le timestamp de dernière activité
$_SESSION['last_activity'] = time();
?> 