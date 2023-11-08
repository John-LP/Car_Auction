<!-- Formulaire pour poster une nouvelle annonce -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="./../css/styles_form.css" rel="stylesheet">
</head>
<body>
  <?php
  require __DIR__ . "/navbar2.php";
  ?>
  <div id="contactForm">
    <h1 style="margin-bottom: 10px;">Votre annonce</h1>
    <form action="class_annonce.php">
      <input placeholder="Name" type="text" required />
      <input placeholder="Email" type="email" required />
      <input placeholder="Subject" type="text" required />
      <input placeholder="Message"/>
      <button class="formBtn" type="submit">Submit</button>
    </form>
  </div>
  <script src="/js/main.js"></script>
</body>
</html>
