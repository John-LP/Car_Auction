<?php
class Encheres {
    // Propriétés de la classe
    protected $montant;
    protected $id_annonce;
    protected $id_utilisateur;
    protected $date_heure_enchere;
    protected $dbh;

    function __construct($montant, $id_annonce, $id_utilisateur, $date_heure_enchere, $dbh){
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
            echo "<p>Votre enchère a bien été prise en compte.</p>";
            usleep(1000000);
            header("Location: ../");
            exit;
        } else {
            echo "Erreur lors de votre enchère.";
        }
    }
}

// Vérification si le formulaire est soumis en POST et si les données nécessaires sont présentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['montant'], $_POST['id_annonce'], $_POST['date_heure_enchere'])) {
    if(!isset($_SESSION['email'])) {
        header("Location: ../views/login");
        exit;
    } else {
        if (isset($_SESSION['id_utilisateur'])) {
            $id_utilisateur = $_SESSION['id_utilisateur'];

            // Récupérer id_annonce depuis le formulaire
            $id_annonce = $_POST['id_annonce'];

            $query = $dbh->prepare(
                "SELECT
                    annonces.id_annonce,
                    annonces.prix_depart,
                    COALESCE(MAX(encheres.montant), annonces.prix_depart) as montant_max,
                    annonces.id_utilisateur as id_utilisateur_annonce
                FROM
                    annonces 
                LEFT JOIN
                    encheres ON annonces.id_annonce=encheres.id_annonce       
                WHERE 
                    annonces.id_annonce = :id_annonce");

            // Lie la valeur à la variable dans la requête SQL
            $query->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();

            if ($_POST['montant'] > $result['prix_depart'] && $_POST['montant'] > $result['montant_max'] && $id_utilisateur != $result['id_utilisateur_annonce']) {
                // Création de l'objet Encheres
                $enchere = new Encheres($_POST['montant'], $id_annonce, $id_utilisateur, $_POST['date_heure_enchere'], $dbh);
            
                // Appel de la méthode pour créer l'enchère
                $enchere->createEnchereFromForm();
            } else {
                echo '<article>';
                echo '<section class="card">';
                echo '<div class="text-content">';
                echo "Le montant de votre enchère doit être supérieur au prix actuel du produit et à son enchère la plus haute, et vous ne pouvez pas enchérir sur vos propres annonces.";
                echo "<br><br>";
                echo "<a href='..' >Retour</a>";
                echo '</div>';
                echo '</section>';
                echo '</article>';
            }
        }
    }
}

?>
<!-- Fin de construction -->
