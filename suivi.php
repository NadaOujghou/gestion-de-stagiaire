<?php
require 'connection.php';

$stagiaire_id = 1;
$message = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $fichier_nom = "";

    if (!empty($_FILES["fichier"]["name"])) {
        $fichier_nom = basename($_FILES["fichier"]["name"]);
        $chemin = "uploads/" . $fichier_nom;
        move_uploaded_file($_FILES["fichier"]["tmp_name"], $chemin);
    }

    $stmt = $conn->prepare("INSERT INTO avancements (stagiaire_id, titre, description, fichier) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $stagiaire_id, $titre, $description, $fichier_nom);

    if ($stmt->execute()) {
        $message = "Avancement ajouté avec succès.";
    } else {
        $message = "Erreur lors de l'ajout.";
    }
}

// Récupération des avancements du stagiaire
$avancements = $conn->query("
  SELECT a.*, s.nom, s.prenom 
  FROM avancements a 
  JOIN stagiaires s ON a.stagiaire_id = s.id 
  WHERE a.stagiaire_id = $stagiaire_id 
  ORDER BY a.created_at DESC
");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Historique des Avancements</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { 
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f4f8;
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
      padding: 0 20px;
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

    .container-historique { 
      max-width: 1000px; 
      margin: 40px auto; 
    }
    
    .historique-box { 
      background: #fff; 
      padding: 20px; 
      margin-bottom: 20px; 
      border-left: 5px solid #0d6efd; 
      border-radius: 8px; 
    }
    
    .form-box { 
      background: #fff; 
      padding: 20px; 
      border-radius: 8px; 
      box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
    }
  </style>
</head>
<body>

<!-- HEADER -->
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

<!-- FORMULAIRE -->
<div class="container-historique">
  <h3 class="mb-4 text-center">Ajouter un nouvel avancement</h3>

  <?php if (!empty($message)): ?>
    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <div class="form-box mb-5">
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="fichier" class="form-label">Fichier (optionnel)</label>
        <input type="file" name="fichier" id="fichier" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
  </div>

  <h3 class="mb-4 text-center">Historique des Avancements</h3>

  <?php if ($avancements->num_rows > 0): ?>
    <?php while ($row = $avancements->fetch_assoc()): ?>
      <div class="historique-box">
        <h5><?= htmlspecialchars($row['titre']) ?></h5>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
        <?php if ($row['fichier']): ?>
          <p><a href="uploads/<?= htmlspecialchars($row['fichier']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Voir le fichier joint</a></p>
        <?php endif; ?>
        <p class="text-muted">
          Posté par <?= htmlspecialchars($row['nom'] . ' ' . $row['prenom']) ?> le 
          <?= date("d/m/Y à H:i", strtotime($row['created_at'])) ?>
        </p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-center text-muted">Aucun avancement trouvé pour ce stagiaire.</p>
  <?php endif; ?>
</div>

<!-- FOOTER -->
<footer style="background:#1a2940;color:white;text-align:center;padding:2rem 1rem;">
  <p><strong>EMAIL:</strong> contact@epg.ma</p>
  <p><strong>WHATSAPP:</strong> (+212) 06 19 08 66 66</p>
  <p><strong>MOBILE:</strong> (+212) 06 60 77 73 82</p>
  <p><strong>FIXE:</strong> (+212) 05 35 62 18 65</p>
  <p><strong>ADRESSE:</strong> À côté de la pharmacie Bahja, avenue Mhd 5, au-dessus du café El Momouniya</p>
  <p>&copy; 2025 École Polytechnique des Génies - Tous droits réservés</p>
</footer>

</body>
</html>

<?php $conn->close(); ?>
