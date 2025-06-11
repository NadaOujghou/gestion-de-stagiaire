<?php
require 'connection.php';
session_start();

// Requête pour récupérer les stagiaires
$sql = "SELECT * FROM stagiaires ORDER BY date_ajout DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Stagiaires - EPG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f7fa;
      color: #2c3e50;
    }

    nav {
      background: linear-gradient(135deg, #1a2940 0%, #2c3e50 100%);
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0;
      height: 80px;
      padding: 0 0 0 0;
    }

    .logo {
      height: 100%;
      width: auto;
      object-fit: contain;
      display: block;
    }

    .nav-links {
      display: flex;
      gap: 30px;
    }

    .nav-links a {
      color: #f8f9fa;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.1rem;
      transition: color 0.3s;
    }

    .nav-links a:hover {
      color: #f39c12;
    }

    .container {
      max-width: 95%;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: white;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
    }

    .stat-card i {
      font-size: 2rem;
      color: #1a2940;
      margin-bottom: 0.5rem;
    }

    .stat-card h3 {
      margin: 0.5rem 0;
      color: #2c3e50;
    }

    .stat-card p {
      font-size: 1.5rem;
      font-weight: bold;
      color: #f39c12;
      margin: 0;
    }

    .search-container {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .search-box {
      flex: 2;
      min-width: 300px;
      max-width: 500px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 1rem 1rem 1rem 3rem;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .search-box input:focus {
      border-color: #3498db;
      box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
      outline: none;
    }

    .search-box i {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      font-size: 1.2rem;
    }

    .filter-select {
      padding: 1rem;
      border: 2px solid #ddd;
      border-radius: 8px;
      min-width: 200px;
      font-size: 1rem;
      background-color: white;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-select:focus {
      border-color: #3498db;
      box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
      outline: none;
    }

    .filter-group {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .action-buttons {
      display: flex;
      gap: 0.5rem;
    }

    .btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.9rem;
      transition: background-color 0.3s;
    }

    .btn-view {
      background-color: #3498db;
      color: white;
    }

    .btn-edit {
      background-color: #f39c12;
      color: white;
    }

    .btn-delete {
      background-color: #e74c3c;
      color: white;
    }

    .btn:hover {
      opacity: 0.9;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-size: 0.9rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
    }

    thead {
      background-color: #1a2940;
      color: white;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    tbody tr:hover {
      background-color: #f5f6fa;
    }

    .status-badge {
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .status-active {
      background-color: #2ecc71;
      color: white;
    }

    .status-pending {
      background-color: #f1c40f;
      color: white;
    }

    .status-completed {
      background-color: #95a5a6;
      color: white;
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #1a2940;
    }

    footer {
      background: #1a2940;
      color: white;
      text-align: center;
      padding: 2rem 1rem;
      margin-top: 3rem;
    }

    footer p {
      margin: 0.5rem 0;
      line-height: 1.6;
    }

    .footer-contact {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 2rem;
      margin-bottom: 1.5rem;
    }

    .footer-contact div {
      text-align: left;
    }

    .copyright {
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body>

<!-- Header (identique à accueil.php) -->
<nav>
  <div class="nav-container">
    <img src="img/epg.jpg" alt="Logo EPG" class="logo">
    <div class="nav-links">
      <a href="accueil.php">Accueil</a>
      <a href="stagiaires.php">Stagiaires</a>
      <a href="encadrants.php">Encadrants</a>
      <a href="suivi.php">Suivi des Projets</a>
      <a href="MonEspace.php">Mon espace</a>
      <a href="deconnexion.php">Déconnexion</a>
    </div>
  </div>
</nav>

<!-- Contenu -->
<div class="container">
  <h2>Liste des Stagiaires</h2>

  <!-- Statistiques -->
  <div class="stats-container">
    <div class="stat-card">
      <i class="fas fa-users"></i>
      <h3>Total Stagiaires</h3>
      <p><?php echo $result->num_rows; ?></p>
    </div>
    <div class="stat-card">
      <i class="fas fa-user-check"></i>
      <h3>Stagiaires Actifs</h3>
      <p><?php 
        $active_count = 0;
        $result->data_seek(0);
        while($row = $result->fetch_assoc()) {
          if(strtolower(trim($row['statut'])) === 'actif') {
            $active_count++;
          }
        }
        echo $active_count;
      ?></p>
    </div>
    <div class="stat-card">
      <i class="fas fa-graduation-cap"></i>
      <h3>Filières</h3>
      <p><?php 
        $filiere_count = 0;
        $filieres = array();
        $result->data_seek(0);
        while($row = $result->fetch_assoc()) {
          if(!in_array($row['filiere'], $filieres)) {
            $filieres[] = $row['filiere'];
            $filiere_count++;
          }
        }
        echo $filiere_count;
      ?></p>
    </div>
  </div>

  <!-- Barre de recherche et filtres -->
  <div class="search-container">
    <div class="search-box">
      <i class="fas fa-search"></i>
      <input type="text" id="searchInput" placeholder="Rechercher un stagiaire par nom, prénom, email, filière...">
    </div>
    <div class="filter-group">
      <select class="filter-select" id="filiereFilter">
        <option value="">Toutes les filières</option>
        <?php
          $filieres = array();
          $result->data_seek(0);
          while($row = $result->fetch_assoc()) {
            if(!in_array($row['filiere'], $filieres)) {
              $filieres[] = $row['filiere'];
              echo "<option value='" . htmlspecialchars($row['filiere']) . "'>" . htmlspecialchars($row['filiere']) . "</option>";
            }
          }
        ?>
      </select>
      <select class="filter-select" id="statutFilter">
        <option value="">Tous les statuts</option>
        <?php
          $statuts = array();
          $result->data_seek(0);
          while($row = $result->fetch_assoc()) {
            if(!in_array($row['statut'], $statuts)) {
              $statuts[] = $row['statut'];
              echo "<option value='" . htmlspecialchars($row['statut']) . "'>" . htmlspecialchars($row['statut']) . "</option>";
            }
          }
        ?>
      </select>
    </div>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Téléphone</th>
          <th>Filière</th>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Statut</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $result->data_seek(0);
        while ($stagiaire = $result->fetch_assoc()): 
          $statusClass = '';
          switch(strtolower(trim($stagiaire['statut']))) {
            case 'actif':
              $statusClass = 'status-active';
              break;
            case 'en attente':
              $statusClass = 'status-pending';
              break;
            case 'terminé':
              $statusClass = 'status-completed';
              break;
          }
        ?>
          <tr>
            <td><?= $stagiaire['id'] ?></td>
            <td><?= htmlspecialchars($stagiaire['nom']) ?></td>
            <td><?= htmlspecialchars($stagiaire['prenom']) ?></td>
            <td><?= htmlspecialchars($stagiaire['email']) ?></td>
            <td><?= htmlspecialchars($stagiaire['telephone']) ?></td>
            <td><?= htmlspecialchars($stagiaire['filiere']) ?></td>
            <td><?= $stagiaire['date_debut'] ?></td>
            <td><?= $stagiaire['date_fin'] ?></td>
            <td><span class="status-badge <?= $statusClass ?>"><?= $stagiaire['statut'] ?></span></td>
            
          
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Aucun stagiaire trouvé dans la base de données.</p>
  <?php endif; ?>
</div>

<!-- Footer (identique à accueil.php) -->
<footer>
  <div class="footer-contact">
    <div>
      <p><strong>EMAIL:</strong> contact@epg.ma</p>
      <p><strong>WHATSAPP:</strong> (+212) 06 19 08 66 66</p>
    </div>
    <div>
      <p><strong>MOBILE:</strong> (+212) 06 60 77 73 82</p>
      <p><strong>FIXE:</strong> (+212) 05 35 62 18 65</p>
    </div>
    <div>
      <p><strong>ADRESSE:</strong></p>
      <p>A côté de la pharmacie Bahja sur l'avenue Mhd 5,</p>
      <p>Au-dessus du café El Momouniya</p>
    </div>
  </div>
  <div class="copyright">
    <p>&copy; 2025 École Polytechnique des Génies - Tous droits réservés</p>
  </div>
</footer>

<script>
function viewStagiaire(id) {
  // Implémenter la fonction de visualisation
  window.location.href = `view_stagiaire.php?id=${id}`;
}

function editStagiaire(id) {
  // Implémenter la fonction de modification
  window.location.href = `edit_stagiaire.php?id=${id}`;
}

function deleteStagiaire(id) {
  if(confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire ?')) {
    // Implémenter la fonction de suppression
    window.location.href = `delete_stagiaire.php?id=${id}`;
  }
}

// Fonction de recherche améliorée
document.getElementById('searchInput').addEventListener('keyup', function() {
  const searchText = this.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  let visibleCount = 0;
  
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    const isVisible = text.includes(searchText);
    row.style.display = isVisible ? '' : 'none';
    if (isVisible) visibleCount++;
  });

  // Mettre à jour le message si aucun résultat
  const noResultsMessage = document.getElementById('noResultsMessage');
  if (visibleCount === 0 && searchText !== '') {
    if (!noResultsMessage) {
      const message = document.createElement('p');
      message.id = 'noResultsMessage';
      message.style.textAlign = 'center';
      message.style.padding = '1rem';
      message.style.color = '#666';
      message.textContent = 'Aucun résultat trouvé pour votre recherche.';
      document.querySelector('table').after(message);
    }
  } else if (noResultsMessage) {
    noResultsMessage.remove();
  }
});

// Filtres améliorés
document.getElementById('filiereFilter').addEventListener('change', filterTable);
document.getElementById('statutFilter').addEventListener('change', filterTable);

function filterTable() {
  const searchText = document.getElementById('searchInput').value.toLowerCase();
  const filiereValue = document.getElementById('filiereFilter').value.toLowerCase();
  const statutValue = document.getElementById('statutFilter').value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  let visibleCount = 0;
  
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    const filiere = row.cells[5].textContent.toLowerCase();
    const statut = row.cells[8].textContent.toLowerCase();
    
    const searchMatch = text.includes(searchText);
    const filiereMatch = !filiereValue || filiere === filiereValue;
    const statutMatch = !statutValue || statut === statutValue;
    
    const isVisible = searchMatch && filiereMatch && statutMatch;
    row.style.display = isVisible ? '' : 'none';
    if (isVisible) visibleCount++;
  });

  // Mettre à jour le message si aucun résultat
  const noResultsMessage = document.getElementById('noResultsMessage');
  if (visibleCount === 0) {
    if (!noResultsMessage) {
      const message = document.createElement('p');
      message.id = 'noResultsMessage';
      message.style.textAlign = 'center';
      message.style.padding = '1rem';
      message.style.color = '#666';
      message.textContent = 'Aucun résultat trouvé pour les filtres sélectionnés.';
      document.querySelector('table').after(message);
    }
  } else if (noResultsMessage) {
    noResultsMessage.remove();
  }
}

// Réinitialiser les filtres
function resetFilters() {
  document.getElementById('searchInput').value = '';
  document.getElementById('filiereFilter').value = '';
  document.getElementById('statutFilter').value = '';
  filterTable();
}
</script>

</body>
</html>

<?php $conn->close(); ?>
