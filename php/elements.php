<?php

function getHead($titleText = "null") {
    $dir = getcwd();
    $lstylesheet;
    $lfavicon;

    switch($dir) {
        case "/srv/www/kilicit/web":
            $lstylesheet = "style.css";
            $lfavicon = "./media/favicon.ico";
        break;

        default:
            $lstylesheet = "../style.css";
            $lfavicon = "../media/favicon.ico";
        break;
    }


    echo "<html lang='de'>
        <meta charset='utf-8'>";
        
        if($titleText == "null") {
            echo "<title>Kilic.it</title>";
        } else {
            echo "<title>Kilic.it - $titleText</title>";
        }
        
   
        echo "<link rel='icon' href='$lfavicon' type='image/x-icon'>
        <link rel='stylesheet' href='$lstylesheet'/>
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0' />
    ";
}


function getNavigation($active) {
    $dir = getcwd();

    $lhome;
    $lcontact;
    $lnotes;
    $limpressum;
    $llogin;

    if($_SESSION["login"] == true) {
        $loggedin = true;
    };

    switch($dir) {
        case "/srv/www/kilicit/web":
            $lhome = "index";
            $lcontact = "contact";
            $lnotes = "./notes/index";
            $lshorts = "./shorts/index";

            $limpressum = "impressum";
            $llogin = "./account/login";
            $lbackend = "./backend/index";
            $llogout = "./account/logout";
        break;

        case "/srv/www/kilicit/web/notes": 
            $lhome = "../index";
            $lcontact = "../contact";
            $lnotes = "index";
            $lshorts = "../shorts/index";

            $limpressum = "../impressum";
            $llogin = "../account/login";
            $lbackend = "../backend/index";
            $llogout = "../account/logout";
        break;

        case "/srv/www/kilicit/web/backend": 
            $lhome = "../index";
            $lcontact = "../contact";
            $lnotes = "../notes/index";
            $lshorts = "../shorts/index";

            $limpressum = "../impressum";
            $llogin = "../account/login";
            $lbackend = "index";
            $llogout = "../account/logout";
        break;

        case "/srv/www/kilicit/web/account": 
            $lhome = "../index";
            $lcontact = "../contact";
            $lnotes = "../notes/index";
            $lshorts = "../shorts/index";

            $limpressum = "../impressum";
            $llogin = "login";
            $lbackend = "../backend/index";
            $llogout = "logout";
        break;

        case "/srv/www/kilicit/web/shorts": 
            $lhome = "../index";
            $lcontact = "../contact";
            $lnotes = "../notes/index";
            $lshorts = "index";

            $limpressum = "../impressum";
            $llogin = "../account/login";
            $lbackend = "../backend/index";
            $llogout = "../account/logout";
        break;
    }


    echo "  <div class='pcmenu'>
                <ul>
                    <li><a href='$lhome'".($active == 'Home' ? " class='active'" : "").">Home</a></li>
                    <li><a href='$lcontact'".($active == 'Kontakt' ? " class='active'" : "").">Kontakt</a></li>
                    <li><a href='$lnotes'".($active == 'Notes' ? " class='active'" : "").">Notes</a></li>
                    <li><a href='$lshorts'".($active == 'Shorts' ? " class='active'" : "").">Shorts</a></li>

                    <li style='float: right;'><a href='$limpressum'".($active == 'Impressum' ? " class='active'" : "").">Impressum</a></li>
                    "; 
                    if($loggedin) { echo
                    "<li style='float: right;'><a href='$llogout'".($active == 'Backend' ? " class='active'" : "").">Logout</a></li>
                    <li style='float: right;'><a href='$lbackend'".($active == 'Backend' ? " class='active'" : "").">Backend</a></li>
                     "
                      ;} else { echo
                    "<li style='float: right;'><a href='$llogin'".($active == 'Login' ? " class='active'" : "").">Login</a></li>
                      ";}
                   echo "</ul>
            </div>
            <div class='mobilemenu'>

            <div class='mobilemenu-overlay' id='mobilemenu-overlay'>
            </div>

                <div class='hamburger-menu' id='hamburger-menu'>
                    <span style='font-size: 40px; z-index=999;' class='material-symbols-outlined'>menu</span>
                </div>


                <ul class='mobilemenu-items' id='mobilemenu-items'>
                <li><a href='$lhome'".($active == 'Home' ? " class='active'" : "").">Home</a></li>
                <li><a href='$lcontact'".($active == 'Kontakt' ? " class='active'" : "").">Kontakt</a></li>
                <li><a href='$lnotes'".($active == 'Notes' ? " class='active'" : "").">Notes</a></li>
                <li><a href='$lshorts'".($active == 'Shorts' ? " class='active'" : "").">Shorts</a></li>

                <li<p></p></li>

                <li><a href='$limpressum'".($active == 'Impressum' ? " class='active'" : "").">Impressum</a></li>
                "; 
                if($loggedin) { echo
                "<li><a href='$llogout'".($active == 'Backend' ? " class='active'" : "").">Logout</a></li>
                <li><a href='$lbackend'".($active == 'Backend' ? " class='active'" : "").">Backend</a></li>
                 "
                  ;} else { echo
                "<li><a href='$llogin'".($active == 'Login' ? " class='active'" : "").">Login</a></li>
                  ";}
                echo "</ul>
            </div>";
    }
?>