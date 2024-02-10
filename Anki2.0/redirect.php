<?php
session_start();
$conn = new mysqli("localhost", "root", "", "anki_db");

$_SESSION["cloneDeckName"] = $_GET["data"];

header("Location: start.php");
?>
