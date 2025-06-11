<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Gestion des Stagiaires</title>
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

    .cards {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 6px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 23%;
      text-align: center;
    }

    .card h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 16px;
      color: #7f8c8d;
    }

    .card .number {
      font-size: 32px;
      color:#f39c12;
      font-weight: bold;
    }

    .notifications {
      background: white;
      padding: 20px;
      border-radius: 6px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .notifications h3 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .notification-item {
      background: #ecf0f1;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 4px;
    }

    .notification-item p {
      margin: 0;
    }

    .action-buttons {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }

    .action-buttons button {
      padding: 10px 15px;
      font-size: 14px;
      background: #3498db;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }

    .action-buttons button:hover {
      background: #2980b9;
    }

    @media (max-width: 768px) {
      .cards {
        flex-direction: column;
        gap: 10px;
      }

      .card {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>Tableau de bord - Stagiaires</h1>
  <div>Admin • <a href="#" style="color: #ecf0f1;">Déconnexion</a></div>
</header>

<nav>
  <a href="acceuilAdmin.php">🏠 Accueil</a>
  <a href="pageAdmin.php">👨‍🎓 Stagiaires</a>
  <a href="encadrantsAdmin.php">🧑‍🏫 Encadrants</a>
  <a href="parametre.php">⚙️ Paramètres</a>
</nav>

<div class="container">
  <!-- Cartes récapitulatives -->
  <div class="cards">
    <div class="card">
      <h2>Total Stagiaires</h2>
      <p>Nombre total de stagiaires</p>
      <div class="number" id="total-stagiaires">5</div>
    </div>
    <div class="card">
      <h2>Stagiaires en cours</h2>
      <p>Nombre de stagiaires en cours</p>
      <div class="number" id="stagiaires-en-cours">3</div>
    </div>
    <div class="card">
      <h2>Stagiaires terminés</h2>
      <p>Nombre de stagiaires ayant terminé leur stage</p>
      <div class="number" id="stagiaires-termines">2</div>
    </div>
    <div class="card">
      <h2>Encadrants</h2>
      <p>Nombre d'encadrants</p>
      <div class="number" id="total-encadrants">5</div>
    </div>
  </div>

  <!-- Notifications récentes -->
  <div class="notifications">
    <h3>Notifications récentes</h3>
    <div class="notification-item">
      <p><strong>Nada Oujghou</strong> a terminé son stage de PFE.</p>
    </div>
    <div class="notification-item">
      <p><strong>Hanan Oudirro</strong> a un stage en cours jusqu'au 12/06/2025.</p>
    </div>
    <div class="notification-item">
      <p><strong>Khadija</strong> a commencé son stage de PFE le 02/04/2025.</p>
    </div>
  </div>
  <div class="action-buttons">
    <button><a href="pageAdmin.php" style="color: white; text-decoration: none;">Voir les Stagiaires</a></button>
    <button><a href="encadrantsAdmin.php" style="color: white; text-decoration: none;">Voir les Encadrants</a></button>
    <button><a href="parametre.php" style="color: white; text-decoration: none;">Voir les Paramètres</a></button>
  </div>
</div>

</body>
</html>