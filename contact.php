<!--made by me-->
<?php 
require './php/elements.php';
require './php/config.php'; 

if($setting["maintenance"]) {
    header("Location: maintenance");
}
?>

<!DOCTYPE html>
<html>
    
<head>
    <?php getHead(); ?>
</head>
    <body>
        <div class="header">
            <?php getNavigation("Kontakt"); ?>
        </div>

        <script src="./php/elements.js"></script>

        <div class="main">
            <h1 class="title1">Kontakt</h1>
            <p style="margin-top:50px"></p>
           <div class="highlight">
                Befindet sich im Aufbau
           </div>
        </div>

    </body>
</html