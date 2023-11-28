<?php 
$servername = "localhost";
$username = "root";
$password = "maha123";
$dbname = "electronacerdb2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$categoriesResult = $conn->query("SELECT * FROM categories");

// Fetch categories and store them in an array
$categories = [];
while ($row = $categoriesResult->fetch_assoc()) {
    $categories[] = $row;
}

// Fetch products based on the selected category filter
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;
$stockFilter = isset($_GET['stock']) && $_GET['stock'] == 'low';

if ($stockFilter) {
    $lowStockThreshold = 10; // Set your desired threshold
    $sql = "SELECT * FROM products WHERE stock_quantity < $lowStockThreshold";
    $result = $conn->query($sql);
} else {
    // If the button is not pressed, show products based on the selected category filter or all products
    if ($categoryFilter) {
        $categoryFilterString = implode("','", $categoryFilter);
        $sql = "SELECT * FROM products WHERE category_name IN ('$categoryFilterString')";
        $result = $conn->query($sql);
    } else {
        // If no category filter is applied and "Show Low on Stock Products" is not pressed, show all products
        $result = $conn->query("SELECT * FROM products");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                    <img src="img/user-286-128.png" alt="user">
                    <h2> username</h2>
                    <hr>
                    <a href="index.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <form action="" method="get" class="row mt-4 justify-content-center">
        <?php
        // Display checkboxes for each category
        foreach ($categories as $category) {
            ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $category['catname']; ?>" <?php if (is_array($categoryFilter) && in_array($category['catname'], $categoryFilter)) echo 'checked'; ?>>
                <label class="form-check-label">
                    <img src="<?php echo $category['imgs']; ?>" alt="<?php echo $category['catname']; ?>" width="50" height="50"><br>
                    <?php echo $category['catname']; ?>
                </label>
            </div>
            <?php
        }
        ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="stock" value="low" <?php if ($stockFilter) echo 'checked'; ?>>
            <label class="form-check-label">Low Stock</label>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="row">
        <?php
        // Display products based on the filter
        while ($item = $result->fetch_assoc()) {
            ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="<?php echo $item['imgs']; ?>" class="card-img-top" alt="<?php echo $item['productname']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['productname']; ?></h5>
                        <p class="card-text">
                            Purchase Price: <?php echo $item['purchase_price']; ?><br>
                            Final Price: <?php echo $item['final_price']; ?><br>
                            Stock Quantity: <?php echo $item['stock_quantity']; ?><br>
                            Category: <?php echo $item['category_name']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <script src="index.js"></script>
</body>
</html>
