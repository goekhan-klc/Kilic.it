<!--made by me-->
<?php 
require './php/config.php'; 

if($setting["maintenance"]) {
    header("Location: maintenance");
}
?>

<!DOCTYPE html>
<html>
    
    <head>
        <html lang="de">
        <meta charset="utf-8">
        <title>Kilic.it</title>
        <link rel="stylesheet" href="style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./media/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0" />
    </head>

    <body>
        <div class="header">
            <ul>
                <li><a href="index">Home</a></li>
                <li><a href="contact" class="active">Kontakt</a></li>
                <li><a href="./notes/index">Notes</a></li>
            </ul>
        </div>

        <div class="main">
            <h1 class="title1">Kontakt</h1>
            <p style="margin-top:50px"></p>
           <div class="highlight">
                Befindet sich im Aufbau
           </div>
        </div>

        <footer class="footer"> 
            <ul class="footerNav">
                <li><a href="./account/login">Login</a></li>
                <li><a href="impressum">Impressum</a></li>
            </ul>
        </footer>

    </body>
</html