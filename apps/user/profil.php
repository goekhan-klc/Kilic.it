<?php
require '../php/elements.php';
require "../php/config.php";

if($_SESSION["login"] == false) {
    header("Location: ../account/login");
}

if(isset($_POST["submit1"])) {
    if(!empty($_POST["newpw"])) {
        $newpw = $_POST["newpw"];

        $hashedPassword = password_hash($newpw, PASSWORD_DEFAULT);
  
        $query = "UPDATE user SET password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $_SESSION["id"]);
        mysqli_stmt_execute($stmt);
  
        destroySession();
        header("Refresh:1; url=../account/login");
    }
}

function destroySession() {
    $_SESSION = [];
    session_unset();
    session_destroy();
};

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
            <a href="einstellungen"> &#187; Einstellungen</a>
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

                <br><hr><br>

                <label>Ändere dein Passwort</label>
                    <form action="" method="POST">
                    <input type="text" class="showLinkDiv" type="password" placeholder="***********" name="newpw" required>
                    <br>
                    <button class="settingsButton" type="submit" name="submit1">Ändern</button>
                </form>
            </div>
        </div>

        <script src="../php/elements.js"></script>
    </body>
</html>