<?php
// Start the session to access the cart data
session_start();

// Include the database connection file
include_once "conn.php";

// Retrieve the cart items from the session
$cart = $_SESSION['cart'] ?? array();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the item details from the form
  $item_index = $_POST['item_index'];
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];

  // Create an array representing the item
  $item = array(
    'id' => $id,
    'name' => $name,
    'price' => $price,
    'image' => $image
  );

  // Add the item to the cart
  $cart[] = $item;

  // Update the cart in the session
  $_SESSION['cart'] = $cart;

  // Redirect back to the previous page
  header("Location: ".$_SERVER['HTTP_REFERER']);
  exit();
}
?>
<form action="add_to_cart.php" method="post">
  <input type="hidden" name="item_index" value="<?php echo $index; ?>">
  <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
  <input type="hidden" name="name" value="<?php echo $animal['name']; ?>">
  <input type="hidden" name="price" value="<?php echo $animal['price']; ?>">
  <input type="hidden" name="image" value="<?php echo $animal['image']; ?>">
  <a href="maindetails.php" class="button">Owner</a>
  <button class="button" type="submit">Add to Cart</button>
</form>
