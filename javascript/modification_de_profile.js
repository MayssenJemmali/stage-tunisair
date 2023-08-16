// Verification de log in form
function validateUpdateForm() {
  const nom = document.getElementById("nom");
  const prenom = document.getElementById("prenom");
  const email = document.getElementById("email");
  const numero = document.getElementById("numero");
  const passwordConfirmer = document.getElementById("passwordConfirmer");
  const passwordNouveau = document.getElementById("passwordNouveau");
  let isValid = true;

  // Validation for nom and prenom (not empty)
  if (nom.value.trim() === "") {
    nom.classList.add("is-invalid");
    isValid = false;
  } else {
    nom.classList.remove("is-invalid");
  }

  if (prenom.value.trim() === "") {
    prenom.classList.add("is-invalid");
    isValid = false;
  } else {
    prenom.classList.remove("is-invalid");
  }

  // Validation for email (valid format)
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email.value)) {
    email.classList.add("is-invalid");
    isValid = false;
  } else {
    email.classList.remove("is-invalid");
  }

  // Validation for numero (numeric and 8 digits)
  const numeroPattern = /^\d{8}$/;
  if (!numeroPattern.test(numero.value)) {
    numero.classList.add("is-invalid");
    isValid = false;
  } else {
    numero.classList.remove("is-invalid");
  }

  if (
    (passwordConfirmer.value.length > 0 || passwordNouveau.value.length > 0) &&
    passwordConfirmer.value !== passwordNouveau.value
  ) {
    passwordConfirmer.classList.add("is-invalid");
    isValid = false;
  }
  if (passwordConfirmer.value === passwordNouveau.value) {
    passwordConfirmer.classList.remove("is-invalid");
  }
  console.log(isValid);
  return isValid;
}

// To test in real-time
document.getElementById("nom").addEventListener("input", validateUpdateForm);
document.getElementById("prenom").addEventListener("input", validateUpdateForm);
document.getElementById("email").addEventListener("input", validateUpdateForm);
document.getElementById("numero").addEventListener("input", validateUpdateForm);
document
  .getElementById("passwordNouveau")
  .addEventListener("input", validateUpdateForm);

document
  .getElementById("passwordConfirmer")
  .addEventListener("input", validateUpdateForm);

// Only enable the enregister button when new values are inserted in the input
document.addEventListener("DOMContentLoaded", function () {
  // Flag to track input changes
  let hasInputChanged = false;

  // Function to enable/disable "Enregistrer" button
  function toggleEnregistrerButton() {
    const enregistrerButton = document.querySelector(".enregistrer-btn");
    const invalidInputs = document.querySelectorAll(".is-invalid");
    enregistrerButton.disabled = !hasInputChanged || invalidInputs.length > 0;
  }

  // Add event listeners to input fields
  const inputFields = document.querySelectorAll("input");
  inputFields.forEach(function (input) {
    // Store the default value of each input
    input.defaultVal = input.value;

    input.addEventListener("input", function () {
      // Compare the current value with the default value
      if (input.value !== input.defaultVal) {
        hasInputChanged = true;
      } else {
        hasInputChanged = false;
      }
      toggleEnregistrerButton();
    });
  });

  // Add event listener to "Annuler" button
  const annulerButton = document.getElementById("annuler-btn");
  annulerButton.addEventListener("click", function () {
    hasInputChanged = false;
    toggleEnregistrerButton();
  });
});
