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
   $select = mysqli_query($conn, "SELECT chef.cname,chef.salary,cook.title
    FROM chef LEFT JOIN cook ON cook.name = chef.cname; "); 
   ?>

   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Name</th>
            <th>Salary</th>
            <th>Dish</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['cname']; ?></td>
            <td>₹<?php echo $row['salary']; ?>/-</td>
            <td><?php echo $row['title']; ?></td>
         </tr>

      <?php } ?>
      
      </table>
   </div>
</div>
</body>
</html>