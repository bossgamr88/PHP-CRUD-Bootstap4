<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP CURD</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>
<body>
	<?php require_once 'process.php'; ?>

	<?php 
	if(isset($_SESSION['message'])): ?>

	 <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
	 	<?php 
	 		echo $_SESSION['message'];
	 		unset($_SESSION['message']);
	 	 ?>
	 	</div>
	 <?php endif ?>


	<div class="container">
	<?php 
		$mysqli = new mysqli('localhost','bospos','bossgamr11','curd_br4') 
		or die(mysqli_error($mysqli));

		$result = $mysqli->query("select * from data") or die($mysqli->error);

		// pre_r($result);
		 // pre_r($result->fetch_assoc());
		// pre_r($result->fetch_assoc());
	?>
	
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
			<?php 
				while ($row = $result->fetch_assoc()): ?>
				<tr>
					<th><?php echo $row['name']; ?></th>
					<th><?php echo $row['location']; ?></th>
					<td>
						<a href="index.php?edit=<?php echo $row['id'];  ?>" class="btn btn-info">Edit</a>
						<a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>	
					</td>
				</tr>
			<?php endwhile; ?>
			</table>
		</div>
	<?php 
		function pre_r($array){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
	 ?>

	<div class="form-row justify-content-center">
		<form action="process.php" method="POST" >
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $name;  ?>" placeholder="Enter your name">
			</div>
			<div class="form-group">
				<label>Location</label>
				<input type="text" class="form-control" name="location" value="<?php echo $location; ?>" placeholder="Enter your location ">
			</div>
			<div class="form-group">
				<?php 
					if($update == true): 
				 ?>
				 	<button type="submit" class="btn btn-info" name="update">Update</button>
				<?php else: ?>
					<button type="submit" class="btn btn-primary" name="save">Save</button>
				<?php endif ?>
				
			</div>
		</form>
	</div>

	</div>

</body>
</html>