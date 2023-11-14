<!-- Page affichant les annonces suivies par l'utilisateur -->
<?php
  // Démarre la session pour accéder aux variables de session
  session_start();

  // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
  if(!isset($_SESSION['email'])) {
    header("Location: ../views/login");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../css/styles_card.css" rel="stylesheet" type="text/css" />
    <link href="./../css/styles_navbar.css" rel="stylesheet">
    <title>Annonces suivies</title>
</head>

<body>
<!-- Inclusion de la barre de navigation -->
<?php
    require_once __DIR__ . "/navbar.php";
    require_once __DIR__ . "./../classes/class_serveur.php";
    require_once __DIR__ . "./../classes/class_enchere.php";

    if (isset($_SESSION['id_utilisateur'])) {
      $id_utilisateur = $_SESSION['id_utilisateur'];

      // Requête SQL pour obtenir les enchères remportées par l'utilisateur actuel
      $query = $dbh->prepare("  SELECT 
      annonces.*, 
      encheres.montant AS montant_enchere, 
      encheres.id_utilisateur AS id_utilisateur_enchere, 
      encheres.date_heure_enchere, 
      utilisateurs.nom, 
          utilisateurs.prenom 
      FROM 
          annonces 
      LEFT JOIN 
          encheres ON annonces.id_annonce = encheres.id_annonce 
      LEFT JOIN 
          utilisateurs ON encheres.id_utilisateur = utilisateurs.id_utilisateur 
      WHERE 
          encheres.id_utilisateur = :id_utilisateur 
          AND annonces.date_fin < NOW() 
          AND encheres.montant = (
              SELECT 
                  MAX(montant) 
              FROM 
                  encheres 
              WHERE 
                  encheres.id_annonce = annonces.id_annonce
          )
      ORDER BY 
          encheres.montant DESC");
  
      $query->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_ASSOC);
      
      if ($results && count($results) > 0) {
        foreach ($results as $result) {
          echo '<article>';
          echo '<section class="card">';
          echo '<div class="text-content">';
          echo "<h3>" . $result['marque'] . " " . $result['modele'] . "</h3>";
          echo "<p><u>Année :</u>" . " " . $result['annee'] . "</p>";
          echo "<p><u>Prix de départ :</u> " . $result['prix_depart'] . " €" . "</p>";
          echo "<p>" . "Vous avez remporté le bien" . "<br>" . "avec une enchère de " . $result['montant_enchere'] . " €" . "<br>" . " le " . $result['date_heure_enchere'] . "</p>";
          echo "<p><u>Échéance de l'enchère :</u> " . $result['date_fin'] . "</p>";
          echo "<p>" . $result['description'] . "</p>";
          echo '<br><br>';
          echo '<a href="../">Retour</a>';
          echo '</div>';
          echo '<div class="visual">';
          echo "<img src='" . $result['image_path'] . "' alt />";
          echo '</div>';
          echo '</section>';
          echo '</article>';
        }
      } else {
        echo '<article>';
        echo '<section class="card">';
        echo '<div class="text-content">';
        echo "<p>Vous n'avez aucune enchère remportée.</p>";
        echo '<a href="../">Retour</a>';
        echo '</div>';
        echo '</section>';
        echo '</article>';
      }

  }
?>
</body>
</html>
