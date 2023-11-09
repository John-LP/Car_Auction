<!-- Création d'un compte utilisateur -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $dbh = new PDO("mysql:dbname=car_auction;host=localhost", "root", "");

    $query = $dbh->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp)
    VALUES (:nom, :prenom, :email, :mdp)");
    $query->bindValue(':nom', $nom);
    $query->bindValue(':prenom', $prenom);
    $query->bindValue(':email', $email);
    $query->bindValue(':mdp', $mdp);
    $query = $query->execute();

    if ($query) {
        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $query->execute([$nom]);
        $utilisateur = $query->fetch();

        echo "<p>Nom: " . $utilisateur['nom'] . "</p>";
        echo "<p>Prénom: " . $utilisateur['prenom'] . "</p>";
        echo "<p>Mail: " . $utilisateur['email'] . "</p>";

    } else {

        echo "Erreur lors de l'insertion dans la base de données.
        Veuillez remplir tous les champs.";
    }
}
?>