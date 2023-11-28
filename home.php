<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to bottom, #023364, #6ab1e7)">
    
<nav class="navbar navbar-expand-sm navbar-dark fixed-top">
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
  </div>
</div>
</nav>
<div class="background">
  <img src="img/background.jpg" alt="Background Image">
  <h1 class="title">ElectroNacer</h1>
</div>

<div id="imageCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/casque.jpg" class="d-block w-100" alt="Slide 1">
      <div class="carousel-caption d-none d-md-block">
        <h5>HEADPHONES</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catcooler.jpg" class="d-block w-100" alt="Slide 2">
      <div class="carousel-caption d-none d-md-block">
        <h5>COOLERS</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catkeyboards.jpg" class="d-block w-100" alt="Slide 3">
      <div class="carousel-caption d-none d-md-block">
        <h5>KEYBOARDS</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catlaptop&pc.jpg" class="d-block w-100" alt="Slide 4">
      <div class="carousel-caption d-none d-md-block">
        <h5>LAPTOPS & PCS</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catmonitors.jpg" class="d-block w-100" alt="Slide 5">
      <div class="carousel-caption d-none d-md-block">
        <h5>MONITORS</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catram.jpg" class="d-block w-100" alt="Slide 6">
      <div class="carousel-caption d-none d-md-block">
        <h5>RAM</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catmouse.jpg" class="d-block w-100" alt="Slide 7">
      <div class="carousel-caption d-none d-md-block">
        <h5>MOUSE</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/catssd.jpg" class="d-block w-100" alt="Slide 8">
      <div class="carousel-caption d-none d-md-block">
        <h5>SSD</h5>
      </div>
    </div>
  </div>

  <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
 
 <?php



function get_AllItems() {
    $servername = "localhost";
    $username = "root";
    $password = "maha123";
    $dbname = "electronacerdb2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    
// fetch all items
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);
$allItems = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $allItems[] = $row;
    }
    
    // Display the length of items
    
} else {
    echo "No items found.";
}

   
     return $allItems;

}



 function get_items($page, $itemsPerPage) {
     $servername = "localhost";
     $username = "root";
     $password = "maha123";
     $dbname = "electronacerdb2";
 
     $conn = new mysqli($servername, $username, $password, $dbname);
 
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
 
     // Calculate offset based on page number
     $offset = ($page - 1) * $itemsPerPage;
 
     $sql = "SELECT * FROM Products LIMIT $offset, $itemsPerPage";
     $result = $conn->query($sql);

     $items = array();
 
    
     if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
         $items[] = $row;
        }
      }

      $conn->close();
     return $items;
 }
 
 // Set the number of items per page
 $itemsPerPage = 10;
 
 // Get the current page number (default to 1 if not set)
 $page = isset($_GET['page']) ? $_GET['page'] : 1;
 
 // Get items for the current page
 $items = get_items($page, $itemsPerPage);

 ?>
 
 <!-- Display items -->
 <div class="container mt-4">
     <div class="row">
         <?php foreach ($items as $item) : ?>
             <div class="col-md-3 mb-4">
                 <div class="card">
                     <img src="<?php echo $item['imgs']; ?>" class="card-img-top" alt="<?php echo $item['productname']; ?>">
                     <div class="card-body">
                         <h5 class="card-title"><?php echo $item['productname']; ?></h5>
                         <p class="card-text">
                             Reference: <?php echo $item['reference']; ?><br>
                             Barcode: <?php echo $item['barcode']; ?><br>
                             Purchase Price: <?php echo $item['purchase_price']; ?><br>
                             Final Price: <?php echo $item['final_price']; ?><br>
                             Price Offer: <?php echo $item['price_offer']; ?><br>
                             Description: <?php echo $item['descrip']; ?><br>
                             Min Quantity: <?php echo $item['min_quantity']; ?><br>
                             Stock Quantity: <?php echo $item['stock_quantity']; ?><br>
                             Category: <?php echo $item['category_name']; ?>
                         </p>
                     </div>
                 </div>
             </div>
         <?php endforeach; ?>
     </div>
 </div>
 
<!-- Display pagination links -->
<div class="pagination">
    <?php
    // Get total number of items for the current page
    $totalItems = count(get_items($page, $itemsPerPage));

    // Calculate total number of pages
    $totalPages = ceil(count(get_AllItems()) / $itemsPerPage);

    // Display previous page link if applicable
    if ($page > 1) {
     
        echo "<a href='?page=" . ($page - 1) . "' class='page-link'>Previous</a> ";
    }

    // Display numbered pagination links
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i' class='page-link'>$i</a> ";
    }


    // Display next page link if applicable
    if ($page < $totalPages) {
   
        echo "<a href='?page=" . ($page + 1) . "' class='page-link'>Next</a> ";
    }
    ?>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>

</body>
</html>