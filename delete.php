<?php
    $id = $_GET['id'];
    include('conn.php');
    mysqli_query($conn, "DELETE FROM `signup` WHERE id='$id'");
    header('Location: admin.php');
    exit(); // Optional: Use exit() to stop script execution after redirection
?>