<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");
$user_exist = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $matricule = $_POST['Matricule'];
  $password = $_POST['password'];

  $select_query = "select * from user where matricule = '$matricule' && password = '$password'";
  $select_data = mysql_query($select_query);

  
  if(mysql_num_rows($select_data)!=0) {
      session_start();
      $_SESSION['user_matricule'] = $matricule;
      $_SESSION['user_session'] = true;
      $user_exist = true;
      header('Location: ../index.php?success=true');
      exit();
  } else {
    $user_exist = false;
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="../img/icon.png" />
    <link rel="stylesheet" href="../css/login_signup.css" />

    <title>Se connecter</title>
  </head>
  <body>
    <div class="container">
      <form
        action=""
        method="post"
        class="form"
        onsubmit="return validateLogInForm();"
      >
        <h2>Se Connecter</h2>
        <div id="error-container">
          <?php if($user_exist == false) { ?>
          <div class="error-message">
            Coordonnées incorrectes. Veuillez vérifier les informations saisies
            et réessayer.
          </div>
          <?php } ?>
        </div>
        <div class="form-group input-group has-validation mb-3 mt-2">
          <div id="form-floating-add-is-invalid" class="form-floating">
            <input
              type="text"
              class="form-control mb-0 "
              id="Matricule"
              name="Matricule"
              placeholder="Matricule"
            />
            <label for="Matricule">Matricule</label>
          </div>
          <div class="invalid-feedback">Matricule Invalide.</div>
        </div>

        <div class="form-group input-group has-validation mb-3 mt-2">
          <div id="form-floating-add-is-invalid-pw" class="password-container form-floating">
            <input
              type="password"
              class="form-control mb-0"
              id="password"
              name="password"
              placeholder="Mot de passe"
            />
            <div id="eye-icon-id" class="eye-icon">
              <img
                src="../img/eye-slash.svg"
                alt="slash-eye"
                id="eye-icon-img"
              />
            </div>
            <label for="password">Mod de passe</label>

          </div>
          <div class="invalid-feedback">Saisir votre mot de passe.</div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
          Se connecter
        </button>

        <p>
          Vous n'avez pas encore de compte?
          <a href="./signup.php">S'inscrire</a>
        </p>
      </form>
    </div>
    <script src="../javascript/login_signup.js"></script>
  </body>
</html>
