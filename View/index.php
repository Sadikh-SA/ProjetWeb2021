<?php
include '../Controller/Service.php';
include '../Modele/Utilisateur.php';
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
    <link rel="stylesheet" href="style.css">
</head>

<body onload="">
    <h2>Bienvenue dans votre plateforme e-learning</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" method="POST">
                <h1>Creer Compte</h1>
                <span>utilisez votre email pour vous inscrire</span>
                <input class="input" type="text" name="nom" placeholder="Nom" required />
                <input class="input" type="text" name="prenom" placeholder="Prénom" required />
                <input class="input" type="email" name="mail" placeholder="Email" required />
                <input class="input" type="password" name="pwd" placeholder="Password" required />
                <input class="input" type="password" name="pwd1" placeholder="Password" required />
                <input type="submit" class="button" name="inscrire" value="Inscrire">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Connexion</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>Utiliser votre mail</span>
                <input class="input" type="email" name="mail" placeholder="Email" />
                <input class="input" type="password" name="pwd" placeholder="Password" />
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

<?php


if (isset($_POST['inscrire'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];
    $pwd1 = $_POST['pwd1'];

    if ($pwd != $pwd1) {
        echo "<script type='text/javascript'>alert('Les deux mots de passes ne sont pas conforme.');</script>";
    } else {
        $users = $test->findAll("Utilisateur");
        while ($row = $users->fetch()) {
            if (strtolower($row['mail']) == strtolower($mail)) {
                return "<script type='text/javascript'>alert('Ce mail existe Déjà.');</script>";
            }
        }
        $date = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
        $user = new Utilisateur($nom, $prenom, $mail, "User", $pwd, $date);
        $insert = $test->add($user);
        if ($insert) {
            echo "<script type='text/javascript'>alert('Inscription réussi.');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Oups!!! Erreur inattendue');</script>";
        }
    }
}


//     // include '../Classes/ServiceEtudiant.php';
//     // $test = new Service();		
//     if ($bourse == "NonBoursier") {
//         $adresse=$_POST['adresse'];
//         // $donne = new NonBoursier($matricule,$nom,$prenom,$tel,$mail,$ddn,$adresse);
//         $insert = $test->add($donne);
//         if ($insert) {
//             echo "<h2 class='reponse'>INSERTION D'UN ETUDIANT NON BOURSIER RÉUSSIE</h2>";
//         } else {
//             echo "<h2 class='reponse'>CE MATRICULE EXISTE DEJA</h2>";
//         }

//     }
//     else {
//         $loger = $_POST['loger'];

//         if ($bourse =="Boursier" && $loger=="NonLoger") {
//             $type = $_POST['situation'];
//             // $donnes = new Boursier($matricule,$nom,$prenom,$tel,$mail,$ddn,$type);
//             $insert = $test->add($donnes);
//             if ($insert) {
//                 echo "<h2 class='reponse'>INSERTION D'UN ETUDIANT BOURSIER ET NON LOGER RÉUSSIE</h2>";
//             } else {
//                 echo "<h2 class='reponse'>CE MATRICULE EXISTE DEJA</h2>";
//             }
//         }

//         elseif ($bourse =="Boursier" && $loger =="Loger") {
//             $chambre = $_POST['chambre'];
//             $batiment = $_POST['batiment'];
//             $type = $_POST['situation'];
//             // $donness = new Loger($matricule,$nom,$prenom,$tel,$mail,$ddn,$type,$chambre,$batiment);
//             $insert = $test->add($donness);
//             if ($insert) {
//                 echo "<h2 class='reponse'>INSERTION D'UN ETUDIANT BOURSIER ET LOGER RÉUSSIE</h2>";
//             } else {
//                 echo "<h2 class='reponse'>CE MATRICULE EXISTE DEJA</h2>";
//             }
//         }	

//     }
// }else {
//     $mail=$_POST['mail'];
//     $pwd=$_POST['pwd'];
// }



?>


<script src="script.js"></script>