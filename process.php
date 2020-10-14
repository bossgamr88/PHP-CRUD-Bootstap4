<?php 
	
	session_start();

	$mysqli = new mysqli('localhost','bospos','bossgamr11','curd_br4') 
	or die(mysqli_error($mysqli));

	$id = 0;
	$update = false;
	$name = '';
	$location = '';

	if(isset($_POST['save'])){
		$name = $_POST['name'];
		$location = $_POST['location'];

		$mysqli->query("insert into data(name,location) values('$name','$location')")
		or die($mysqli->error);

		$_SESSION['message'] = "Record has been saved!";
		$_SESSION['msg_type'] = "success";

		header("location: index.php");
	}

	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$mysqli->query("delete from data where id=$id") or die($mysqli->error());

		$_SESSION['message'] = "Record has been delete!";
		$_SESSION['msg_type'] = "danger";

		header("location: index.php");

	}

	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$update = true;
		$result = $mysqli->query("select * from data where id=$id") or die($mysqli->error());
		if($result->num_rows == 1){
			$row = $result->fetch_array();
			$name = $row['name'];
			$location = $row['location'];
		}
	}

	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$location = $_POST['location'];

		$mysqli->query("update data set name='$name',location='$location' where id=$id ") or die($mysqli->error());

		$_SESSION['message'] = "Record has been updated!";
		$_SESSION['msg_type'] = "warning";

		header("location: index.php");
 	}
?>

<!-- https://www.php.net/manual/en/function.count.php

Warning จะขึ้นเป็น ปกติ ที่ array มากกว่า 1

อ่านจาก comment

ใช้ $result->num_rows == 1

เป็น num_row  http://code.function.in.th/php/mysqli/num_rows 

https://www.geeksforgeeks.org/php-mysqli_num_rows-function/

-->

