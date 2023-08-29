<!--made by me-->

<?php
require './php/elements.php';
require "./php/config.php";

if($setting["maintenance"]) {
    header("Location: maintenance");
}

if(!isset($_GET["i"])) {
    header("Location: index");
}

$id = $_GET["i"];
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

        <script src="./php/elements.js"></script>


        <div class="main">
            <span class="title1">Shorts</span> <br>
            <span class="title2">Short-ID: <?php if($text == "Diese Notiz wurde nicht gefunden") {echo "-/-";} else {echo $id;} ?></span>
           
            <p style="margin-top:50px"></p>

            <?php if($link != "Dieses Short wurde nicht gefunden") {
  
                echo "<div class='shortRedirect'>
                    <span> Weiterleitung zu: </span> <div class='spinner'></div> <br><br><br>
                    </div> 
                    
                    <span style='text-decoration: underline;'> $link </span>
                    ";

                header("Refresh: 1; url=$link");

            } else {
                echo "<span style='color: rgb(229, 27, 27);'> Es ist unter diesem Short kein Link hinterlegt </span>";
            }
            ?>
        </div>
    </body>
</html>