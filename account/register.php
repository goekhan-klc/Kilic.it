<?php
require '../php/config.php'; 

if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    header("url=../backend/index");
}

if($setting["maintenance"]) {
  header("Location: ../account/maintenance");
}

if (!empty($_SESSION["id"])) {
  header("Location: ../index");
}

if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $mail = $_POST["mail"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];

  $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

  if (mysqli_num_rows($duplicate) > 0) { 
    echo "<script> alert('Email bereits vergeben'); </script>";
  } else {
    if ($password == $confirmpassword) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $query = "insert into user(name,email,password) VALUES('$name', '$mail', '$hashedPassword');";
      mysqli_query($conn, $query);
      echo "<script> alert('Das Konto wurde angelegt. Weiterleitung...'); </script>";
      header("Refresh:2; url=login");
    } else {
      echo "<script> alert('Passwörter stimmen nicht überein'); </script>";
    }
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
                <li><a href="../index">Home</a></li>
                <li><a href="../contact">Kontakt</a></li>
            </ul>
        </div>

        <div class="main">
            <h1 class="title1">Registrierung</h1>
            <p style="margin-top:50px"></p>

                <form class="" action="register" method="post" autocomplete="on">
                <label for="name">Name:</label>
                <input class="formInput" type="text" name="name" id="name" required value=""><br>
                <label for="email">Email:</label>
                <input class="formInput" type="email" name="mail" id="mail" required value=""><br>
                <label for="password">Passwort:</label>
                <input class="formInput" type="password" name="password" id="password" required value=""><br>
                <label for="confirmpassword">Passwort bestätigen:</label>
                <input class="formInput" type="password" name="confirmpassword" id="confirmpassword" required value=""><br>
                <button class="formSubmit" type="submit" name="submit">Registrieren</button>
            </form>
            <br>
            <a class="aa" href="login">Login</a> 
        
        </div>

        <footer class="footer"> 
            <ul class="footerNav">
                <li><a href="login" class="active">Login</a></li>
                <li><a href="../impressum">Impressum</a></li>
            </ul>
        </footer>

    </body>
</html>