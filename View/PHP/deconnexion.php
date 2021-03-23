<?php
    session_start();
    if($_SESSION["ouvert"]==true){
        session_destroy();
        header('Location: index.php');
    }
?>