<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");
session_start(); 
$error_message = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $matricule = $_POST['matricule'];
  $payment_option = $_POST['payment-option'];
  $captcha_code = $_POST['captchaInput'];
  
  if(($_SESSION['captcha_word'] == $captcha_code) && ($matricule == $_SESSION['user_matricule'])) {
    /* Generating a Reference */
    $prefix = "TT";
    $availableDigits = "0123456789";
    $reference = $prefix;
    for ($i = 0; $i < 12; $i++) for ($i = 0; $i < 12; $i++) {
      $randomDigit = $availableDigits[rand(0, strlen($availableDigits) - 1)];
      $reference .= $randomDigit;
  }
    /* Getting the Date */
    $date = date('Y-m-d');

    $cotisation_query = "INSERT INTO cotisation (matricule, reference, date_paiment, montant, methode_de_Paiement, statut)
                        VALUES($matricule,'$reference','$date',$payment_option,'MasterCard','success')";

    mysql_query($cotisation_query);
      
    if (mysql_affected_rows() > 0) {
      $_SESSION['payment_success'] = true;
      $error_message = false;
    } else {
      echo "Error ". mysql_error();
    }

  } else {
    $error_message = true;
    echo mysql_error();
  }

}
 
unset($_SESSION['captcha_word']);
include '../php/GenerateCaptcha.php';

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
    <link rel="stylesheet" href="../css/historique.css" />
    <link rel="stylesheet" href="../css/cotisation.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="../img/icon.png" />

    <title>Cotisation</title>
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
      <h1 class="text-center my-4">Paiement de cotisation</h1>
      <form
        action="<?php echo $_SERVER['PHP_SELF']; ?>"
        method="post"
        class="form"
        id="form"
        onsubmit="return validateCotisationForm()"
      >
      <div class="payment-form">
        <?php if($error_message) { ?>
          <div class="error-message">
              Coordonnées incorrectes. Veuillez vérifier les informations saisies
              et réessayer.
          </div>
        <?php } ?>
        <div class="form-group">
          <label for="CIN">Matricule:</label>
          <input
            type="text"
            class="form-control"
            id="matricule"
            name="matricule"
            maxlength="5"
            required
          />
        </div>
        <div class="form-group">
          <label for="payment-option">Option De Paiement</label>
          <select class="form-control" id="payment-option" name="payment-option">
            <option value="" disabled selected>Choisir une option</option>
            <option value="30">Mensuel 30 DT</option>
            <option value="60">Trimestriel 60 DT</option>
            <option value="90">Semestriel 90 DT</option>
          </select>
        </div>
        <div class="form-group">
           <label for="captchaInput">Saisir le code: </label>
            <input type="text" class="form-control" id="captchaInput" name="captchaInput" required />
            <img src="captcha.png" alt="captcha image" class="captcha-image">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Payer</button>
        </form>
        <div class="payment">
          <img
            class="payment-card"
            src="../img/mastercard.png"
            alt="mastercard"
          />
          <img class="payment-card" src="../img/visa.png" alt="visa-card" />
          <img class="payment-card" src="../img/poste.png" alt="poste" />
        </div>
      </div>
    </div>
    <div class="popup" id="popup">
        <div class="popup-content">
            <p>Paiement avec succès.</p>
            <button id="closePopup">Fermer</button>
        </div>
    </div>
  </div>
  <script>
    // Pop up success message on update
    document.addEventListener("DOMContentLoaded", function () {
        <?php if(isset($_SESSION['payment_success']) && $_SESSION['payment_success']) { ?>
            const popup = document.getElementById("popup");
            const closePopup = document.getElementById("closePopup");

            popup.style.display = "flex";

            closePopup.addEventListener("click", function () {
                popup.style.display = "none";
            });

            <?php unset($_SESSION['payment_success']); ?> // Clear the session flag after using it
        <?php } ?>
    });
  </script>
  <script src="../javascript/cotisation.js"></script>
  </body>
</html>
