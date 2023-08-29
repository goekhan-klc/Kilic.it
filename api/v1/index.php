<?php 

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
        $id = rand(1, 99999);
        $timestamp = date("d.m.Y H:i:s");
        $creator = "-2";

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
} else {
    echo "error #E404 - type mismatch";
}

function isLink($text) {
    $pattern = '/\b(?:https?|ftp):\/\/[^\s]+\b/';
    return preg_match($pattern, $text);
  }

?>
