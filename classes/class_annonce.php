<!-- Créer une annonce  -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prix_depart = $_POST['prix_depart'];
    $date_fin = $_POST['date_fin'];
    $modele = $_POST['modele'];
    $marque = $_POST['marque'];
    $puissance = $_POST['puissance'];
    $annee = $_POST['annee'];
    $description = $_POST['description'];

    $dbh = new PDO("mysql:dbname=car_auction;host=localhost", "root", "");

    $query = $dbh->prepare("INSERT INTO annonces (prix_depart, date_fin, modele, marque, puissance, annee, description)
    VALUES (:prix_depart, :date_fin, :modele, :marque, :puissance, :annee, :description)");
    $query->bindValue(':prix_depart', $prix_depart);
    $query->bindValue(':date_fin', $date_fin);
    $query->bindValue(':modele', $modele);
    $query->bindValue(':marque', $marque);
    $query->bindValue(':puissance', $puissance);
    $query->bindValue(':annee', $annee);
    $query->bindValue(':description', $description);
    $query->execute();

    if ($query) {
        $query = $dbh->prepare("SELECT * FROM annonces WHERE prix_depart = ?");
        $query->execute([$prix_depart]);
        $utilisateur = $query->fetch();

        echo "<p>prix_depart: " . $utilisateur['prix_depart'] . "</p>";
        echo "<p>Préprix_depart: " . $utilisateur['date_fin'] . "</p>";
        echo "<p>Mail: " . $utilisateur['modele'] . "</p>";

    } else {

        echo "Erreur lors de l'insertion dans la base de données.
        Veuillez remplir tous les champs.";
    }
}
?>