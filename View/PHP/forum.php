<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
    include '../../Controller/Service.php';
    $test = new Service();
    $res=$test->findAll("Cours");
    $req=$res->fetchAll();   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../CSS/styleMenu.css">
</head>

<body>
    <?php require_once("header.php"); ?>
      <div class="overlay">
      <h1>FORUM</h1>  
      <div>
        <table>
            <tr>
                <th>Cours</th>
                <th>Date Création</th>
            </tr>
            <?php
                // On utilise la variable $r
                foreach($req as $r){
            ?>   
                <tr>
                <td> <a href="Affiche_sujet.php?idforum=<?=$r['id']?>&cours=<?=$r['nom']?>"> <?= $r['nom'] ?></a></td> <!-- On affiche le nom de la personne  -->
               <td><?php echo date_format(new DateTime($r["dateCreation"]), "Y-m-d")?></td>
                </tr>
            <?php
            }
            ?>
     </table>
     </div>
    </div>

</body>

</html>
<script>
    if (localStorage.getItem("couleur")) {
        document.body.style.backgroundColor=localStorage.getItem("couleur");
    }
</script>