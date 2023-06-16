<?php 
require_once './php/config.php';

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
    <link rel="icon" href="./media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0" />
</head>


    <body>
        <div class="header">
            <ul>
                <li><a href="index" class="active">Home</a></li>
                <li><a href="contact">Kontakt</a></li>
            </ul>
        </div>

        <br><br>

    <div class="grid-container">
        <div class="main">
            <span class="title1">Hallo.</span> <br>
            <span class="title2">Informationen, Links & Socials</span>
            <br> <br> <br> <hr class="hr2">
            <br>
            <div style="display: flex; justify-content: center;">
                <br>
                <div class="text highlight">
                    Willkommen, hier findest du einige Links und Informationen.<br>
                    <br><br>
                </div>
            </div>

            <br> <hr class="hr2"><br>

            <div class="socialBoxes">
                <button onclick=" window.open('http://instagram.com/goekhan.klc','_blank')" class="socialButton bInsta">Instagram <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://t.snapchat.com/OxlUyqA4', '_blank')" class="socialButton bSnapchat">Snapchat <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://www.linkedin.com/in/g%C3%B6khan-kilic/','_blank')" class="socialButton bLinkedIn">LinkedIn <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://github.com/goekhan-klc', '_blank')" class="socialButton bGitHub">GitHub <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://soundcloud.com/goekhn', '_blank')" class="socialButton bSoundCloud">SoundCloud <span class="material-symbols-outlined">link</span></button>
            </div> 
            <br> <br> <hr class="hr2">
            
            <div class="socialBoxes">
                <br><button onclick=" window.open('https://kilic.it', '_blank')" class="socialButton bKilicit">Kilic.it <span class="material-symbols-outlined">link</span></button>
                <br><br><br><br>
            </div>

        </div>

        <div class="sidebar">
            <p style="margin-top: 198px;"></p>
            <span class="title3">Informationen <span class="material-symbols-outlined" style="display: flex; align-self: center;">arrow_forward_ios</span></span><br>
            <p style="margin-top: 90px;"></p>
            <span class="title3">Social <span class="material-symbols-outlined" style="display: flex; align-self: center;">arrow_forward_ios</span></span><br>
            <p style="margin-top: 320px;"></p>
            <span class="title3">Weitere <span class="material-symbols-outlined" style="display: flex; align-self: center;">arrow_forward_ios</span></span><br>
        </div>
    </div>
        
        <footer class="footer"> 
            <ul class="footerNav">
                <li><a href="./account/login">Login</a></li>
                <li><a href="impressum">Impressum</a></li>
            </ul>
        </footer>

    </body>
</html>