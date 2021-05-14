<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
    include '../../Controller/Service.php';
    include '../../Modele/Discussion.php';
    $test = new Service();
    $req=$test->findBy("Discussion",$_GET['idforum']);
    $req=$req->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiche Sujet </title>
    <link rel="stylesheet" href="../CSS/styleMenu.css">
    <link rel="stylesheet" href="affiche_sujet.css">
</head>

<body>
     <?php require_once("header.php"); ?>
    <div class="overlay">
              <div>

	              <h1>SUJET : <?php echo $_GET['cours'] ?> </h1>
              </div>
	                 <div class="commentaires" >
       	            	     <h3>Participer à la discussion</h3>
       	            	       <div class="form-group">
       	            	            <form method="post" action="">
       	            	            <label for="trinité">Mon commentaire</label>
                                      <textarea id="trinité" class="form-control" rows="14" placeholder="Décrivez votre sujet" name="contenu">
                                 </textarea>
                                  <div class="form-group">
                                        <button class="btn btn-primary" type="submit" name="commentaire">Envoyer</button>
                                 </div>
                                </form>
                                <?php
                                      if(isset($_POST['commentaire']))
                                      {
                                          $valid=true;
                                  
                                          if(!empty($_POST['contenu']))
                                          {
                                              $Texte =(string) htmlentities(trim($_POST['contenu']));
                                                if(empty($Texte))
                                               {
                                                   $valid=false;
                                                   $er_commentaire=["il faut mettre un commentaire"];
                                               }
                                               if($valid){
                                                   $user=$test->finds($_SESSION['user']);
                                                   $user=$user->fetch();
                                                   $disc=new Discussion($_GET['idforum'],$user['id'],$_POST['contenu'],date_format(new DateTime('NOW'), 'Y-m-d H:i:s'));
                                                   $test->add($disc);
                                                    header('Location: Affiche_sujet.php?idforum=' .$_GET['idforum'].'&cours='.$user['nom']);
                                               }
                                          }
                                      }
                                      ?>
                                 </div>
        	               
		           </div>
		           
	        <div class="commentaires" >
       	            	 <h3>Commentaires</h3>
        	            <table>
          	            <?php
            	               // On utilise la variable $r
              	        	  foreach($req as $rc){
                                $userv=$test->find("Utilisateur",$rc['idUtilisateur']);
                                $userv=$userv->fetch();
            	         ?>   
              		             <tr>
               			             <td><?= "De " .$userv['nom']. " " .$userv['prenom'] ?></td>
              			             <td><?= $rc['message'] ?></td>
				                    <td><?= $rc['dateCreation'] ?></td>
       
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