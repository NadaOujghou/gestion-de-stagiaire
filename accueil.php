<?php
require 'connection.php';
// Récupération des données
$stages = $conn->query("SELECT * FROM stages");
$stats = $conn->query("SELECT * FROM statistiques");
$temoignages = $conn->query("SELECT * FROM temoignages");
$faqs = $conn->query("SELECT * FROM faq");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Gestion des Stagiaires EPG</title>
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

    .hero {
      background-image: url('img/web.jpg');
      background-size: 100% auto;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      padding: 5rem 2rem;
      text-align: center;
      min-height: 450px;
      color: #fff;
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

    .hero button {
      padding: 0.9rem 2rem;
      font-size: 1.1rem;
      background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
      color: #1a2940;
      border: none;
      cursor: pointer;
      border-radius: 30px;
      font-weight: 600;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(243, 156, 18, 0.2);
    }

    .hero button:hover {
      background: linear-gradient(135deg,rgb(120, 125, 133) 0%,rgb(126, 132, 137) 100%);
      color: #f39c12;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(26, 41, 64, 0.3);
    }

    .section {
      padding: 4rem 2rem;
      max-width: 1200px;
      margin: auto;
    }
    
    .stages h2,
    .about h2,
    .testimonials h2,
    .faq h2 {
      text-align: center;
      color: #1a2940;
      margin-bottom: 2rem;
    }

    .stage-cards,
    .testimonial-cards {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .stage-card,
    .testimonial-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(26, 41, 64, 0.05);
      padding: 2rem;
      width: 300px;
    }

    .stage-card i {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #f39c12;
    }

    .stat-item {
      flex: 1;
      min-width: 200px;
      text-align: center;
    }

    .stats {
      background: #1a2940;
      color: white;
    }

    .stats-container {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 2rem;
      padding: 4rem 2rem;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: bold;
      color: #f39c12;
    }

    .faq section {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(26, 41, 64, 0.05);
      padding: 2rem;
      margin: 2rem auto;
    }

    .faq h2 {
      color: #1a2940;
      text-align: center;
      margin-bottom: 2rem;
      font-size: 2rem;
    }

    .faq-item {
      margin-bottom: 1rem;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .faq-item:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .faq-question {
      background-color: #f8f9fa;
      padding: 1rem;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      color: #1a2940;
      transition: background-color 0.3s ease;
    }

    .faq-question:hover {
      background-color: #e9ecef;
    }

    .faq-question::after {
      content: '+';
      font-size: 1.5rem;
      color: #f39c12;
      transition: transform 0.3s ease;
    }

    .faq-item.active .faq-question::after {
      transform: rotate(45deg);
    }

    .faq-answer {
      padding: 0;
      max-height: 0;
      overflow: hidden;
      transition: all 0.3s ease;
      background-color: #fff;
    }

    .faq-item.active .faq-answer {
      padding: 1rem;
      max-height: 1000px;
    }

    .faq-answer p {
      margin: 0;
      color: #666;
      line-height: 1.6;
    }

    .quick-contact {
      background-color: #f8f9fa;
      padding: 4rem 2rem;
      text-align: center;
    }

    .quick-contact input,
    .quick-contact textarea {
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
      margin-bottom: 1rem;
    }

    .quick-contact button {
      background-color: #f39c12;
      color: white;
      padding: 1rem;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    footer {
      background: #1a2940;
      color: white;
      text-align: center;
      padding: 2rem 1rem;
    }

    .back-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #f39c12;
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .back-to-top.visible {
      opacity: 1;
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

  <section class="hero">
    <h1>Bienvenue <?php echo isset($_SESSION['nom']) ? htmlspecialchars($_SESSION['nom']) : ''; ?> sur la plateforme EPGS</h1>
    <p>Gestion centralisée des stagiaires</p>
    <button><a href="MonEspace.php">Accéder à votre espace</a></button>
  </section>

  <section class="about section">
    <h2>À propos de la plateforme EPG</h2>
    <div>
      <p>Cette plateforme exclusive permet une gestion complète du parcours des stagiaires de l'École Polytechnique des Génies...</p>
      <p>Notre système offre une solution intégrée pour faciliter le processus de stage.</p>
    </div>
  </section>

  <section class="stages section">
    <h2>Types de Stages Offerts</h2>
    <div class="stage-cards">
      <?php while($stage = $stages->fetch_assoc()): ?>
        <div class="stage-card">
          <i class="<?= htmlspecialchars($stage['icone']) ?>"></i>
          <h3><?= htmlspecialchars($stage['titre']) ?></h3>
          <p><?= htmlspecialchars($stage['description']) ?></p>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <section class="stats">
    <div class="stats-container">
      <?php while($stat = $stats->fetch_assoc()): ?>
        <div class="stat-item">
          <div class="stat-number"><?= htmlspecialchars($stat['valeur']) ?></div>
          <div><?= htmlspecialchars($stat['label']) ?></div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <section class="testimonials section">
    <h2>Témoignages</h2>
    <div class="testimonial-cards">
      <?php while($tem = $temoignages->fetch_assoc()): ?>
        <div class="testimonial-card">
          <div class="testimonial-text">"<?= htmlspecialchars($tem['texte']) ?>"</div>
          <div class="testimonial-author">- <?= htmlspecialchars($tem['auteur']) ?></div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <section class="faq section">
    <h2>Questions Fréquentes</h2>
    <?php while($faq = $faqs->fetch_assoc()): ?>
      <div class="faq-item">
        <div class="faq-question"><?= htmlspecialchars($faq['question']) ?></div>
        <div class="faq-answer">
          <p><?= htmlspecialchars($faq['reponse']) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </section>

  <section class="quick-contact">
    <h2>Contactez-nous</h2>
    <form>
      <input type="text" placeholder="Votre nom" required>
      <input type="email" placeholder="Votre email" required>
      <textarea rows="4" placeholder="Votre message" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
  </section>

  <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

  <footer>
    <p><strong>EMAIL:</strong> contact@epg.ma</p>
    <p><strong>WHATSAPP:</strong> (+212) 06 19 08 66 66</p>
    <p><strong>MOBILE:</strong> (+212) 06 60 77 73 82</p>
    <p><strong>FIXE:</strong> (+212) 05 35 62 18 65</p>
    <p><strong>ADRESSE:</strong> À côté de la pharmacie Bahja, avenue Mhd 5, au-dessus du café El Momouniya</p>
    <p>&copy; 2025 École Polytechnique des Génies - Tous droits réservés</p>
  </footer>

  <script>
    window.onscroll = function() {
      const btn = document.querySelector('.back-to-top');
      btn.classList.toggle('visible', window.scrollY > 20);
    };
    document.querySelector('.back-to-top').addEventListener('click', e => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // FAQ Accordion functionality
    document.querySelectorAll('.faq-question').forEach(question => {
      question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle('active');
      });
    });
  </script>
</body>
</html>

<?php $conn->close(); ?>
