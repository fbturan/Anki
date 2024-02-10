<?php

$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$deckNameToDelete = $_GET["data"];

$sqlDeleteRow = "DELETE FROM deck WHERE deckName = '$deckNameToDelete'";

if ($conn->query($sqlDeleteRow)) {
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

header("Location: ind.php");
exit();
?>

