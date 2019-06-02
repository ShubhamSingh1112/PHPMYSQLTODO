<!DOCTYPE html>
<html>
<head>
<title>TODO</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<?php require_once 'process.php'; ?>

<?php 
if(isset($_SESSION['message'])):
 ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php 
echo $_SESSION['message'];
unset($_SESSION['message']);
 ?>
</div>
<?php endif ?>

<div class="jumbotron" style="padding: 0px">
		<?php echo "Today is " . date("Y/m/d ") . date(" l ") . "<br>" ; ?>
</div>

<div class="container">
	<?php
	$mysqli = new mysqli('localhost', 'root', '', 'todo') or die(mysqli_error($mysqli));
	$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
	//print_r($result);
	?>
<div class=" row justify-content-center">
	<table class="table table-striped">
		<thead class="thead-dark">
			<tr>
				<th>Task</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php
		while ($row = $result->fetch_assoc()): ?>
		<tr>
			<td><?php echo $row['Task']; ?></td>
			<td>
				<a href="index.php?Edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
				<a href="process.php?Delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
			</td>
		</tr>
		<?php endwhile; ?>
	</table>
</div>
	<?php
	function pre_r($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	?>
<div class="container-fluid justify-content-center">
	<div class=" row justify-content-center">
	   <h1>Todo List</h1>
    </div>
	<form action="process.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group">
		    <label class=" font-weight-bolder">ADD TASK</label>
		    <input type="text" name="Task" class="form-control" value="<?php echo $Task; ?>" placeholder="Enter the task" required>
        </div>
		<div class="form-group">
			<?php if ($update == true): ?>
			<button type="submit" class="btn btn-info btn-block" name="update">Update</button>
			<?php else: ?>
		    <input type="submit" class="btn btn-success btn-block" name="submit" value="Submit" class="form-control">
		    <?php endif ?>
	    </div>
	</form>
</div>
</body>
</html>