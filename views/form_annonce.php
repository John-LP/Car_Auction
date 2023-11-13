<!-- Formulaire pour poster une nouvelle annonce -->
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
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire d'Annonce</title>
  <link href="./../css/styles_form.css" rel="stylesheet">
  <link href="./../css/styles_navbar.css" rel="stylesheet">
</head>
<body>
  <?php
  // Inclusion de la barre de navigation
  require __DIR__ . "/navbar.php";
  ?>

  <!-- Contenu du formulaire -->
  <div id="contactForm">
    <h1 style="margin-bottom: 10px;">Votre annonce</h1>
    
    <!-- Formulaire d'annonce avec action vers la classe de gestion des annonces -->
    <form action="./../classes/class_annonce.php" method="POST" enctype="multipart/form-data">
      <!-- Champ pour l'échéance de l'enchère -->
      <label>Échéance de l'enchère :</label>
      <input type="date" name="date_fin" min="<?= date('Y-m-d') ?>" required />

      <!-- Champs pour les détails de l'annonce -->
      <input placeholder="Marque du véhicule" type="text" name="marque" required />
      <input placeholder="Modèle" type="text" name="modele" required />
      <input placeholder="Prix de départ" type="number" name="prix_depart" required min="0" />
      <input placeholder="Puissance" type="number" name="puissance" required min="0" />
      <input placeholder="Année" type="number" id="yearInput" name="annee" min="1985" step="1" required>

      <!-- Champ pour la description de l'annonce -->
      <input placeholder="Description" type="textearea" name="description" required />

      <!-- Champ pour télécharger une image -->
      <input type="file" name="image" accept="image/*" required />

      <!-- Bouton d'envoi du formulaire -->
      <button class="formBtn" type="submit">Envoyer</button>
    </form>
  </div>
</body>
</html>
