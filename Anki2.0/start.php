<?php
    
$conn = new mysqli("localhost", "root", "", "anki_db");
session_start();

$deckName = $_SESSION["cloneDeckName"];
echo $deckName;


$sql = "SELECT id FROM deck WHERE deckName = '$deckName'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$idNumber = $row["id"];

$sql = "SELECT * FROM deckDetails WHERE deck_id = $idNumber ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row["id"];
    $front_face = $row["front_side"];
    $back_face = $row["back_side"];
}
else {
    header("Location: ind.php");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <link rel="stylesheet" href="start.css">
</head>
<body>
    <h1>Start Memory Game</h1>
    <div id="card-container">
        <div id="card" style="width:100px;height:100px;" onclick="flipCard(<?php echo $id; ?>)">
            <div id="frontFace"><?php echo $front_face; ?></div>
            <div id="backFace"><?php echo $back_face; ?></div>
        </div>
    </div>
    <div class="btnDown">
        <form id="redirectForm" action="" method="post">
            <input type="text" style="display:none;" value="<?php echo $id; ?>" name="idValue">
            <input type="submit" value="SKIP">
        </form>
        <button onclick="finish()">FINISH</button>
    </div>
    <script>
        var hoverLabel = document.getElementById("card");
        var frontFace = document.getElementById("frontFace");
        var backFace = document.getElementById("backFace");
        var redirectForm = document.getElementById("redirectForm");

        hoverLabel.addEventListener("click", function() {
            redirectForm.action = "";
        });

        function flipCard(id) {
            frontFace.style.display = "none";
            backFace.style.display = "flex";
        }

        function finish() {
            window.location.href = 'ind.php';
        }
    </script>
</body>
</html>



