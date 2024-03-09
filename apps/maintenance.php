<?php 

require './php/elements.php';
require './php/config.php'; 

if(!$setting["maintenance"]) {
    header("Location: index");
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php getHead(); ?>
</head>
    <body>

        <?php getNavigation("Maintenance"); ?>

    <script src="./php/elements.js"></script>

        <p style="margin-top: 100px;"></p>

    <div class="grid-container">
        <div class="main">
            <span class="title1">:(</span> <br>
            <span class="title2">Diese Seite ist aktuell nicht verfügbar</span>
        </div>
    </div>

    </body>
</html>