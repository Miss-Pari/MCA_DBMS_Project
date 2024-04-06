<?php  @include ('config.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <div class="container">

   <?php
   $select = mysqli_query($conn, "SELECT items.Title,items.price,items.pic,cook.name FROM items LEFT JOIN cook ON items.Title = cook.title; "); 
   ?>

   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Dish</th>
            <th>Title</th>
            <th>Price</th>
            <th>Cook</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['pic']; ?>" height="100" alt=""></td>
            <td><?php echo $row['Title']; ?></td>
            <td>₹<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['name']; ?></td>
         </tr>

      <?php } ?>
      
      </table>
   </div>
</div>
</body>
</html>