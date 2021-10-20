<?php include('partials/menu.php');
include('partials/login_check.php');
?>




<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN PAGE</h1>
        <br><br>
        <?php
        
            //1.Get the id of selected Admin
            $id=$_GET['id'];
        
            //2.Create SQL  Query too get details
            $sql ="SELECT * FROM tbl_reg";
            
            //3.EXECUTE QUERY
            $res = mysqli_query($conn , $sql);
        
        
        if($res == true){
            //check the data is avaible or not
            $count = mysqli_num_rows($res);
            //check we have admin data or not
            if($count == 1)
            {
                //Get the details
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            }
        }else
        {
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/mange-admin.php');
        }
       
        
        
        
        
        
        
        
        
        
        
        
        
        ?>
        <form action="" method="POST">
           <table class="tbl-30">
               <tr>
                   <td>Full Name:</td>
                   <td>
                       <input type="text" name="full_name" value="<?php $full_name; ?>">
                   </td>
               </tr>
               <tr>
                   <td>Username:</td>
                   <td>
                       <input type="text" name="username" value="<?php $username; ?>">
                   </td>
               </tr>
               <tr>
                   
                   <td colspan="2">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="submit" name="submit" value="Update-Admin" class="btn-secondary">
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
        $full_name =$_POST['full_name'];
        $username =$_POST['username'];
        
        
        //create a SQL ouery t update Admin
        $sql = "UPDATE tbl_reg SET
            full_name = '$full_name',
            username = '$username'
            WHERE id ='$id'
        
        ";
        
        //execute query
        
        $res = mysqli_query($conn , $sql);
        
        //check query successfully or not
        if($res == true)
        {
            //query execute and admin update 
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            //redirect to admin page
            
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            
            //failed to update
                        //query execute and admin update 
            $_SESSION['update'] = "<div class='success'>Admin updated fail.</div>";
            //redirect to admin page
            
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
            
        }

    

    
    ?>



























































<?php include('partials/footer.php'); ?> 