<?php
// Start the session to access the cart data
session_start();

// Retrieve the cart items from the session
$cart = $_SESSION['cart'] ?? array();

// Handle the checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the quantity for each item in the cart based on the user input
    foreach ($cart as $index => $item) {
        $quantity = $_POST['quantity'][$index] ?? 1;
        $quantity = max(1, intval($quantity)); // Ensure the quantity is at least 1

        $cart[$index]['quantity'] = $quantity;
        $cart[$index]['total'] = $item['price'] * $quantity;
    }

    // Recalculate the total price
    $total_price = 0;
    foreach ($cart as $item) {
        $total_price += $item['total'];
    }

    // Update the cart data in the session
    $_SESSION['cart'] = $cart;
} else {
    // Calculate the initial total price and quantity of items in the cart
    $total_price = 0;
    foreach ($cart as $index => $item) {
        $cart[$index]['quantity'] = $item['quantity'] ?? 1;
        $cart[$index]['total'] = $item['price'] * $cart[$index]['quantity'];

        $total_price += $cart[$index]['total'];
    }
}

// Remove item from the cart
if (isset($_GET['item_index'])) {
    $item_index = $_GET['item_index'];
    if (isset($cart[$item_index])) {
        unset($cart[$item_index]);

        // Recalculate the total price
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item['total'];
        }

        // Update the cart data in the session
        $_SESSION['cart'] = $cart;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
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
        <a href="checkout.php"><img src="truck.jpg"  width="30px" height="30px">Order</a>
        <a href="profile.php"><img src="profilebutton.png" alt="Profile Icon">Profile</a>
        <a href="mainindex.php">Home</a>
        <a href="maincontact.php">Contact Us</a>
        <a href="mainabout.php">About Us</a>
        <a href="index.php">Log Out</a>
      </div>
    </div>
  </nav>

  <h1 class="cart">Checkout</h1>

  <div class="container">
    <?php if ($total_price > 0): ?>
        <form action="" method="post">
            <table class="table" border="10px">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $index => $item): ?>
                        <tr>
                            <td>
                                <img src="<?php echo $item['image']; ?>" class="borr" width="300" height="300" alt="Profile Picture" alt="Item photo">
                                <?php echo $item['name']; ?>
                            </td>
                            <td><?php echo $item['price']; ?></td>
                            <td>
                                <input type="number" name="quantity[<?php echo $index; ?>]" value="<?php echo $item['quantity']; ?>" min="1" onchange="recalculateTotal(this, <?php echo $item['price']; ?>, <?php echo $index; ?>)">
                            </td>
                            <td><?php echo $item['total']; ?></td>
                            <td align="center">
                                <button class="butq" type="submit">Update</button>
                                <a href="checkout.php?item_index=<?php echo $index; ?>" class="butq">Remove</a>
                                <a href="mainindex.php" class="butq">Back to Main</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total:</strong></td>
                            <td><?php echo $total_price; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            <td><input type="text" placeholder="Delivery Address"></td>
        <a href="remove_cart.php?include_items=true" class="butq">Place Order</a>
    <?php else: ?>
        <p>Your truck is empty.</p>
    <?php endif; ?>
</div>

  <script>
    function recalculateTotal(input, price, index) {
      var quantity = parseInt(input.value);
      if (isNaN(quantity) || quantity < 1) {
        quantity = 1;
        input.value = quantity;
      }

      var totalCell = document.getElementById('total-' + index);
      var total = price * quantity;
      totalCell.textContent = total;
    }
  </script>

  <p style="position: center; bottom: 0; width: 100%; text-align: center;">© All Rights Reserved Dream Farm</p>
</body>
</html>
