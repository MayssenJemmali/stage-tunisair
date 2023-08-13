<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 

// Check if the session variable is not set
if (!isset($_SESSION['user_session'])) {
  header('Location: ./src/login.php'); 
  exit();
}

  $select_name_query = "SELECT nom, prenom FROM user WHERE matricule = '{$_SESSION['user_matricule']}'";
  $select_name = mysql_query($select_name_query);

  if ($select_name === false) {
      echo "Error in query: " . mysql_error();
  } else {
      $row = mysql_fetch_assoc($select_name);
      if ($row !== false) {
        
       } else {
          echo "User not found.";
      }
  }



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="css/loading_animation.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="./img/icon.png" />
    <title>Stage Tunisair</title>
  </head>
  <body>
    <div class="page-content">
      <header class="header">
        <div class="logo">
          <img src="./img/Tunisair-logo.png" alt="Logo" />
        </div>
        <div class="user-info">
          <a href="./php/logout.php" class="logout-link">
            <button class="logout-button">
              <img src="./img/logout.png" alt="Logout" class="logout-icon">
            </button>
          </a>
        </div>
      </header>
      <div class="card-container">
        <div class="card">
          <a href="./src/modification_de_profile.php" class="stretched-link"></a>
          <div class="card--content">
            <img
              class="card--icon"
              src="./img/profile.svg"
              alt="Modif Profile Icon"
            />
            <p class="card--title">Modification <br />De Profile</p>
          </div>
        </div>

        <div class="card">
          <a href="./src/achat_billet.html" class="stretched-link"></a>
          <div class="card--content">
            <img
              class="card--icon"
              id="card--icon--ticket"
              src="./img/plane-ticket.svg"
              alt="Historique Icon"
            />
            <p class="card--title">Achat Billet</p>
          </div>
        </div>

        <div class="card">
          <a href="./src/historique.html" class="stretched-link"></a>
          <div class="card--content">
            <img
              class="card--icon"
              src="./img/Historique.svg"
              alt="Historique Icon"
            />
            <p class="card--title">Historique <br />De Mouvement</p>
          </div>
        </div>

        <div class="card">
          <a href="./src/cotisation.html" class="stretched-link"></a>
          <div class="card--content">
            <img
              class="card--icon"
              id="card--icon--cotisation"
              src="./img/cotisation.svg"
              alt="Historique Icon"
            />
            <p class="card--title">Cotisation</p>
          </div>
        </div>

        <div class="card">
          <img
            class="card--icon"
            id="card--icon--doc"
            src="./img/doc.svg"
            alt="Historique Icon"
          />
          <p class="card--title">Pièces Justificatives</p>
        </div>
        <div class="card">
          <a href="./src/reclamation.html" class="stretched-link"></a>
          <div class="card--content">
            <img
              class="card--icon"
              id="card--icon--report"
              src="./img/report.svg"
              alt="Historique Icon"
            />
            <p class="card--title">Réclamation</p>
          </div>
        </div>
      </div>
    </div>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <div class="loading-animation">
      <lottie-player
        src="https://lottie.host/6540dd45-4ae7-4221-861f-fed786593b1e/Ge9BEihuIL.json"
        background="transparent"
        speed="1.2"
        style="width: 300px; height: 300px"
        loop
        autoplay
      ></lottie-player>
      <script src="./javascript/script.js"></script>
    </div>
  </body>
</html>
