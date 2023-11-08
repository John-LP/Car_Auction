<!-- Création d'un compte utilisateur -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./../css/styles.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>
<?php
class Utilisateur {
    private $dbh;

    public function __construct() {
        $this->dbh = new PDO("mysql:dbname=car_auction;host=localhost", "root", "");
    }

    public function createUtilisateur($nom, $prenom, $email, $password) {
        $query = $this->dbh->prepare("INSERT INTO utilisateurs (nom, prenom, email, password)
        VALUES (':nom', ':prenom', ':email', (MD5)':password')");
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);

        if ($query->execute()) {
            return true;
        } else {
            return false; 
        }
    }
}

$utilisateur = new Utilisateur();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $utilisateurCreated = $utilisateur->createUtilisateur($nom, $prenom, $email, $password);

    echo '<div  class="d-flex align-items-center">';
    echo '<div class="row justify-content-center" style="margin:20px;">';
    echo '<p class="creation">Votre compte a bien été créé.</p>';
    echo "<br><br>";
    echo '<div class="col-lg-12 login-title">';
    echo '<a class="concessionaire" href="http://localhost/exoPHP/ecomm2/">Accueil</a>';
    echo '</div>';
    echo '<div class="col-lg-12 login-title">';
    echo '<a class="concessionaire" href="http://localhost/exoPHP/ecomm2/views/display_customers.php">Liste Utilisateurs</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>
</body>
</html>