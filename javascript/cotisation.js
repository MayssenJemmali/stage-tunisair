// Get references to the input elements
var matriculeInput = document.getElementById("matricule");
var paymentOption = document.getElementById("payment-option");
var captchaInput = document.getElementById("captchaInput");

// Add event listeners for the "blur" event on each input element
matriculeInput.addEventListener("input", validateMatricule);
paymentOption.addEventListener("input", validatePaymentOption);
captchaInput.addEventListener("input", validateCaptcha);

function validateMatricule() {
  var matricule = matriculeInput.value;
  if (!/^\d{5}$/.test(matricule)) {
    matriculeInput.classList.add("is-invalid");
  } else {
    matriculeInput.classList.remove("is-invalid");
  }
}

function validatePaymentOption() {
  var opntion = paymentOption.value;
  if (opntion === "") {
    paymentOption.classList.add("is-invalid");
  } else {
    paymentOption.classList.remove("is-invalid");
  }
}

function validateCaptcha() {
  var captcha = captchaInput.value;
  if (captcha === "") {
    captchaInput.classList.add("is-invalid");
  } else {
    captchaInput.classList.remove("is-invalid");
  }
}

function validateCotisationForm() {
  // Call individual validation functions for each input
  validateMatricule();
  validatePaymentOption();
  validateCaptcha();
  // Check if any input has the "is-invalid" class
  var invalidInputs = document.querySelectorAll(".is-invalid");

  if (invalidInputs.length > 0) {
    return false;
  }
  return true;
}
