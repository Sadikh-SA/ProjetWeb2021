<?php
    session_start();
   include('connexionDB.php');
   $get_id=(int) trim(htmlentities($_GET['id']));
   if(empty($get_id))
   {
       header('location: forum.php');
       exit;
   }
    $req=$DB->query("SELECT T.* , DATE_FORMAT(date_creation, ' le %d/%m/%Y à %H\h%i') as date_c, U.prenom
        FROM sujet T
	LEFT JOIN utilisateur U ON U.id = T.id_utilisateur
        WHERE T.id_forum = ?
        ORDER BY T.date_creation DESC",
          array($get_id));
      
        $req=$req->fetchAll();   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sujet </title>
    <link rel="stylesheet" href="/CSS/style.css">
</head>

<body onload="">
      <div class="overlay">
           
        <table>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                 <th>Date</th>
		    <th>Par</th>
     
      
            </tr>
            <?php
                // On utilise la variable $r
                foreach($req as $r){
            ?>   
                <tr>
                <td><?= $r['id'] ?></td> <!-- On afficher l'ID de la personne -->
                <td><a href="Affiche_sujet.php?id_forum=<?=$r['id_forum']?>&id_sujet=<?=$r['id']?>"><?= $r['titre'] ?></a></td>
                <td><?= $r['date_c'] ?></td>
		        <td><?= $r['prenom'] ?></td>
       
                </tr>
            <?php
            }
            ?>
     </table>
    </div>

</body>

</html>
