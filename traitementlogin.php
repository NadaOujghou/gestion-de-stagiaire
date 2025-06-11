<?php
session_start();
require 'connection.php';

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Vérifier si c'est un admin
    $sql_admin = "SELECT * FROM admin WHERE email = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param("s", $email);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows === 1) {
        $admin = $result_admin->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['user_role'] = 'admin';
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['nom'] = $admin['nom'];
            header("Location: accueilAdmin.php");
            exit();
        }
    }

    // Vérifier si c'est un encadrant
    $sql_encadrant = "SELECT * FROM encadrants WHERE email = ?";
    $stmt_encadrant = $conn->prepare($sql_encadrant);
    $stmt_encadrant->bind_param("s", $email);
    $stmt_encadrant->execute();
    $result_encadrant = $stmt_encadrant->get_result();

    if ($result_encadrant->num_rows === 1) {
        $encadrant = $result_encadrant->fetch_assoc();
        if (password_verify($password, $encadrant['password'])) {
            $_SESSION['user_role'] = 'encadrant';
            $_SESSION['user_id'] = $encadrant['id'];
            $_SESSION['nom'] = $encadrant['nom'];
            header("Location: MonEspace.php");
            exit();
        }
    }

    // Vérifier si c'est un stagiaire
    $sql_stagiaire = "SELECT * FROM stagiaires WHERE email = ?";
    $stmt_stagiaire = $conn->prepare($sql_stagiaire);
    $stmt_stagiaire->bind_param("s", $email);
    $stmt_stagiaire->execute();
    $result_stagiaire = $stmt_stagiaire->get_result();

    if ($result_stagiaire->num_rows === 1) {
        $user = $result_stagiaire->fetch_assoc();

        // Vérifier le mot de passe avec password_verify
        if (password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_role'] = 'stagiaire';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            header("Location: accueil.php");
            exit();
        } else {
            $_SESSION['error'] = "Mot de passe incorrect.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email introuvable.";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>
