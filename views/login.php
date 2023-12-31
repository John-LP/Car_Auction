<!-- Page de connexion/création de compte -->
<?php
    // Démarre la session pour accéder aux variables de session
    session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <title>Connexion/Inscription</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <link href="./../css/styles_login.css" rel="stylesheet">
    </head>
    <body>
        <!-- Section principale de la page -->
        <div class="section">
            <div class="container">
                <div class="row full-height justify-content-center">
                    <div class="col-12 text-center align-self-center py-5">
                        <div class="section pb-5 pt-5 pt-sm-2 text-center">
                            <!-- Lien vers la page d'accueil -->
                            <a class="accueil-login btn mt-4" href="../">ACCUEIL</a>
                            <br><br>
                            <?php
                                // Affichage des messages d'erreur ou de succès s'il y en a
                                if(isset($_SESSION['error'])) {
                                    echo "<h5>" . $_SESSION['error'] . "</h5>";
                                    echo "<br>";
                                    unset($_SESSION['error']);
                                }
                                if(isset($_SESSION['success'])) {
                                    echo "<h5>" . $_SESSION['success'] . "</h5>";
                                    echo "<br>";
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <!-- Titre de la section avec option de connexion/inscription -->
                            <h6 class="mb-0 pb-3"><span>Connexion </span><span>Inscription</span></h6>
                            <!-- Case à cocher pour basculer entre les formulaires de connexion et d'inscription -->
                            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                            <label for="reg-log"></label>

                            <!-- Conteneur pour les cartes de connexion/inscription -->
                            <div class="card-3d-wrap mx-auto">
                                <div class="card-3d-wrapper">
                                    <!-- Carte frontale pour la connexion -->
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <!-- Formulaire de connexion -->
                                                <form class="section" action="./../classes/class_login.php" method="POST">
                                                    <h4 class="mb-4 pb-3">Connexion</h4>
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-style" placeholder="Email" required>
                                                        <i class="input-icon uil uil-at"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="password" name="mdp" class="form-style" placeholder="Mot de passe" required>
                                                        <i class="input-icon uil uil-lock-alt"></i>
                                                    </div>
                                                    <button type="submit" class="btn mt-4">Se connecter</button>
                                                    <p class="mb-0 mt-4 text-center"><a href="../" class="link">Mot de passe oublié?</a></p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carte arrière pour l'inscription -->
                                    <div class="card-back">
                                        <div class="center-wrap">
                                            <div class="section text-center">
                                                <!-- Formulaire d'inscription -->
                                                <form class="section" action="./../classes/class_utilisateur.php" method="POST">
                                                    <h4 class="mb-3 pb-3">S'inscrire</h4>
                                                    <div class="form-group">
                                                        <input type="text" name="nom" class="form-style" placeholder="Nom" required>
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="tel" name="prenom" class="form-style" placeholder="Prénom" required>
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="email" name="email" class="form-style" placeholder="Email" required>
                                                        <i class="input-icon uil uil-at"></i>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <input type="password" name="mdp" class="form-style" placeholder="Mot de passe" required>
                                                        <i class="input-icon uil uil-lock-alt"></i>
                                                    </div>
                                                    <button type="submit" class="btn mt-4">Créer le compte</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Message indiquant la nécessité de se connecter pour accéder à certaines pages -->
                            <br>
                            <ul>Vous devez être connecté(e) pour accéder aux pages suivantes : 
                                <li>Créer une annonce</li>
                                <li>Mes enchères</li>
                                <li>Mon profil</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
