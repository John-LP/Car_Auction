<!-- En construction -->
<?php
class Encheres {
    // Propriétés de la classe
    protected $montant;
    protected $id_annonce;
    protected $id_utilisateur;
    protected $date_heure_enchere;
    protected $dbh; // Ajout de la propriété pour la connexion

    function __construct($montant, $id_annonce,$id_utilisateur,$date_heure_enchere,$dbh){
        $this->montant = $montant;
        $this->id_annonce = $id_annonce;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_heure_enchere = $date_heure_enchere;
        $this->dbh = $dbh;
    }

    // Méthodes d'accès aux propriétés
    public function getMontant(){
        return $this->montant;
    }

    public function getId_annonce(){
        return $this->id_annonce;
    }

    public function getid_utilisateur(){
        return $this->id_utilisateur;
    }

    public function getDate_heure_enchere(){
        return $this->date_heure_enchere;
    }

    // Méthode pour créer une enchère à partir des données du formulaire
    public function createEnchereFromForm() {
        // Connexion à la base de données
        $dbh = new PDO("mysql:dbname=car_auction;host=127.0.0.1", "root", "");

        // Préparation de la requête d'insertion
        $query = $dbh->prepare("INSERT INTO encheres (montant, id_annonce, id_utilisateur, date_heure_enchere)
        VALUES (:montant, :id_annonce, :id_utilisateur, :date_heure_enchere)");

        // Liaison des valeurs
        $query->bindValue(':montant', $this->montant);
        $query->bindValue(':id_annonce', $this->id_annonce);
        $query->bindValue(':id_utilisateur', $this->id_utilisateur);
        $query->bindValue(':date_heure_enchere', $this->date_heure_enchere);

        // Exécution de la requête
        $query->execute();

        // Vérification du succès de l'enchère
        if ($query) {
            var_dump($query); // (Optionnel) Affiche les détails de la requête dans la console
            echo "<p>Votre enchère a bien été faite.</p>";
            usleep(1000000);
            header("Location: http://localhost/exoBocal/car_auction/index.php");
            exit;
        } else {
            echo "Erreur lors de votre enchère.";
        }
    }
}

// Vérification si le formulaire est soumis en POST et si les données nécessaires sont présentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['montant'], $_POST['id_annonce'], $_POST['id_utilisateur'], $_POST['date_heure_enchere'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['montant'], $_POST['id_annonce'], $_POST['date_heure_enchere'])) {
    // Récupérer l'ID de l'utilisateur depuis la session
    if (isset($_SESSION['user_id'])) {
        $id_utilisateur = $_SESSION['user_id'];

        // Autres variables du formulaire
        $montant = $_POST['montant'];
        $id_annonce = $_POST['id_annonce'];
        $date_heure_enchere = $_POST['date_heure_enchere'];

        // ... le reste de votre code
    } else {
        echo "Erreur : ID de l'utilisateur non trouvé dans la session.";
    }
}
    $dbh = new PDO("mysql:dbname=car_auction;host=127.0.0.1", "root", "");
    $enchere = new Encheres($_POST['montant'], $_POST['id_annonce'], $_POST['id_utilisateur'], $_POST['date_heure_enchere'], $dbh);
    $enchere->createEnchereFromForm();
}

?>
<!-- Fin de contruction -->
