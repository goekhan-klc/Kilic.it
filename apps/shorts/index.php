<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: ../maintenance");
}

if(isset($_POST["short"])) {
    $link = $_POST["short"];
    $id = $uniqueId = bin2hex(random_bytes(3));
    $timestamp = date("d.m.Y / H:i");
    $creator = "-1";

    if($_SESSION["login"]) $creator = $_SESSION["id"];

    if(isLink($link)) {

    $stmt = $conn->prepare("INSERT INTO shorts (id, link, timestamp, creator) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $link, $timestamp, $creator);
    
    if ($stmt->execute()) {
        header("Refresh: 0.1; url=short?id=" . $id);
    } else {
        echo "<script> alert('Fehler bei SQL INSERT') </script>";
        echo $conn->error;
    }
    
    $stmt->close();
    $conn->close();

    } else {
        echo "<script> alert('Dies ist kein Link') </script>";
    }
}

if($_SESSION['login']) {
    $myshorts = array();

    $sql11 = "SELECT * FROM shorts WHERE creator=".$_SESSION['id']; 
    $result11 = $conn->query($sql11);

    if($result11) {
        while ($row11 = $result11->fetch_assoc()) {
            $myshorts[] = $row11;
        }
    }
}  

function isLink($text) {
    $pattern = '/\b(?:https?|ftp):\/\/[^\s]+\b/';
    return preg_match($pattern, $text);
  }

?>

<!DOCTYPE html>
<html>
    
<head>
    <?php getHead("Shorts"); ?>
</head>
    <body>
        <div class="header">
            <?php getNavigation("Shorts"); ?>
        </div>

        <br><br>

        <div class="main" style="display: grid; justify-content: center;">
            <span class="title1">Shorts</span><br>
            <span class="title2">Kürze und teile deine Links</span>
            <p style="margin-top:50px"></p>

            <form action="" method="POST" class="noteCreateForm">
                <div class="noteAreaContainer">
                    <label for="note" style="width: 90%;">Tippe den Link ein welchen du kürzen möchtest</label>
                    <input type="text" class="formInput" placeholder="Link..." name="short" id="short" required></textarea>
                </div>

                <br>
                <button class="noteButton" type="submit" name="submit">Kürzen & teilen</button>

                <br>

            </form>

            <?php if($_SESSION["login"]) {
                echo "<br><br><hr style='width: 90%'><br><br>
                    <label>oder zeige deine erstellten Shorts</label> <br>
                    <button class='noteButton' id='bttn_mynotes'>Meine Shorts</button>
                <br><br><br>

                "; }
                ?>

            <div id='div_modal_mynotes' class='modal'>
                <div id='div_modal_content_mynotes' class='modal-content'>
                    <div id='div_modal_header_mynotes' class='modal-header'>
                        <span id='span_modal_close' class='modal-close'>❌</span>
                        <span class="title2">Deine erstellten Shorts:</span><br>
                    </div>
                    <div>
                        <ul class="mdal_mynotes_list">
                            <?php foreach($myshorts as $nr => $ashort) {
                                $nr = $nr +1;
                                echo "
                                    <li style='margin-top: 10px;'>$nr. Short <a href='short?id=". $ashort['id'] ."'>#". $ashort['id'] ."</a></li>";
                            }?>
                        </ul>
                    </div>
                </div>
            </div>

            <p style="margin-top: 50px;"></p>
        </div>

    <script src="../php/elements.js"></script>

    </body>
</html>