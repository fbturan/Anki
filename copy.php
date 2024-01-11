<?php
session_start();
$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$deckName = $_GET["data"];
$copyDeck = "copyDeck"; 

$sql = "CREATE TABLE $copyDeck AS SELECT * FROM $deckName";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Table created successfully";
    $_SESSION["cloneDeckName"] = $copyDeck;
    $conn->close();
    header("Location: start.php");
} else {
    echo "Error creating table: " . $conn->error;
}
?>
