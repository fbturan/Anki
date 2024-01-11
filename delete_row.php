<?php
session_start();
$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Silinecek satırın id'sini al
$deleted_row = $_POST["idValue"];

// Tablo adını ve sütun adını kendi veritabanınıza göre güncelleyin
$deckName = $_SESSION["cloneDeckName"];
$column = "id";

// DELETE sorgusunu oluştur
$sql = "DELETE FROM $deckName WHERE $column = $deleted_row";

// Sorguyu çalıştır
if ($conn->query($sql) === TRUE) {
    echo "Satır başarıyla silindi.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: start.php");
?>
