<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if($setting["maintenance"]) {
    header("Location: ../maintenance");
}

if(isset($_POST["note"])) {
    $id = uniqid('', false);
    $text1 = $_POST['note'];
    $timestamp = date("d.m.Y / H:i");
    $creator = "Anonymous";
    $uploadedfiles = false;

    if($_FILES["file"]["size"][0] > 0) $uploadedfiles = true;
    if($_SESSION["login"]) $creator = $_SESSION["name"];

    $stmt = $conn->prepare("INSERT INTO notes (id, text, timestamp, creator) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $text1, $timestamp, $creator);
    
    if ($stmt->execute()) {
        if($uploadedfiles == false) {
            header("Refresh: 0.1; url=note?id=" . $id);
        }
    } else {
        echo "<script> alert('Fehler bei SQL INSERT') </script>";
        echo $conn->error;
    }

    if($uploadedfiles == true) {
        #echo "<script> alert('LADE NUN HOCH') </script>";

        $files = $_FILES['file'];
        $targetDir = "../files/notes/";

        for ($i = 0; $i < count($files["name"]); $i++) {
            $idi = $id . "_" . $i;
            $file_type = end((explode(".", $files['name'][$i])));
            $file_tmp = $files['tmp_name'][$i];
            $file_size = $files['size'][$i];
            $file_error = $files['error'][$i];
            $folder = "notes";

            $targetFilePath = $targetDir.$idi.".".$file_type;
        
            if(move_uploaded_file($files["tmp_name"][$i], $targetFilePath)){
                $stmt = $conn->prepare("INSERT INTO files (idname, filetype, timestamp, folder) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $idi, $file_type, $timestamp, $folder);
                
                if ($stmt->execute()) {

                } else {
                    echo "<script> alert('Fehler bei SQL INSERT') </script>";
                    echo $conn->error;
                }
            } else {
                echo "<script> alter('Error while uploading file') </script>";
            }

          }

          #echo "<script alert('DATEI ERKANNT UND VERARBEITET') </script>";
          header("Refresh: 0.1; url=note?id=" . $id);
    }
    
    $stmt->close();
    $conn->close();

} else if(isset($_POST["search"])) {
    $id = $_POST["search"];

    header("Location: https://kilic.it/notes/note?id=$id");

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

        <form action="" method="POST" class="noteCreateForm" enctype="multipart/form-data">
            <div class="noteAreaContainer">
                <label for="note">Erstelle eine neue Notiz</label>
                <textarea class="noteArea" placeholder="Schreibe hier..." name="note" id="note" required></textarea>
                <br> <br>
                <label for="files">Füge Dateien zu deiner Notiz hinzu</label>
                <input type="file" id="file" name="file[]" multiple></input>
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