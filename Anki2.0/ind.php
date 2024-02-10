<?php 
	$conn = new mysqli("localhost", "root", "", "anki_db");
	session_start();

	$sql = "CREATE TABLE IF NOT EXISTS deck (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		deckName VARCHAR(255) NOT NULL,
		UNIQUE KEY (deckName)
	)";

	$conn->query($sql);

	$sql = "CREATE TABLE IF NOT EXISTS deckDetails (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		deck_id INT(6) UNSIGNED,
		front_side VARCHAR(255) NOT NULL,
		back_side VARCHAR(255) NOT NULL
	)";

	$conn->query($sql);

	$sql ="SELECT deck.*, deckDetails.*
	FROM deck
	INNER JOIN deckDetails ON deck.id = deckDetails.deck_id";

	$conn->query($sql);

	$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Cards</title> 
	<link rel="stylesheet" href="ind.css">
</head>
<body>
    <h1>Welcome to Anki</h1>
    <div>
        <h2>Memory Card Decks</h2>
		<button onclick="addDeck()">Add Deck</button>
		<?php include 'show_deck.php';?>
    </div>
	<a href="login.php" style="text-decoration:none;"><p>You can log-out here</p></a>
	<script>
	function PHPWithQueryStringadd(i) {
		var dataToSend = document.getElementById(i).innerHTML;
		window.location.href = 'add_card.php?data=' + encodeURIComponent(dataToSend);
	}

	function PHPWithQueryStringstart(i) {
		var dataToSend = document.getElementById(i).innerHTML;
		window.location.href = 'redirect.php?data=' + encodeURIComponent(dataToSend);
	}

	function PHPWithQueryStringdelete(i) {
		var dataToSend = document.getElementById(i).innerHTML;
		window.location.href = 'delete_deck.php?data=' + encodeURIComponent(dataToSend);
	}

	function addDeck(deckName) {
		window.location.href = 'add_deck.php?deck=' + encodeURIComponent(deckName);
	}
</script>

</body>
</html>