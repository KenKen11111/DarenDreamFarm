<div>
  <form action="update.php" method="POST">
    <table class="table" border="5">
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
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <input type="text" name="fullname" value="<?php echo $row['fullname']; ?>">
                <?php } else { ?>
                  <?php echo $row['fullname']; ?>
                <?php } ?>
              </td>
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <input type="text" name="username" value="<?php echo $row['username']; ?>">
                <?php } else { ?>
                  <?php echo $row['username']; ?>
                <?php } ?>
              </td>
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <input type="text" name="cellnum" value="<?php echo $row['cellnum']; ?>">
                <?php } else { ?>
                  <?php echo $row['cellnum']; ?>
                <?php } ?>
              </td>
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <input type="text" name="email" value="<?php echo $row['email']; ?>">
                <?php } else { ?>
                  <?php echo $row['email']; ?>
                <?php } ?>
              </td>
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <input type="text" name="facebook" value="<?php echo $row['facebook']; ?>">
                <?php } else { ?>
                  <?php echo $row['facebook']; ?>
                <?php } ?>
              </td>
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <input type="text" name="address" value="<?php echo $row['address']; ?>">
                <?php } else { ?>
                  <?php echo $row['address']; ?>
                <?php } ?>
              </td>
              <td><?php echo $row['password']; ?></td>
              <td><?php echo $row['gender']; ?></td>
              <td>
                <img src="profile_images/<?php echo $row['profile_image']; ?>" class="bor" width="100" height="100" alt="Profile Picture">
              </td>
              <td>
                <?php if (isset($_GET['id']) && $_GET['id'] == $row['id']) { ?>
                  <button type="submit" name="save">Save</button>
                  <a href="admin.php">Cancel</a>
                <?php } else { ?>
                  <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                  <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                <?php } ?>
              </td>
            </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </form>
</div>
