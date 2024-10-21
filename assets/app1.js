// Nav - bar

// Sticky Header on Scroll
document.addEventListener("scroll", () => {
  const header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 0);
});

// Dropdown functionality
document.addEventListener("DOMContentLoaded", () => {
  // Events Dropdown
  const eventsDropdown = document.querySelector(".events-dropdown");
  const eventsDropdownMenu = eventsDropdown.querySelector(".dropdown-menu");
  const eventsDropdownArrow = eventsDropdown.querySelector(".dropdown-arrow");

  eventsDropdown.addEventListener("click", (e) => {
    eventsDropdown.classList.toggle("active");

    // Toggle the display of the dropdown menu
    if (eventsDropdown.classList.contains("active")) {
      eventsDropdownMenu.style.display = "flex";
    } else {
      eventsDropdownMenu.style.display = "none";
    }
  });

  // User Profile Dropdown
  const userDropdown = document.querySelector(".user-dropdown");
  const userDropdownMenu = userDropdown.querySelector(".dropdown-menu");
  const userIcon = document.getElementById("user-icon");
  const logoutButton = document.getElementById("logout-button");
  const displayUsername = document.getElementById("display-username");

  // Function to display the username in the dropdown
  function displayUser() {
    const currentUser = localStorage.getItem("currentUser");
    if (currentUser) {
      displayUsername.textContent = currentUser;
    } else {
      displayUsername.textContent = "Admin";
    }
  }

  // Toggle user profile dropdown
  userIcon.addEventListener("click", function (e) {
    e.preventDefault();
    userDropdown.classList.toggle("active");

    // Toggle the display of the dropdown menu
    if (userDropdown.classList.contains("active")) {
      userDropdownMenu.style.display = "flex";
    } else {
      userDropdownMenu.style.display = "none";
    }
  });

  // Admin Sign In Form Submission
  document
    .getElementById("admin-form")
    ?.addEventListener("submit", function (e) {
      e.preventDefault();
      clearMessages();

      const adminID = document.getElementById("admin-id").value.trim();
      const adminPassword = document
        .getElementById("admin-password")
        .value.trim();

      // Fixed Admin credentials
      const fixedAdminID = "admin123";
      const fixedAdminPassword = "adminPass";

      if (adminID === fixedAdminID && adminPassword === fixedAdminPassword) {
        // Store in localStorage that Admin is signed in
        localStorage.setItem("currentUser", "Admin");

        displayMessage("admin-success", "Admin signed in successfully!", false);
        setTimeout(() => {
          window.location.href = "index1.html"; // Redirect to Admin dashboard
        }, 2000);
      } else {
        displayMessage("admin-error", "Incorrect Admin ID or Password.");
      }
    });

  // User Sign In Form Submission
  document
    .getElementById("signin-form")
    ?.addEventListener("submit", function (e) {
      e.preventDefault();
      clearMessages();

      const username = document.getElementById("signin-username").value.trim();
      const password = document.getElementById("signin-password").value.trim();

      if (username && password) {
        // Store in localStorage that User is signed in
        localStorage.setItem("currentUser", username);

        displayMessage("signin-success", "User signed in successfully!", false);
        setTimeout(() => {
          window.location.href = "index1.html"; // Redirect to User dashboard
        }, 2000);
      } else {
        displayMessage("signin-error", "Please enter valid credentials.");
      }
    });

  // Display Username or Admin in Profile Dropdown
  displayUser();

  // Logout functionality
  logoutButton?.addEventListener("click", function () {
    // Remove currentUser from local storage
    localStorage.removeItem("currentUser");
    // Redirect to login page
    window.location.href = "login.html";
  });

  // Close dropdowns when clicking outside
  document.addEventListener("click", function (e) {
    // Close Events Dropdown if click is outside
    if (!eventsDropdown.contains(e.target)) {
      eventsDropdown.classList.remove("active");
      eventsDropdownMenu.style.display = "none";
    }

    // Close User Dropdown if click is outside
    if (!userDropdown.contains(e.target) && !userIcon.contains(e.target)) {
      userDropdown.classList.remove("active");
      userDropdownMenu.style.display = "none";
    }
  });

  // Initialize the username display
  displayUser();
});

// Typing effect
const textArray = [
  "The only way to prove that you’re a good sport is to lose....",
  "Sportsmanship means not only taking part but doing it with grace...",
  "Success is no accident. It’s hard work, learning, studying, and sacrifice...",
];

let textIndex = 0;
const dynamicText = document.getElementById("dynamicText");

function typeAndChangeText() {
  dynamicText.style.animation = "none";
  dynamicText.offsetHeight;
  dynamicText.style.animation = "";
  dynamicText.textContent = textArray[textIndex];

  setTimeout(() => {
    textIndex = (textIndex + 1) % textArray.length;
    typeAndChangeText();
  }, 5000);
}
// Initial call to start the typing animation
typeAndChangeText();
