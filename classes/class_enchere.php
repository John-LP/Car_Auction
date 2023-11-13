<!-- En construction -->
<?php
class Encheres {
    // Propriétés de la classe
    protected $montant;
    protected $id_annonce;
    protected $id_utilisateur;
    protected $date_heure_enchere;
    protected $id_utilisateur_connecte;

    // Constructeur de la classe
   function __construct($montant, $id_annonce, $id_utilisateur, $date_heure_enchere, $id_utilisateur_connecte){
        $this->montant = $montant;
        $this->id_annonce = $id_annonce;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_heure_enchere = $date_heure_enchere;
        $this->id_utilisateur_connecte = $id_utilisateur_connecte;
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

        $id_annonce = $_GET['id_annonce'];
        $query = $dbh->prepare("SELECT annonces.*, encheres.montant, encheres.id_utilisateur, utilisateurs.nom, utilisateurs.prenom FROM annonces 
        LEFT JOIN encheres ON annonces.id_annonce=encheres.id_annonce 
        LEFT JOIN utilisateurs ON encheres.id_utilisateur=utilisateurs.id_utilisateur         
        WHERE annonces.id_annonce = :id_annonce");
        $query->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $query->execute();
        $prixDepart = $query['prix_depart'];
        $enchereActuelle = $query['montant'];

        if ($this->montant <= $prixDepart) {
            echo "<p>Le montant de l'enchère doit être supérieur au prix de départ.</p>";
            return;
        }

        if (!is_null($enchereActuelle) && $this->montant <= $enchereActuelle) {
            echo "<p>Le montant de l'enchère doit être supérieur à l'enchère actuelle.</p>";
            return;
        }
        // Préparation de la requête d'insertion
        $query = $dbh->prepare("INSERT INTO encheres (montant, id_annonce, id_utilisateur, date_heure_enchere)
        VALUES (:montant, :id_annonce, :id_utilisateur, :date_heure_enchere)");

        // Liaison des valeurs
        $query->bindValue(':montant', $this->montant);
        $query->bindValue(':id_annonce', $this->id_annonce);
        $query->bindValue(':id_utilisateur', $this->id_utilisateur_connecte);
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['montant'], $_POST['id_annonce'], $_POST['date_heure_enchere'])) {
    // Création d'une instance de la classe Encheres avec les données du formulaire et l'id de l'utilisateur connecté
    $enchere = new Encheres(
        $_POST['montant'],
        $_POST['id_annonce'],
        $_SESSION['id_utilisateur'],
        date("Y-m-d H:i:s"), // Utiliser la date actuelle pour date_heure_enchere
        $_SESSION['id_utilisateur']
    );
    
    // Appel de la méthode pour créer une enchère à partir des données du formulaire
    $enchere->createEnchereFromForm();
}
?>
<!-- Fin de construction -->
