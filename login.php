<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Register</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .error-message {
      color: #ff0000;
      font-size: 14px;
      margin-top: 5px;
      margin-bottom: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="insertinfo.php" method="POST">
          <h1>Registration</h1>
          <input type="text" placeholder="Nom" name="nom" required />
          <input type="text" placeholder="Prénom" name="prenom" required />
          <input type="email" placeholder="Email" name="email" required />
          <input type="text" placeholder="Téléphone" name="telephone" />
          <input type="text" placeholder="Adresse" name="adresse" />
        
          <label style="text-align: left; margin-top: 8px;">Date de naissance :</label>
          <input type="date" name="date_naissance" />
        
          <label style="text-align: left; margin-top: 8px;">Genre :</label>
          <select name="genre" style="padding: 12px; border-radius: 8px; background-color: #eee; border: none; margin-bottom: 8px; width: 100%;">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autre">Autre</option>
          </select>
        
          <input type="text" placeholder="Filière" name="filiere" />
          <input type="text" placeholder="Niveau" name="niveau" />
          <input type="text" placeholder="Établissement" name="etablissement" />
        
          <label style="text-align: left; margin-top: 8px;">Date début stage :</label>
          <input type="date" name="date_debut" />
        
          <label style="text-align: left; margin-top: 8px;">Date fin stage :</label>
          <input type="date" name="date_fin" />
        
          <input type="text" placeholder="Sujet de stage" name="sujet_stage" />
        
          <input type="password" placeholder="Mot de passe" name="password" required />
        
          <button type="submit" name="submit">Register</button>
        
          <p>Our social platforms</p>
          <div class="social-icons">
            <a href="https://epg.ma/"><img src="img/social.png" /></a>
            <a href="https://www.facebook.com/epg.ma/"><img src="img/facebook.png" /></a>
            <a href="https://www.instagram.com/epg.ma/"><img src="img/instagram.png" /></a>
          </div>
        </form>
        
    </div>
    <div class="form-container sign-in-container">
      <form action="traitementlogin.php" method="POST">
        <h1>Login</h1>
        <input type="email" placeholder="e-mail" name="email" required />
        <input type="password" placeholder="Password" name="password" required />
    
        <!-- Affichage d'erreur via SESSION -->
        <?php if (isset($_SESSION['error'])): ?>
          <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
    
        <a href="forgetPassword.php">Forgot your password?</a>
        <button type="submit" name="submit">Login</button>
        <p>Our social platforms</p>
        <div class="social-icons">
          <a href="https://epg.ma/"><img src="img/social.png"/></a>
          <a href="https://www.facebook.com/epg.ma/"><img src="img/facebook.png"/></a>
          <a href="https://www.instagram.com/epg.ma/"><img src="img/instagram.png"/></a>
        </div>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>Already have an account?</p>
          <button class="ghost" id="signIn">Login</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hello, Welcome!</h1>
          <p>Don't have an account?</p>
          <button class="ghost" id="signUp">Register</button>
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
