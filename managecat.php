<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["admin_username"])) {
    header("Location: index.php");
    exit();
}

// Establish your database connection
$servername = "localhost";
$username = "root";
$password = "maha123";
$dbname = "electronacerdb2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch all categories
function fetchCategories() {
    global $conn;
    $sql = "SELECT * FROM Categories WHERE bl=true";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Function to display category details in a form
function displayCategoryDetails($categoryName) {
    global $conn;
    $sql = "SELECT * FROM Categories WHERE catname = '$categoryName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to update category details
function updateCategory($categoryName, $description, $imagePath) {
    global $conn;
    $sql = "UPDATE Categories SET descrip='$description', imgs='$imagePath' WHERE catname='$categoryName'";

    return $conn->query($sql);
}

// Function to add a new category
function addCategory($categoryName, $description, $imagePath) {
    global $conn;
    $sql = "INSERT INTO Categories (catname, descrip, imgs, bl) VALUES ('$categoryName', '$description', '$imagePath', 1)";

    return $conn->query($sql);
}

// Function to delete (hide) a category
function deleteCategory($categoryName) {
    global $conn;
    $sql = "UPDATE Categories SET bl=false WHERE catname='$categoryName'";

    return $conn->query($sql);
}

// Check if the form is submitted for adding a new category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $newCategoryName = $_POST['new_category_name'];
    $newDescription = $_POST['new_description'];

    // Check if an image file is uploaded
    if ($_FILES['new_image']['error'] == 0) {
        $imagePath = "uploads/" . $_FILES['new_image']['name'];

        // Move the uploaded file to the specified directory
        move_uploaded_file($_FILES['new_image']['tmp_name'], $imagePath);
    } else {
        $imagePath = "";
    }

    // Add the new category to the database
    if (addCategory($newCategoryName, $newDescription, $imagePath)) {
        echo "<script type='text/javascript'>alert('New category added successfully!');</script>";
    } else {
        echo "Error adding new category: " . $conn->error;
    }
}

// Check if the form is submitted for deleting
if (isset($_GET['delete_category'])) {
    $categoryName = $_GET['delete_category'];
    if (deleteCategory($categoryName)) {
        echo  "<script type='text/javascript'>alert('Category deleted successfully!');</script>";
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

// Display a list of categories with options to modify or delete
$categories = fetchCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
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
              $isAdmin = true;
            } elseif (isset($_SESSION["username"])) {
              $displayName = $_SESSION["username"];
              $isAdmin = false;
            } else {
              // Redirect to the login page if neither admin nor user is logged in
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
              <div>
              <a href="logout.php">Log Out</a>
              </div>
              
              
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </nav>

<div class="container mt-5">
    <h2 class="mb-4">Manage Categories</h2>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Category Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?php echo $category['catname']; ?></td>
                    <td><?php echo $category['descrip']; ?></td>
                    <td><img src="<?php echo $category['imgs']; ?>" alt="Category Image" style="max-width: 100px;"></td>
                    <td>
                        <a href="edit_category.php?category_name=<?php echo $category['catname']; ?>">Edit</a>
                        |
                        <a href="?delete_category=<?php echo $category['catname']; ?>" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3 class="mt-4">Add a New Category</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="new_category_name">Category Name:</label>
            <input type="text" class="form-control" id="new_category_name" name="new_category_name" required>
        </div>
        <div class="form-group">
            <label for="new_description">Description:</label>
            <textarea class="form-control" id="new_description" name="new_description" required></textarea>
        </div>
        <div class="form-group">
            <label for="new_image">Image:</label>
            <input type="file" class="form-control-file" id="new_image" name="new_image">
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add Category</button>
    </form>
</div>

<script src="index.js"></script>
</body>
</html>
