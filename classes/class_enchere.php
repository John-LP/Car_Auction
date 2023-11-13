<!-- En constuction -->
<?php
class Encheres {
    protected $montant;
    protected $id_annonce;
    protected $id_utilisateur;
    protected $date_heure_enchere;

    function __construct($montant, $id_annonce,$id_utilisateur,$date_heure_enchere){
        $this->montant = $montant;
        $this->id_annonce = $id_annonce;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_heure_enchere = $date_heure_enchere;
    }

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

    public function createEnchereFromForm() {
        $query = $this->dbh->prepare("INSERT INTO encheres (montant, id_annonce, id_utilisateur,date_heure_enchere)
        VALUES (:montant, :id_annonce, :id_utilisateur, :date_heure_enchere)");
        $query->bindValue(':montant', $this->montant);
        $query->bindValue(':id_annonce', $this->id_annonce);
        $query->bindValue(':id_utilisateur', $this->id_utilisateur);
        $query->bindValue(':date_heure_enchere', $this->date_heure_enchere);
        $query->execute();

        if ($query) {
            var_dump($query);
            echo "<p>Votre enchère a bien été faite.</p>";
            usleep(1000000);
            header("Location: http://localhost/exoBocal/car_auction/index.php");
            exit;
        } else {
            echo "Erreur lors de votre enchère.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['montant'], $_POST['id_annonce'], $_POST['id_utilisateur'], $_POST['date_heure_enchere'])) {
    $dbh = new PDO("mysql:dbname=car_auction;host=127.0.0.1", "root", "");
    $enchere = new Encheres($_POST['montant'], $_POST['id_annonce'], $_POST['id_utilisateur'], $_POST['date_heure_enchere']);
    $enchere->createEnchereFromForm();
}
?>
<!-- Fin de contruction -->