<?php
require 'connection.php';
session_start();

$encadrants = $conn->query("SELECT * FROM encadrants ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encadrants - EPG</title>
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

    .role-badge {
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .role-admin {
      background-color: #2ecc71;
      color: white;
    }

    .role-encadrant {
      background-color: #3498db;
      color: white;
    }

    .role-superviseur {
      background-color: #9b59b6;
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

  <div class="container">
    <h2>Liste des Encadrants</h2>

    <!-- Statistiques -->
    <div class="stats-container">
      <div class="stat-card">
        <i class="fas fa-users"></i>
        <h3>Total Encadrants</h3>
        <p><?php echo $encadrants->num_rows; ?></p>
      </div>
      <div class="stat-card">
        <i class="fas fa-user-tie"></i>
        <h3>Départements</h3>
        <p><?php 
          $departements = array();
          $encadrants->data_seek(0);
          while($row = $encadrants->fetch_assoc()) {
            if(!in_array($row['departement'], $departements)) {
              $departements[] = $row['departement'];
            }
          }
          echo count($departements);
        ?></p>
      </div>
      <div class="stat-card">
        <i class="fas fa-user-shield"></i>
        <h3>Rôles</h3>
        <p><?php 
          $roles = array();
          $encadrants->data_seek(0);
          while($row = $encadrants->fetch_assoc()) {
            if(!in_array($row['role'], $roles)) {
              $roles[] = $row['role'];
            }
          }
          echo count($roles);
        ?></p>
      </div>
    </div>

    <!-- Barre de recherche et filtres -->
    <div class="search-container">
      <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Rechercher un encadrant par nom, prénom, email, département...">
      </div>
      <div class="filter-group">
        <select class="filter-select" id="departementFilter">
          <option value="">Tous les départements</option>
          <?php
            $departements = array();
            $encadrants->data_seek(0);
            while($row = $encadrants->fetch_assoc()) {
              if(!in_array($row['departement'], $departements)) {
                $departements[] = $row['departement'];
                echo "<option value='" . htmlspecialchars($row['departement']) . "'>" . htmlspecialchars($row['departement']) . "</option>";
              }
            }
          ?>
        </select>
        <select class="filter-select" id="roleFilter">
          <option value="">Tous les rôles</option>
          <?php
            $roles = array();
            $encadrants->data_seek(0);
            while($row = $encadrants->fetch_assoc()) {
              if(!in_array($row['role'], $roles)) {
                $roles[] = $row['role'];
                echo "<option value='" . htmlspecialchars($row['role']) . "'>" . htmlspecialchars($row['role']) . "</option>";
              }
            }
          ?>
        </select>
      </div>
    </div>

    <?php if ($encadrants->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Poste</th>
            <th>Département</th>
            <th>Rôle</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $encadrants->data_seek(0);
          while($row = $encadrants->fetch_assoc()): 
            $roleClass = '';
            switch($row['role']) {
              case 'Administrateur':
                $roleClass = 'role-admin';
                break;
              case 'Encadrant':
                $roleClass = 'role-encadrant';
                break;
              case 'Superviseur':
                $roleClass = 'role-superviseur';
                break;
            }
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['nom']) ?></td>
              <td><?= htmlspecialchars($row['prenom']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['telephone']) ?></td>
              <td><?= htmlspecialchars($row['poste']) ?></td>
              <td><?= htmlspecialchars($row['departement']) ?></td>
              <td><span class="role-badge <?= $roleClass ?>"><?= htmlspecialchars($row['role']) ?></span></td>
              
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Aucun encadrant trouvé dans la base de données.</p>
    <?php endif; ?>
  </div>

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
  function viewEncadrant(id) {
    window.location.href = `view_encadrant.php?id=${id}`;
  }

  function editEncadrant(id) {
    window.location.href = `edit_encadrant.php?id=${id}`;
  }

  function deleteEncadrant(id) {
    if(confirm('Êtes-vous sûr de vouloir supprimer cet encadrant ?')) {
      window.location.href = `delete_encadrant.php?id=${id}`;
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
  document.getElementById('departementFilter').addEventListener('change', filterTable);
  document.getElementById('roleFilter').addEventListener('change', filterTable);

  function filterTable() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const departementValue = document.getElementById('departementFilter').value.toLowerCase();
    const roleValue = document.getElementById('roleFilter').value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const departement = row.cells[6].textContent.toLowerCase();
      const role = row.cells[7].textContent.toLowerCase();
      
      const searchMatch = text.includes(searchText);
      const departementMatch = !departementValue || departement === departementValue;
      const roleMatch = !roleValue || role === roleValue;
      
      const isVisible = searchMatch && departementMatch && roleMatch;
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
    document.getElementById('departementFilter').value = '';
    document.getElementById('roleFilter').value = '';
    filterTable();
  }
  </script>
</body>
</html>

<?php $conn->close(); ?>
