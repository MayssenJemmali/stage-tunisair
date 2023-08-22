<?php 
mysql_connect('localhost','root','') or die("Coudln't connect to server");
mysql_select_db('stage-tunisair') or die("Coudln't select Data base");

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $matricule = $_SESSION['user_matricule'];
  $nom = $_POST['name'];
  $email = $_POST['email'];
  $numero = $_POST['numero'];
  $sujet = $_POST['sujet'];
  $message = $_POST['message'];
  $uploadedFile = $_FILES['formFile'];
  $uploadDirectory = '../reclamationFile/'; // Specify your upload directory
  $fileName = basename($uploadedFile['name']);
  $targetPath = $uploadDirectory . $fileName;

  if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {

    $insert_query = "INSERT INTO reclamations (matricule, nom, email, numero, sujet, message_text, fichier_path)
                     VALUES ($matricule, '$nom', '$email', '$numero', '$sujet', '$message', '$targetPath')";
    mysql_query($insert_query);

    if (mysql_affected_rows() > 0) {
      $_SESSION['enoyer_success'] = true;
/*       $error_message = false; 
 */    } else {
      echo "Error ". mysql_error();
    }

} else {
  echo "<script>alert('Something went wrong!')</script>";
}
 
  
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
    <link rel="stylesheet" href="../css/reclamation.css" />
    <link rel="stylesheet" href="../css/cotisation.css" />
    <link rel="stylesheet" href="../css/historique.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&family=Roboto:wght@100;300;400&family=Rubik:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="../img/icon.png" />

    <title>Réclamation</title>
  </head>
  <body>
    <div class="container">
      <a href="../index.php" class="back-button">
        <div class="button-content">
          <img src="../img/arrow.png" alt="Arrow" class="return-arrow" />
          <span>Retour </span>
        </div>
      </a>
      <h1 class="text-center my-4">Réclamation Form</h1>
      <form
        action=""
        method="post"
        class="form"
        id="form"
        enctype="multipart/form-data"
        onsubmit="return validateReclamationForm()"
      >
        <div class="payment-form">
          <div class="form-group">
            <label for="name">Nom et Prénom:</label>
            <input type="text" class="form-control" id="name"  name="name"/>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email"/>
          </div>
          <div class="form-group">
            <label for="numero">Numéro:</label>
            <input type="text" class="form-control" id="numero" maxlength="8" name="numero" />
          </div>
          <div class="form-group">
            <label for="sujet">Sujet:</label>
            <input type="text" class="form-control" id="sujet" name="sujet" />
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea
              class="form-control"
              id="message"
              name="message"
              rows="4"
              
            ></textarea>
          </div>
          <div class="form-group">
            <label for="file"
                >Télécharger un fichier ou une photo (optionnel) :</label
              >
            <div class="mb-3">
              <input class="form-control mt-2" type="file" id="formFile" name="formFile" value="" accept=".pdf, .png, .jpeg, .jpg">
            </div>
            <p class="fs-6"><span class="ms-2 fw-bold">Note:</span> types de fichiers acceptés: .pdf, .png, .jpeg, .jpg</p>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
        </div>
      </form> 
    </div>
    <div class="popup" id="popup">
        <div class="popup-content">
            <p>Enoyer avec succès.</p>
            <button id="closePopup">Fermer</button>
        </div>
    </div>
    <script>
    // Pop up success message on update
    document.addEventListener("DOMContentLoaded", function () {
        <?php if(isset($_SESSION['enoyer_success']) && $_SESSION['enoyer_success']) { ?>
            const popup = document.getElementById("popup");
            const closePopup = document.getElementById("closePopup");

            popup.style.display = "flex";

            closePopup.addEventListener("click", function () {
                popup.style.display = "none";
            });

            <?php unset($_SESSION['enoyer_success']); ?> // Clear the session flag after using it
        <?php } ?>
    });
  </script>
    <script src="../javascript/reclamation.js"></script>
  </body>
</html>
