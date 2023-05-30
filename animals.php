
<head>
    <link rel="stylesheet" href="detail.css">
  <title>Admin - Users</title>
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
        <a href="admin.php">Users</a>
        <a href="animals.php">Animals</a>
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
$chickens = $_SESSION['chickens'];
$query = mysqli_query($conn, "SELECT * FROM signup WHERE chickens = '$chickens' ");
$row = mysqli_fetch_array($query);
if ($row) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $cellnum = $_POST['cellnum'];
    $facebook = $_POST['facebook'];
    $address = $_POST['address'];

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

	<br>
	<div>
		
		<h1 align="center">USERS</h1>
		<table class="table" border="10">
			<thead>
				<th class="fm">Fullame</th>
				<th class="fm">Username</th>
				<th class="fm">Contact</th>
				<th class="fm">Email</th>
				<th class="fm">Facebook</th>
				<th class="fm">Address</th>
				<th class="fm">Password</th>
				<th class="fm">Gender</th>
				<th class="fm">Profile</th>
				<th class="fm">Option</th>
			</thead>
			<tbody>

				<?php
					include('conn.php');
					$query=mysqli_query($conn,"select * from `signup`");
          
					while($row=mysqli_fetch_array($query)){
						?>

						<tr>
							<td><?php echo $row['fullname']; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['cellnum']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['facebook']; ?></td>
							<td><?php echo $row['address']; ?></td>
							<td><?php echo $row['password']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><img src="profile_images/<?php echo $row['profile_image']; ?>" class="bor" width="100" height="100" alt="Profile Picture"></td>
							<td>
								<a href="delete.php?id=<?php echo $row['id']; ?> "class="but">Delete</a>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>

<p style="position: center; bottom: 0; width: 100%; text-align: center;">© All Right Reserved Dream Farm</p>

</body>
</html>
