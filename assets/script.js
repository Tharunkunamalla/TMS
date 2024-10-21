// Sign-in page
// Function to handle form toggling with fade-in effect
function toggleForm(formToShow) {
  const forms = document.querySelectorAll(".form");
  forms.forEach((form) => {
    form.style.display = "none";
  });
  formToShow.style.display = "block";
  formToShow.classList.remove("fade-in");
  // Trigger reflow to restart animation
  void formToShow.offsetWidth;
  formToShow.classList.add("fade-in");
}

// Function to set active button styling
function setActiveButton(activeBtn) {
  const buttons = document.querySelectorAll(".form-toggle button, .role-toggle button");
  buttons.forEach((btn) => {
    btn.classList.remove("active");
  });
  activeBtn.classList.add("active");
}

// Utility function to validate email format
function validateEmail(email) {
  const re = /\S+@\S+\.\S+/;
  return re.test(email);
}

// Utility function to validate username format
function validateUsername(username) {
  const re = /^[a-zA-Z0-9]{3,15}$/;
  return re.test(username);
}

// Function to display messages
function displayMessage(elementId, message, isError = true) {
  const element = document.getElementById(elementId);
  element.textContent = message;
  if (isError) {
    element.classList.remove("success-message");
    element.classList.add("error-message");
  } else {
    element.classList.remove("error-message");
    element.classList.add("success-message");
  }
}

// Function to clear messages
function clearMessages() {
  const messageElements = document.querySelectorAll(".error-message, .success-message");
  messageElements.forEach((element) => {
    element.textContent = "";
  });
}

// Function to get users from Local Storage
function getUsers() {
  const users = localStorage.getItem("users");
  return users ? JSON.parse(users) : [];
}

// Function to save users to Local Storage
function saveUsers(users) {
  localStorage.setItem("users", JSON.stringify(users));
}

// Event listeners for form toggles
document.getElementById("signin-toggle").addEventListener("click", function () {
  toggleForm(document.getElementById("signin-form"));
  setActiveButton(this);
});

document.getElementById("signup-toggle").addEventListener("click", function () {
  toggleForm(document.getElementById("signup-form"));
  setActiveButton(this);
});

document.getElementById("forgot-toggle").addEventListener("click", function () {
  toggleForm(document.getElementById("forgot-form"));
  setActiveButton(this);
});

document.getElementById("user-toggle").addEventListener("click", function () {
  toggleForm(document.getElementById("signin-form"));
  setActiveButton(this);
});

document.getElementById("admin-toggle").addEventListener("click", function () {
  toggleForm(document.getElementById("admin-form"));
  setActiveButton(this);
});

// Sign Up Form Submission
document.getElementById("signup-form").addEventListener("submit", function (e) {
  e.preventDefault();
  clearMessages();

  const username = document.getElementById("signup-username").value.trim();
  const email = document.getElementById("signup-email").value.trim();
  const password = document.getElementById("signup-password").value.trim();

  if (!validateUsername(username)) {
    displayMessage("signup-error", "Please choose a valid username (alphanumeric, 3-15 characters).");
    return;
  }

  if (!validateEmail(email)) {
    displayMessage("signup-error", "Please enter a valid email address.");
    return;
  }

  if (password.length < 6) {
    displayMessage("signup-error", "Password must be at least 6 characters long.");
    return;
  }

  let users = getUsers();

  const userExists = users.some((user) => user.username === username);
  const emailExists = users.some((user) => user.email === email);
  if (userExists) {
    displayMessage("signup-error", "Username is already taken. Please choose another.");
    return;
  }
  if (emailExists) {
    displayMessage("signup-error", "An account with this email already exists.");
    return;
  }

  users.push({ username, email, password });
  saveUsers(users);

  displayMessage("signup-success", "Signed up successfully! You can now sign in.", false);
  setTimeout(() => {
    toggleForm(document.getElementById("signin-form"));
    setActiveButton(document.getElementById("signin-toggle"));
    clearMessages();
  }, 2000);
});

// Sign In Form Submission
document.getElementById("signin-form").addEventListener("submit", function (e) {
  e.preventDefault();
  clearMessages();

  const username = document.getElementById("signin-username").value.trim();
  const password = document.getElementById("signin-password").value.trim();

  let users = getUsers();

  const user = users.find((user) => user.username === username);

  if (!user) {
    displayMessage("signin-error", "No account found with this username. Please sign up.");
    return;
  }

  if (user.password !== password) {
    displayMessage("signin-error", "Incorrect password. Please try again.");
    return;
  }

  localStorage.setItem("currentUser", username);
  displayMessage("signin-success", "Signed in successfully!", false);
  setTimeout(() => {
    window.location.href = "index1.html"; // Redirect to index1.html
  }, 2000);
});

// Forgot Password Form Submission
document.getElementById("forgot-form").addEventListener("submit", function (e) {
  e.preventDefault();
  clearMessages();

  const email = document.getElementById("forgot-email").value.trim();
  let users = getUsers();

  const userIndex = users.findIndex((user) => user.email === email);

  if (userIndex === -1) {
    displayMessage("forgot-error", "No account found with this email.");
    return;
  }

  const newPassword = prompt("Enter your new password (at least 6 characters):");
  if (newPassword === null || newPassword.length < 6) {
    displayMessage("forgot-error", "Password must be at least 6 characters long.");
    return;
  }

  users[userIndex].password = newPassword;
  saveUsers(users);

  displayMessage("forgot-success", "Password reset successfully! You can now sign in with your new password.", false);
  setTimeout(() => {
    toggleForm(document.getElementById("signin-form"));
    setActiveButton(document.getElementById("signin-toggle"));
    clearMessages();
  }, 2000);
});

// Admin Sign In Form Submission
document.getElementById("admin-form").addEventListener("submit", function (e) {
  e.preventDefault();
  clearMessages();

  const adminID = document.getElementById("admin-id").value.trim();
  const adminPassword = document.getElementById("admin-password").value.trim();

  const fixedAdminID = "admin123";
  const fixedAdminPassword = "adminPass";

  if (adminID === fixedAdminID && adminPassword === fixedAdminPassword) {
    displayMessage("admin-success", "Admin signed in successfully!", false);
    setTimeout(() => {
      window.location.href = "index2.html"; // Redirect to Admin dashboard
    }, 2000);
  } else {
    displayMessage("admin-error", "Incorrect Admin ID or Password.");
  }
});

// Optional: Automatically show Sign Up form if no users are registered
window.onload = function () {
  const users = getUsers();
  if (users.length === 0) {
    toggleForm(document.getElementById("signup-form"));
    setActiveButton(document.getElementById("signup-toggle"));
  }
};
