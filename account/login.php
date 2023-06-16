<!--made by me-->

<?php
require "../php/config.php";

    if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
        header("Location: ../backend/index");
    }

    if(isset($_POST["submit"])) {

    $mail = $_POST["mail"];
    $pass = $_POST["password"];

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM user WHERE email = '$mail'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($pass, $row["password"])) {
             session_start();
             $_SESSION["login"] = true;
             $_SESSION["id"] = $row["id"];
             $_SESSION["name"] = $row["name"];
             $_SESSION["mail"] = $row["mail"];

            echo "<script> alert('Angemeldet. Weiterleitung..'); </script>";
            header('Refresh:1; url=../backend/index');
        } else {
            echo "<script> alert('Mail oder Passwort nicht korrekt'); </script>";
            
        }
    } else {
        echo "<script> alert('E-Mail nicht registriert'); </script>";
    }
    
    $conn->close();
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
                <li><a href="../index">Home</a></li>
                <li><a href="../contact">Kontakt</a></li>
            </ul>
        </div>

        <div class="main">
            <h1 class="title1">Login</h1>
            <p style="margin-top:50px"></p>
           <div class="highlight">

            <form action="" method="POST">
                <label for="mail">E-Mail</label>
                <input class="formInput" type="text" name="mail" id="mail" required><br><br>
                
                <label for="password">Passwort:</label>
                <input class="formInput" type="password" name="password" id="mail" required><br><br>
                
                <button class="formSubmit" type="submit" name="submit">Anmelden</button>
            </form>    

            <br>
            <a class="aa" href="register">Registrierung</a> 

           </div>
        </div>

        <footer class="footer"> 
            <ul class="footerNav">
                <li><a href="login" class="active">Login</a></li>
                <li><a href="../impressum">Impressum</a></li>
            </ul>
        </footer>

    </body>
</html>