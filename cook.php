<?php 

@include ('config.php');

if(isset($_POST['add_cook'])){
   $name = $_POST['name'];
   $title = $_POST['title'];
   if(empty($name) || empty($title)){
      $message[] = 'please fill out both fields below';
   }
   else{
         $checkC = mysqli_query($conn, "SELECT * FROM chef WHERE cname = '$name'");
         $cvC = $checkC->num_rows;
         $checkT = mysqli_query($conn, "SELECT * FROM items WHERE Title = '$title'");
         $cvT = $checkT->num_rows;
         if($cvC == 0 && $cvT == 0){
            $message[] = '<b>This chef does not works here nor this dish is served here!!<b>';
            $message[] = '<b>No such dish is served here!!<b>';
         }elseif($cvC == 0 && $cvT > 0){
            $message[] = '<b>This chef does not works here!!<b>';
         }elseif($cvC > 0 && $cvT == 0){
            $message[] = '<b>No such dish is served here!!<b>';
         }

      else{
        $check = mysqli_query($conn, "SELECT * FROM cook WHERE name = '$name' and title = '$title'");
         $cv = $check->num_rows;
         if($cv > 0){
            $message[] = '<b>This record already exists!!<b>';
         }else{
         $insert = "INSERT INTO cook(name, title) VALUES('$name', '$title')";
         $upload = mysqli_query($conn,$insert);
         if($upload){
            $message[] = 'Successfully added';
         }else{
            $message[] = 'could not add this record';
         }
        }
      }
   }
};

if(isset($_GET['delete'])){
   $pk = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM cook WHERE rID = '$pk'");
   header('location:cook.php');
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
         <h3>add a cook</h3>
         <input type="text" placeholder="Full Name" name="name" class="box">
         <input type="text" placeholder="Title" name="title" class="box">
         <input type="submit" class="btn" name="add_cook" value="add">
         <a href="index.php" class="btn">Back</a>
      </form>
   </div>

   <?php $select = mysqli_query($conn, "SELECT * FROM cook");  ?>

   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Name</th>
            <th>Dish</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td>
               <a href="cook.php?delete=<?php echo $row['rID']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>

      <?php } ?>
      
      </table>
   </div>
</div>
</body>
</html>