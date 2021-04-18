<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role']=="User") {
    header('Location: AccueilUser.php');
    exit();
}elseif (isset($_SESSION['role']) && $_SESSION['role']=="Admin") {
    header('Location: AccueilAdmin.php');
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
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>Utiliser votre mail</span>
                <input class="input" type="email" name="login" placeholder="Email" />
                <input class="input" type="password" name="mdp" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <input type="submit" class="button" name="connexion" value="Connexion">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost button" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost button" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="https://florin-pop.com">Florin Pop</a>
            - Read how I created this and how you can join the challenge
            <a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
        </p>
    </footer>
</body>

</html>
<script src="../JS/script.js"></script>