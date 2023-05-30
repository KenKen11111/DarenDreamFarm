
<head>
  <title>User Profile</title>
  <link rel="stylesheet" href="detail.css">
</head>
<body>
  <nav>
    <a href="index.php">
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

<?php
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "signup";

$conn = mysqli_connect("localhost", "root", "", "signup");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();
$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM signup WHERE email = '$email' ");
$row = mysqli_fetch_array($query);
if ($row) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $cellnum = $_POST['cellnum'];
    $facebook = $_POST['facebook'];
    $address = $_POST['address'];

    $updateQuery = "UPDATE signup SET username='$username', fullname='$fullname', cellnum='$cellnum', facebook='$facebook', address='$address' WHERE email='$email'";

    if (mysqli_query($conn, $updateQuery)) {
      echo "Profile updated successfully";
      $row['username'] = $username;
      $row['fullname'] = $fullname;
      $row['cellnum'] = $cellnum;
      $row['facebook'] = $facebook;
      $row['address'] = $address;
    } else {
      echo "Error updating profile: " . mysqli_error($conn);
    }
    }
}


?>
  <div class="wrapper">
    <div class="container">
      <div class="gallery">
        <div class="item">
          <div class="text">
            <img src="profile_images/<?php echo $row['profile_image']; ?>" class="bor" width="400" height="400" alt="Profile Picture">
            <h2>Profile</h2>
            <form action="profileedit.php" method="POST">
            <p><strong>Username:</strong> <input type="text" name="username" value="<?php echo $row['username']; ?>"></p>
            <p><strong>Name:</strong> <input type="text" name="fullname" value="<?php echo $row['fullname']; ?>"></p>
            <p><strong>Contact:</strong> <input type="text" name="cellnum" value="<?php echo $row['cellnum']; ?>"></p>
            <p><strong>Gmail:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Facebook:</strong> <input type="text" name="facebook" value="<?php echo $row['facebook']; ?>"></p>
            <p><strong>Address:</strong> <input type="text" name="address" value="<?php echo $row['address']; ?>"></p>
            <p class="center-button" align="center"><input type="submit" value="Update Profile" class="but">
            </p>
            <a href="profile.php" class="but">Back</a>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<p style="position: center; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>

</body>
</html>
