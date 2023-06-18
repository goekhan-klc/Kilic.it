<!--made by me-->

<?php
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: maintenance");
}

if(!isset($_GET["id"])) {
    header("Location: index");
}

$id = $_GET["id"];
$text;
$timestamp;

$sql = "select * from notes where id=" . $id; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($result->num_rows == 1) {
$escapedText = htmlspecialchars($row["text"]);
$timestamp = $row["timestamp"];
$text = nl2br($escapedText);

} else {
    $text = "Diese Notiz wurde nicht gefunden";
}

?>


<script>
        function copyToClipboard() {
             var confirmationDiv = document.getElementById('confirmation');

            confirmationDiv.style.display = 'block';

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

            textField.innerText = '<?php echo "https://kilic.it/web/notes/note?id=$id"; ?>';
            document.body.appendChild(textField);
            textField.select();
            document.execCommand('copy');

            document.body.removeChild(textField);
        }
    </script>


<!DOCTYPE html>
<html>
    
    <head>
        <html lang="de">
        <meta charset="utf-8">
        <title>Kilic.it</title>
        <link rel="stylesheet" href="../style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../media/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0" />
    </head>

    <body>
        <div class="header">
            <ul>
                <li><a href="../index">Zurück zur Webseite</a></li>
                <li><a href="index">Notes</a></li>
            </ul>
        </div>

        <div class="main" style="display: grid; justify-content: center;">
            <span class="title1">Notes</span><br>
            <span class="title2">Notiz-ID: <?php if($text == "Diese Notiz wurde nicht gefunden") {echo "error";} else {echo $id;} ?></span>
           
            <p style="margin-top:50px"></p>

            <div class="showNoteDiv">
                <span><?php echo $text ?></span>
            </div>
            <br>
            <span> <?php echo "Erstellt: " . $timestamp ?>

            <br> <br>

              <?php if($text != "Diese Notiz wurde nicht gefunden") {
                echo "<div class='shareNote'> 
                <a onclick='copyToClipboard()'>https://kilic.it/web/notes/note?id=$id  <span class='material-symbols-outlined'0000>link</span></a>
                </div>";
              } ?> 
            <br> <br> <br>
        </div>


        <footer class="footer"> 
            <div id="confirmation" class="confirmation-message">
            In die Zwischenablage kopiert!
            </div>
            <ul class="footerNav">
            </ul>
        </footer>

    </body>
</html>