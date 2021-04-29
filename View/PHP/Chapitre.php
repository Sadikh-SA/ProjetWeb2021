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
    if ($_SESSION['role'] != "User") {
        echo '<div><button id="myBtn" class="button" style="float: right;margin-right: 12%">Ajouter Chapitre</button>'.
        '<button id="myBtns" class="button" style="float: right;">Ajouter QCM</button></div><br><br><br><br>';
    }
    ?>
    <!-- The Modal pour ajouter cours-->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Ajouter un Chapitre</h2>
            </div>
            <div class="modal-body">
                <form action="../../Controller/CoursChapitre.php" class="form" method="POST" enctype="multipart/form-data">
                    <input class="input" type="text" name="titre" placeholder="Nom du Chapitre " required />
                    <textarea class="input" name="description" placeholder="Description du chapitre" cols="30" rows="7" required></textarea>
                    <input class="input" type="file" name="videos" title="Chapitre en vidéo (mp4/amv/...)" required />
                    <input class="input" type="file" name="fichiers" title="Chapitre en fichiers (pptx/doc/pdf/...)" required />
                    <input class="input" type="file" name="qcm" title="Le questionnaire en xml (Peut être renseigner plus tard)" />
                    <input type="submit" class="button" name="addChapitre" value="Ajouter">
                </form>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>

    </div>
    <?php
    $form = $test->findBy("Chapitre", $_GET['cours']);
    $_SESSION['cours']=$_GET['cours'];
    while ($row = $form->fetch()) {
        echo "<a href='page.php?chapitre=" . $row['id'] . "'><div style='padding: 28px 17px; border: #FF416C solid; background: none no-repeat scroll 15px 50%; width: 60%; margin: 0 auto; border-radius: 12px;  text-align: center'>Chapitre " . $row['id'] . "</div></a>";
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