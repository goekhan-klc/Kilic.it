<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: ../maintenance");
}

if(isset($_POST["short"])) {
    $link = $_POST["short"];
    $id = rand(1, 999);
    $timestamp = date("d.m.Y H:i:s");

    if(isLink($link)) {

    $stmt = $conn->prepare("INSERT INTO shorts (id, link, timestamp) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $link, $timestamp);
    
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

        <script src="../php/elements.js"></script>

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

            <br><br><br><br>

        </form>

        <p style="margin-top: 50px;"></p>
    </div>

    </body>
</html>