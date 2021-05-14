<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
?>
<nav class="style-3">
	  <ul class="menu-3">
		<li><a href="Cours.php">Accueil</a></li>
		<li><a href="Cours.php">Cours</a></li>
		<li><a href="forum.php">Forum</a></li>
        <?php if ($_SESSION['role']!='User') {
            echo '<li><a href="gestion_users.php">Gestion Utilisateur</a></li>';
        }
        ?>
		<li><a href="deconnexion.php">Déconnexion</a></li>
	  </ul>
</nav>