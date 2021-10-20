

<?php


 //include constants.php file here
  include('../config/constants.php');

    // 1.get the id of admin to be Deleted


     $id = $_GET['id'];

    //2.Create SQL query to delete admin
    $sql = "DELETE FROM tbl_reg WHERE id=$id";

    //Execute Query
    
    $res = mysqli_query($conn,$sql);

    //3. check the query properly execute or not
    
    if($res == true){
        
       
        //create session variable to display msg
        
        $_SESSION['delete'] =  "<div class='success'>Admin Delete Sucessfully</div>";
        
        //Redirect to manage admin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        
        $_SESSION['delete'] = "<div class='error'>fail to  Delete .Try again!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }




?>