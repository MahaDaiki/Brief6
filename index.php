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
    <form class="d-flex flex-column login" action="index.php" method="post" >
        <h2>Login</h2>
        <input  class="inp" type="text" id="username" name="username" placeholder="Name" required>
        <input  class="inp" type="password" id="password" name="password" placeholder="password" required>
        <button class=" bttn btn btn-primary " type="submit">Login</button>
        <a href="register.php">Sign up</a>
  </form>
  <?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "maha123";
    $dbname = "electronacerdb2";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = mysqli_real_escape_string($conn, $username);

    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["passw"];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variable and redirect to the home page
            $_SESSION["username"] = $username;
            header("Location: home.php");
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: User not found.";
    }

    $conn->close();
}
?>

</body>
</html>