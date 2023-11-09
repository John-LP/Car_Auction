<?php
require_once __DIR__ . "/class_serveur.php";

class Annonces {
    protected $id_utilisateur;
    protected $prix_depart;
    protected $date_fin;
    protected $modele;
    protected $marque;
    protected $puissance;
    protected $annee;
    protected $description;

    function __construct($id_utilisateur, $prix_depart, $date_fin, $modele, $marque, $puissance, $annee, $description) {
        $this->id_utilisateur = $id_utilisateur;
        $this->prix_depart = $prix_depart;
        $this->date_fin = $date_fin;
        $this->modele = $modele;
        $this->marque = $marque;
        $this->puissance = $puissance;
        $this->annee = $annee;
        $this->description = $description;
    }

    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }
    public function getPrix_depart() {
        return $this->prix_depart;
    }
    public function getDate_fin() {
        return $this->date_fin;
    }
    public function getModele() {
        return $this->modele;
    }
    public function getMarque() {
        return $this->marque;
    }
    public function getPuissance() {
        return $this->puissance;
    }
    public function getAnnee() {
        return $this->annee;
    }
    public function getDescription() {
        return $this->description;
    }

    public function createAnnonceFromForm($id_utilisateur, $prix_depart, $date_fin, $modele, $marque, $puissance, $annee, $description) {
        $dbh = new PDO("mysql:dbname=car_auction;host=127.0.0.1", "root", "");

        $query = $dbh->prepare("INSERT INTO annonces (id_utilisateur, prix_depart, date_fin, modele, marque, puissance, annee, description)
        VALUES (:id_utilisateur, :prix_depart, :date_fin, :modele, :marque, :puissance, :annee, :description)");
        $query->bindValue(':id_utilisateur', $id_utilisateur);
        $query->bindValue(':prix_depart', $prix_depart);
        $query->bindValue(':date_fin', $date_fin);
        $query->bindValue(':modele', $modele);
        $query->bindValue(':marque', $marque);
        $query->bindValue(':puissance', $puissance);
        $query->bindValue(':annee', $annee);
        $query->bindValue(':description', $description);
        $query->execute();

            if ($query) {
                echo "<p>Votre annonce a bien été créée.</p>";
                usleep(1000000);
                header("Location: http://localhost/exoBocal/car_auction/index.php");
                exit; 
            } else {
                echo "Erreur lors de la création de l'annonce.";
            }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $annonce = new Annonces(
        $_POST['id_utilisateur'],
        $_POST['prix_depart'],
        $_POST['date_fin'],
        $_POST['modele'],
        $_POST['marque'],
        $_POST['puissance'],
        $_POST['annee'],
        $_POST['description']
    );

    $annonce->createAnnonceFromForm(
        $_POST['id_utilisateur'],
        $_POST['prix_depart'],
        $_POST['date_fin'],
        $_POST['modele'],
        $_POST['marque'],
        $_POST['puissance'],
        $_POST['annee'],
        $_POST['description']
    );
}
?>