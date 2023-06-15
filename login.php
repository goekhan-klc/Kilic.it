<!--made by me-->

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $jsonFile = './.vscode/settings.json';
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);
    $servername = $data['server'];
    $username = $data['username'];
    $password = "";
    $dbname = $data['database'];
    
    $mail = $_POST["mail"];
    $pass = $_POST["password"];
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }
    
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE mail = '$mail'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($pass, $row["password"])) {
            echo "Login erfolgreich!";
        } else {
            echo "Ungültige Anmeldedaten!";
        }
    } else {
        echo "Ungültige Anmeldedaten!";
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
        <link rel="stylesheet" href="style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,500,0,0" />
    </head>

    <body>
        <div class="header">
            <ul>
                <li><a href="index">Home</a></li>
                <li><a href="contact">Kontakt</a></li>
            </ul>
        </div>

        <div class="main">
            <h1 class="title1">Login</h1>
            <p style="margin-top:50px"></p>
           <div class="highlight">

            <form method="POST" action="login.php">
                <label for="mail">E-Mail</label>
                <input type="text" name="mail" id="mail" required><br><br>
                
                <label for="password">Passwort:</label>
                <input type="password" name="password" id="password" required><br><br>
                
                <input type="submit" value="Anmelden">
            </form>    
           
           </div>
        </div>

        <footer class="footer"> 
            <ul class="footerNav">
                <li><a href="login" class="active">Login</a></li>
                <li><a href="impressum">Impressum</a></li>
            </ul>
        </footer>

    </body>
</html>