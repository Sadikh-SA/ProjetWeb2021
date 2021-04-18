<?php
    session_start();
    include '../../Controller/Service.php';
    $test = new Service();
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
    <button id="myBtn">Open Modal</button><br><br>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Modal Header</h2>
            </div>
            <div class="modal-body">
                <p>Some text in the Modal Body</p>
                <p>Some other text...</p>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>

    </div>
    <!-- <div class="photo"> -->
        <?php
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
                    echo '<div class="desc" title="'.$row['description'].'">'.$test->longText($row['description'],90).'</div>';
                echo '</div>';
            }
        ?>

    <!-- </div> -->
</body>

</html>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>