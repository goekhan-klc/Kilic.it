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
$link;
$timestamp;

$sql = "select * from shorts where id=" . $id; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($result->num_rows == 1) {
$escapedText = htmlspecialchars($row["link"]);
$timestamp = $row["timestamp"];
$link = nl2br($escapedText);

} else {
    $link = "Dieses Short wurde nicht gefunden";
}

?>


<script>
        function copyToClipboard() {
             var confirmationDiv = document.getElementById('confirmation2');

            confirmationDiv.style.display = 'block';
            confirmationDiv.style.position = 'fixed';
            confirmationDiv.style.bottom = '3px';
            confirmationDiv.style.right = '3px';

            confirmationDiv.classList.remove('fadeInOut');
            confirmationDiv.classList.add('fadeInOut');

            

            setTimeout(function() {
                confirmationDiv.style.display = 'none';
            }, 6000);

            sendConfirmation();
        }
        

        function sendConfirmation() {
            var textField = document.createElement('textarea');

            textField.innerText = '<?php echo "https://kilic.it/web/shorts/s?i=$id"; ?>';
            document.body.appendChild(textField);
            textField.select();
            document.execCommand('copy');

            document.body.removeChild(textField);
        }
    </script>


<!DOCTYPE html>
<html>
    
<head>
    <?php if($link == "Dieses Short wurde nicht gefunden") {
        getHead("Short");
    } else {
        getHead("Short #" . $id);
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
            <span class="title1">Shorts</span>
            <span class="title2">Short-ID: <?php if($link == "Dieses Short wurde nicht gefunden") {echo "-/-";} else {echo $id;} ?></span>
           
            <p style="margin-top:50px"></p>

            <?php if($link != "Dieses Short wurde nicht gefunden") {
                echo "
                
                <label>Folgender Link wurde gekürzt:
                <div class='showShortDiv'>
                    <span>$link</span>
                </div>

                <br><br><br><br>

                <label>Kurzer Link (Click to Copy)</label>
                <div class='showShortDiv'>
                    <span><a onclick='copyToClipboard()'>https://kilic.it/web/shorts/s?i=$id</a></span>
                </div>
                <br>
                <span>Erstellt: $timestamp </span>
                
                ";
            } else {
                echo "<span style='font-size: 30px; color: rgb(229, 27, 27);'> Es ist unter diesem Short kein Link hinterlegt </span>";
            }
            ?>

            <div id="confirmation2" class="informationBox">
                In die Zwischenablage kopiert!
            </div>
    </body>
</html>