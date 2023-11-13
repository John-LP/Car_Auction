<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de connexion à la base de données
require_once __DIR__ . "/class_serveur.php";

// Vérification si les données de connexion sont soumises via POST
if(isset($_POST['email'])) {
    // Récupération des valeurs du formulaire
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Préparation de la requête pour vérifier les informations de connexion
    $query = $dbh->prepare("SELECT utilisateurs.email, utilisateurs.mdp FROM utilisateurs WHERE email = :email AND mdp = :mdp");
    $query->bindValue(':email', $email);
    $query->bindValue(':mdp', $mdp);
    $query->execute();

    // Vérification du nombre de lignes retournées par la requête
    if($query->rowCount() == 0) {
        // En cas d'échec de connexion, redirection avec un message d'erreur
        $_SESSION['error'] = 'Identifiant ou mot de passe incorrect';
        header("Location: http://localhost/exoPHP/car_auction/views/login");
        exit; 
    } else {
        // En cas de succès de la connexion, enregistrement de l'email dans la session
        $_SESSION['email'] = $email;
        $_SESSION['success'] = 'Connexion réussie';
        $_SESSION['error'] = null;
        $_SESSION['success'] = null;
        header("Location: http://localhost/exoPHP/car_auction");
        exit; 
    }
}
?>
