<?php

require '../php/elements.php';
require '../php/config.php';

if($_SESSION["login"] == false || !isset($_SESSION["login"])) {
    header("Location: ../index");
}

    function destroySession() {
        setcookie('sessionToken', "", time() - 86400, '/', '', true, false);
        $_SESSION["login"] = false;
        $_SESSION = [];
        session_unset();
        session_destroy();
    };

    echo "
<!DOCTYPE html>
<html> 
    <head>
       " . getHead("Logout") . "
    </head>

    <body>
        <div class='main'>
            <h1 class='title1'>Logout</h1>
            <p style='margin-top:50px'></p>
           
            <div class='logoutDiv'>
                <h2>Du wirst nun ausgeloggt...</h2><div class='spinner'></div>
            </div>
        </div>
    </body>
</html>

    ";
    

    destroySession();
    header('Refresh: 1; url=../index');

    exit;
?>