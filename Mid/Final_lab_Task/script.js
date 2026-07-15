const greeting = document.getElementById("greeting");

const hour = new Date().getHours();

if (hour < 12) {
  greeting.innerText = "Good Moring";
} else if (hour < 18) {
  greeting.innerText = "Good Afternoon";
} else {
  greeting.innerText = "Good Evening";
}

const themeBtn = document.getElementById("themeBtn");

themeBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");

  if (document.body.classList.contains("dark-mode")) {
    themeBtn.innerText = "Light Mode";
  } else {
    themeBtn.innerText = "Dark Mode";
  }
});

function showSection(sectionId) {
  const sections = document.querySelectorAll(".content-section");
  sections.forEach((section) => {
    section.classList.add("hidden");
  });

  document.getElementById(sectionId).classList.remove("hidden");
}

const form = document.getElementById("contactForm");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  let valid = true;

  const name = document.getElementById("name").value;

  const email = document.getElementById("email").value;

  const message = document.getElementById("message").value;

  document.getElementById("nameError").innerText = "";
  document.getElementById("emailError").innerText = "";
  document.getElementById("messageError").innerText = "";

  if (name.trim() === "") {
    document.getElementById("nameError").innerText = "Name is required";
    valid = false;
  }

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(email)) {
    document.getElementById("emailError").innerText = "Enter a valid email";
    valid = false;
  }

  if (message.length < 10) {
    document.getElementById("messageError").innerText =
      "Message must be at least 10 characters";
    valid = false;
  }

  if (valid) {
    alert("Message Sent Succesfuly!");
  }
});
