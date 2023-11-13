<!-- Structure de la barre de navigation -->
<nav>
    <!-- Logo de l'application -->
    <div class="logo" style="display: flex; align-items: center;">
        <span style="color:#ffeba7; font-size:26px; font-weight:bold; letter-spacing: 1px; margin-left: 20px;">Car Auction</span>
    </div>

    <!-- Icône de menu hamburger pour les écrans mobiles -->
    <div class="hamburger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>

    <!-- Liste des liens de navigation -->
    <ul class="nav-links nav">
        <li><a id="accueil-link" class="nav-item" active-color="#ffeba7" href="http://localhost/exoPHP/car_auction/">Accueil</a></li>
        <li><a id="annonce-link" class="nav-item" active-color="#ffeba7" href="http://localhost/exoPHP/car_auction/views/form_annonce.php">Créer une annonce</a></li>
        <li><a id="enchere-acheteur-link" class="nav-item" active-color="#ffeba7" href="http://localhost/exoPHP/car_auction/views/encheres_acheteur.php">Mes enchères</a></li>
        <li><a id="enchere-vendeur-link" class="nav-item" active-color="#ffeba7" href="http://localhost/exoPHP/car_auction/views/profil.php">Mon profil</a></li>
        <?php
            if (!isset($_SESSION['email'])) { 
                echo '<li><a class="login-button" href="http://localhost/exoPHP/car_auction/views/login.php">Se connecter</a></li>';
            } else {
                echo '<li><a class="login-button" href="http://localhost/exoPHP/car_auction/views/logout.php">Se déconnecter</a></li>';
            }
        ?>
    </ul>
</nav>

<!-- Script JavaScript pour la gestion des événements -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Sélection de tous les éléments de navigation
        let navItems = document.querySelectorAll('.nav-item');

        // Ajout d'un gestionnaire d'événements à chaque élément de navigation
        navItems.forEach(function(item) {
            item.addEventListener('click', function() {
                // Suppression de la classe 'is-clicked' de tous les éléments de navigation
                navItems.forEach(function(navItem) {
                    navItem.classList.remove('is-clicked');
                });
                
                // Ajout de la classe 'is-clicked' à l'élément cliqué
                this.classList.add('is-clicked');
            });
        });
    });

    // Gestion du menu hamburger et de l'animation des liens
    const hamburger = document.querySelector(".hamburger");
    const navLinks = document.querySelector(".nav-links");
    const links = document.querySelectorAll(".nav-links li");

    hamburger.addEventListener("click", () => {
        // Ajout ou suppression de la classe 'open' pour afficher ou masquer les liens de navigation
        navLinks.classList.toggle("open");

        // Ajout ou suppression de la classe 'fade' pour animer l'apparition/disparition des liens
        links.forEach((link) => {
            link.classList.toggle("fade");
        });

        // Ajout ou suppression de la classe 'toggle' pour animer l'icône du menu hamburger
        hamburger.classList.toggle("toggle");
    });
</script>
