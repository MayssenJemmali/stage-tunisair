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
    if ($row !== false) {
        echo "Welcome, " . $row['prenom'] . ' ' . $row['nom'];
    } else {
        echo "User not found.";
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
      <form id="flight-form" onsubmit="return validateForm()">
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
                class="form-control"
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
                placeholder="<?php echo $row['CIN']; ?>"
                class="form-control"
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
                class="form-control"
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
                class="form-control"
                id="prenom"
                name="prenom"
                value="<?php echo $row['prenom']; ?>"
              />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md align-items-start flex-column">
            <label for="email" class="d-inline-flex nowrap"> E-mail: </label>
            <div class="input-group">
              <input
                type="email"
                placeholder="email@yahoo.fr"
                class="form-control"
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
                type="email"
                placeholder="Numéro"
                class="form-control"
                id="numero"
                name="numero"
                value="<?php echo $row['numero']; ?>"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-9">
            <button type="submit" class="btn btn-primary btn-block">
              Enregistrer
            </button>
          </div>
          <div class="col-md-3">
            <button type="reset" class="btn btn-primary btn-block">
              Annuler
            </button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
