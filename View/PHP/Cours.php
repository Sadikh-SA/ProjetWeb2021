<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
    include '../../Controller/Service.php';
    $test = new Service();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleMenu.css">
    <link rel="stylesheet" href="../CSS/cours.css">
    <title>Les Cours</title>
</head>

<body>
    <?php
        require_once("header.php");
        
        /* Trigger/Open The Modal */
        if ($_SESSION['role']!="User") {
            echo '<div><button id="myBtn" class="button" style="float: right;">Ajouter Cours</button></div><br><br>';
        }
    ?>

    <!-- The Modal pour ajouter cours-->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Ajouter un cours</h2>
            </div>
            <div class="modal-body">
                <form action="../../Controller/CoursChapitre.php" method="POST" enctype="multipart/form-data">
                    <input class="input" type="text" name="nom" placeholder="Nom du Cours (Module)" required />
                    <textarea class="input" name="description" placeholder="Description du cours" cols="30" rows="10" required></textarea>
                    <input class="input" type="file" name="image" placeholder="Image ou Logo du Cours en question" required />
                    <select name="formation" class="input" placeholder="Choisir une formation" required>
                        <option class="input" value="">Choisir une formation</option>
                        <?php
                        $form = $test->findAll("Formation");
                        while ($row = $form->fetch()) {
                            echo "<option class='input' value='" . $row['id'] . "'>" . $row['titre'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" class="button" name="addCours" value="Ajouter">
                </form>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>

    </div>
    <?php
    $form = $test->findBy("Cours", $_SESSION['formation']);
    while ($row = $form->fetch()) {
        echo '<div class="gallery">';
        echo '<a href="Chapitre.php?cours='.$row['id'].'">';
        echo '<img src="../../Media/' . $row['image'] . '" alt="' . $row['nom'] . '" width="600" height="400">';
        echo '</a>';
        echo '<h1>' . $row['nom'] . '</h1>';
        echo '<div class="desc" title="' . $row['description'] . '">' . $test->longText($row['description'], 90) . '</div>';
        echo '</div>';
    }
    ?>

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