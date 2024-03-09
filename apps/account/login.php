<!--made by me-->

<?php
require '../php/elements.php';
require "../php/config.php";

    function createSessionToken($userid) {
        $length = 16;

        $token = openssl_random_pseudo_bytes($length);        
        $token = bin2hex($token);

        return $userid."_".$token;
    }


    if(isset($_SESSION["login"]) && $_SESSION["login"] == true) {
        header("Location: ../index");
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
             $_SESSION["mail"] = $row["email"];
             $_SESSION["role"] = $row["role"]; //ROLES: "admin", "user"

             setcookie('sessionToken', createSessionToken($_SESSION["id"]), time() + 86400, '/', '', true, false);

            header('Location: ../index');
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
  <?php getHead("Login"); ?>
</head>
    <body>
        <div class="header">
            <?php getNavigation("Login") ?>
        </div>

        <script src="../php/elements.js"></script>

        <div class="main">
            <h1 class="title1">Login</h1>
            <p style="margin-top:50px"></p>
           <div class="highlight">

            <form action="" method="POST" class="loginForm">
                <label for="mail">E-Mail</label>
                <input class="formInput" type="text" name="mail" id="mail" placeholder="E-Mail.."required><br><br>
                
                <label for="password">Passwort:</label>
                <input class="formInput" type="password" name="password" id="mail" placeholder="Passwort.." required><br><br>
                
                <button class="formSubmit" type="submit" name="submit">Anmelden</button>
            </form>    

            <br>
            <a class="aa" href="register">Registrierung</a> 

           </div>
        </div>
    </body>
</html>