<?php 
class Utilisateur {
    // Propriétés protégées
    protected $id_utilisateur;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $mdp;

    // Constructeur de la classe
    function __construct($nom, $prenom, $email, $mdp) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

    // Méthode pour obtenir le nom de l'utilisateur
    public function getNom() {
        return $this->nom;
    }

    // Méthode pour obtenir le prénom de l'utilisateur
    public function getPrenom() {
        return $this->prenom;
    }

    // Méthode pour obtenir l'email de l'utilisateur
    public function getEmail() {
        return $this->email;
    }

    // Méthode pour obtenir le mot de passe de l'utilisateur
    public function getMdp() {
        return $this->mdp;
    }
   
    // Méthode pour créer un utilisateur dans la base de données
    public function createUtilisateur($nom, $prenom, $email, $mdp) {
        // Inclusion du fichier de connexion à la base de données
        require_once __DIR__ . "/class_serveur.php";
        
        // Préparation de la requête d'insertion
        $query = $dbh->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)");
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':email', $email);
        $query->bindValue(':mdp', $mdp);
   
        // Exécution de la requête d'insertion
        $query->execute();

        // Vérification de la réussite de la requête
        if ($query) {
            echo "<p>Votre compte a bien été créé.</p>";
            // Pause d'une seconde avant la redirection
            usleep(1000000);
            header("Location: http://localhost:8888/exoBocal/car_auction/index.php");
            exit;
        } else {
            echo "Erreur lors de la création du compte.";
        }
    }
}
?>

<!-- Page HTML pour le formulaire d'inscription -->
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
// Vérification de la méthode de requête (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Inclusion du fichier de connexion à la base de données
    require_once __DIR__ . "/class_serveur.php";

    // Préparation de la requête d'insertion des données dans la table utilisateurs
    $query = $dbh->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)");
    $query->bindValue(':nom', $nom);
    $query->bindValue(':prenom', $prenom);
    $query->bindValue(':email', $email);
    $query->bindValue(':mdp', $mdp);
    
    // Exécution de la requête
    $query = $query->execute();

    // Vérification de la réussite de la requête
    if ($query) {
        // Sélection de l'utilisateur nouvellement créé
        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $query->execute([$nom]);
        $utilisateur = $query->fetch();

        // Affichage d'un message de succès
        echo "<p>Votre compte a bien été créé. <br>
                Vous allez être redirigé vers l'accueil.<br>
                Bonne visite.</p>";

    } else {
        // Affichage d'un message d'erreur en cas d'échec de la requête
        echo "<p>Erreur lors de la création du compte.</p>";
    }

    // Script JavaScript pour la redirection après une seconde (1000 millisecondes)
    echo '<script>
            setTimeout(function() {
                window.location.href = "../";
            }, 1000);
          </script>';
}
?>
</body>

</html>
