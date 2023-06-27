<?php

require '../php/elements.php';
require '../php/config.php'; 

if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    header("url=../backend/index");
}

if($setting["maintenance"]) {
  header("Location: ../account/maintenance");
}

if (isset($_SESSION["id"])) {
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
  <?php getHead("Registrierung"); ?>
</head>
    <body>
        <div class="header">
          <?php getNavigation() ?>
        </div>
        
        <script src="../php/elements.js"></script>

        <div class="main">
            <h1 class="title1">Registrierung</h1>
            <p style="margin-top:50px"></p>

            <form class="loginForm" action="register" method="post" autocomplete="on">
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
    </body>
</html>