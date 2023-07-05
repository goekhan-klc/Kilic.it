<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: ../maintenance");
}

if(!isset($_GET["id"])) {
    header("Location: index");
}

$id = $_GET["id"];
$text;
$timestamp;
$creator;
$hasfiles = false;

$sql = "SELECT * FROM notes WHERE id='$id'"; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($result->num_rows == 1) {
    $escapedText = htmlspecialchars($row["text"]);
    $timestamp = $row["timestamp"];
    $text = nl2br($escapedText);
    $creator = $row["creator"];

    if($creator != -1) {
        $sql3 = "select name from user where id = $creator";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();
        $creator = $row3["name"];
    } else {
        $creator = "Unbekannt";
    }

} else {
    $text = "Diese Notiz wurde nicht gefunden";
}



$sql2 = "SELECT * FROM files WHERE idname LIKE '$id%'"; 
$result2 = $conn->query($sql2);
$rows2 = array();

if($result2) {
    while ($row2 = $result2->fetch_assoc()) {
        $rows2[] = $row2;
    }

    if($result2->num_rows > 0) {
        $hasfiles = true;
        $countfiles = $result2->num_rows;
        $files = $rows2; # 1. Nummer  2. Welche Information
    }
}
?>


<script>
        function copyToClipboard() {
             var confirmationDiv = document.getElementById('confirmation');

            confirmationDiv.style.display = 'block';
            confirmationDiv.style.position = 'fixed';
            confirmationDiv.style.bottom = '3px';
            confirmationDiv.style.right = '3px';

            confirmationDiv.classList.remove('fadeInOut');
            void confirmationDiv.offsetWidth;
            confirmationDiv.classList.add('fadeInOut');

            

            setTimeout(function() {
                confirmationDiv.style.display = 'none';
            }, 6000);

            sendConfirmation();
        }
        

        function sendConfirmation() {
            var textField = document.createElement('textarea');

            textField.innerText = '<?php echo "https://kilic.it/notes/note?id=$id"; ?>';
            document.body.appendChild(textField);
            textField.select();
            document.execCommand('copy');

            document.body.removeChild(textField);
        }
    </script>


<!DOCTYPE html>
<html>
    
<head>
    <?php if($text == "Diese Notiz wurde nicht gefunden") {
        getHead("Notes");
    } else {
        getHead("Note #" . $id);
    }
    echo "<meta property='og:description' content='$text'/>
          <meta property='og:url' content='https://kilic.it/notes'/>";
          
    ?>
</head>

    <body>
        <div class="header">
            <?php getNavigation("Notes"); ?>
        </div>

        <script src="../php/elements.js"></script>

        <br><br>

        <div class="main" style="display: grid; justify-content: center;">
            <span class="title1">Notes</span>
            <span class="title2">Notiz-ID: <?php if($text == "Diese Notiz wurde nicht gefunden") {echo "-/-";} else {echo $id;} ?></span>
           
            <p style="margin-top:50px"></p>

            <?php if($text != "Diese Notiz wurde nicht gefunden") {
        echo "<div class='showNoteDiv'>
                <span>$text</span>
            </div>
            <br>
            <span>Erstellt von $creator am $timestamp </span>";

        if($hasfiles) {
            echo "
            <br><br><hr style='width: 70%'><br>

            <div class='fileContainer'> 
                <label>Angehängte Dateien</label>
                "; 

                foreach($files as $afile) {
                    $afile_name = end((explode("_", $afile["idname"])));
                    $afile_type = $afile["filetype"];
                    $afile_location = "../files/".$afile["folder"]."/".$afile["idname"].".".$afile["filetype"];

                    echo "<button onclick=\"window.open('$afile_location', '_blank');\" type='button' class='downloadButton'>Datei ". (intval($afile_name)+1) ." ($afile_type)</button>";
                }

            echo "</div>"; 
        } 
        echo "
            <br><hr style='width: 70%'><br>
                <div class='shareNote'> 
                    <a onclick='copyToClipboard()'>https://kilic.it/notes/note?id=$id  <span class='material-symbols-outlined'0000>link</span></a>
                </div>
              "; 
            } else {
        echo "
                <p style='margin-top:15%'></p>
                <span style='font-size: 30px; color: rgb(229, 27, 27);'>Dieses Note existiert nicht oder wurde gelöscht.</span>
            ";

              } ?> 
            <br> <br> <br>
        </div>
        <div id="confirmation" class="informationBox">
                In die Zwischenablage kopiert!
        </div>
    </body>
</html>