<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>E-Menu and Chef Records</title>
   <link rel="stylesheet" href="css/style.css">
   <style>
      body {
         background-color: var(--bg-color);
         font-family: 'Poppins', sans-serif;
      }

      .container {
         background-color:#f2f2f2;;
         border-radius: 20px;
         box-shadow: var(--box-shadow);
         padding: 2rem;
         margin: 3rem auto;
         max-width: 800px;
      }

      h2 {
         text-align: center;
         color: var(--black);
         margin-bottom: 2rem;
         font-size: 4.6rem;
         
      }

      .buttons-container {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }

      .btn {
         display: inline-block;
         margin: 0.5rem;
         padding: 1rem 2rem;
         font-size: 3.6rem;
         border-radius: 20px;
         background-color: var(--main);
         color: #333;
         font-weight: bold;
         transition: background-color 0.3s ease;
      }

      .btn:hover {
         background-color: var(--black);
         color: var(--white);
      }
   </style>
</head>
<body>

<div class="container">
   <h2>Welcome to the<br>E-Menu & Chef Records System</h2>
   <div class="buttons-container">
      <a href="items_add.php" class="btn">Item</a>
      <a href="chef_add.php" class="btn">Chef</a>
      <a href="right.php" class="btn">Chefs with Dishes(Right Join)</a>
      <a href="left.php" class="btn">Items w/o Cooks(Left Join)</a>
      <a href="cook.php" class="btn">Items & Chef</a>
   </div>
</div>

</body>
</html>