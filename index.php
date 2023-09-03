<?php 
require './php/elements.php';
require './php/config.php';

if($setting["maintenance"]) {
    header("Location: maintenance");
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php getHead(); ?>
</head>

    <body>
        <div class="header">
           <?php getNavigation("Home"); ?>
        </div>

        <script src="./php/elements.js"></script>

        <br><br>

    <div class="grid-container">
        <div class="main">
            <span class="title1">Hallo.</span> <br>
            <span class="title2">Links & Socials</span>
            <br> <br> <br> <hr class="hr2">
            <br>
            <div style="display: flex; justify-content: center;">
                <br>
                <div class="text highlight">
                    Anwendungen <br><br>
                   Notes = Notizen erstellen & teilen <br>
                   Shorts = Links kürzen & teilen (+ api)<br>
                   MovieList = Projekt für einen Kurs des Studiums<br>
                   <br>
                   Alles PHP & SQL basiert.
                    <br>
                </div>
            </div>

            <br> <hr class="hr2"><br>

            <div class="socialBoxes">
                <button onclick=" window.open('http://instagram.com/goekhan.klc','_blank')" class="socialButton bInsta">Instagram <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://www.linkedin.com/in/g%C3%B6khan-kilic/','_blank')" class="socialButton bLinkedIn">LinkedIn <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://t.snapchat.com/OxlUyqA4', '_blank')" class="socialButton bSnapchat">Snapchat <span class="material-symbols-outlined">link</span></button>
                <br>
                <br><button onclick=" window.open('https://github.com/goekhan-klc', '_blank')" class="socialButton bGitHub">GitHub <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://open.spotify.com/user/kiligo_','_blank')" class="socialButton bSpotify">Spotify <span class="material-symbols-outlined">link</span></button>
                <br><button onclick=" window.open('https://soundcloud.com/goekhn', '_blank')" class="socialButton bSoundCloud">SoundCloud <span class="material-symbols-outlined">link</span></button>
            </div> 
            <br> <br> <hr class="hr2">
            
            <div class="socialBoxes">
                <br><button onclick=" window.open('./project/movielist/index', '_blank')" class="socialButton bKilicit">MovieList <span class="material-symbols-outlined">link</span></button>
                <br><br><br><br>
            </div>

        </div>
    </div>

    </body>
</html>
