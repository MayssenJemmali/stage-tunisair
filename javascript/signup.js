// Get references to the input elements
var matriculeInput = document.getElementById("matricule");
var cinInput = document.getElementById("cin");
var nomInput = document.getElementById("nom");
var prenomInput = document.getElementById("prenom");
var genreInput = document.getElementById("sexe");
var emailInput = document.getElementById("email");
var numeroInput = document.getElementById("numero");
var motdepasseInput = document.getElementById("motdepasse");
var verifmotdepasseInput = document.getElementById("verifmotdepasse");

// Add event listeners for the "blur" event on each input element
matriculeInput.addEventListener("input", validateMatricule);
cinInput.addEventListener("input", validateCIN);
nomInput.addEventListener("input", validateNom);
prenomInput.addEventListener("input", validatePrenom);
genreInput.addEventListener("input", validateGenre);
emailInput.addEventListener("input", validateEmail);
numeroInput.addEventListener("input", validateNumero);
verifmotdepasseInput.addEventListener("input", validatePasswords);

// Validation functions for each input
function validateMatricule() {
  var matricule = matriculeInput.value;
  if (!/^\d{5}$/.test(matricule)) {
    matriculeInput.classList.add("is-invalid");
  } else {
    matriculeInput.classList.remove("is-invalid");
  }
}

function validateCIN() {
  var cin = cinInput.value;
  if (!/^\d{8}$/.test(cin)) {
    cinInput.classList.add("is-invalid");
  } else {
    cinInput.classList.remove("is-invalid");
  }
}

function validateNom() {
  var nom = nomInput.value;
  if (nom === "") {
    nomInput.classList.add("is-invalid");
  } else {
    nomInput.classList.remove("is-invalid");
  }
}

function validatePrenom() {
  var prenom = prenomInput.value;
  if (prenom === "") {
    prenomInput.classList.add("is-invalid");
  } else {
    prenomInput.classList.remove("is-invalid");
  }
}

function validateGenre() {
  var genre = genreInput.value;
  if (genre === "") {
    genreInput.classList.add("is-invalid");
  } else {
    genreInput.classList.remove("is-invalid");
  }
}

function validateEmail() {
  var email = emailInput.value;
  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  if (!emailPattern.test(email)) {
    emailInput.classList.add("is-invalid");
  } else {
    emailInput.classList.remove("is-invalid");
  }
}

function validateNumero() {
  var numero = numeroInput.value;
  if (!/^\d{8}$/.test(numero)) {
    numeroInput.classList.add("is-invalid");
  } else {
    numeroInput.classList.remove("is-invalid");
  }
}

function validatePasswords() {
  var motdepasse = motdepasseInput.value;
  var verifmotdepasse = verifmotdepasseInput.value;
  if (motdepasse !== verifmotdepasse) {
    verifmotdepasseInput.classList.add("is-invalid");
  } else {
    verifmotdepasseInput.classList.remove("is-invalid");
  }
}

/* function validateRecaptcha() {
  var recaptchaCheckbox = document.querySelector(".g-recaptcha-checkbox");
  var isRecaptchaChecked = recaptchaCheckbox && recaptchaCheckbox.checked;

  var recaptchaTooltip = document.querySelector(".recaptcha-tooltip");
  if (!isRecaptchaChecked) {
    recaptchaTooltip.style.display = "block";
    recaptchaCheckbox.addEventListener("change", function () {
      recaptchaTooltip.style.display = "none";
    });
  } else {
    recaptchaTooltip.style.display = "none";
  }
} */

// Form submission handler
function validateSignUpForm() {
  // Call individual validation functions for each input
  validateMatricule();
  validateCIN();
  validateNom();
  validatePrenom();
  validateGenre();
  validateEmail();
  validateNumero();
  validatePasswords();

  // Check if any input has the "is-invalid" class
  var invalidInputs = document.querySelectorAll(".is-invalid");

  if (invalidInputs.length > 0) {
    return false;
  }

  return true;
}
