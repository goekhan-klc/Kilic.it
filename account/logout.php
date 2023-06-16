<?php
require '../php/config.php';

if($_SESSION["login"] == false || !isset($_SESSION["login"])) {
    header("Location: ../index");
}

    function destroySession() {
        $_SESSION = [];
        session_unset();
        session_destroy();
    };

    echo "
<!DOCTYPE html>
<html> 
    <head>
        <html lang='de'>
        <meta charset='utf-8'>
        <title>Kilic.it</title>
        <link rel='stylesheet' href='../style.css'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='icon' href='../media/favicon.ico' type='image/x-icon'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0' />
    </head>

    <body>
        <div class='header'>
            <ul>
            </ul>
        </div>

        <div class='main'>
            <h1 class='title1'>Logout</h1>
            <p style='margin-top:50px'></p>
           
            <div class='logoutDiv'>
            <h2>Du wirst nun ausgeloggt...</h2><div class='spinner'></div>
            </div>


        </div>

        <footer class='footer'> 
            <ul class='footerNav'>
            </ul>
        </footer>

    </body>
</html>

    ";

    destroySession();
    header('Refresh: 3; url=../index');

    exit;
?>