<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <p>Create A Memory Card Deck <?php session_start();echo $_SESSION['mail'];session_destroy();?></p>
    <main> 
        <form action=""  method="post">
            <input type="text" name="deck_name">
            <div>
                <input type="submit" value="ADD">
            </div>
        </form>
    </main>
</body>
</html>

<?php
$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$deckName = $_POST['deck_name'];

$sql = "CREATE TABLE IF NOT EXISTS $deckName (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    front_side TEXT DEFAULT NULL,
    back_side TEXT DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "New deck created succesfully";
} else {
    echo "Deck cannot created!: " . $conn->error;
}
header("Location: ind.php");
$conn->close();
?>


