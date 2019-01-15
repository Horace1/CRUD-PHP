<?php

session_start();

$mysqli = new mysqli('localhost', 'root','','crud') or die(mysqli_error($mysqli));  // Connect to Database

$id = 0;
$update = false;
$name = '';
$location = '';


if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name','$location')") or // Send to database
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg-type'] = "success";

    header("location: index.php");

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been Deleted!";
    $_SESSION['msg-type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id='$id'") or die($mysqli->error());
    if(($result->num_rows) ==1)
    {
      $row = $result->fetch_array();
      $name = $row['name'];
      $location = $row['location'];
    }
}

if (isset($_POST['update'])){
	$id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

	$mysqli->query("UPDATE data SET name= '$name', location= '$location' WHERE id= '$id'");
	
	$_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg-type'] = "warning";
	
    header("location: index.php");

}
