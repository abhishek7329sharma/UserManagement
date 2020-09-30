<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>UserManagementSystem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css\styles.css">
  </head>

  <body>
    <h1 class="row justify-content-center">User Management System</h1>
  <?php require_once 'process.php'; ?>

  <?php

if (isset($_SESSION['message'])): ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">


    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
     ?>

   </div>


 <?php endif ?>

  <div class="container">

  <?php
$mysqli = new mysqli('localhost', 'root', 'pwd1234', 'ums') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
// pre_r($result);
?>
<div class="row justify-content-center">
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>EmlpyeeId</th>
        <th>Phone</th>
        <th>Location</th>
        <th>Action</th>
      </tr>

    </thead>
<?php
while($row = $result->fetch_assoc()):
 ?>
 <tr>

   <td><?php echo $row['name'];?></td>
   <td><?php echo $row['email'];?></td>
   <td><?php echo $row['employeeid'];?></td>
   <td><?php echo $row['phone'];?></td>
   <td><?php echo $row['location'];?></td>
   <td>
     <a href="index.php?edit=<?php echo $row['id'];?>"
       class="btn btn-info">Edit</a>
     <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
   </td>

 </tr>
<?php endwhile; ?>
  </table>


</div>

<?php

// <!-- pre_r($result->fetch_assoc()); -->

function pre_r( $array){

  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

   ?>
<div class="row justify-content-center">

    <form class="" action="process.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">
      <label for="">Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo "$name"; ?>" placeholder="Enter your name">
    </div>

  <div class="form-group">
      <label for="">Email</label>
<input type="email" name="email" class="form-control" value="<?php echo "$email"; ?>" placeholder="Enter your email">
</div>

<div class="form-group">
<label for="">Employeeid</label>
<input type="tel" name="employeeid"  class="form-control" value="<?php echo "$employeeid"; ?>" placeholder="Enter your EmployeeID">
</div>

<div class="form-group">
<label for="">Phone</label>
<input type="tel" name="phone" class="form-control" value="<?php echo "$phone"; ?>" placeholder="Enter your contact">

</div>

<div class="form-group">
<label for="">Location</label>
<input type="text" name="location" class="form-control" value="<?php echo "$location"; ?>" placeholder="Enter your location">
</div>
<div class="form-group">
  <?php
if ($update == true):
  ?>
  <button type="submit" class="btn btn-info" name="update">Update</button>
<?php else: ?>
<button type="submit" class="btn btn-primary" name="save">Save</button>
<?php endif; ?>
</div>
    </form>
  </div>
</div>

  </body>
</html>
