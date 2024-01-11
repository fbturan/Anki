
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Card</title>
</head>
<body>
    <h1>Add a Memory Card</h1>
    <form action="" method="post">
        <label for="front_side">Front Side:</label>
        <input type="text" name="front_side" required>
        <br>
        <label for="back_side">Back Side:</label>
        <input type="text" name="back_side" required>
        <br>
        <button type="submit">Add Card</button>
    </form>
</body>
</html>

<?php

$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $front_side = $_POST["front_side"];
    $back_side = $_POST["back_side"];

    $deckName = $_GET["data"];

    if (!empty($front_side) && !empty($back_side)) {
        $sql = "INSERT INTO $deckName (front_side, back_side) VALUES ('$front_side', '$back_side')";

        if ($conn->query($sql)) {
            echo "Card added successfully. ";
			echo "<a href='ind.php'>Go back to deck</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Front side and back side cannot be empty.";
    }
}

$conn->close();
?>
