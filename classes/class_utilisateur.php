<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/styles_login.css">
    <title>Document</title>
</head>
<body>
    

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $dbh = new PDO("mysql:dbname=car_auction;localhost=8889", "root", "root");

    $query = $dbh->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES (?, ?, ?, ?)");
    $res = $query->execute([$nom, $prenom, $email, $mdp]);

    if ($res) {
        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $query->execute([$nom]);
        $utilisateur = $query->fetch();

        echo "<p>Votre compte a bien été créé. <br>
                Vous allez être redirigé à l'accueil.<br>
                Bonne visite.</p>";

    } else {
        echo "<p>Erreur lors de l'insertion dans la base de données. Veuillez remplir tous les champs.</p>";
    }

    echo '<script>
            setTimeout(function() {
                window.location.href = "http://localhost:8888/php/car_auction/index.php";
            }, 1000); // Redirection après 1 secondes (1000 millisecondes)
          </script>';
}
?>
</body>
</html>
