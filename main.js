const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener("click", () => {
  //Animate Links
  navLinks.classList.toggle("open");
  links.forEach((link) => {
    link.classList.toggle("fade");
  });

  //Hamburger Animation
  hamburger.classList.toggle("toggle");
});

// Obtenez l'année actuelle
const anneeActuelle = new Date().getFullYear();

// Définissez la valeur maximale pour le champ input
document.getElementById("yearInput").setAttribute("max", anneeActuelle);

// Vous pouvez également ajouter une fonction de validation personnalisée pour empêcher l'envoi du formulaire si l'année est supérieure à l'année actuelle.
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
