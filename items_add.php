<?php 

 @include ('config.php');

if(isset($_POST['add_product'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;
   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out details';
   }
   else{
         $check = mysqli_query($conn, "SELECT * FROM items WHERE Title = '$product_name'");
         $cv = $check->num_rows;
         if($cv > 0){
            $message[] = '<b>This dish has already been added!!<b>';
         }
      else{
         $insert = "INSERT INTO items(Title, price, pic) VALUES('$product_name', '$product_price', '$product_image')";
         $upload = mysqli_query($conn,$insert);
         if($upload){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'new item added successfully';
         }else{
            $message[] = 'could not add the item';
         }
      }
   }
};

if(isset($_GET['delete'])){
   $pk = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM items WHERE Title = '$pk'");
   header('location:items_add.php');
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
         <h3>add a new dish to the menu</h3>
         <input type="text" placeholder="Dish Title" name="product_name" class="box">
         <input type="number" placeholder="Price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add to menu">
         <a href="index.php" class="btn">Back</a>
      </form>
   </div>

   <?php   $select = mysqli_query($conn, "SELECT * FROM items");   ?>

   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Dish</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['pic']; ?>" height="100" alt=""></td>
            <td><?php echo $row['Title']; ?></td>
            <td>₹<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="items_update.php?edit=<?php echo $row['Title']; ?>" class="btn"> <i class="fas fa-edit"></i> update </a>
               <a href="items_add.php?delete=<?php echo $row['Title']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>

      <?php } ?>
      
      </table>
   </div>
</div>
</body>
</html>