<!--made by me-->
<?php 
require './php/elements.php';
require './php/config.php'; 

if($setting["maintenance"]) {
    header("Location: maintenance");
}



if(isset($_POST["submit"])) {
    $name = $_POST["txt_name"];
    $mail = $_POST["txt_email"];
    $message = $_POST["txt_msg"];

    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        echo "<script> alert('Dies ist kein gültiger Name') </script>";
       die();
      }

      if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "<script> alert('Dies ist keine gültige E-Mail') </script>";
        die();
      }

    $to = "goekhan@kilic.it";
    $msg = "Hallo. Neuer Eintrag durch Kontaktformular:\n\n
    Name: $name\n
    E-Mail: $mail\n
    Nachricht: $message\n\n
    Kilic.it - Nachrichtendienst";
    $msg = wordwrap($msg,70);
    $headers = "From: nachrichten@kilic.it";
    $subject = "Kilic.it | Neuer Eintrag im Kontaktformular";
    mail($to,$subject,$msg, $headers);
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
            <br><br>
            <span class="title1">Kontakt</span><br>
            <span class="title2">Senden Sie mir eine E-Mail per Formular</span>
            <p style="margin-top:50px"></p>
                <div class="highlight"> 
                    <p> Mit diesem Formular wird eine E-Mail-Benachrichtigung an mich gesendet. </p>
                    <p style="margin-top:30px"></p>
                    <hr style="width:70%;"> <br><br>
                <div class="contactDiv">
                    <form action="" method="POST">
                        <label for="txt_name">Ihr Name:</label>
                        <input class="inpt_contact" placeholder="Name.." type="text" name="txt_name" required>

                        <label for="txt_email">Ihre E-Mail:</label>
                        <input class="inpt_contact" placeholder="E-Mail.."type="text" name="txt_email" required>

                        <label for="txt_msg">Ihre Nachricht: (optional)</label>
                        <input class="inpt_contact inpt_contact_big" placeholder="Hallo.." type="text" name="txt_msg">

                        <br><br>
                        <button class="bttn_contact" type="submit" name="submit">Bestätigen</button>

                    </form>
                </div>
                <br><br>
                <hr style="width:70%;">
        </div>

    </body>
</html