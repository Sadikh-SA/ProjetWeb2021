<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
    $chapitre=$_GET["chapitre"];
    include '../../Controller/Service.php';
    $test = new Service();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="../CSS/formulaire.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
  <meta charset="utf-8" />
  <title></title>

<body>

<?php
  $row = $test->find("Chapitre", $chapitre);
  $form = $row->fetch();
  $all = $test->findBy("Chapitre",$_SESSION["cours"]);
  $cours = $test->find("Cours",$form['idCours']);
  $idCours=$cours->fetch();
?>

  <form method="POST" action="#">
    <header style="border-bottom: ridge">
      <div class="log">
       <?php echo'<a href="Cours.php"><img src="../../Media/'.$idCours['image'].'" alt="Image cours"></a>'; ?>
      </div>
      <div class="logo">
        <input type="search" id="recherche" name="s" placeholder="recherche">
        <input type="submit" class="btn" id="envoyer" value="Chercher" name="Chercher">
        <input id="myBtn" class="btn" type="button" name="add" value="Ajouter Chapitre">
        <a href="deconnexion.php" id="deconn" class="btn">Déconnexion</a>
      </div>
    </header>
    <nav>
      <button class="bt" name="video">vidéo</button>
      <button class="bt" name="cours">cours</button>
      <button class="bt" name="quizz">quizz</button>
      <hr>
      <?php
      // while ($ligne= $all->fetch()) {
      //   # code...
      //   if ($ligne['id']==$chapitre-1) {
      //     # code...
      //     echo "<a href='page.php?Chapitre=".$ligne['id']."'><span>Suivant</span></a>";
      //   }
      //   if ($ligne['id']==$chapitre+1) {
      //     # code...
      //     echo "<a href='page.php?Chapitre=".$ligne['id']."'><span>Suivant</span></a>";
      //   }
      // }
      ?>
    </nav>
    <?php
    if (isset($_POST['video'])) {
      $ret = "";
      $ret .= "<article style='border-left: ridge'>";
      $ret .= "<iframe src='../../Media/".$form['videos']."'>";
      $ret .= "</iframe>";
      $ret .= "</article>";
      echo $ret;
    }

    if (isset($_POST['cours'])) {
      $ret = "";
      $ret .= "<article style='border-left: ridge'>";
      $ret .= "<iframe src='../../Media/".$form['fichiers']."'>";
      $ret .= "</iframe>";
      $ret .= "</article>";
      echo $ret;
    }
    if (isset($_POST['quizz'])) {
      $ret = "";
      $ret .= "<article style='border-left: ridge'>";
      $ret .= "<iframe src='question.php?ident=".$form['id']."'>";
      $ret .= "</iframe>";
      $ret .= "</article>";
      echo $ret;
    }
    ?>
  </form>

<!-- The Modal pour ajouter chapitre-->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Ajouter un Chapitre</h2>
    </div>
    <div class="modal-body">
        <form action="../../Controller/CoursChapitre.php" class="form" method="POST" enctype="multipart/form-data">
            <input class="input" type="text" name="nom" placeholder="Nom du Chapitre (Module) facultatif"/>
            <input class="input" type="file" name="videos" title="Chapitre en vidéo (mp4/amv/...)" required />
            <input class="input" type="file" name="fichiers" title="Chapitre en fichiers (pptx/doc/pdf/...)" required />
            <input class="input" type="file" name="qcm" title="Le questionnaire (QCM en xml) alternatif" />
            <input type="submit" class="button" name="addChapitre" value="Ajouter">
        </form>
    </div>
    <div class="modal-footer">
        <h3>Modal Footer</h3>
    </div>
</div>

</div>


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
    if (localStorage.getItem("couleur")) {
        document.body.style.backgroundColor=localStorage.getItem("couleur");
    }
</script>