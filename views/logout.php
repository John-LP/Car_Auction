<?php
// Démarre la session pour accéder aux variables de session
session_start();

// Efface toutes les variables de session
session_unset();

// Détruit la session actuelle
session_destroy();
header("Location: http://localhost:8888/php//car_auction/");
?>
