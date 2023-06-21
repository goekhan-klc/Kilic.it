<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

if(!$_SESSION["login"]) {
    header("url=../index");
}

if(isset($_POST["submit"])) {
    if($_POST["maintenance"] == "true") {
        $sql = "UPDATE settings SET maintenance=false";
        if ($conn->query($sql) === TRUE) {
            header("Refresh: 0.1; url='index'");
        } else {
          echo "Error updating record: " . $conn->error;
        }
    } else {
        $sql = "UPDATE settings SET maintenance=true";
        if ($conn->query($sql) === TRUE) {
            header("Refresh: 0.1; url='index'");
        } else {
          echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["submit2"])) {
    $id = $_POST["delete"];

    if(strlen($id > 1 && $id < 9999999)) {
        $sql = "delete from notes where id=" . $id;
        if($conn->query($sql) === TRUE) {
            header("Refresh: 0.1; url='index'");
        } else {
            echo "<script> alert('Fehler beim löschen'); </script>";
        }
    } else {
        echo "<script> alert('Fehler');";
    }
}

if(isset($_POST["submit3"])) {
    $id = $_POST["delete"];

    if(strlen($id > 1 && $id < 9999)) {
        $sql = "delete from shorts where id=" . $id;
        if($conn->query($sql) === TRUE) {
            header("Refresh: 0.1; url='index'");
        } else {
            echo "<script> alert('Fehler beim löschen'); </script>";
        }
    } else {
        echo "<script> alert('Fehler');";
    }
}
?>

<!DOCTYPE html>
<html>
    
    <head>
        <?php getHead("Backend"); ?>
    </head>

    <body>
        <div class="header">
         <div class='pcmenu'>
            <ul>
                <li><a href="../index">Zurück zur Webseite</a></li>
                <li><a href="../account/logout">Logout</a></li>
            </ul>
         </div>
        </div>

        <div class="main">
            <h1 class="title1">Backend</h1>
            <p style="margin-top:50px"></p>
            
            <div class="highlight">
           <span class="title2">Wartungsmodus</span>
            <?php if($setting["maintenance"]) {
                echo "
                <form action='' method='POST'>
                <label for='maintenance'>Wartungsmodus: eingeschaltet</label>
                <input type='hidden' name='maintenance' id='maintenance' value='true'>
                <button class='settingsButton' type='submit' name='submit'>Ausschalten</button>
                </form> 
            ";
            } else {
                echo "
                <form action='' method='POST'>
                <label for='maintenance'>Wartungsmodus: ausgeschaltet</label>
                <input type='hidden' name='maintenance' id='maintenance' value='false'>
                <button class='settingsButton' type='submit' name='submit'>Einschalten</button>
                </form> 
            ";
            }
            
           ?>


                <p style="margin-top:50px"></p>
                <hr style="width: 70%"> <br>

                <span class="title2">Notes</span>
                <br>
                <label>Aktuell gespeicherte Notes: <?php 
                    $sql = "SELECT count(id) FROM notes;";
                    $result = $conn->query($sql);
                    if($result->num_rows == 1) {
                        $row = $result->fetch_assoc();

                        echo $row["count(id)"];
                    }
                ?> 
                <br><br>
                <form action="" method="POST">
                    <label for="delete">Note per ID löschen</label>
                    <input class="formInput" style="height: 20px; width: 8%;" type="text" placeholder="ID..." name="delete" required>
                    <br> <button class="settingsButton" type="submit" name="submit2">Löschen</button>
                </form>


                <p style="margin-top:50px"></p>
                <hr style="width: 70%"> <br>

                <span class="title2">Shorts</span>
                <br>
                <label>Aktuell gespeicherte Shorts: <?php 
                    $sql = "SELECT count(id) FROM shorts;";
                    $result = $conn->query($sql);
                    if($result->num_rows == 1) {
                        $row = $result->fetch_assoc();

                        echo $row["count(id)"];
                    }
                ?> 
                <br><br>
                <form action="" method="POST">
                    <label for="delete">Short per ID löschen</label>
                    <input class="formInput" style="height: 20px; width: 10%;" type="text" placeholder="ID..." name="delete" required>
                    <br> <button class="settingsButton" type="submit" name="submit3">Löschen</button>
                </form>
                
                <p style="margin-top:50px"></p> <br>

            </div>
        </div>
    </body>
</html>