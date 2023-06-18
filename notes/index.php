<!--made by me-->

<?php
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: maintenance");
}

if(isset($_POST["note"])) {

    $id = rand(1, 999999);
    $text1 = $_POST['note'];
    $timestamp = date("d.m.Y H:i:s");

    $stmt = $conn->prepare("INSERT INTO notes (id, text, timestamp) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $text1, $timestamp);
    
    if ($stmt->execute()) {
        header("Refresh: 1; url=note?id=" . $id);
    } else {
        echo "<script> alert('Fehler bei SQL INSERT') </script>";
        echo $conn->error;
    }
    
    $stmt->close();
    $conn->close();

} else if(isset($_POST["search"])) {
    $id = $_POST["search"];

    if(strlen($id > 1 && $id < 9999999)) {
        header("Location: https://kilic.it/web/notes/note?id=$id");
    }
}

?>

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
                <li><a href="index" class="active">Notes</a></li>
            </ul>
        </div>

        <div class="main" style="display: grid; justify-content: center;">
        <span class="title1">Notes</span><br>
        <span class="title2">Erstelle und teile eine neue Notiz</span>
        <p style="margin-top:50px"></p>

        <form action="" method="POST" class="noteCreateForm">
            <div class="noteAreaContainer">
                <label for="note">Erstelle eine neue Notiz</label>
                <textarea class="noteArea" placeholder="Schreibe hier..." name="note" id="note" required></textarea>
            </div>

            <br>
            <button class="noteButton" type="submit" name="submit">Speichern & teilen</button>

            <br><br><br><hr><br><br>

        </form>

        <form action="" method="POST" class="noteCreateForm">
            <div class="noteAreaContainer">
                <label for="search">Oder suche nach der Note-ID</label>
                <input type="text" class="formInput" placeholder="Note-ID..." name="search" id="search" required></input>
            </div>

            <br>
            <button class="noteButton" type="submit" name="submit">Suchen</button>
        </form>
</div>

        <footer class="footer"> 
            <ul class="footerNav">
            </ul>
        </footer>

    </body>
</html>