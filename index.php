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
        <h2>Login</h2>
        <input  class="inp" type="text" id="username" name="username" placeholder="Name" required>
        <input  class="inp" type="password" id="password" name="password" placeholder="password" required>
        <button class=" bttn btn btn-primary " type="submit">Login</button>
        <a href="register.html">Sign up</a>
  </form>
</body>
</html>