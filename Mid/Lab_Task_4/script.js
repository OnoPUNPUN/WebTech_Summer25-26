const loginForm = document.getElementById("login-form");
const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");

loginForm.addEventListener("submit", function (event) {
  const username = usernameInput.value.trim();
  const password = passwordInput.value.trim();

  if (username === "" || password === "") {
    alert("Please fill in all fields.");
    return;
  }

  alert("Login successful!");
});
