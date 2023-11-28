<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bdindex">
    <div class="overlay"></div>
    <div class="cont">
        <form class="d-flex flex-column login" action="register.php" method="post">
            <h2>Sign Up</h2>
            <input class="inp" type="text" id="username" name="username" placeholder="Name" required>
            <input class="inp" type="email" id="email" name="email" placeholder="Email" required>
            <input class="inp" type="password" id="password" name="password" placeholder="Password" required>
            <input class="inp" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <button class="bttn btn btn-primary" type="submit">Sign Up</button>
            <a href="index.html">Log In</a>
        </form>

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validation
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit();
    }

    // Establish a database connection (replace these with your actual database details)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "maha123";
    $dbname = "electronacerdb2";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user inputs
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user data into the users table
    $sql = "INSERT INTO users (username, email, passw, valide) VALUES ('$username', '$email', '$hashed_password', 1)";

    if ($conn->query($sql) === true) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
    </body>
    </html>
