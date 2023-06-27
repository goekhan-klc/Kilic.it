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

$sql = "SELECT * FROM notes WHERE id=$id"; 
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
        getHead("Note");
    } else {
        getHead("Note #" . $id);
    }
    ?>
</head>

    <body>
        <div class="header">
            <?php getNavigation(); ?>
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
            <span>Erstellt: $timestamp </span>

            <br> <br>
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