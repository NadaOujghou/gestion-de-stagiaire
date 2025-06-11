<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Gestion des Stagiaires</title>
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

    .filters {
      margin-bottom: 20px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .filters input, .filters select {
      padding: 8px;
      font-size: 14px;
    }

    .total-stagiaires {
      background: #3498db;
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 16px;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 6px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #3498db;
      color: white;
    }

    tr:hover {
      background: #f1f1f1;
    }

    .status {
      padding: 5px 10px;
      border-radius: 4px;
      color: white;
      font-size: 12px;
    }

    .en-cours { background: #27ae60; }
    .termine { background: #95a5a6; }
    .attente { background: #f39c12; }

    .actions button {
      margin-right: 5px;
      padding: 6px 10px;
      font-size: 12px;
      cursor: pointer;
    }

    .actions button.view { background: #3498db; color: white; }
    .actions button.edit { background: #f39c12; color: white; }
    .actions button.delete { background: #e74c3c; color: white; }

    @media (max-width: 768px) {
      .filters {
        flex-direction: column;
      }

      th, td {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>Gestion des Stagiaires</h1>
  <div>Admin • <a href="#" style="color: #ecf0f1;">Déconnexion</a></div>
</header>

<nav>
  <a href="acceuilAdmin.php">🏠 Accueil</a>
  <a href="pageAdmin.php">👨‍🎓 Stagiaires</a>
  <a href="encadrantsAdmin.php">🧑‍🏫 Encadrants</a>
  <a href="parametre.php">⚙️ Paramètres</a>
</nav>

<div class="container">
  <div class="total-stagiaires">
    Nombre total des stagiaires : <span id="total-stagiaires">5</span>
  </div>

  <div class="filters">
    <input type="text" placeholder="Rechercher...">
    <select>
      <option>Tous les établissements</option>
      <option>BTS</option>
      <option>FST</option>
      <option>EST</option>
    </select>
    <select>
      <option>Tous les statuts</option>
      <option>En cours</option>
      <option>Terminé</option>
    </select>
    <select>
      <option>Toutes les filières</option>
      <option>MCW</option>
      <option>PME</option>
      <option>SI</option>
    </select>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Établissement</th>
        <th>Filière</th>
        <th>Sujet</th>
        <th>Dates</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Oujghou</td>
        <td>Nada</td>
        <td>BTS</td>
        <td>MCW</td>
        <td>PFE</td>
        <td>02/02 - 05/05</td>
        <td><span class="status termine">Terminé</span></td>
        <td class="actions">
          <button class="view">Voir</button>
          <button class="edit">Modifier</button>
          <button class="delete">Supprimer</button>
        </td>
      </tr>
      <tr>
        <td>Oudirro</td>
        <td>Hanan</td>
        <td>FST</td>
        <td>MCW</td>
        <td>PFE</td>
        <td>12/05 - 12/06</td>
        <td><span class="status en-cours">En cours</span></td>
        <td class="actions">
          <button class="view">Voir</button>
          <button class="edit">Modifier</button>
          <button class="delete">Supprimer</button>
        </td>
      </tr>
      <tr>
        <td>Wassim</td>
        <td>Waasim</td>
        <td>BTS</td>
        <td>PME</td>
        <td>Stage Technique</td>
        <td>23/02 - 28/05</td>
        <td><span class="status termine">Terminé</span></td>
        <td class="actions">
          <button class="view">Voir</button>
          <button class="edit">Modifier</button>
          <button class="delete">Supprimer</button>
        </td>
      </tr>
      <tr>
        <td>Khadija</td>
        <td>Khadija</td>
        <td>BTS</td>
        <td>SI</td>
        <td>PFE</td>
        <td>02/04 - 02/07</td>
        <td><span class="status en-cours">En cours</span></td>
        <td class="actions">
          <button class="view">Voir</button>
          <button class="edit">Modifier</button>
          <button class="delete">Supprimer</button>
        </td>
      </tr>
      <tr>
        <td>Tt</td>
        <td>Amine</td>
        <td>EST</td>
        <td>MCW</td>
        <td>PFE</td>
        <td>05/06 - 07/07</td>
        <td><span class="status en-cours">En cours</span></td>
        <td class="actions">
          <button class="view">Voir</button>
          <button class="edit">Modifier</button>
          <button class="delete">Supprimer</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>