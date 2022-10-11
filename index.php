<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Bootstrap demo</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
      <?php require_once 'process.php'; ?>
      <?php 
         if(isset($_SESSION['message'])):
          ?>
      <div class="toast-container position-fixed bottom-0 end-0 p-3">
         <div id="liveToast" class="toast <?=$_SESSION['msg_type']?>" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
               <img src="..." class="rounded me-2" alt="...">
               <strong class="me-auto">Task added</strong>
               <small>1s ago</small>
               <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               <?php 
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                       ?>
            </div>
         </div>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
      <script>
         const toastTrigger = document.getElementById('liveToastBtn')
         	const toastLiveExample = document.getElementById('liveToast')
         	if (toastTrigger) {
         	  toastTrigger.addEventListener('click', () => {
         	    const toast = new bootstrap.Toast(toastLiveExample)
         
         	    toast.show()
         	  })
         	}
      </script>
   </body>
</html>
