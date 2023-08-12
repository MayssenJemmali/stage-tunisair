<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");
$user_exist = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $matricule = $_POST['matricule'];
  $cin = $_POST['cin'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $numero = $_POST['numero'];
  $sexe = $_POST['sexe'];
  $password = $_POST['motdepasse'];

  $select_query = "select * from user where matricule = '$matricule'";
  $select_data = mysql_query($select_query);

  
  if(mysql_num_rows($select_data)!=0) {
    //header('Location: ' . $_SERVER['PHP_SELF']);
    $user_exist = true;
  } else {
    $insert_data = "INSERT INTO user VALUES($matricule,'$cin','$nom','$prenom','$email','$numero','$sexe','$password')";

    mysql_query($insert_data);
  
    if (mysql_affected_rows() > 0) {
      session_start();
      $_SESSION['user_session'] = true;
      $_SESSION['user_matricule'] = $matricule;
      $_SESSION['user_name'] = $prenom . ' ' . $nom;
      
      $user_exist = false;
      header('Location: ../index.php?success=true');
      exit();
  } else {
      $error_message = "Error: " . mysql_error();
  }
  }
  unset($_POST);
}

if (isset($_GET['success']) && $_GET['success'] === 'true') {
  $user_exist = false; // Reset user_exist variable
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
    <link rel="stylesheet" href="../css/historique.css" />
    <link rel="stylesheet" href="../css/login_signup.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="../img/icon.png" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Se connecter</title>
  </head>
  <body>
    <div class="container">
      <form
        action=""
        method="post"
        class="form"
        id="form"
        onsubmit="return validateSignUpForm()"
      >
      <div id="error-container">
        <?php if($user_exist) { ?>
        <div class="error-message">
          Cet utilisateur existe déjà. Essayez de vous <a href="./login.php">connecter.</a>
        </div>
        <?php } ?>
      </div>

        <h2>S'inscrire</h2>
        <div class="form-group">
          <label for="matricule">Matricule :</label>
          <input
            type="text"
            class="form-control"
            id="matricule"
            name="matricule"
            placeholder="00000"
            required
          />
        </div>
        <div class="form-group">
          <label for="cin">CIN :</label>
          <input
            type="text"
            class="form-control"
            id="cin"
            name="cin"
            required
          />
        </div>
        <div class="form-group">
          <label for="nom">Nom :</label>
          <input
            type="text"
            class="form-control"
            id="nom"
            name="nom"
            required
          />
        </div>
        <div class="form-group">
          <label for="prenom">Prénom :</label>
          <input
            type="text"
            class="form-control"
            id="prenom"
            name="prenom"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">E-mail :</label>
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            required
          />
        </div>
        <div class="form-group">
          <label for="numero">Numéro de téléphone :</label>
          <input
            type="tel"
            class="form-control"
            id="numero"
            name="numero"
            required
          />
        </div>
        <div class="form-group">
          <label for="sexe">Genre :</label>
          <select
            class="form-control select-sexe"
            id="sexe"
            name="sexe"
            required
          >
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
          </select>
        </div>
        <div class="form-group">
          <label for="motdepasse">Mot de passe :</label>
          <input
            type="password"
            class="form-control"
            id="motdepasse"
            name="motdepasse"
            required
          />
        </div>
        <div class="form-group">
          <label for="verifmotdepasse">Vérification du mot de passe :</label>
          <input
            type="password"
            class="form-control"
            id="verifmotdepasse"
            name="verifmotdepasse"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary btn-block">
          S'inscrire
        </button>
        <p>Vous avez un compte? <a href="./login.php">Se connecter</a></p>
      </form>
    </div>
    <script src="../javascript/login_signup.js"></script>
  </body>
</html>
