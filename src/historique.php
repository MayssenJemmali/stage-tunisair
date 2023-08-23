<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 


$flight_data_query = "SELECT * 
                FROM flight 
                WHERE matricule = '{$_SESSION['user_matricule']}'
                ORDER BY id_flight DESC";

$flight_data = mysql_query($flight_data_query);

if ($flight_data === false) {
    echo "Error in query: " . mysql_error();
    die("Something went wrong!");
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

      <h1 class="ticket-history mb-3">Historique D'Achat Billet</h1>

      <?php if (mysql_num_rows($flight_data) == 0) {
        echo "<h3 class='m-2'>Pas d'achat de billet jusqu'à présent.</h3>";
      } else {?>
      <div class="table-responsive-xl">
        <table class="table table-bordered table-striped" id="payment-table">
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
                echo "<td>$direct_flight</td>";
                echo "<td>$trip_type</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
      <?php }?>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../javascript/historique.js"></script>
  </body>
</html>
