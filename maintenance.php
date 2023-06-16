<?php 

require './php/config.php';

if(!$setting["maintenance"]) {
    header("Location: index");
}

?>

<!DOCTYPE html>
<html>

<head>
    <html lang="de">
    <meta charset="utf-8">
    <title>Kilic.it - Wartung</title>
    <link rel="icon" href="./media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0" />
</head>


    <body>
        <div class="header">
            <ul>

            </ul>
        </div>

        <br><br>

    <div class="grid-container">
        <div class="main">
            <span class="title1">Wartung</span> <br>
            <span class="title2">Seite aktuell nicht verfügbar</span>


        </div>

        
        <footer class="footer"> 
            <ul class="footerNav">
                <li><a href="./account/login">Login</a></li>
            </ul>
        </footer>

    </body>
</html>