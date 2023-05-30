<?php
// Start the session to access the cart data
session_start();

// Include the database connection file
include_once "conn.php";

// Retrieve the cart items from the session
$cart = $_SESSION['cart'] ?? array();

// Calculate the total number of items in the cart
$total_items = count($cart);

// Remove item from the cart if the delete button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['delete'])) {
    $item_index = $_POST['item_index'];
    unset($cart[$item_index]);
    $_SESSION['cart'] = $cart;
  } elseif (isset($_POST['order'])) {
    // Process the order here
    // ...

    // Clear the cart after placing the order
    $_SESSION['cart'] = array();

    // Redirect to a thank you page or display a success message
    header("Location: thank_you.php");
    exit();
  }
}

// Fetch carabaos from the database
$query = "SELECT * FROM carabaos";
$result = mysqli_query($conn, $query);
$carabaos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Carabaos</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav>
    <a href="mainindex.php">
      <img src="logo.png" class="logoc" alt="Logo">
    </a>
    <div class="dropdown">
      <button class="dropbtn">Menu
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="checkout.php"><img src="truck.jpg"  width="30px" height="30px">Order</a>
        <a href="profile.php"><img src="profilebutton.png" alt="Profile Icon">Profile</a>
        <a href="mainindex.php">Home</a>
        <a href="maincontact.php">Contact Us</a>
        <a href="mainabout.php">About Us</a>
        <a href="index.php">Log Out</a>
      </div>
    </div>
  </nav>

  <h1>WELCOME TO DREAM FARM</h1>

  <div class="dropdown">
    <button class="dropbtn">Animals</button>
    <div class="dropdown-content">
      <a href="maincows.php">Cows</a>
      <a href="mainchickenp.php">Chickens</a>
      <a href="maincarab.php">Carabaos</a>
      <a href="mainpigg.php">Pigs</a>
      <a href="mainduckk.php">Ducks</a>
      <a href="maingoatt.php">Goats</a>
    </div>
  </div>

  <div class="container">
    <main class="grid">
      <?php foreach ($carabaos as $index => $carabao): ?>
        <article>
          <img src="<?php echo $carabao['image']; ?>" alt="Sample photo">
          <div class="text">
            <p><strong><?php echo $carabao['name']; ?></strong></p>
            <p><strong>Available: </strong><?php echo $carabao['available']; ?></p>
            <p><strong>Selling Price: </strong><?php echo $carabao['price']; ?></p>
            <p><strong>Location: </strong><?php echo $carabao['location']; ?></p>
            <form action="add_to_cart.php" method="post">
              <input type="hidden" name="item_index" value="<?php echo $index; ?>">
              <input type="hidden" name="id" value="<?php echo $carabao['id']; ?>">
              <input type="hidden" name="name" value="<?php echo $carabao['name']; ?>">
              <input type="hidden" name="price" value="<?php echo $carabao['price']; ?>">
              <input type="hidden" name="image" value="<?php echo $carabao['image']; ?>">
              <a href="maindetails.php" class="button">Owner</a>
              <button class="button" type="submit">Add to Truck</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </main>
  </div>

  <p style="position: center; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>
</body>
</html>
