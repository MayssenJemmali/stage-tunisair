<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $matricule = $_SESSION['user_matricule'];
  $departure = $_POST['departureInput'];
  $arrival = $_POST['arrivalInput'];

  $date_range = $_POST['departure-date'];
  $date = explode(" to ", $date_range);

  $departure_date = $date[0];
  $arrival_date = $date[1];
  $cabin = $_POST['cabin'];
  $adult_nbr = $_POST['adults'];
  $children_nbr = $_POST['children'];
  $baby_nbr = $_POST['infants'];
  $direct_flight = $_POST['infants'];
  $baby_nbr = $_POST['infants'];
  if(isset($_POST['directFlights'])) {
      // Checkbox is checked
      $direct_flights = true;
  } else {
      // Checkbox is not checked
      $direct_flights = false;
  }
  $trip_type = $_POST['trip-type'];

  $flight_query = "INSERT INTO flight (departure, arrival, departure_date, arrival_date, cabin, adult_nbr, children_nbr, baby_nbr, direct_flight, trip_type, matricule)
                   VALUES('$departure', '$arrival', '$departure_date', '$arrival_date', '$cabin', $adult_nbr, $children_nbr, $baby_nbr, $direct_flight , '$trip_type',$matricule)";

  mysql_query($flight_query);
        
  if (mysql_affected_rows() > 0) {
    $_SESSION['flight_success'] = true;
    $error_message = false;
  } else {
    echo "Error ". mysql_error();
  }

}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/achat_billet.css" />
    <link rel="stylesheet" href="../css/historique.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />

    <link rel="icon" type="image/png" href="../img/icon.png" />

    <title>Achat Billet</title>
  </head>
  <body>
    <div class="page-container">
      <div class="container">
        <a href="../index.php" class="back-button">
          <div class="button-content">
            <img src="../img/arrow.png" alt="Arrow" class="return-arrow" />
            <span>Retour </span>
          </div>
        </a>
        <div class="row">
          <div class="pb-3 h3 text-left">Recherche De Vol</div>
        </div>
        <form 
          action="<?php echo $_SERVER['PHP_SELF']; ?>"
          method="post"
          id="flight-form" 
          onsubmit="return validateAchatBilletForm()"
          >
          <div class="row">
            <div
              class="autocomplete-container form-group col-md align-items-start flex-column"
            >
              <div class="input-group-prepend d-flex">
                <label for="depart" class="d-inline-flex">De</label>
                <span class="input-group-text p-1"
                  ><i class="fas fa-plane-departure mb-1"></i
                ></span>
              </div>
              <div class="input-group">
                <input
                  type="text"
                  placeholder="Ville ou aéroport"
                  class="form-control"
                  id="departureInput"
                  name="departureInput"
                  autocomplete="off"
                  required
                />
              </div>
              <ul id="departureAutocompleteList"></ul>
            </div>
            <div
              class="autocomplete-container form-group col-md align-items-start flex-column"
            >
              <div class="input-group-prepend d-flex">
                <label for="depart" class="d-inline-flex">À</label>
                <span class="input-group-text p-1"
                  ><i class="fas fa-plane-arrival mb-1"></i
                ></span>
              </div>
              <div class="input-group">
                <input
                  type="text"
                  placeholder="Ville ou aéroport"
                  class="form-control"
                  id="arrivalInput"
                  name="arrivalInput"
                  autocomplete="off"
                  required
                />
              </div>
              <ul id="arrivalAutocompleteList"></ul>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md align-items-start flex-column">
              <label for="departure-date" class="d-inline-flex nowrap">
                Date Départ / Retour
              </label>
              <div class="input-group">
                <input
                  type="date"
                  placeholder="Choisir une Date"
                  class="form-control"
                  id="departure-date"
                  name="departure-date"
                  onkeydown="return false"
                  required
                />
                <div class="input-group-append">
                  <button
                    class="btn btn-outline-secondary"
                    type="button"
                    id="calendar-button"
                  >
                    <i class="fas fa-calendar"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="form-group col-lg-6 align-items-start flex-column">
              <label for="cabin" class="d-inline-flex">Cabine</label>
              <select class="form-select" id="cabin" name="cabin">
                <option value="ECONOMY" selected>Classe économique</option>
                <option value="BUSINESS">Classe affaires</option>
                <option value="FIRST">Première classe</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-3 align-items-start flex-column">
              <label for="adults" class="d-inline-flex col-auto"
                >Adultes <span class="sublabel"> 12+ ans</span></label
              >
              <select class="form-select" id="adults" name="adults">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select>
            </div>
            <div class="form-group col-lg-3 align-items-start flex-column">
              <label for="children" class="d-inline-flex col-auto"
                >Enfant <span class="sublabel"> 2-11 ans </span></label
              >
              <select class="form-select" id="children" name="children">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
            <div class="form-group col-lg-3 align-items-start flex-column">
              <label for="infants" class="d-inline-flex col-auto"
                >Nourrissons <span class="sublabel"> -2 ans</span></label
              >
              <select class="form-select" id="infants" name="infants">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="1">2</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div
              class="form-group col-lg-6 align-items-start flex-column pt-lg-4"
            >
              <div class="form-check form-switch">
                <input
                  class="form-check-input align-self-center"
                  type="checkbox"
                  id="directFlights"
                  name="directFlights"
                  checked
                />
                <label
                  class="form-check-label d-inline-flex align-self-center"
                  for="directFlights"
                  >Vols directs
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div
              class="form-group col-lg-6 flex-row align-items-start justify-content-lg-start"
            >
              <label>
                <input type="radio" name="trip-type" value="Aller-retour" checked />
                Aller retour
              </label>
              <br />
              <label>
                <input type="radio" name="trip-type" value="Aller-simple" />
                Aller simple
              </label>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-primary btn-block">
              Recherche
            </button>
          </div>
        </form>
      </div>
      <div class="popup" id="popup">
          <div class="popup-content">
              <p>Achat avec succès.</p>
              <button id="closePopup">Fermer</button>
          </div>
      </div>
    </div>
    <script>
    // Pop up success message on update
    document.addEventListener("DOMContentLoaded", function () {
        <?php if(isset($_SESSION['flight_success']) && $_SESSION['flight_success']) { ?>
            const popup = document.getElementById("popup");
            const closePopup = document.getElementById("closePopup");

            popup.style.display = "flex";

            closePopup.addEventListener("click", function () {
                popup.style.display = "none";
            });

            <?php unset($_SESSION['flight_success']); ?> // Clear the session flag after using it
        <?php } ?>
    });
  </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="../javascript/achat_billet.js"></script>
  </body>
</html>
