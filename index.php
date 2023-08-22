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
          <button class="Btn">
            <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
            <div class="text">Se déconnecter</div>
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
          <a href="./src/achat_billet.php" class="stretched-link"></a>
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
          <a href="./src/historique.php" class="stretched-link"></a>
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
          <a href="./src/cotisation.php" class="stretched-link"></a>
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
          <a href="./src/reclamation.php" class="stretched-link"></a>
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
