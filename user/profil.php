<?php
require '../php/elements.php';
require "../php/config.php";

if($_SESSION["login"] == false) {
    header("Location: ../index");
}

?>

<!DOCTYPE html>
<html>
    
    <head>
        <?php getHead("Profil"); ?>
    </head>

    <body>
        <div class="header">
         <?php getNavigation("Profil"); ?>
        </div>

        <nav id="nav_profil_sidebar" class="nav_profil_sidebar">
            <a class="active" href="#">&#187; Deine Daten</a>
            <a href="#"> &#187; Einstellungen</a>
            <?php if($_SESSION["role"] == "admin") echo "<a href='admin'>&#187; Administrator</a>"; ?>
            <a href='../account/logout'>&#187; Ausloggen</a>
        </nav>

        <div class="main" style="display: grid;">
        <span style='font-size: 39px;' class="material-symbols-outlined" id="nav_sidebar_profil_switch">chevron_right</span>

            <p style="margin-top:80px;"></p>
            <span class="title1">Dein Profil</span><br>
            <span class="title2">Verwalte deine Daten, interargier mit anderen und weiteres.</span>
            <p style="margin-top:50px"></p>

            <span class="title2">Kontoinformationen und Personenbezogene Daten</span><br><br>
            
            <div class="div_profil_infos">
                <label>Dein Name</label>
                <div class="showLinkDiv">
                    <?php echo $_SESSION['name'] ?>
                </div>

                <br>

                <label>Deine E-Mail</label>
                <div class="showLinkDiv">
                    <?php echo $_SESSION['mail'] ?>
                </div>

                <br>

                <label>Deine Rolle</label>
                <div class="showLinkDiv">
                    <?php echo $_SESSION['role'] ?>
                </div>

                <br>

                <label>Ändere dein Passwort</label>
                <input type="text" class="showLinkDiv" placeholder="***********">
            </div>
        </div>

        <script src="../php/elements.js"></script>
    </body>
</html>