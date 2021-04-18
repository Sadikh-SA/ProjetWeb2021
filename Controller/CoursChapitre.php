<?php
session_start();
include 'Service.php';
include '../Modele/Cours.php';
$test = new Service();
// Vérifier si le formulaire a été soumis
if(isset($_POST["addCours"])){
    $nom=$_POST["nom"];
    $description=$_POST["description"];
    $idformation = $_POST['formation'];
    $donnee=$test->find("Formation",$idformation);
    $date = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $formation=$donnee->fetch();
    // Vérifie si le fichier a été uploadé sans erreur.
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];
    // Vérifie l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

    // Vérifie la taille du fichier - 5Mo maximum
    $maxsize = 8 * 1024 * 1024;
    if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

    // Vérifie le type MIME du fichier
    if(in_array($filetype, $allowed)){
    // Vérifie si le fichier existe avant de le télécharger.
        if(file_exists("../Media/" . $filename)){
            echo $filename . " existe déjà.";
        } else{
            move_uploaded_file($_FILES["image"]["tmp_name"], "../Media/". $filename);
            $cours = new Cours($nom, $description, $filename,$date,$formation['id']);
            $insert = $test->add($cours);
            if ($insert) {
                header('Location: ../View/PHP/accueil.php');
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Oups!!! Erreur inattendue');</script>";
            }
        } 
    } else{
        echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
    }
}elseif (isset($_POST["addCours"])) {
    $titre=$_POST["titre"];
    $description=$_POST["description"];
    $idformation = $_POST['formation'];
    $donnee=$test->find("Formation",$idformation);
    $date = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $formation=$donnee->fetch();
}
?>