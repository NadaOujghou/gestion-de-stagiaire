<?php
require 'connection.php';

// Traitement de l'ajout d'un encadrant
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_encadrant'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $departement = $_POST['departement'];
    $poste = $_POST['poste'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO encadrants (nom, prenom, email, telephone, departement, poste, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nom, $prenom, $email, $telephone, $departement, $poste, $password);
    
    if ($stmt->execute()) {
        $message = "Encadrant ajouté avec succès!";
    } else {
        $error = "Erreur lors de l'ajout de l'encadrant.";
    }
}

// Récupération des encadrants
$sql = "SELECT * FROM encadrants ORDER BY nom, prenom";
$result = $conn->query($sql);
$encadrants = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Encadrants</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .total-encadrants {
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

    .actions button {
      margin-right: 5px;
      padding: 6px 10px;
      font-size: 12px;
      cursor: pointer;
      border: none;
      color: white;
      border-radius: 4px;
    }

    .actions button.view { background: #3498db; }
    .actions button.edit { background: #f39c12; }
    .actions button.delete { background: #e74c3c; }

    .form-container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-container h3 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input, .form-group select {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .form-actions {
      text-align: right;
      margin-top: 20px;
    }

    .form-actions button {
      padding: 8px 15px;
      margin-left: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-actions .save {
      background-color: #2ecc71;
      color: white;
    }

    .form-actions .cancel {
      background-color: #95a5a6;
      color: white;
    }
  </style>
</head>
<body>

<header>
  <h1>Gestion des Encadrants</h1>
  <div>Admin • <a href="deconnexion.php" style="color: #ecf0f1;">Déconnexion</a></div>
</header>

<nav>
  <a href="acceuilAdmin.php">🏠 Accueil</a>
  <a href="pageAdmin.php">👨‍🎓 Stagiaires</a>
  <a href="encadrantsAdmin.php" style="background-color: #2980b9;">🧑‍🏫 Encadrants</a>
  <a href="parametre.php">⚙️ Paramètres</a>
</nav>

<div class="container">
  <?php if (isset($message)): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
  <?php endif; ?>
  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <!-- Formulaire d'ajout d'encadrant -->
  <div class="form-container">
    <h3>Ajouter un nouvel encadrant</h3>
    <form method="POST" action="">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="departement">Département</label>
            <select id="departement" name="departement" required>
              <option value="">Sélectionner un département</option>
              <option value="Informatique">Informatique</option>
              <option value="Infrastructure">Infrastructure</option>
              <option value="Analyse de données">Analyse de données</option>
              <option value="Ressources Humaines">Ressources Humaines</option>
              <option value="Développement">Développement</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="poste">Poste</label>
            <input type="text" id="poste" name="poste" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <button type="submit" name="add_encadrant" class="save">Ajouter l'encadrant</button>
      </div>
    </form>
  </div>

  <div class="total-encadrants">
    Nombre total des encadrants : <span id="total-encadrants"><?php echo count($encadrants); ?></span>
  </div>

  <div class="filters">
    <input type="text" placeholder="Rechercher..." id="search-input">
    <select id="departement-filter">
      <option value="">Tous les départements</option>
      <option value="Informatique">Informatique</option>
      <option value="Infrastructure">Infrastructure</option>
      <option value="Analyse de données">Analyse de données</option>
      <option value="Ressources Humaines">Ressources Humaines</option>
      <option value="Développement">Développement</option>
    </select>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Département</th>
        <th>Poste</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($encadrants as $encadrant): ?>
      <tr>
        <td><?php echo htmlspecialchars($encadrant['nom']); ?></td>
        <td><?php echo htmlspecialchars($encadrant['prenom']); ?></td>
        <td><?php echo htmlspecialchars($encadrant['email']); ?></td>
        <td><?php echo htmlspecialchars($encadrant['telephone']); ?></td>
        <td><?php echo htmlspecialchars($encadrant['departement']); ?></td>
        <td><?php echo htmlspecialchars($encadrant['poste']); ?></td>
        <td class="actions">
          <button class="view" onclick="viewEncadrant(<?php echo $encadrant['id']; ?>)">Voir</button>
          <button class="edit" onclick="editEncadrant(<?php echo $encadrant['id']; ?>)">Modifier</button>
          <button class="delete" onclick="confirmDelete(<?php echo $encadrant['id']; ?>)">Supprimer</button>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
function viewEncadrant(id) {
    // Implémenter la fonction de visualisation
    alert('Voir encadrant ' + id);
}

function editEncadrant(id) {
    // Implémenter la fonction de modification
    alert('Modifier encadrant ' + id);
}

function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet encadrant ?')) {
        // Implémenter la fonction de suppression
        alert('Supprimer encadrant ' + id);
    }
}

// Filtrage des encadrants
document.getElementById('search-input').addEventListener('input', function(e) {
    const searchText = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});

document.getElementById('departement-filter').addEventListener('change', function(e) {
    const departement = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const cellDepartement = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
        row.style.display = departement === '' || cellDepartement === departement ? '' : 'none';
    });
});
</script>

</body>
</html>    