<?php
// Start the session to access the cart data
session_start();

// Retrieve the cart items from the session
$cart = $_SESSION['cart'] ?? array();

// Calculate the total number of items in the cart
$total_items = count($cart);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cart</title>
  <link rel="stylesheet" href="detail.css">
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
        <a href="profile.php"><img src="profilebutton.png" alt="Profile Icon">Profile</a>
        <a href="mainindex.php">Home</a>
        <a href="maincontact.php">Contact Us</a>
        <a href="mainabout.php">About Us</a>
        <a href="index.php">Log Out</a>
      </div>
    </div>
  </nav>

  <h1 class="cart">Cart</h1>

  <div class="container">
    <?php if ($total_items > 0): ?>
      <table>
        <thead>
          <table class="table" border="10">
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $index => $item): ?>
            <tr>
              <td>
                <img src="<?php echo $item['image']; ?>" class="bor" width="300" height="300" alt="Profile Picture" alt="Item photo">
                <?php echo $item['name']; ?>
              </td>
              <td><?php echo $item['price']; ?></td>
              <td>
                <form action="remove_cart.php" method="post" >
                  <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                    <div align="center">
                  <button class="but" type="submit">Remove</button>
                    <a href="checkout.php" class="but" >Proceed to Checkout</a>
                    <a href="mainindex.php" class="but">Back</a>
                    </td>
                </form>
              </td>
            </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Your cart is empty.</p>
    <?php endif; ?>
  </div>

  <p style="position: center; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>
</body>
</html>
