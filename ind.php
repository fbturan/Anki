<?php 
	$conn = new mysqli("localhost", "root", "", "anki_db");
	session_start();
	if (!empty($_SESSION["cloneDeckName"]))
	{
		$deckName = $_SESSION["cloneDeckName"];
		$sql = "DROP TABLE $deckName";
		$_SESSION["cloneDeckName"] = "";
		$conn->query($sql);
	}
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
		window.location.href = 'copy.php?data=' + encodeURIComponent(dataToSend);
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