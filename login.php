<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
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
    <div class="container">
        <form method="post" action="login.php">
            <h1>Login</h1>
            <input type="email" placeholder="Email" name="email" id="email" required>
            <input type="password" placeholder="Password" name="password" id="password" required>
            <input type="submit" name="login" value="Log in">
            <span></span>
            <div class="show-password">
                <input type="checkbox" id="show-password-checkbox">
                <label for="show-password-checkbox">Show password</label>
                <footer>Don't have an account? <a href="signup.php" class="signup">Signup</a></footer>
            </div>
        </form>
    </div>

    <?php
        session_start();

        if (isset($_POST['login'])) {
            $host = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "signup";

            $conn = mysqli_connect("localhost","root","","signup");

            // Check if email and password match a record in the database
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Check if the login credentials match the admin account
            $adminEmail = "admin@gmail.com";
            $adminPassword = "admin123";
            
            if ($email === $adminEmail && $password === $adminPassword) {
                // Set session variable to indicate that the admin is logged in
                $_SESSION['admin'] = true;

                // Redirect to the admin dashboard or any protected page
                header('Location: admin.php');
                exit();
            }

            $query = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                // Set session variable to indicate that the signup user is logged in
                $_SESSION['email'] = $email;

                // Redirect to the user dashboard or any protected page
                header('Location: mainindex.php');
                exit();
            } else {
                // Show error message if email and password do not match a record in the database
                $error = "Incorrect email or password";
                echo "<script>alert('$error');</script>";
            }
        }
    ?>

    <script>
        const showPasswordCheckbox = document.getElementById("show-password-checkbox");
        const passwordInput = document.querySelector('input[type="password"]');

        showPasswordCheckbox.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });

        function hidePassword() {
            passwordInput.type = "password";
        }

        showPasswordCheckbox.addEventListener("change", function () {
            if (!this.checked) {
                hidePassword();
            }
        });
    </script>
    <p style="position: fixed; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>
</body>
