<?php
session_start();
include 'Service.php';
include '../Modele/Chapitre.php';
include '../Modele/Cours.php';
$test = new Service();
$medialocation = "../Media/";
// Vérifier si le formulaire a été soumis
if (isset($_POST["addCours"])) {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $idformation = $_POST['formation'];
    $donnee = $test->find("Formation", $idformation);
    $date = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $formation = $donnee->fetch();
    // Vérifie si le fichier a été uploadé sans erreur.
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];
    // Vérifie l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) {
        die("Erreur : Veuillez sélectionner un format de fichier valide.");
    }

    // Vérifie la taille du fichier - 5Mo maximum
    $maxsize = 8 * 1024 * 1024;
    if ($filesize > $maxsize) {
        die("Error: La taille du fichier est supérieure à la limite autorisée.");
    }

    // Vérifie le type MIME du fichier
    if (in_array($filetype, $allowed)) {
        $cours = new Cours($nom, $description, $filename, $date, $formation['id']);
        $insert = $test->add($cours);
        if ($insert) {
            if (!file_exists($medialocation . $filename)) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $medialocation . $filename);
            }
            header('Location: ../View/PHP/Cours.php');
            exit();
        } else {
            echo "<script type='text/javascript'>alert('Oups!!! Erreur inattendue');</script>";
        }
    } else {
        echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
    }
} elseif (isset($_POST["addChapitre"])) {
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $date = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
    $videoname = $_FILES["videos"]["name"];
    $fichiername = $_FILES["fichiers"]["name"];
    $qcmname = $_FILES["qcm"]["name"];
    /*Vérifie si le fichier a été uploadé sans erreur.*/
    // $allowed = array("mp4" => "video/mp4", "mpg" => "video/mpg", "mp3" => "audio/mp3", "mp3" => "video/mp3");
    // $videotype = $_FILES["videos"]["type"];
    // $videosize = $_FILES["videos"]["size"];
    // // Vérifie l'extension du fichier
    // $ext = pathinfo($videoname, PATHINFO_EXTENSION);
    // if (!array_key_exists($ext, $allowed)) {
    //     die("Erreur : Veuillez sélectionner un format de fichier vidéo valide.");
    // }
    // Vérifie le type MIME du fichier
    //if (in_array($filetype, $allowed)) {
        $chapitre = new Chapitre($titre, $description, $videoname, $fichiername, $qcmname, $date, $_SESSION['cours']);
        var_dump($chapitre);echo "<br><br>";
        var_dump(!file_exists($medialocation . $videoname));
        $insert = $test->add($chapitre);
        if ($insert) {
            if (!file_exists($medialocation . $videoname)) {
                move_uploaded_file($_FILES["videos"]["tmp_name"], $medialocation . $videoname);
            }
            if (!file_exists($medialocation . $fichiername)) {
                move_uploaded_file($_FILES["fichiers"]["tmp_name"], $medialocation . $fichiername);
            }
            if (!file_exists($medialocation . $qcmname)) {
                move_uploaded_file($_FILES["qcm"]["tmp_name"], $medialocation . $qcmname);
            }
            header('Location: ../View/PHP/Chapitre.php?cours='.$_SESSION["cours"].'');
            exit();
        } else {
            echo "<script type='text/javascript'>alert('Oups!!! Erreur inattendue');</script>";
        }
    // } else {
    //     echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
    // }
}
