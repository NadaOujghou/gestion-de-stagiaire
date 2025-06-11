<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestionstagiare");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les informations du stagiaire
$id_stagiaire = 1; // ID fixe pour le test
$sql = "SELECT * FROM stagiaires WHERE id = $id_stagiaire";
$result = $conn->query($sql);
$stagiaire = $result->fetch_assoc();

// Messages de succès/erreur
$message = '';
$message_type = '';

if (isset($_GET['success'])) {
    $message = 'Vos informations ont été mises à jour avec succès.';
    $message_type = 'success';
} elseif (isset($_GET['error'])) {
    $message = 'Une erreur est survenue lors de la mise à jour.';
    $message_type = 'error';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Espace - EPG</title>
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

    header.hero {
      background: linear-gradient(135deg, #1a2940 0%, #2c3e50 100%);
      color: #fff;
      text-align: center;
      padding: 3rem 2rem;
    }

    .hero h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .card {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      flex: 1 1 45%;
    }

    .card h2 {
      color: #1a2940;
      margin-bottom: 1.5rem;
      font-size: 1.8rem;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #1a2940;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: #f39c12;
      box-shadow: 0 0 5px rgba(243, 156, 18, 0.3);
      outline: none;
    }

    button {
      margin-top: 20px;
      background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
      border: none;
      padding: 12px 25px;
      border-radius: 30px;
      color: #1a2940;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(243, 156, 18, 0.2);
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(243, 156, 18, 0.3);
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

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      
      .nav-links {
        display: none;
      }
    }

    .message {
      padding: 15px;
      margin: 20px auto;
      max-width: 1200px;
      border-radius: 8px;
      text-align: center;
      font-weight: 500;
    }
    
    .message.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .message.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>

<!-- Barre de navigation -->
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

<!-- En-tête de page -->
<header class="hero">
  <h1>Bienvenue, <?= htmlspecialchars($stagiaire['prenom']) ?> 👋</h1>
  <p>Modifiez vos informations et envoyez vos documents de stage.</p>
</header>

<?php if ($message): ?>
<div class="message <?= $message_type ?>">
  <?= htmlspecialchars($message) ?>
</div>
<?php endif; ?>

<!-- Contenu principal -->
<div class="container">
  <!-- Informations du profil -->
  <div class="card">
    <h2>📋 Votre profil</h2>
    <p><strong>Nom :</strong> <?= htmlspecialchars($stagiaire['nom']) ?> <?= htmlspecialchars($stagiaire['prenom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($stagiaire['email']) ?></p>
    <p><strong>Filière :</strong> <?= htmlspecialchars($stagiaire['filiere']) ?> (<?= htmlspecialchars($stagiaire['niveau']) ?>)</p>
    <p><strong>Stage :</strong> <?= htmlspecialchars($stagiaire['date_debut']) ?> → <?= htmlspecialchars($stagiaire['date_fin']) ?></p>
    <p><strong>Statut :</strong> <?= htmlspecialchars($stagiaire['statut']) ?></p>
  </div>

  <!-- Formulaire de mise à jour -->
  <div class="card">
    <h2>🛠️ Modifier & Ajouter des documents</h2>
    <form action="update_stagiaire.php" method="post" enctype="multipart/form-data">
      <label>Nom :</label>
      <input type="text" name="nom" value="<?= htmlspecialchars($stagiaire['nom']) ?>" required>

      <label>Prénom :</label>
      <input type="text" name="prenom" value="<?= htmlspecialchars($stagiaire['prenom']) ?>" required>

      <label>Email :</label>
      <input type="email" name="email" value="<?= htmlspecialchars($stagiaire['email']) ?>" required>

      <label>Téléphone :</label>
      <input type="tel" name="telephone" value="<?= htmlspecialchars($stagiaire['telephone']) ?>" required>

      <label>Adresse :</label>
      <input type="text" name="adresse" value="<?= htmlspecialchars($stagiaire['adresse']) ?>" required>

      <label>Date de naissance :</label>
      <input type="date" name="date_naissance" value="<?= htmlspecialchars($stagiaire['date_naissance']) ?>" required>

      <label>Filière :</label>
      <input type="text" name="filiere" value="<?= htmlspecialchars($stagiaire['filiere']) ?>" required>

      <label>Niveau :</label>
      <input type="text" name="niveau" value="<?= htmlspecialchars($stagiaire['niveau']) ?>" required>

      <label>Établissement :</label>
      <input type="text" name="etablissement" value="<?= htmlspecialchars($stagiaire['etablissement']) ?>" required>

      <label>Date de début :</label>
      <input type="date" name="date_debut" value="<?= htmlspecialchars($stagiaire['date_debut']) ?>" required>

      <label>Date de fin :</label>
      <input type="date" name="date_fin" value="<?= htmlspecialchars($stagiaire['date_fin']) ?>" required>

      <label>Sujet de stage :</label>
      <textarea name="sujet_stage" required><?= htmlspecialchars($stagiaire['sujet_stage']) ?></textarea>

      <label>Statut :</label>
      <input type="text" name="statut" value="<?= htmlspecialchars($stagiaire['statut']) ?>" disabled>

      <label>CV (PDF) :</label>
      <input type="file" name="cv" accept=".pdf">

      <label>Lettre de motivation :</label>
      <input type="file" name="lettre_motivation" accept=".pdf">

      <label>Demande de stage :</label>
      <input type="file" name="demande_stage" accept=".pdf">

      <label>Assurance :</label>
      <input type="file" name="assurance" accept=".pdf">

      <label>Convocation :</label>
      <input type="file" name="convocation" accept=".pdf">

      <label>Ajouter d'autres fichiers (optionnel) :</label>
      <input type="file" name="autres_fichiers[]" multiple>

      <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px;">
        <p style="margin: 0; color: #666;">
          <i class="fas fa-info-circle"></i> 
          Tous les documents seront automatiquement envoyés à l'entreprise.
        </p>
      </div>

      <button type="submit">📤 Envoyer</button>
    </form>
  </div>
</div>

<footer>
  <div class="footer-contact">
    <div>
      <p><strong>EMAIL:</strong> contact@epg.ma</p>
      <p><strong>WHATSAPP:</strong> (+212) 06 19 08 66 66</p>
      <p><strong>MOBILE:</strong> (+212) 06 60 77 73 82</p>
    </div>
    <div>
      <p><strong>FIXE:</strong> (+212) 05 35 62 18 65</p>
      <p><strong>ADRESSE:</strong></p>
      <p>À côté de la pharmacie Bahja, avenue Mhd 5,</p>
      <p>Au-dessus du café El Momouniya</p>
    </div>
  </div>
  <div class="copyright">
    <p>&copy; 2025 École Polytechnique des Génies - Tous droits réservés</p>
  </div>
</footer>

</body>
</html>
