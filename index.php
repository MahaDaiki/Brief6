<?php
session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "maha123";
$dbname = "electronacerdb2";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($conn, $username);

    // Check if it's an admin
    $adminResult = $conn->query("SELECT * FROM admins WHERE username = '$username'");

    if ($adminResult->num_rows > 0) {
        $adminRow = $adminResult->fetch_assoc();
        $adminStoredHash = $adminRow["passw"];
    
        // Verify the admin password
        if (password_verify($password, $adminStoredHash)) {
            $_SESSION["admin_username"] = $username;
            $_SESSION["is_admin"] = true;
    
            header("Location: home.php");
            exit();
        } else {
            echo "Error: Incorrect admin password.";
        }
    } else {
        // Check if it's a regular user
        $userResult = $conn->query("SELECT * FROM users WHERE username = '$username'");

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $hashedPassword = $userRow["passw"];
            $valide = $userRow["valide"];

            // validation status
            if ($valide == 0) {
                echo '<div style="color: red; font-weight: bold; text-align: center;">Waiting for admin validation. You cannot access the website yet.</div>';
                exit();
            }

            // Verify the user password
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["username"] = $username;
                header("Location: home.php");
                exit();
            } else {
                echo "Error: Incorrect password.";
            }
        } else {
            echo "Error: User not found.";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bdindex">
    <div class="overlay"></div>
    <div class="cont">
        <form class="d-flex flex-column login" action="index.php" method="post">
            <h2>Login</h2>
            <input class="inp" type="text" id="username" name="username" placeholder="Name" required>
            <input class="inp" type="password" id="password" name="password" placeholder="password" required>
            <button class="bttn btn btn-primary" type="submit">Login</button>
            <a href="register.php">Sign up</a>
        </form>
    </div>
</body>
</html>
