<?php include('partials/menu.php'); 
include('partials/login_check.php');?>




<div class="main-content">
    <div class="wrapper">
        <h1>CHANGE PASSWORD</h1>
        <br><br>
        <?php
        
            //1.Get the id of selected Admin
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        
        }
       
        
        
        ?>
        <form action="" method="POST">
           <table class="tbl-30">
               <tr>
                   <td>Current Password:</td>
                   <td>
                       <input type="password" name="current_password" placeholder="Old password" value="<?php $password; ?>">
                   </td>
               </tr>
               
               <tr>
                   <td>NEW Password:</td>
                   <td>
                       <input type="password" name="new_password" placeholder="New password" value="<?php $password; ?>">
                   </td>
               </tr>
               
               
               <tr>
                   <td>Confirm Password:</td>
                   <td>
                       <input type="password" name="confirm_password" placeholder="confirm password" value="<?php $password; ?>">
                   </td>
               </tr>
               
                              


               <tr>
                   
                   <td colspan="2">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="submit" name="submit" value="Change password" class="btn-secondary">
                   </td>
               </tr>
           </table>
            
        </form>
    </div>
</div>


<?php
    //check the submit button clicked or not
    
    if(isset($_POST['submit']))
    {
               // echo"Button click";
            //get all tha valuse from form to update
        
        $id =$_POST['id'];
        $current_password =md5($_POST['current_password']);
        $new_password =md5($_POST['new_password']);
        $confirm_password =md5($_POST['confirm_password']);
        
        
        
        //create a SQL ouery 
        $sql = "SELECT * FROM tbl_reg WHERE id=$id AND password='$current_password'";
        
        //execute query
        
        $res = mysqli_query($conn , $sql);
        
        //check query successfully or not
        if($res == true){
            
            $count=mysqli_num_rows($res);
            
            if($count==1)
            {
                
                if($new_password == $confirm_password)
                {
                         //update password
              
                     $sql2 ="UPDATE tbl_reg SET password='$new_password' WHERE id=$id";
              
                       $res2 = mysqli_query($conn , $sql2);
                    
                        if($res2 == true)
                        {
                                      //query execute and admin update 
                            $_SESSION['update-pass'] = "<div class='success'>Admin password updated successfully.</div>";
                                     //redirect to admin page
                                header('location:'.SITEURL.'admin/manage-admin.php');
            
                           }else{
                            
                                         //failed to update
                                         //query execute and admin update 
                                    $_SESSION['matche-pass'] = "<div class='success'>password did not match.</div>";
                                    //redirect to admin page
            
                                    header('location:'.SITEURL.'admin/manage-admin.php');
                            
                            
                                }
                 }else{
            
                             //failed to update
                           //query execute and admin update 
                           $_SESSION['match-pass'] = "<div class='success'>password did not match.</div>";
                             //redirect to admin page
                          header('location:'.SITEURL.'admin/manage-admin.php');
                     }
            
            
            
          }else{
            
                //failed to update
                        //query execute and admin update 
                 $_SESSION['user-not-found'] = "<div class='success'>user not found.</div>";
                   //redirect to admin page
             
                  header('location:'.SITEURL.'admin/manage-admin.php');
               }
     
        }
            
    }
  

    

    
    ?>
