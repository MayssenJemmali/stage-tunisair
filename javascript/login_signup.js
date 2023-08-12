// Changing the eye icon and showing password
const passwordInput = document.getElementById("password");
const eyeIcon = document.getElementById("eye-icon-img");

eyeIcon.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.src = "../img/eye.svg"; // Regular eye SVG image
    eyeIcon.alt = "eye";
  } else {
    passwordInput.type = "password";
    eyeIcon.src = "../img/eye-slash.svg"; // Slash eye SVG image
    eyeIcon.alt = "slash-eye";
  }
});

// Verification de log in form
function validateLogInForm() {
  const matriculeInput = document.getElementById("Matricule");
  const passwordInput = document.getElementById("password");
  const parentDiv = document.getElementById("form-floating-add-is-invalid");
  const parentDivPw = document.getElementById(
    "form-floating-add-is-invalid-pw"
  );
  const eyeIconDiv = document.getElementById("eye-icon-id");

  console.log("Matricule:", matriculeInput.value);
  console.log("Password:", passwordInput.value);

  // Matricule validation (5-digit number)
  const matriculePattern = /^\d{5}$/;
  if (!matriculePattern.test(matriculeInput.value)) {
    parentDiv.classList.add("is-invalid");
    matriculeInput.classList.add("is-invalid");
  } else {
    parentDiv.classList.remove("is-invalid");
    matriculeInput.classList.remove("is-invalid");
  }

  // Password validation (not empty)
  if (passwordInput.value === "") {
    passwordInput.classList.add("is-invalid");
    parentDivPw.classList.add("is-invalid");
    eyeIconDiv.classList.add("me-3");
  } else {
    passwordInput.classList.remove("is-invalid");
    parentDivPw.classList.remove("is-invalid");
    eyeIconDiv.classList.remove("me-3");
  }

  if (
    !matriculePattern.test(matriculeInput.value) ||
    passwordInput.value === ""
  ) {
    return false;
  }

  return true; // Form is valid, allow submission
}

// Verification for Sign up form
function validateSignUpForm() {
  var matricule = document.getElementById("matricule").value;
  var cin = document.getElementById("cin").value;
  var nom = document.getElementById("nom").value;
  var prenom = document.getElementById("prenom").value;
  var genre = document.getElementById("sexe").value;
  var motdepasse = document.getElementById("motdepasse").value;
  var verifmotdepasse = document.getElementById("verifmotdepasse").value;

  // Vérification du matricule (5 chiffres)
  if (!/^\d{5}$/.test(matricule)) {
    alert("Le matricule doit contenir 5 chiffres.");
    return false;
  }

  // Vérification du CIN (8 chiffres)
  if (!/^\d{8}$/.test(cin)) {
    alert("Le CIN doit contenir 8 chiffres.");
    return false;
  }

  // Vérification du genre (sélectionné)
  if (genre === "") {
    alert("Veuillez sélectionner un genre.");
    return false;
  }

  // Vérification du mot de passe
  if (motdepasse !== verifmotdepasse) {
    alert("Les mots de passe ne correspondent pas.");
    return false;
  }

  return true;
}
