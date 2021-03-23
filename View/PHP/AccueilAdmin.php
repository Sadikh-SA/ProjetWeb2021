<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: index.php');
  exit();
}else {
  $_SESSION["ouvert"] = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/styleAdmin.css">
  <title>Accueil Administrateur</title>
</head>

<body>
  <section>
    <span>Projet Web 2021</span>
  </section>
  <header>
    <h1>E-Learning</h1>
    <nav>
      <a href=#>Accueil</a>
      <a href=#>Formation</a>
      <a href=#>Cours</a>
      <a href=#>Forum</a>
      <a href=deconnexion.php>Déconnexion</a>
    </nav>
  </header>
  <article>
    <h1>Headline</h1>
    <p>In elementum lorem eget est euismod ornare. Phasellus sit amet pellentesque mauris. Aliquam quis malesuada ex. Nullam eu aliquam nibh. Mauris molestie, urna accumsan ornare semper, augue nibh posuere lorem, vitae feugiat sem magna eget massa. Vivamus quis tincidunt dolor. Fusce efficitur, orci non vestibulum consequat, lectus turpis bibendum odio, in efficitur leo felis sed justo. Fusce commodo iaculis orci, quis imperdiet urna. Sed mollis facilisis lacus non condimentum. Nunc efficitur massa non neque elementum semper. Vestibulum lorem arcu, tincidunt in quam et, feugiat venenatis augue. Donec sed tincidunt tellus, a facilisis magna. Proin sit amet viverra nibh, bibendum gravida felis. Vivamus ut nunc id mauris posuere pellentesque. Praesent tincidunt id odio id feugiat.</p>
    <p>In ac nisi lacus. Fusce est dolor, tincidunt ut bibendum vitae, fermentum ac quam. Aliquam pretium tristique nibh quis iaculis. In et cursus ex, eu aliquet ex. Proin facilisis lacus sit amet sapien ultrices, ut vehicula arcu lobortis. Vivamus mollis ipsum ut hendrerit molestie. Morbi lacinia, sapien eu dictum dignissim, tellus tortor congue magna, sit amet bibendum libero nisi id massa.</p>
    <p>Donec arcu elit, euismod vel lobortis eu, fringilla sit amet dolor. Cras congue, massa nec sagittis mollis, dui felis ultrices magna, tincidunt finibus lorem quam in sem. Morbi odio turpis, pulvinar sit amet vulputate quis, ultricies eu libero. Donec ac maximus neque, nec maximus nibh. Morbi rhoncus convallis urna, accumsan porta lorem hendrerit in. Cras eget nisl dui. Morbi faucibus nisi eget ipsum semper vulputate. Mauris nec tincidunt lectus. Aenean ac mi consequat velit dignissim consectetur. Fusce placerat ac ipsum ac eleifend. Aenean quis faucibus ex.</p>
    <p>Cras egestas tempor nibh, a fermentum lorem sollicitudin non. Nulla facilisi. In at elit id leo tristique condimentum. Donec at est nulla. Mauris egestas magna ut laoreet pretium. Sed ultrices suscipit vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id sapien eros. Vivamus viverra ultricies gravida. Nam urna nibh, blandit a vulputate at, vehicula non nulla. Aenean ut nulla leo. Praesent in ullamcorper est.</p>
    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus bibendum nec arcu eu lobortis. Nam convallis faucibus ante sed porta. Nullam ut convallis elit, quis venenatis nunc. Curabitur sed sem eget velit condimentum rutrum in et orci. Nunc non suscipit eros. Suspendisse porta sem vel justo commodo dictum. Aliquam erat ligula, fringilla nec suscipit sed, porta vitae turpis. Vestibulum rhoncus placerat nulla vitae suscipit. Curabitur consectetur ex ut odio tristique vehicula. Ut ligula tortor, tincidunt quis sodales vitae, ornare a turpis. Proin sit amet finibus enim. Fusce tempus a neque vitae tempor. Aenean rutrum, libero iaculis interdum vulputate, dui eros vehicula nisi, at interdum enim lacus eu diam.</p>
  </article>
</body>

</html>