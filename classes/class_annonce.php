<?php

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

    public function createAnnonceFromForm($id_utilisateur, $prix_depart, $date_fin, $modele, $marque, $puissance, $annee, $description, $imagePath) {
        require_once __DIR__ . "/class_serveur.php";
        $query = $dbh->prepare("INSERT INTO annonces (id_utilisateur, prix_depart, date_fin, modele, marque, puissance, annee, description, image_path)
        VALUES (:id_utilisateur, :prix_depart, :date_fin, :modele, :marque, :puissance, :annee, :description, :imagePath)");
        $query->bindValue(':id_utilisateur', $id_utilisateur);
        $query->bindValue(':prix_depart', $prix_depart);
        $query->bindValue(':date_fin', $date_fin);
        $query->bindValue(':modele', $modele);
        $query->bindValue(':marque', $marque);
        $query->bindValue(':puissance', $puissance);
        $query->bindValue(':annee', $annee);
        $query->bindValue(':description', $description);
        $query->bindValue(':imagePath', $imagePath);
        $query->execute();

        if ($query) {
            echo "<p>Votre annonce a bien été créée.</p>";
            usleep(1000000);
            header("Location: http://localhost:8888/php/car_auction/index.php");
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

    $targetDirectory = "E:/wamp64/www/images/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $imagePath = "http://localhost/images/" . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Le fichier " . htmlspecialchars(basename($_FILES["image"]["name"])) . " a été téléchargé.";
        $annonce->createAnnonceFromForm(
            $_POST['id_utilisateur'],
            $_POST['prix_depart'],
            $_POST['date_fin'],
            $_POST['modele'],
            $_POST['marque'],
            $_POST['puissance'],
            $_POST['annee'],
            $_POST['description'],
            $imagePath
        );
    } else {
        echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
    }

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "Le fichier est une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($targetFile)) {
        echo "Le fichier existe déjà.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        echo "Votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Votre fichier n'a pas été téléchargé.";

    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "Le fichier " . htmlspecialchars(basename($_FILES["image"]["name"])) . " a été téléchargé.";

        } else {
            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
}
?>
