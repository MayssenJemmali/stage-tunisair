<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 

$select_data_query = "SELECT * 
                      FROM cotisation 
                      WHERE matricule = '{$_SESSION['user_matricule']}'";

$select_data = mysql_query($select_data_query);

if ($select_data === false) {
    echo "Error in query: " . mysql_error();
} 


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../css/historique.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="../img/icon.png" />

    <title>Historique</title>
  </head>
  <body>
    <div class="container mt-5">
      <a href="../index.php" class="back-button">
        <div class="button-content">
          <img src="../img/arrow.png" alt="Arrow" class="return-arrow" />
          <span>Retour </span>
        </div>
      </a>

      <h1 class="title mb-4 fw-medium">Historique De Mouvement</h1>
      <?php if (mysql_num_rows($select_data) == 0) {
        echo "<h3 class='m-2'>Pas de cotisation jusqu'à présent.</h3>";
      } else {?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>
              ID Paiement
              <button class="sort-btn" id="sort-id">
                <img
                  src="../img/sort-arrow.png"
                  alt="Sort Arrow"
                  class="arrow-icon"
                />
              </button>
            </th>
            <th>Référence</th>
            <th>
              <span>Date</span>
              <button class="sort-btn" id="sort-date">
                <img
                  src="../img/sort-arrow.png"
                  alt="Sort Arrow"
                  class="arrow-icon"
                />
              </button>
            </th>
            <th>
              Montant (DT)
              <button class="sort-btn" id="sort-montant">
                <img
                  src="../img/sort-arrow.png"
                  alt="Sort Arrow"
                  class="arrow-icon"
                />
              </button>
            </th>
            <th>Méthode de Paiement</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while ($row = mysql_fetch_assoc($select_data)) {
              $id_paiment = $row['id_paiment'];
              $reference = $row['reference'];
              $date_paiment = $row['date_paiment'];
              $montant = $row['montant'];
              $methode_de_Paiement = $row['methode_de_Paiement'];
              $statut = $row['statut'];
              $badgeClass = '';
              if ($statut == 'success') {
                  $badgeClass = 'success';
              } elseif ($statut == 'rejetee') {
                  $badgeClass = 'danger';
              } elseif ($statut == 'attente') {
                  $badgeClass = 'info';
              }
              // Display the cotisation information
              echo "<tr>";
              echo "<td>$id_paiment</td>";
              echo "<td>$reference</td>";
              echo "<td>$date_paiment</td>";
              echo "<td>$montant</td>";
              echo "<td class='d-flex align-items-center'>
                      <img
                        src='../img/{$methode_de_Paiement}.png'
                        alt='MasterCard'
                        class='credit-card'
                      />
                      <span>$methode_de_Paiement</span>
                    </td>";
              echo "<td class='text-center'>
                       <span class='badge text-bg-{$badgeClass}'>$statut</span>
                       </td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
      <?php }?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../javascript/historique.js"></script>
  </body>
</html>
