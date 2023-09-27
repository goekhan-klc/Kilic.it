<!--made by me-->
<?php
require '../php/elements.php';
require "../php/config.php";
?>

<!DOCTYPE html>
<html>
    
<head>
        <link rel='icon' href='/media/favicon.ico' type='image/x-icon'>
        <link rel='stylesheet' href='/style.css'/>
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover'>
        <title>Kilic.it - #404</title>
</head>

    <body>
        <div class="header">
            <?php getNavigation("404"); ?>
        </div>

        <br><br>

        <div class="main" style="display: grid; justify-content: center;">
            <p style="margin-top:100px"></p>
            <span class="title1">#404</span><br>
            <span class="title2">Diese Seite wurde nicht gefunden :(</span>
            <p style="margin-top: 50px;"></p>
        </div>
    </body>
</html>