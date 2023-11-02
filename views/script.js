// Login
document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const errorDiv = document.getElementById("error");
    const loginForm = document.querySelector("form");
  
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();
  
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();
  
      if (!email || !password) {
        showError("Please fill in all fields.");
      } else {
        // Clear any previous error messages
        errorDiv.classList.add("d-none");
  
        // Submit the form
        loginForm.submit();
      }
    });
  
    function showError(message) {
      errorDiv.textContent = message;
      errorDiv.classList.remove("d-none");
    }
  });

  // Register
  document.addEventListener("DOMContentLoaded", function () {
    const firstNameInput = document.getElementById("firstName");
    const lastNameInput = document.getElementById("lastName");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phoneNumber");
    const passwordInput = document.getElementById("password");
    const passwordConfirmationInput = document.getElementById("passwordConfirmation");
    const errorDiv = document.getElementById("error");
    const registerForm = document.querySelector("form");
    
    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const firstName = firstNameInput.value.trim();
        const lastName = lastNameInput.value.trim();
        const email = emailInput.value.trim();
        const phone = phoneInput.value.trim();
        const password = passwordInput.value.trim();
        const passwordConfirmation = passwordConfirmationInput.value.trim();

        if (!firstName || !lastName || !email || !phone || !password || !passwordConfirmation) {
            showError("Please fill in all fields.");
        } else if (password !== passwordConfirmation) {
            showError("Passwords do not match.");
        } else {
            // Clear any previous error messages
            errorDiv.classList.add("d-none");

            // Submit the form
            registerForm.submit();
        }
    });

    function showError(message) {
        errorDiv.textContent = message;
        errorDiv.classList.remove("d-none");
        return false;
    }
    
});