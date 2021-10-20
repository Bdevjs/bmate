

   <?php

        //Authorization - Access control
       //check whether the user is logged in or not!
        

        include('../config/constants.php'); 
        //include('login_check.php');
        
       


  ?>


   
   <html>
    <head>
        <title>
            Food order website home page
        </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
                

    </head>
    <body>
        <!-- Menu section start-->
        
        <div class="menu">
           <div class="wrapper">
              <ul>
                  <li><a href="index.php">Home</a></li>
                  <li><a href="manage-admin.php">Admin</a></li>
                  <li><a href="manage-category.php">Category</a></li>
                  <li><a href="manage-food.php">Food</a></li>
                  <li><a href="manage-order.php">Order</a></li>
                  <li><a href="logout.php">LogOUT</a></li>
              </ul>
               
           </div>
            
        </div>