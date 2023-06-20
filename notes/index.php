<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: ../maintenance");
}

if(isset($_POST["note"])) {

    $id = rand(1, 999999);
    $text1 = $_POST['note'];
    $timestamp = date("d.m.Y H:i:s");

    $stmt = $conn->prepare("INSERT INTO notes (id, text, timestamp) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $text1, $timestamp);
    
    if ($stmt->execute()) {
        header("Refresh: 0.1; url=note?id=" . $id);
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
    <?php getHead("Notes"); ?>
</head>
    <body>
        <div class="header">
            <?php getNavigation("Notes"); ?>
        </div>

        <script src="../php/elements.js"></script>

        <br><br>

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

            <br><br><br><hr style="width: 90%"><br><br>

        </form>

        <form action="" method="POST" class="noteCreateForm">
            <div class="noteAreaContainer">
                <label for="search">Oder suche nach der Note-ID</label>
                <input type="text" class="formInput" placeholder="Note-ID..." name="search" id="search" required></input>
            </div>

            <br>
            <button class="noteButton" type="submit" name="submit">Suchen</button>
        </form>

        <p style="margin-top: 50px;"></p>
    </div>

    </body>
</html>