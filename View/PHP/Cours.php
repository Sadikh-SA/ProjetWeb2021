<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
} else {
    $_SESSION["ouvert"] = true;
}
require_once '../../Controller/Service.php';
$test = new Service();
$pdo = $test->getPDO();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleAdmin.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Accueil Administrateur</title>
</head>

<body>
    <section>
        <span>Projet Web 2021</span>
    </section>
    <!-- <header>
        <h1>E-Learning</h1>
        <nav>
            <a href=#>Accueil</a>
            <a href=#>Formation</a>
            <a href=#>Cours</a>
            <a href=#>Forum</a>
            <a href=deconnexion.php>Déconnexion</a>
        </nav>
    </header> -->
    <article>
        <form action="../../Controller/CoursChapitre.php" method="POST" enctype="multipart/form-data">
            <h1>Ajouter Un cours</h1>
            <input class="input" type="text" name="nom" placeholder="Nom du Cours (Module)" required />
            <textarea class="input" name="description" placeholder="Description du cours" cols="30" rows="10" required></textarea>
            <input class="input" type="file" name="image" placeholder="Image ou Logo du Cours en question" required />
            <select name="formation" class="input">
                <?php
                $form = $test->findAll("Formation");
                while ($row = $form->fetch()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['titre'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" class="button" name="addCours" value="Ajouter">
        </form>
    </article>
</body>

</html>