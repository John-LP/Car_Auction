
<nav>
<div class="logo" style="display: flex;align-items: center;">
    <span
            style="color:#ffeba7; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">Car Auction</span>
    </div>
    <div class="hamburger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
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
<script>
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
</script>

