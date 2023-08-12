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

function validateLoginForm() {
  console.log("validateLoginForm function executed");

  const form = document.querySelector(".form");

  // Toggle is-invalid class and show validation errors
  function toggleValidation() {
    const inputs = form.querySelectorAll(".form-control");
    let hasInvalidInputs = false;

    inputs.forEach((input) => {
      const parentDiv = input.closest(".form-group");
      const feedback = parentDiv.querySelector(".invalid-feedback");

      if (input.value.trim() === "") {
        input.classList.add("is-invalid");
        parentDiv.classList.add("is-invalid");
        feedback.style.display = "block";
        hasInvalidInputs = true;
      } else {
        input.classList.remove("is-invalid");
        parentDiv.classList.remove("is-invalid");
        feedback.style.display = "none";
      }
    });

    return !hasInvalidInputs; // Return true if there are no invalid inputs
  }

  if (!toggleValidation()) {
    return false; // Prevent form submission if there are invalid inputs
  }
}
