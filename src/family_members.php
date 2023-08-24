<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 
$matricule = $_SESSION['user_matricule'];

$select_member_query = "SELECT * 
                        FROM family
                        WHERE matricule = $matricule";

$member_data = mysql_query($select_member_query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['relationship']) && isset($_POST['birthdate'])) {
        $nameArray = $_POST['name'];
        $relationshipArray = $_POST['relationship'];
        $birthdateArray = $_POST['birthdate'];

        $numberOfCards = count($nameArray);

        for ($i = 1; $i <= $numberOfCards; $i++) {
            $name = $nameArray[$i];
            $relationship = $relationshipArray[$i];
            $birthdate = $birthdateArray[$i];
            
            $member_query = "INSERT INTO family (matricule, nom, relation, date_naissance	, file_path)
                             VALUES($matricule,'$name', '$relationship', '$birthdate','emty')";

            mysql_query($member_query);
            
            if (mysql_affected_rows() > 0) {
            $_SESSION['payment_success'] = true;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
            } else {
            echo "Error ". mysql_error();
            }
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Piece Justificatives</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/historique.css" />
    <link rel="stylesheet" href="../css/family_members.css" />

  </head>
  <body>
    <div class="container">
        <a href="../index.php" class="back-button">
          <div class="button-content">
            <img src="../img/arrow.png" alt="Arrow" class="return-arrow" />
            <span>Retour </span>
          </div>
        </a>
      <h2 >Ajouter des Membres de la Famille</h2>

      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mb-4">
          <button class="btn btn-success btn-lg btn-add btn-add-family" type="button">
            Ajouter un Membre
          </button>
        </div>
      </div>
      <form
        action="<?php echo $_SERVER['PHP_SELF']; ?>"
        method="post"
        class="form"
        id="form"
      >
      <div class="row" id="family-members">
        <?php 
        while ($row = mysql_fetch_assoc($member_data)) {
            $name = $row['nom'];
            $relationship = $row['relation'];
            $birthdate = $row['date_naissance'];
            
            echo '<div class="col-lg-4 col-md-6 mb-4 card">
                    <div class="card-header">
                        <h5 class="card-title">' . $name . '</h5>
                        <button class="btn btn-remove-family" type="button">×</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="card-label" for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="' . $name . '">
                        </div>
                        <div class="form-group">
                            <label for="relationship">Relation</label>
                            <select class="form-select" id="relationship" name="relationship">
                                <option value="conjoint"' . ($relationship === "conjoint" ? " selected" : "") . '>Conjoint</option>
                                <option value="fils"' . ($relationship === "fils" ? " selected" : "") . '>Fils</option>
                                <option value="fille"' . ($relationship === "fille" ? " selected" : "") . '>Fille</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="card-label" for="date">Date de naissance</label>
                            <input type="date" class="form-control" id="date" name="birthdate" value="' . $birthdate . '">
                        </div>
                        <div class="form-group">
                            <label for="formFile_">Piéce justificative</label>
                            <input class="form-control" type="file" id="formFile_" name="formFile">
                        </div>
                    </div>
                </div>';
        

        }
        ?>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
    </form> 
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="../javascript/family_members.js"></script>
</html>
