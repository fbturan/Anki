<?php
session_start();

$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM anki_users WHERE email ='$email'";
    echo "SQL Query: " . $query;

    $result = $conn->query($query);

    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "DB Password: " . $row['password'];

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: ind.php");
        } else {
            // Kontrol 4: Girilen parola ile veritabanındaki parola eşleşmiyorsa hata mesajını yazdır
            echo "<p>Invalid password</p>";
        }
    } else {
        // Kontrol 5: Kullanıcı bulunamazsa hata mesajını yazdır
        echo "<p>User not found</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form action="login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
