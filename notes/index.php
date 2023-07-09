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
    $creator = "-1";
    $uploadedfiles = false;

    if($_FILES["file"]["size"][0] > 0) $uploadedfiles = true;
    if($_SESSION["login"]) $creator = $_SESSION["id"];

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

} else if(isset($_POST["search"])) {
    $id = $_POST["search"];

    header("Location: https://kilic.it/notes/note?id=$id");

}

    if($_SESSION['login']) {
        $mynotes = array();

        $sql11 = "SELECT * FROM notes WHERE creator=".$_SESSION['id']; 
        $result11 = $conn->query($sql11);

        if($result11) {
            while ($row11 = $result11->fetch_assoc()) {
                $mynotes[] = $row11;
            }
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

            <?php if($_SESSION["login"]) {
            echo "<br><br><hr style='width: 90%'><br><br>
                <label>Oder suche nach deine Notes</label> <br>
                <button class='noteButton' id='bttn_mynotes'>Meine Notes</button>
            <br><br><br>

            "; }
            ?>

    <div id='div_modal_mynotes' class='modal'>
        <div id='div_modal_content_mynotes' class='modal-content'>
            <div id='div_modal_header_mynotes' class='modal-header'>
                <span id='span_modal_close' class='modal-close'>❌</span>
                <span class="title2">Deine erstellten Notes:</span><br>
            </div>

            <div>
                <ul class="mdal_mynotes_list">

                <?php foreach($mynotes as $nr => $anote) {
                    $nr = $nr +1;
                    echo "
                        <li style='margin-top: 10px;'>$nr. Note <a href='note?id=". $anote['id'] ."'>#". $anote['id'] ."</a></li>
                        ";
            
                    }?>
                </ul>
            </div>
        </div>
    </div>
    </div>

    <script src="../php/elements.js"></script>

    </body>
</html>