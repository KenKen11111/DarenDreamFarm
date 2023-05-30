<?php
	include('conn.php');
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