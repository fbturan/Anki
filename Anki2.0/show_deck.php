<?php

$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$sql = "SELECT * FROM deck";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    $i = 0;
    while($row = $result->fetch_assoc()) {
        $deckName = $row["deckName"];
            echo "<li>";
            echo "<a id=\"$i\">" . $deckName . "</a>";
            echo "<button id=\"$i\" onclick=\"PHPWithQueryStringadd($i)\">Add Card</button>";
            echo "<button id=\"$i\" onclick=\"PHPWithQueryStringstart($i)\">Start</button>";
            echo "<button id=\"$i\" onclick=\"PHPWithQueryStringdelete($i)\">Delete Deck</button>";
            echo "</li>";
            $i += 1;
    }
    echo "</ul>";
} else {
    echo "Deck not found";
}

$conn->close();

?>
