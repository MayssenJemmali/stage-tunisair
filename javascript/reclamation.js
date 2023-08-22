var nomInput = document.getElementById("name");
var emailInput = document.getElementById("email");
var numeroInput = document.getElementById("numero");
var sujetInput = document.getElementById("sujet");
var messageInput = document.getElementById("message");
var fileInput = document.getElementById("formFile");

/* const reclamationForm = document.getElementById("form");

reclamationForm.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent the form from submitting
}); */
// Add event listeners for the "blur" event on each input element
nomInput.addEventListener("input", validateNom);
emailInput.addEventListener("input", validateEmail);
numeroInput.addEventListener("input", validateNumero);
sujetInput.addEventListener("input", validateSujet);
messageInput.addEventListener("input", validateMessage);
fileInput.addEventListener("input", fileInputValidation);

function validateNom() {
  var nom = nomInput.value;
  if (nom === "") {
    nomInput.classList.add("is-invalid");
  } else {
    nomInput.classList.remove("is-invalid");
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

function validateSujet() {
  var sujet = sujetInput.value;
  if (sujet === "") {
    sujetInput.classList.add("is-invalid");
  } else {
    sujetInput.classList.remove("is-invalid");
  }
}

function validateMessage() {
  var message = messageInput.value;
  if (message === "") {
    messageInput.classList.add("is-invalid");
  } else {
    messageInput.classList.remove("is-invalid");
  }
}

function fileInputValidation() {
  const allowedTypes = ["application/pdf", "image/png", "image/jpeg"];
  const selectedFileType = this.files[0].type;

  if (!allowedTypes.includes(selectedFileType)) {
    fileInput.classList.add("is-invalid");
  } else {
    fileInput.classList.remove("is-invalid");
  }
}

function validateReclamationForm() {
  // Call individual validation functions for each input
  validateNom();
  validateEmail();
  validateNumero();
  validateSujet();
  validateMessage();
  // Check if any input has the "is-invalid" class
  var invalidInputs = document.querySelectorAll(".is-invalid");
  console.log(invalidInputs);
  if (invalidInputs.length > 0) {
    return false;
  }
  return true;
}
