<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <a href="login.php"><img src="truck.jpg"  width="30px" height="30px">Order</a>
          <a href="index.php">Home</a>
          <a href="login.php">Login</a>
          <a href="signup.php">SignUp</a>
          <a href="contact.php">Contact Us</a>
          <a href="about.php">About Us</a>
        </div>
      </div>
    </nav>
    <main>
        <form class="form1" method="POST" action="signup.php" enctype="multipart/form-data">
            <h1>SignUp</h1>
            <div>Profile Picture</div> <input type="file" name="profile_image" accept="image/*" required>
            <form class="form2" method="POST" action="signup.php" enctype="multipart/form-data" required>
            <input type="text" placeholder="Full name" name="name" required>
            <input type="text" placeholder="Username" name="username"required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="facebook" placeholder="Facebook" name="facebook" required>
            <input type="tel" placeholder="Cellphone Number" name="tel" required>
            <input type="address" placeholder="Address" name="address" required>
            <input type="password" placeholder="Password" name="password" required>
            <label for="male">Male</label>
            <input type="radio" name="gender" id="male" value="male" >
            <label for="female">Female</label>
            <input type="radio" name="gender" id="female" value="female" >
            <div class="show-password">
              <input type="checkbox" id="show-password-checkbox">
              <label for="show-password-checkbox">Show password</label>
            <input type="submit" name="submit" value="Sign up">
            <footer>Click here to login <a href="login.php" class="signup">Login</a></footer>
            </div>
        </form>
        <?php
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    
    // File upload
    $profileImageName = $_FILES['profile_image']['name'];
    $profileImageTmpName = $_FILES['profile_image']['tmp_name'];
    $profileImageSize = $_FILES['profile_image']['size'];
    $profileImageError = $_FILES['profile_image']['error'];

    // Check if a file was uploaded successfully
    if ($profileImageError === UPLOAD_ERR_OK) {
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "signup");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Read the image file into a variable
        $profileImageData = file_get_contents($profileImageTmpName);
        $profileImageData = mysqli_real_escape_string($conn, $profileImageData);

        // Check if email exists
        $email_query = mysqli_query($conn, "SELECT * FROM signup WHERE email='$email'");
        $email_row = mysqli_fetch_array($email_query);

        // Check if cellphone number exists
        $tel_query = mysqli_query($conn, "SELECT * FROM signup WHERE cellnum='$tel'");
        $tel_row = mysqli_fetch_array($tel_query);

        // Check if username exists
        $username_query = mysqli_query($conn, "SELECT * FROM signup WHERE username='$username'");
        $username_row = mysqli_fetch_array($username_query);

        if ($email_row) {
            echo "This email is already in use. Please use a different email.";
        } elseif ($tel_row) {
            echo "This cellphone number is already in use. Please use a different number.";
        } elseif ($username_row) {
            echo "This username is already in use. Please choose a different username.";
        } else {
            // Insert the data including the profile image path into the database
            $insert_query = mysqli_query($conn, "INSERT INTO signup (fullname, username, email, facebook, cellnum, address, password, gender, profile_image) VALUES ('$name', '$username', '$email', '$facebook', '$tel', '$address', '$password', '$gender', '$profileImageName')");
    
            if ($insert_query) {
                // Move the uploaded file to a permanent location
                $destination = "profile_images/" . $profileImageName;
                move_uploaded_file($profileImageTmpName, $destination);
    
                echo "Registration successful!";
            } else {
                echo "Registration failed. Please try again.";
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
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

  $sel = "SELECT * FROM signup";
  $query = mysqli_query($conn,$sel);
  $resul = mysqli_fetch_assoc($query);  
  
  ?>

       
        <script>
            const showPasswordCheckbox = document.getElementById('show-password-checkbox');
            const passwordInput = document.querySelector('input[type="password"]');
            showPasswordCheckbox.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                } 
            });
        </script>
    </main>
    </div>
        </div>
          <p style="position: center; margin-top: 1%; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>
    </body>