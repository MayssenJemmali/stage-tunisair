<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 

$select_data_query = "SELECT * 
                      FROM cotisation 
                      WHERE matricule = '{$_SESSION['user_matricule']}'";

$flight_data_query = "SELECT * 
                FROM flight 
                WHERE matricule = '{$_SESSION['user_matricule']}'";

$select_data = mysql_query($select_data_query);
$flight_data = mysql_query($flight_data_query);

if ($select_data === false) {
    echo "Error in query: " . mysql_error();
} 
if ($flight_data === false) {
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
      <div>
        <a href="../index.php" class="back-button">
          <div class="button-content">
            <img src="../img/arrow.png" alt="Arrow" class="return-arrow" />
            <span>Retour </span>
          </div>
        </a>
      </div>

      <div class="button-container">
          <button id="payment-history" class="styled-button selected">Historique De Cotisation</button>
          <button id="ticket-history" class="styled-button">Historique D'Achat Billet</button>
      </div>

      <?php if (mysql_num_rows($select_data) == 0) {
        echo "<h3 class='m-2'>Pas de cotisation jusqu'à présent.</h3>";
      } else {?>
      <table class="table table-bordered table-striped" id="payment-table">
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

      <!-- Flgiht table -->
      <table class="table table-bordered table-striped" id="ticket-table" style="display: none">
        <thead>
          <tr>
            <th>
              ID
            </th>
            <th>Depart</th>
            <th>
              Arrivée
            </th>
            <th>
              Date depart
            </th>
            <th>Date arrivée</th>
            <th>Cabine</th>
            <th>Adultes</th>
            <th>Enfants</th>
            <th>Bébés</th>
            <th>Vol direct</th>
            <th>Type	</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while ($row = mysql_fetch_assoc($flight_data)) {
              $id_flight = $row['id_flight'];
              $departure = $row['departure'];
              $arrival = $row['arrival'];
              $departure_date = $row['departure_date'];
              $arrival_date = $row['arrival_date'];
              $cabin = $row['cabin'];
              $adult_nbr = $row['adult_nbr'];
              $children_nbr = $row['children_nbr'];
              $baby_nbr = $row['baby_nbr'];
              if ($row['direct_flight']) {
                $direct_flight = "Vol direct";
              } else {
                $direct_flight = "Vol non direct";
              }
              $trip_type = $row['trip_type'];
              
              
              // Display the cotisation information
              echo "<tr>";
              echo "<td>$id_flight</td>";
              echo "<td>$departure</td>";
              echo "<td>$arrival</td>";
              echo "<td>$departure_date</td>";
              echo "<td>$arrival_date</td>";
              echo "<td>$cabin</td>";
              echo "<td>$adult_nbr</td>";
              echo "<td>$children_nbr</td>";
              echo "<td>$baby_nbr</td>";
              echo "<td>$direct_flight</td>";
              echo "<td>$trip_type</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".styled-button");

        buttons.forEach((button) => {
            button.addEventListener("click", () => {
                buttons.forEach((btn) => {
                    btn.classList.remove("selected");
                    btn.style.backgroundColor = ""; // Reset background color
                    btn.style.color = ""; // Reset text color
                });
                button.classList.add("selected");
                button.style.backgroundColor = "red"; // Red shade
                button.style.color = "white";
            });
        });
    });

      const paymentHistoryBtn = document.getElementById("payment-history");
      const ticketHistoryBtn = document.getElementById("ticket-history");
      const paymentTable = document.getElementById("payment-table");
      const ticketTable = document.getElementById("ticket-table");

      paymentHistoryBtn.addEventListener("click", () => {
        paymentTable.style.display = "table";
        ticketTable.style.display = "none";
      });

      ticketHistoryBtn.addEventListener("click", () => {
        paymentTable.style.display = "none";
        ticketTable.style.display = "table";
      });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../javascript/historique.js"></script>
  </body>
</html>
