<?php 

@include ('config.php');

if(isset($_POST['add_chef'])){
   $name = $_POST['name'];
   $salary = $_POST['salary'];
   if(empty($name) || empty($salary)){
      $message[] = 'please fill out details';
   }
   else{
         $check = mysqli_query($conn, "SELECT * FROM chef WHERE cname = '$name'");
         $cv = $check->num_rows;
         if($cv > 0){
            $message[] = '<b>This chef already works here!!<b>';
         }
      else{
         $insert = "INSERT INTO chef(cname, salary) VALUES('$name', '$salary')";
         $upload = mysqli_query($conn,$insert);
         if($upload){
            $message[] = 'welcome to the new chef';
         }else{
            $message[] = 'could not add this chef';
         }
      }
   }
};

if(isset($_GET['delete'])){
   $pk = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM chef WHERE cname = '$pk'");
   header('location:chef_add.php');
}; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}
?>

 <div class="container">
   <div class="admin-product-form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a chef</h3>
         <input type="text" placeholder="Full Name" name="name" class="box">
         <input type="number" placeholder="Salary" name="salary" class="box">
         <input type="submit" class="btn" name="add_chef" value="add">
         <a href="index.php" class="btn">Back</a>
      </form>
   </div>

   <?php   $select = mysqli_query($conn, "SELECT * FROM chef");   ?>
   
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Name</th>
            <th>Salary</th>
            <th>Action</th>
         </tr>
         </thead>

         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         
            <tr>
            <td><?php echo $row['cname']; ?></td>
            <td>₹<?php echo $row['salary']; ?>/-</td>
            <td>
               <a href="chef_update.php?edit=<?php echo $row['cname']; ?>" class="btn"> <i class="fas fa-edit"></i> update </a>
               <a href="chef_add.php?delete=<?php echo $row['cname']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>

      <?php } ?>
      
      </table>
   </div>
</div>
</body>
</html>