<?php 

/*
API v1 

inputs:
- type (type of request)
- i1 (input 1; for type: shorts, sync)
- i2 (input 2; for type: sync)

request types:
- shorts (create a short from api and return the link)
- sync (create a sync and return nothing)

*/

require '../../php/config.php';


if(empty($_GET["type"]) || empty($_GET["i1"])) {
    echo "error #E002 - no input given";
    die();
}

$api_type = $_GET["type"];
$api_input1 = $_GET["i1"];

if($api_type == "shorts") {
    if(isLink($api_input1)) {
        $link = $api_input1;
        $id = $uniqueId = bin2hex(random_bytes(3));
        $timestamp = date("d.m.Y / H:i");
        $creator = "";

        if($_SESSION['login']) {
            $creator = $_SESSION['id'];
        } else {
            $creator = "-2";
        }
 
        $stmt = $conn->prepare("INSERT INTO shorts (id, link, timestamp, creator) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id, $link, $timestamp, $creator);
        
        if ($stmt->execute()) {
            echo "https://kilic.it/s?i=" . $id;
        } else {
            echo "error #E101 - fatal mysql querry error";
        }
        
        $stmt->close();
        $conn->close();

    } else {
        echo "error #E001 - input is no link";
    }
} else if($api_type == "sync") {
    if(empty($_GET["i2"])) {
        echo "error #E002 - no input given";
        die();
    }

    $api_input2 = $_GET["i2"];

    $id = $uniqueId = bin2hex(random_bytes(3));
    $content = $api_input2;
    $timestamp = date("d.m.Y / H:i");
    $creator = $api_input1;

    $stmt = $conn->prepare("INSERT INTO sync (id, content, timestamp, creator) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $content, $timestamp, $creator);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error #E101 - fatal mysql querry error";
    }
    
    $stmt->close();
    $conn->close();
    
} else {
    echo "error #E004 - type mismatch";
}

function isLink($text) {
    $pattern = '/\b(?:https?|ftp):\/\/[^\s]+\b/';
    return preg_match($pattern, $text);
  }

?>
