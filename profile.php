<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="detail.css">
  </head>
  </body>
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

  <?php 

$host = "localhost";
$username = "username";
$password = "password";
$dbname = "signup";


$conn = mysqli_connect("localhost","root","","signup");


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

  $sel = "SELECT * FROM signup";
  $query = mysqli_query($conn,$sel);
  $resul = mysqli_fetch_assoc($query);  
  
  ?>

      <?php
              $host = "localhost";
              $username = "username";
              $password = "password";
              $dbname = "signup";
              
              $conn = mysqli_connect("localhost","root","","signup");
              if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
              session_start();
              $email = $_SESSION['email'];
              $query = mysqli_query($conn, "SELECT * FROM signup WHERE email = '$email' ");
              $row = mysqli_fetch_array($query);
              if ($row) {
                ?>
           
          <div class="wrapper">
          <div class="container">
          <div class="gallery">
          <div class="item"> 
          <div class="text">

            <img src="profile_images/<?php echo $row['profile_image']; ?>" class="bor" width="400" height="400" alt="Profile Picture">
            <h2>Profile</h2>
            <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
            <p><strong>Name:</strong> <?php echo $row['fullname']; ?></p>
            <p><strong>Contact:</strong> <?php echo $row['cellnum']; ?></p>
            <p><strong>Gmail:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Facebook:</strong> <?php echo $row['facebook']; ?></p>
            <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
            <p><a href="profileedit.php" class="but" >Update Profile</a></p>
            
            <?php
    } else {
      echo "No record found";
    }
    ?>

         </div>
       </div>
      </div>
    </div>
  </div>
  <p style="position: center; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>
</body>