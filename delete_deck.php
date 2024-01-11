<?php

$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$deckName = $_GET["data"];

// Delete the table and its content
$sqlDeleteDeck = "DROP TABLE IF EXISTS $deckName";

if ($conn->query($sqlDeleteDeck)) {
    // Deletion successful, you can provide a response if desired
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

// Perform the redirect after all content has been sent
header("Location: ind.php");
exit(); // Ensure that no further code is executed after the header redirect
?>

