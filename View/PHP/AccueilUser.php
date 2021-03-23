<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: index.php');
  exit();
}else {
  $_SESSION["ouvert"] = true;
  $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleUser.css">
    <title>Accueil Utilisateur</title>
</head>

<body>
    <div id="blurry-filter">
        <header>
            <div>
                <section id="folders">
                    <article>Travel</article>
                    <article>Nature</article>
                    <article>Wallpapers</article>
                </section>
            </div>
        </header>

        <main>
            <figure style='background-image: url(https://images.unsplash.com/photo-1593414220166-085caeae0382?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80)'>
                <figcaption>Cours1</figcaption>
            </figure>
            <figure style='background-image: url(https://images.unsplash.com/photo-1593414220166-085caeae0382?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80)'>
                <figcaption>Cours2</figcaption>
            </figure>
        </main>

        <footer>

        </footer>
    </div>


    <!-- main
    figure(style='background-image: url(https://images.unsplash.com/photo-1593414220166-085caeae0382?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80)')
    figcaption City-01

    figure(style='background-image: url(https://images.unsplash.com/photo-1593532847202-e818146e134a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80)')
    figcaption Painting-01

    figure(style='background-image: url(https://images.unsplash.com/photo-1593260654451-a214d27978fb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80)')
    figcaption Train-01

    figure(style='background-image: url(https://images.unsplash.com/photo-1593515529105-cec0bd21e1f7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80)')
    figcaption Sky-01

    figure(style='background-image: url(https://images.unsplash.com/photo-1593377872300-67454a2954e1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=673&q=80)')
    figcaption Citi-02

    figure(style='background-image: url(https://images.unsplash.com/photo-1592185285645-5b9d0b13743c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80)')
    figcaption Painting-02

    figure(style='background-image: url(https://images.unsplash.com/photo-1593260654784-4aa47cd0c803?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80)')
    figcaption City-03

    figure(style='background-image: url(https://images.unsplash.com/photo-1593174942395-f7bc79522493?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80)')
    figcaption Nature-01

    figure(style='background-image: url(https://images.unsplash.com/photo-1593055132632-6aeec3f1dc00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80)')
    figcaption Nature-02

    figure(style='background-image: url(https://images.unsplash.com/photo-1593201007276-bd95963531b2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80)')
    figcaption Sky-02

    figure(style='background-image: url(https://images.unsplash.com/photo-1593157729036-ad7c7bb719c6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80)')
    figcaption City-04


    footer -->