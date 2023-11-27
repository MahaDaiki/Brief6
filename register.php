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
    <form class="d-flex flex-column login" action="loginTraitemnet.php" method="POST" >
        <h2>Sign Up</h2>
        <input  class="inp" type="text" id="username" name="username" placeholder="Name" required>
        <input class="inp" type="email" id="email" name="email" placeholder="email" required>
        <input  class="inp" type="password" id="password" name="password" placeholder="password" required>
        <button class=" bttn btn btn-primary " type="submit">Sign Up</button>
        <a href="index.html">Log In</a>
  </form>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Establish a database connection (replace these with your actual database details)
    $servername = "localhost";
    $username = "root";
    $password = "maha123";
    $dbname = "electronacerdb2";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

   
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

  
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

</body>
</html>