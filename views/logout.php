<?php
// Démarre la session pour accéder aux variables de session
session_start();

// Efface toutes les variables de session
session_unset();

// Détruit la session actuelle
session_destroy();

// Redirige l'utilisateur vers la page d'accueil du site
header("Location: http://localhost/exoPHP/car_auction/");
?>
