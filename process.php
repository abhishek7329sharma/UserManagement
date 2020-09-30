<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'pwd1234', 'ums') or die(mysqli_error($mysqli));
$update =false;
$id=0;
$name = '';
$email = '';
$employeeid = '';
$phone ='';
$location ='';

if (isset($_POST['save'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $employeeid = $_POST['employeeid'];
$phone =$_POST['phone'];
$location =$_POST['location'];


$mysqli->query("INSERT INTO data (name, email, employeeid, phone, location) VALUES( '$name', '$email', '$employeeid', '$phone', '$location')") or
die($mysqli->error);

$_SESSION['message'] = "Record has been saved!";
$_SESSION['msg_type'] ="success";

header("location: index.php");
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM  data WHERE id=$id") or die($mysqli->error());
  $_SESSION['message'] ="Record has been deleted!";
  $_SESSION['msg_type'] ="danger";
  header("location: index.php");
}

if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update=true;
  $result = $mysqli->query("SELECT * FROM  data WHERE id=$id") or die($mysqli->error());

if(count($result)==1){
  $row = $result->fetch_array();
  $name = $row['name'];
  $email =$row['email'];
  $employeeid = $row['employeeid'];
$phone =$row['phone'];
$location =$row['location'];

}
}

if(isset($_POST['update'])){
  $id =$_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $employeeid = $_POST['employeeid'];
$phone =$_POST['phone'];
$location =$_POST['location'];

  $mysqli->query("UPDATE data SET name='$name', email='$email', employeeid='$employeeid', phone='$phone', location='$location' WHERE id=$id") or die($mysqli->error());
  $_SESSION['message'] ="Record has been Updated!";
  $_SESSION['msg_type'] ="warning";
  header("location: index.php");
}
