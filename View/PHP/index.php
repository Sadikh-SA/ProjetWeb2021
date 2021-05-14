<?php
session_start();
if (isset($_SESSION['role'])) {
    header('Location: Cours.php');
    exit();
}
include '../../Controller/Service.php';
$test = new Service();
$pdo = $test->getPDO();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Web - 2021</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body onload="">
    <h2>Bienvenue dans votre plateforme e-learning</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../../Controller/Connexion.php" method="POST">
                <h1>Creer Compte</h1>
                <span>utilisez votre email pour vous inscrire</span>
                <input class="input" type="text" name="nom" placeholder="Nom" required />
                <input class="input" type="text" name="prenom" placeholder="Prénom" required />
                <input class="input" type="email" name="mail" placeholder="Email" required />
                <input class="input" type="password" name="pwd" placeholder="Password" required />
                <input class="input" type="password" name="pwd1" placeholder="Password" required />
                <select name="formation" class="input">
                <?php
                    $form = $test->findAll("Formation");
                    while ($row = $form->fetch()) {
                        echo "<option value='".$row['id']."'>".$row['titre']."</option>";
                    }
                ?>
                </select>
                <input type="submit" class="button" name="inscrire" value="Inscrire">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../../Controller/Connexion.php" method="POST">
                <h1>Connexion</h1>
                <div class="social-container">
                    <a href="#" class="social"><em class="fab fa-facebook-f"></em></a>
                    <a href="#" class="social"><em class="fab fa-google-plus-g"></em></a>
                    <a href="#" class="social"><em class="fab fa-linkedin-in"></em></a>
                </div>
                <span>Utiliser votre mail</span>
                <input class="input" type="email" name="login" placeholder="Email" />
                <input class="input" type="password" name="mdp" placeholder="Password" />
                <a href="#">Mot de passe oublié?</a>
                <input type="submit" class="button" name="connexion" value="Connexion">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Rebienvenue!</h1>
                    <p>Plateforme de E-learning pour des formations enrichissantes</p>
                    <button class="ghost button" id="signIn">Connecter</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bienvenue le nouveau</h1>
                    <p>Entre tes informations pour bénéficier des formations enrichissantes</p>
                    <button class="ghost button" id="signUp">Inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            créer <em class="fa fa-heart"></em> par
            <a target="_blank" href="https://github.com/Sadikh-SA">Sadikh</a>
            - informations me concernant voila un lien
            <a target="_blank" href="https://github.com/Sadikh-SA">ici</a>.
        </p>
    </footer>
</body>

</html>
<script src="../JS/script.js"></script>
<script>
    if (localStorage.getItem("couleur")) {
        document.body.style.backgroundColor=localStorage.getItem("couleur");
    }
</script>