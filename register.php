<?php
$conn = new mysqli("localhost", "root", "", "anki_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tabloyu sadece bir kez oluştur
$query = "CREATE TABLE IF NOT EXISTS anki_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email TEXT NOT NULL,
    password TEXT NOT NULL
);";

$conn->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($password !== $confirmPassword) {
        echo "<p>Passwords do not match. Please try again.</p>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO anki_users (email, password) VALUES ('$email', '$hashedPassword')";
        $result = $conn->query($query);
        if ($result) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <h1>REGISTER</h1>
    <main>
        <form action="" method="POST">
            <div>
                <label>Mail:<input type="email" name="email" required></label>
                <label>Password:<input type="password" name="password" required></label>
                <label>Confirm Password:<input type="password" name="confirm_password" required></label>
                <input type="submit" value="Sign Up">
            </div>
        </form> 
    </main>
</body>
</html>