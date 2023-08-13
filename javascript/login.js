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
