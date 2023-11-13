<?php
    session_start();
    require_once __DIR__ . "/class_serveur.php";
        
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
 
        $query = $dbh->prepare("SELECT utilisateurs.email, utilisateurs.mdp FROM utilisateurs WHERE email = :email AND mdp = :mdp");
        $query->bindValue(':email', $email);
        $query->bindValue(':mdp', $mdp);
        $query->execute();

        if($query->rowCount() == 0) {
            $_SESSION['error'] = 'Identifiant ou mot de passe incorrect';
            header("Location: http://localhost/exoBocal/car_auction/views/login");
            exit; 
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = 'Connexion réussie';
            $_SESSION['error'] = null;
            $_SESSION['success'] = null;
            header("Location: http://localhost/exoBocal/car_auction");
            exit; 
        }
    }
?>