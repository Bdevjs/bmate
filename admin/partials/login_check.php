   <?php

    //Authorization - Access control
    //check whether the user is logged in or not!
   

    if(!isset($_SESSION['user']))
    {
        //user is nt logging
        //redirecy the login page 
    $_SESSION['no-login-msg']="<div class='error'>Please login to access Admin panel </div>";
              //redirect to admin page
       header('location:'.SITEURL.'admin/login.php');
    }


?>