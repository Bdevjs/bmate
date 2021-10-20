<?php
    //include constants.php
     include('../config/constants.php');

    //2.Destory the session
    session_destroy();

    //3.Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
    
    
?>