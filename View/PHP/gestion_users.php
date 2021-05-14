<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
$ident = $_GET["ident"];
include '../../Controller/Service.php';
$test = new Service();
$form = $test->findAll("Utilisateur");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styleMenu.css">
    <title>Gestion Users</title>
    <style>

        h1{
        font-size: 30px;
        text-transform: uppercase;
        font-weight: 300;
        text-align: center;
        margin-bottom: 15px;
        }
        table{
        width:100%;
        table-layout: fixed;
        }
        .tbl-header{
        background-color: rgba(255,255,255,0.3);
        }
        .tbl-content{
        height:300px;
        overflow-x:auto;
        margin-top: 0px;
        border: 1px solid rgba(255,255,255,0.3);
        }
        th{
        padding: 20px 15px;
        text-align: left;
        font-weight: 500;
        text-transform: uppercase;
        }
        td{
        padding: 15px;
        text-align: left;
        vertical-align:middle;
        font-weight: 300;
        border-bottom: solid 1px rgba(255,255,255,0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{
        font-family: 'Roboto', sans-serif;
        }
        section{
        margin: 50px;
        }


        /* follow me template */
        .made-with-love {
        margin-top: 40px;
        padding: 10px;
        clear: left;
        text-align: center;
        font-size: 10px;
        font-family: arial;
        }
        .made-with-love i {
        font-style: normal;
        font-size: 14px;
        position: relative;
        top: 2px;
        }
        .made-with-love a {
        text-decoration: none;
        }
        .made-with-love a:hover {
        text-decoration: underline;
        }


        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        }
    </style>
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <section>
        <!--for demo wrap-->
        <h1>Liste des Utilisateurs</h1>
        <div class="tbl-header">
            <table aria-describedby="desc" border="0">
                <thead>
                    <tr>
                        <th id="nom">Nom Utilisateur</th>
                        <th id="mail">Email</th>
                        <th id="dateCreation">Date de Création</th>
                        <th id="formation">Formation</th>
                        <th id="Action">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table aria-describedby="mydesc" border="0" class="display" id="example">
                <tbody>
                    <?php
                    while ($data = $form->fetch()) {
                        
                        echo '<tr class="gradeX">';
                        $formation = "*********";
                        $status = "Débloquer";
                        if ($data['type'] == 1) {
                            $status = "Bloquer";
                        }
                        if ($data["role"] == "Admin") {
                            $role_user = "Administrateur";
                            $formations = "TOUS";
                        } else {
                            $role_user = "Apprenant";
                            $formation = $test->find("Formation", $data['idFormation']);
                            $formation = $formation->fetch();
                            $formations = $formation["titre"];
                        }
                        echo '<td>' . $data["nom"] . ' ' . $data["prenom"] . '</td>' .
                            '<td>' . $data["mail"] . '</td> ' .
                            '<td>' . date_format(new DateTime($data["dateCreation"]), "Y-m-d") . '</td>' .
                            '<td>' . $formations . '</td> ' .
                            '<td><a href="../../Controller/Connexion.php?statut=' . $data["id"] . '"><button class="primary">Editer</button></a>' .
                            '<a href="../../Controller/Connexion.php?statut=' . $data["id"] . '&test=no"><button class="primary">' . $status . '</button></a></td> ';

                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
<script>
    
    // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
    $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();

    if (localStorage.getItem("couleur")) {
        document.body.style.backgroundColor=localStorage.getItem("couleur");
    }
</script>