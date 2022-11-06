# main php code with backend
<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'todo') or die(mysqli_error($mysqli));
$id = 0;
$update = false;
$Task = '';
if (isset($_POST['submit'])) {
	$Task = $_POST['Task'];
	$_SESSION['message'] = "Record has been saved";
	$_SESSION['msg_type'] = "success";
	$mysqli->query("INSERT INTO data (Task) VALUES('$Task')") or die($mysqli->error());
	header("location: index.php");
}
if (isset($_GET['Delete'])) {
	$id = $_GET['Delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id ") or die($mysqli->error());
	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	header("location: index.php");
}
if (isset($_GET['Edit'])) {
	$id = $_GET['Edit'];
	$update = true; 
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id ") or die($mysqli->error());
	if (@count($result) == 1) {
		$row = $result->fetch_array();
		$Task = $row['Task'];
	}
}
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$Task = $_POST['Task'];
	$mysqli->query("UPDATE data SET Task='$Task' WHERE id=$id ") or die($mysqli->error());
	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";
	header("location: index.php");
}
?>
