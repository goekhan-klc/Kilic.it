<!--made by me-->

<?php
require "../php/config.php";

if(!$_SESSION["login"]) {
    header("url=../index");
}

if(isset($_POST["submit"])) {
    if($_POST["maintenance"] == "true") {
        $sql = "UPDATE settings SET maintenance=false";
        if ($conn->query($sql) === TRUE) {
            header("Refresh: 1; url='index'");
        } else {
          echo "Error updating record: " . $conn->error;
        }
    } else {
        $sql = "UPDATE settings SET maintenance=true";
        if ($conn->query($sql) === TRUE) {
            header("Refresh: 1; url='index'");
        } else {
          echo "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
    
    <head>
        <html lang="de">
        <meta charset="utf-8">
        <title>Kilic.it</title>
        <link rel="stylesheet" href="../style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../media/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0" />
    </head>

    <body>
        <div class="header">
            <ul>
                <li><a href="../index">Zurück zur Webseite</a></li>
                <li><a href="../account/logout">Logout</a></li>
            </ul>
        </div>

        <div class="main">
            <h1 class="title1">Backend</h1>
            <p style="margin-top:50px"></p>
           <div class="highlight">

           <?php if($setting["maintenance"]) {
            echo "
            <form action='' method='POST'>
            <label for='maintenance'>Wartungsmodus: eingeschaltet</label>
            <input type='hidden' name='maintenance' id='maintenance' value='true'>
            <button class='settingsButton' type='submit' name='submit'>Ausschalten</button>
            </form> 
        ";
           } else {
            echo "
            <form action='' method='POST'>
            <label for='maintenance'>Wartungsmodus: ausgeschaltet</label>
            <input type='hidden' name='maintenance' id='maintenance' value='false'>
            <button class='settingsButton' type='submit' name='submit'>Einschalten</button>
            </form> 
        ";
           }
           
           ?>
           </div>
        </div>

        <footer class="footer"> 
            <ul class="footerNav">
            </ul>
        </footer>

    </body>
</html>