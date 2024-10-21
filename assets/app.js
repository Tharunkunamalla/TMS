//Home page typing effect

// Function to add/remove 'scrolled' class based on scroll position
window.onscroll = function () {
  var navbar = document.querySelector(".navbar");
  if (window.pageYOffset > 50) {
    // Change value as per your needs
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
};

// To change the context of the theme
const textArray = [
  "The only way to prove that you’re a good sport is to lose....",
  "Sportsmanship means not only taking part but doing it with grace...",
  "Success is no accident.It’s hard work,learning, studying,and sacrifice...",
];

let textIndex = 0; // To track which text is being displayed
const dynamicText = document.getElementById("dynamicText");

function typeAndChangeText() {
  // Reset animation by removing the class and re-adding it
  dynamicText.style.animation = "none";
  dynamicText.offsetHeight; // Trigger reflow to restart animation
  dynamicText.style.animation = "";

  // Set the new text
  dynamicText.textContent = textArray[textIndex];

  // Move to the next text index after the animation duration
  setTimeout(() => {
    textIndex = (textIndex + 1) % textArray.length; // Cycle through the array
    typeAndChangeText(); // Recursive call to change text
  }, 5000); // Allow extra time for the full text to appear (4s typing + 1s pause)
}

// Initial call to start the typing animation
typeAndChangeText();
