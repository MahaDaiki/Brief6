<?php
session_start(); // Start the session

require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addItem'])) {
    $imgs = $_FILES['imgs'];
    $productname = $_POST['productname'];
    $barcode = $_POST['barcode'];
    $purchase_price = $_POST['purchase_price'];
    $final_price = $_POST['final_price'];
    $price_offer = isset($_POST['price_offer']) ? $_POST['price_offer'] : null;
    $descrip = $_POST['descrip'];
    $min_quantity = $_POST['min_quantity'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_name = $_POST['category_name'];

    // Handle image upload
    $imagePath = "img/";
    $imageFileName = $imgs['name'];
    $imageFilePath = $imagePath . $imageFileName;

    move_uploaded_file($imgs['tmp_name'], $imageFilePath);

    // Insert into the 'Products' table
    $sql = "INSERT INTO Products (imgs, productname, barcode, purchase_price, final_price, price_offer, descrip, min_quantity, stock_quantity, category_name, bl) 
            VALUES ('$imageFilePath', '$productname', '$barcode', '$purchase_price', '$final_price', '$price_offer', '$descrip', '$min_quantity', '$stock_quantity', '$category_name', 1)";

    // Handle the foreign key constraint
    try {
        $conn->query($sql);
        echo "New item added successfully";
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $sql . "<br>" . $e->getMessage();
    }
}

$conn->close();
?>
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
            
            // Check if an admin is logged in
            if (isset($_SESSION["admin_username"])) {
              $displayName = $_SESSION["admin_username"];
            } elseif (isset($_SESSION["username"])) {
              $displayName = $_SESSION["username"];
            } else {
              header("Location: index.php");
              exit();
            }
            ?>
            <div class="userinfo">
              <img src="img/user-286-128.png" alt="user">
              <h2>
                <?php echo $displayName; ?>
              </h2>
              <hr>
              <?php
                    if ($isAdmin) {
                        echo '<a href="adminpan.php">Admin Panel</a>';
                    }
                    ?>
              <a href="logout.php">Log Out</a>
              

                </div>
            </div>
        </div>
    </div>
</nav>


<div class="container formedit">
    <h2 class="text-center mb-4">Add Item</h2>
    <form method="post" action="" enctype="multipart/form-data" class="my-5">
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
        <div class="form-group">
    <label for="category_name">Category Name:</label>
    <input type="text" class="form-control" name="category_name" required>
</div>
<button type="submit" class="btn btn-danger mt-5" name="addItem">Add Item</button>
</form>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="index.js"></script>
</body>
</html>