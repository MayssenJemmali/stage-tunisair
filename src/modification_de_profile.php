<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 

$select_data_query = "SELECT * FROM user WHERE matricule = '{$_SESSION['user_matricule']}'";
$select_data = mysql_query($select_data_query);

if ($select_data === false) {
    echo "Error in query: " . mysql_error();
} else {
    $row = mysql_fetch_assoc($select_data);
    if ($row == false) {
       echo "User not found.";
    }
}

/* To show only the last 4 digits of CIN */
$lastFourDigitsCIN = substr($row['CIN'], -3);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $numero = $_POST['numero'];
  $passwordNouveau = $_POST['passwordNouveau'];

  if (empty($passwordNouveau)){
    $update_query = " UPDATE user 
                    SET nom = '$nom' , prenom = '$prenom' , email = '$email' ,numero = '$numero'
                    WHERE matricule = '{$_SESSION['user_matricule']}'";
  } else {
    $update_query = " UPDATE user 
                    SET nom = '$nom' , prenom = '$prenom' , email = '$email' ,numero = '$numero', password ='$passwordNouveau'
                    WHERE matricule = '{$_SESSION['user_matricule']}'";

  }
  
if (mysql_query($update_query)) {
  $_SESSION['update_success'] = true;
  header("Location: ".$_SERVER['PHP_SELF']);
  exit();
} else {
  echo "Error updating user information: " . mysql_error();
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
    <link rel="stylesheet" href="../css/modification_de_profile.css" />
    <link rel="stylesheet" href="../css/historique.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="../img/icon.png" />

    <title>Modification de Profile</title>
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
        <div class="pb-3 h3 text-left">Modification de Profile</div>
      </div>
      <div class="popup" id="popup">
            <div class="popup-content">
                <p>Les informations ont été mises à jour avec succès.</p>
                <button id="closePopup">Fermer</button>
            </div>
        </div>
      <form 
        action=""
        method="post"
        class="form"
        id="flight-form" 
        onsubmit="return validateUpdateForm();">
        <div class="row">
          <div
            class="autocomplete-container form-group col-md align-items-start flex-column"
          >
            <div class="input-group-prepend d-flex">
              <label for="matricule" class="d-inline-flex">Matricule</label>
            </div>
            <div class="input-group">
              <input
                type="text"
                placeholder="<?php echo $row['matricule']; ?>"
                class="form-control fs-6"
                id="matricule"
                name="matricule"
                disabled
              />
            </div>
          </div>
          <div
            class="autocomplete-container form-group col-md align-items-start flex-column"
          >
            <div class="input-group-prepend d-flex">
              <label for="CIN" class="d-inline-flex">CIN</label>
            </div>
            <div class="input-group">
              <input
                type="text"
                placeholder="*****<?php echo $lastFourDigitsCIN; ?>"
                class="form-control fs-6"
                id="CIN"
                name="CIN"
                autocomplete="off"
                disabled
              />
              
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md align-items-start flex-column">
            <label for="nom" class="d-inline-flex nowrap"> Nom: </label>
            <div class="input-group">
              <input
                type="text"
                placeholder="Nom"
                class="form-control p-2 fs-6"
                id="nom"
                name="nom"
                value="<?php echo $row['nom']; ?>"
              />
            </div>
          </div>

          <div class="form-group col-md align-items-start flex-column">
            <label for="prenom" class="d-inline-flex nowrap"> Prénom: </label>
            <div class="input-group">
              <input
                type="text"
                placeholder="Prénom"
                class="form-control p-2 fs-6"
                id="prenom"
                name="prenom"
                value="<?php echo $row['prenom']; ?>"
              />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md align-items-start flex-column ">
            <label for="email" class="d-inline-flex nowrap"> E-mail: </label>
            <div class="input-group ">
              <input
                type="email"
                placeholder="email@yahoo.fr"
                class="form-control p-2"
                id="email"
                name="email"
                value="<?php echo $row['email']; ?>"
              />
            </div>
          </div>

          <div class="form-group col-md align-items-start flex-column">
            <label for="numero" class="d-inline-flex nowrap"> Numéro: </label>
            <div class="input-group">
              <input
                type="text"
                placeholder="Numéro"
                class="form-control p-2 fs-6"
                id="numero"
                name="numero"
                value="<?php echo $row['numero']; ?>"
              />
            </div>
          </div>
        </div>
        <div class="pb-1 pt-2 h3 text-left">Modification de mot de passe</div>

        <div class="row">
          <div class="form-group col-md align-items-start flex-column">
              <label for="passwordNouveau" class="d-inline-flex nowrap"> Nouveau mot de passe: </label>
                <div class="input-group">
                  <input
                    type="password"
                    placeholder=""
                    class="form-control p-2 fs-6"
                    id="passwordNouveau"
                    name="passwordNouveau"
                    value=""
                  />
                </div>
          </div>
          <div class="form-group col-md align-items-start flex-column">
              <label for="passwordConfirmer" class="d-inline-flex nowrap"> Confirmer mot de passe: </label>
                <div class="input-group">
                  <input
                    type="password"
                    placeholder=""
                    class="form-control p-2 fs-6"
                    id="passwordConfirmer"
                    name="passwordConfirmer"
                    value=""
                  />
                </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <button type="submit" class="btn btn-primary btn-block enregistrer-btn" disabled>
              Enregistrer
            </button>
          </div>
          <div class="col-md-3">
            <button type="reset" class="btn btn-primary btn-block" id="annuler-btn">
              Annuler
            </button>
          </div>
        </div>
      </form>
    </div>
</div>
  <script>
    // Pop up success message on update
    document.addEventListener("DOMContentLoaded", function () {
        <?php if(isset($_SESSION['update_success']) && $_SESSION['update_success']) { ?>
            const popup = document.getElementById("popup");
            const closePopup = document.getElementById("closePopup");

            popup.style.display = "flex";

            closePopup.addEventListener("click", function () {
                popup.style.display = "none";
            });

            <?php unset($_SESSION['update_success']); ?> // Clear the session flag after using it
        <?php } ?>
    });
  </script>
  <script src="../javascript/modification_de_profile.js"></script>
  </body>
</html>
