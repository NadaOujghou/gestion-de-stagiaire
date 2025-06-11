<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paramètres - Gestion des Stagiaires</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f6f8;
    }

    header {
      background: #2c3e50;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      margin: 0;
      font-size: 22px;
    }

    nav {
      background: #34495e;
      padding: 10px;
      display: flex;
      gap: 15px;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 14px;
    }

    .container {
      padding: 20px;
    }

    .settings-section {
      background: white;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .settings-section h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .settings-section input, .settings-section select, .settings-section button {
      padding: 10px;
      margin: 10px 0;
      font-size: 14px;
      width: 100%;
      max-width: 400px;
    }

    button {
      background: #3498db;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background: #2980b9;
    }

    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>Paramètres - Gestion des Stagiaires</h1>
  <div>Admin • <a href="#" style="color: #ecf0f1;">Déconnexion</a></div>
</header>

<nav>
  <a href="acceuilAdmin.php">🏠 Accueil</a>
  <a href="pageAdmin.php">👨‍🎓 Stagiaires</a>
  <a href="encadrantsAdmin.php">🧑‍🏫 Encadrants</a>
  <a href="parametre.php">⚙️ Paramètres</a>
</nav>

<div class="container">
  <!-- Paramètres généraux -->
  <div class="settings-section">
    <h2>Paramètres Généraux</h2>
    <label for="app-name">Nom de l'application</label>
    <input type="text" id="app-name" value="Gestion des Stagiaires">
    
    <label for="logo">Logo de l'application</label>
    <input type="file" id="logo">

    <label for="language">Langue de l'application</label>
    <select id="language">
      <option>Français</option>
      <option>Anglais</option>
      <option>Arabe</option>
    </select>
    
    <button>Enregistrer les paramètres</button>
  </div>

  <!-- Gestion des utilisateurs -->
  <div class="settings-section">
    <h2>Gestion des Utilisateurs</h2>
    <label for="user-role">Choisir le rôle</label>
    <select id="user-role">
      <option>Administrateur</option>
      <option>Encadrant</option>
      <option>Stagiaire</option>
    </select>

    <button>Ajouter un utilisateur</button>
    <button>Modifier un utilisateur</button>
    <button>Supprimer un utilisateur</button>
  </div>

  <!-- Gestion des types de stages -->
  <div class="settings-section">
    <h2>Types de Stages</h2>
    <label for="stage-type">Type de stage</label>
    <select id="stage-type">
      <option>Stage d'observation</option>
      <option>Stage technique</option>
      <option>Stage de fin d'études</option>
    </select>

    <button>Ajouter un type</button>
    <button>Modifier un type</button>
    <button>Supprimer un type</button>
  </div>

  <!-- Réglages des notifications -->
  <div class="settings-section">
    <h2>Réglages des Notifications</h2>
    <label for="email-notifications">Notifications par email</label>
    <input type="checkbox" id="email-notifications" checked>
    
    <label for="sms-notifications">Notifications par SMS</label>
    <input type="checkbox" id="sms-notifications">

    <button>Enregistrer les notifications</button>
  </div>
</div>

</body>
</html>