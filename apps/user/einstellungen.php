<?php
require '../php/elements.php';
require "../php/config.php";

if($_SESSION["login"] == false) {
    header("Location: ../account/login");
}

?>

<!DOCTYPE html>
<html>
    
    <head>
        <?php getHead("Einstellungen"); ?>
    </head>

    <body>
        <div class="header">
         <?php getNavigation("Einstellungen"); ?>
        </div>

        <nav id="nav_profil_sidebar" class="nav_profil_sidebar">
            <a href="profil">&#187; Deine Daten</a>
            <a class="active" href="#"> &#187; Einstellungen</a>
            <?php if($_SESSION["role"] == "admin") echo "<a href='admin'>&#187; Administrator</a>"; ?>
            <a href='../account/logout'>&#187; Ausloggen</a>
        </nav>

        <div class="main" style="display: grid;">
        <span style='font-size: 39px;' class="material-symbols-outlined" id="nav_sidebar_profil_switch">chevron_right</span>

            <p style="margin-top:80px;"></p>
            <span class="title1">Einstellungen</span><br>
            <span class="title2">Passe deine Einstellungen an</span>
            <p style="margin-top:50px"></p>

            
        </div>

        <script src="../php/elements.js"></script>
    </body>
</html>