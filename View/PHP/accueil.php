<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/accueil.css">
    <title>Liste des Cours par Formations</title>
</head>
<body>
    <div class="tete"><h1>Sur quelle formation veux tu commencer?</h1>
        <p>tu pourras changer à tout moment l'abonnemenet, l'abonnement donne accès à l'intégralité des cours</p>
    </div>
    <!-- <div class="photo"> -->
        <?php
        include '../../Controller/Service.php';
        $test = new Service();
        $pdo = $test->getPDO();
        $form = $test->findBy("Cours",1);
            while ($row = $form->fetch()) {
                // echo '<a href="#">';
                //     echo '<article >';
                //         echo '<img src="../../Media/'.$row['image'].'"/><br>';
                //         echo '<h1>'.$row['nom'].'</h1>';
                //         echo '<p>'.$row['description'].'</p>';
                //     echo '</article>';
                // echo '</a>';
                echo '<div class="gallery">';
                    echo '<a target="_blank" href="#">';
                        echo '<img src="../../Media/'.$row['image'].'" alt="'.$row['nom'].'" width="600" height="400">';
                    echo '</a>';
                    echo '<h1>'.$row['nom'].'</h1>';
                    echo '<div class="desc">'.$test->longText($row['description'],90).'</div>';
                echo '</div>';
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col">
                        <p>azertyuiop</p>
                </div>
            </div>
        </div>

    <!-- </div> -->
</body>

</html>