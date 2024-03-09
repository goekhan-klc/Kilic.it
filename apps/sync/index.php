<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: ../maintenance");
}

if($_SESSION["login"] == false) {
    header("Location: ../account/login");
}

if($_SESSION['login']) {
    $mysyncs = array();

    $sql11 = "SELECT * FROM sync WHERE creator=".$_SESSION['id']; 
    $result11 = $conn->query($sql11);

    if($result11) {
        while ($row11 = $result11->fetch_assoc()) {
            $mysyncs[] = $row11;
        }
    }
}


function isLink($text) {
    $pattern = '/\b(?:https?|ftp):\/\/[^\s]+\b/';
    return preg_match($pattern, $text);
  }


      /*
    $input["content"]
    $input["id"]
    $input["timestamp"]
    $input["creator"]
    */

    header("Refresh: 3; url=index");
?>


<!DOCTYPE html>
<html>
    
<head>
    <?php getHead("Sync"); ?>

    <link rel="apple-touch-icon" href="./media/favicon.ico">
    <link rel="apple-touch-startup-image" href="./media/bg.jpeg">
    <meta name="apple-mobile-web-app-title" content="Sync">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
</head>
    <body>
        <div class="header">
        
        </div>

        <br><br>

        <div class="main" style="display: grid; justify-content: center;">
            <span class="title1">Sync</span><br>
            <span class="title2">Synchronisiere deine Aktivitäten</span>
            <p style="margin-top:50px"></p>

                <ul class="syncPacket">
                    <?php 
                        foreach($mysyncs as $nr => $async) {
                            $nr = $nr +1;
                            $id = $async["id"];
                            $content = $async["content"];
                            $timestamp = $async["timestamp"];

                            echo "
                            <li class='syncList'>
                                <div id='div_$id' class='syncCard'>
                                    <i>$timestamp</i> <br><br>
                                    $content <br><br>";

                                    if(isLink($content)) {
                                       echo "<button class='syncButton' id='button_$id' onclick=\"window.location.href='$content'\">Öffnen</button>";
                                    } else {
                                        echo "<button class='syncButton' id='button_$id' onclick=\"copyToClipboard($content)\">Kopieren</button>";
                                    }

                                    echo "
                                </div>
                            </li>";
                        }
                    ?>
                </ul>



            <p style="margin-top: 50px;"></p>
        </div>



        <div id="confirmation3" class="informationBox">
            In die Zwischenablage kopiert!
        </div>

            
        <script>
            function copyToClipboard(content) {
            var confirmationDiv = document.getElementById('confirmation3');
            var textToCopy = content;
            const textarea = document.createElement("textarea");
            
            textarea.value = textToCopy;

            document.body.appendChild(textarea);

            textarea.select();
            textarea.setSelectionRange(0, 99999);

            document.execCommand("copy");
            document.body.removeChild(textarea);

            confirmationDiv.style.display = 'block';
            confirmationDiv.style.position = 'fixed';
            confirmationDiv.style.bottom = '5%';
            confirmationDiv.style.right = '2%';
    
            confirmationDiv.classList.remove('fadeInOut');
            void confirmationDiv.offsetWidth;
            confirmationDiv.classList.add('fadeInOut');
    
            
    
            setTimeout(function() {
                confirmationDiv.style.display = 'none';
            }, 6000);
        }
        </script>
    </body>
</html>