// Début JS navbar
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener("click", () => {

  navLinks.classList.toggle("open");
  links.forEach((link) => {
    link.classList.toggle("fade");
  });
  hamburger.classList.toggle("toggle");
});
// Fin JS navbar

// Début JS année input form_annonce
const anneeActuelle = new Date().getFullYear();
document.getElementById("yearInput").setAttribute("max", anneeActuelle);
document.getElementById("yearInput").addEventListener("input", function () {
  const yearInput = parseInt(this.value, 10);
  if (yearInput > anneeActuelle) {
    this.setCustomValidity(
      "L'année ne peut pas être supérieure à l'année actuelle."
    );
  } else {
    this.setCustomValidity("");
  }
});
// Fin JS année input form_annonce

// Début JS section navbar
document.addEventListener("DOMContentLoaded", function() {
  let navItems = document.querySelectorAll('.nav-item');
  navItems.forEach(function(item) {
    item.addEventListener('click', function() {
      navItems.forEach(function(navItem) {
        navItem.classList.remove('is-clicked');
      });
      this.classList.add('is-clicked');
    });
  });
});
// Fin JS section navbar