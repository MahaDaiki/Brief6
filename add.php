<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to bottom, #6ab1e7,#023364)">

<nav class="navbar navbar-expand-sm navbar-dark ">
    <div class="container">
        <a href="#" class="navbar-brand">NE</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="home.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="category.php" class="nav-link">Categories</a>
            </li>
        </ul>
        <img width="48" src="img/user-286-128.png" alt="profile" class="user-pic">
        <div class="menuwrp" id="subMenu">
            <div class="submenu">
                <div class="userinfo">
                <?php
        session_start(); // Start the session

        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
        } else {
            // Redirect to the login page if the user is not logged in
            header("Location: login.php");
            exit();
        }
        ?>
        <div class="userinfo">
            <img src="img/user-286-128.png" alt="user">
            <h2><?php echo $username; ?></h2>
            <hr>
            <a href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
$servername = "localhost";
$username = "root";
$password = "maha123";
$dbname = "electronacerdb2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addCategory'])) {
        // Add a new category
        $catname = $_POST['catname'];
        $descrip = $_POST['descrip'];
        $imgs = $_POST['imgs'];

        $sql = "INSERT INTO Categories (catname, descrip, imgs, bl) VALUES ('$catname', '$descrip', '$imgs', 1)";

        if ($conn->query($sql) === TRUE) {
            echo "New category added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['addItem'])) {
        // Add a new item
        $imgs = $_POST['imgs'];
        $productname = $_POST['productname'];
        $barcode = $_POST['barcode'];
        $purchase_price = $_POST['purchase_price'];
        $final_price = $_POST['final_price'];
        $price_offer = isset($_POST['price_offer']) ? $_POST['price_offer'] : 'NULL';
        $descrip = $_POST['descrip'];
        $min_quantity = $_POST['min_quantity'];
        $stock_quantity = $_POST['stock_quantity'];
        $category_name = $_POST['category_name'];

        $sql = "INSERT INTO Products (imgs, productname, barcode, purchase_price, final_price, price_offer, descrip, min_quantity, stock_quantity, category_name, bl) 
                VALUES ('$imgs', '$productname', '$barcode', '$purchase_price', '$final_price', $price_offer, '$descrip', '$min_quantity', '$stock_quantity', '$category_name', 1)";

        if ($conn->query($sql) === TRUE) {
            echo "New item added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<div class="container formedit">
    <h2 class="text-center mb-4">Add Item</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="imgs">Image Upload:</label>
            <input type="file" class="form-control-file" name="imgs">
        </div>
        <div class="form-group">
            <label for="productname">Product Name:</label>
            <input type="text" class="form-control" name="productname" required>
        </div>
        <div class="form-group">
            <label for="barcode">Barcode:</label>
            <input type="number" class="form-control" name="barcode" required>
        </div>
        <div class="form-group">
            <label for="purchase_price">Purchase Price:</label>
            <input type="number" class="form-control" name="purchase_price" required>
        </div>
        <div class="form-group">
            <label for="final_price">Final Price:</label>
            <input type="number" class="form-control" name="final_price" required>
        </div>
        <div class="form-group">
            <label for="price_offer">Price Offer:</label>
            <input type="number" class="form-control" name="price_offer">
        </div>
        <div class="form-group">
            <label for="descrip">Description:</label>
            <textarea class="form-control" name="descrip" required></textarea>
        </div>
        <div class="form-group">
            <label for="min_quantity">Min Quantity:</label>
            <input type="number" class="form-control" name="min_quantity" required>
        </div>
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" class="form-control" name="stock_quantity" required>
        </div>
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <label for="category_name">Category Name:</label>
            <select class="form-control" name="category_name" required>
                <?php
              
                $servername = "localhost";
                $username = "root";
                $password = "maha123";
                $dbname = "electronacerdb2";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $categoriesResult = $conn->query("SELECT catname FROM categories");

                // Display each category as an option
                while ($row = $categoriesResult->fetch_assoc()) {
                    echo "<option value='{$row['catname']}'>{$row['catname']}</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="addItem">Add Item</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="index.js"></script>
</body>
</html>