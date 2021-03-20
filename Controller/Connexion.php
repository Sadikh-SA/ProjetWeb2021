<?php
include 'Service.php';
include '../Modele/Utilisateur.php';
$test = new Service();
$pdo = $test->getPDO();

if (isset($_POST['inscrire'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];
    $pwd1 = $_POST['pwd1'];
    $idformation = $_POST['formation'];

    if ($pwd != $pwd1) {
        echo "<script type='text/javascript'>alert('Les deux mots de passes ne sont pas conforme.');</script>";
    } else {
        $users = $test->findAll("Utilisateur");
        while ($row = $users->fetch()) {
            if (strtolower($row['mail']) == strtolower($mail)) {
                echo "<script type='text/javascript'>alert('Ce mail existe Déjà.');</script>";
                exit();
            }
        }
        $donnee=$test->find("Formation",$idformation);
        $date = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
        $formation=$donnee->fetch();
        $user = new Utilisateur($nom, $prenom, $mail, "User", $pwd, $date,$formation['id']);
        $insert = $test->add($user);
        if ($insert) {
            echo "<script type='text/javascript'>alert('Inscription réussi.');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Oups!!! Erreur inattendue');</script>";
        }
    }
}else {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $users = $test->findAll("Utilisateur");
    while ($row = $users->fetch()) {
        if (strtolower($row['mail']) == strtolower($login) && $row['password']==$mdp) {
            if (strtolower($row['role'])==strtolower('Admin')) {
                echo "<script type='text/javascript'>alert('Page Administrateur');</script>";
                header('Location: ../View/index.php');
                exit();
            }
            echo "<script type='text/javascript'>alert('Page Utilisateur');</script>";
            header('Location: ../View/index.php');
            exit();
        }
    }
    echo "<script type='text/javascript'>alert('Login ou Mot de Passe incorrecte.');</script>";
    header('Location: ../View/index.php');
}
?>