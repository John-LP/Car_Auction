<!-- Formulaire pour poster une nouvelle annonce -->
<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="./../css/styles_form.css" rel="stylesheet">
  <link href="./../css/styles_navbar.css" rel="stylesheet">
</head>
<body>
  <?php
  require __DIR__ . "/navbar.php";
  ?>
  <div id="contactForm">
    <h1 style="margin-bottom: 10px;">Votre annonce</h1>
    <form action="./../classes/class_annonce.php" method="POST">
      <input placeholder="Votre ID (visible depuis l'onglet 'Mon Profil')" type="number" name="id_utilisateur" required />
      <input placeholder="Marque du véhicule" type="text" name="marque" required />
      <input placeholder="Modèle" type="text" name="modele" required />
      <input placeholder="Prix de départ" type="number" name="prix_depart" required min="0" />
      <label>Échéance de l'enchère :</label>
      <input placeholder="Date de fin" type="date" name="date_fin" min="<?= date('Y-m-d') ?>" required />
      <input placeholder="Puissance" type="number" name="puissance" required min="0" />
      <input placeholder="Année" type="number" id="yearInput" name="annee" min="1985" step="1" required>
      <input placeholder="Description" type="textearea" name="description" required />
      <!-- <input class="file" placeholder="Inserer votre photo" type="file" name="image"  required /> -->
      <button class="formBtn" type="submit">Envoyer</button>
    </form>
  </div>
</body>
</html>  