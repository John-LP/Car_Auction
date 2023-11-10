<?php
    session_start();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
 
        $dbh = new PDO("mysql:dbname=car_auction;host=localhost", "root", "");
        $query = $dbh->prepare("SELECT utilisateurs.email, utilisateurs.mdp FROM utilisateurs WHERE email = :email AND mdp = :mdp");
        $query->bindValue(':email', $email);
        $query->bindValue(':mdp', $mdp);
        $query->execute();

        if($query->rowCount() == 0) {
            $_SESSION['error'] = 'Identifiant ou mot de passe incorrect';
            header("Location: http://localhost/car_auction/views/login");
            exit; 
        } else {
            $_SESSION['success'] = 'Bienvenue ! Vous êtes bien connecté !';
            header("Location: http://localhost/car_auction/");
            exit; 
        }
    }
?>