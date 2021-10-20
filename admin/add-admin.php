<?php include('partials/menu.php'); 
include('partials/login_check.php');
?>





<div class="main-content">
   <div class="wrapper">
       <h1>Add Admin</h1><br>
       
       <form action="" method="POST">
           
           <table class="tbl-30">
               <tr>
                   <td>Full Name: </td>
                   <td><input type="text" name="full_name" placeholder="Enter your name"></td>
               </tr>
               <tr>
                   <td>Username: </td>
                   <td><input type="text" name="username" placeholder="Enter your username"></td>
               </tr>
               <tr>
                   <td>Password: </td>
                   <td><input type="password" name="password" placeholder="Enter your Password"></td>
               </tr>
               
               <tr>
                   <td colspan="2">
                      <input type="submit" name="submit" class="btn-secondary" value="Add Admin">
                       
                   </td>
               </tr>
           </table>
       </form>
       
   </div>
    
</div>


<?php include('partials/footer.php'); ?> 



<?php
    
    
    //process the valu from form and save it in database
    // Check whether the submit button is clicked or not
    
    if(isset($_POST['submit']))
    {
        //button clicked
       // echo"Button click";
        
        
        //1. get the data from our form
        
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); //md5 for incript password
        
        
        
        //2. SQL query to save the date into database
        
        $sql = "INSERT INTO tbl_reg SET
            full_name = '$full_name',
            username ='$username',
            password ='$password'
        
        ";
        
        
        
        //3.Execute Query and save data in database
        
        $res = mysqli_query($conn,$sql) or die(mysqli_error());
        
        
        //4.Check whether the (Query is executed ) data is inserted or not and display appropriate massage 
        
        if($res == TRUE){
            
            //DATA INSERT
            //create a session variable to dispaly massage & i create seccsion in constants.php page.
            
            $_SESSION['add'] ="Admin Added successfully";
            
            //redirect page to manage-admin page
            
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            
            //NOT INSERT
            
            
                       //create a session variable to dispaly massage & i create seccsion in constants.php page.
            
            $_SESSION['add'] ="Fail to add admin";
            
            //redirect page to admin page
            
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

    
    
    
    
    
    ?>