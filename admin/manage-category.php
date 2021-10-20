<?php include('partials/menu.php');
include('partials/login_check.php');

?>
<div class="main-content">
  <div class="wrapper">
   <h1>Manage Category</h1>
   
   <br /><br />
             
             
              <!--Button to add admin-->
              
 <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Catagroy</a>
              <br /><br />
              <?php
      
      
      
      
               if(isset($_SESSION['add'])) 
                {
                    echo $_SESSION['add']; //Displaying Session Message
                    unset($_SESSION['add']); //Removing Session Message
                }
      
            
                if(isset($_SESSION['remove'])) 
                {
                    echo $_SESSION['remove']; //Displaying Session Message
                    unset($_SESSION['remove']); //Removing Session Message
                }
                  
                if(isset($_SESSION['delete'])) 
                {
                    echo $_SESSION['delete']; //Displaying Session Message
                    unset($_SESSION['delete']); //Removing Session Message
                }
                if(isset($_SESSION['no-category-found'])) 
                {
                    echo $_SESSION['no-category-found']; //Displaying Session Message
                    unset($_SESSION['no-category-found']); //Removing Session Message
                }
                if(isset($_SESSION['update'])) 
                {
                    echo $_SESSION['update']; //Displaying Session Message
                    unset($_SESSION['update']); //Removing Session Message
                }
      
                 if(isset($_SESSION['upload'])) 
                {
                    echo $_SESSION['upload']; //Displaying Session Message
                    unset($_SESSION['upload']); //Removing Session Message
                }
      
                if(isset($_SESSION['failed-remove'])) 
                {
                    echo $_SESSION['failed-remove']; //Displaying Session Message
                    unset($_SESSION['failed-remove']); //Removing Session Message
                }
      
      
      
              ?>
      
      
              <br /><br />
              
               <table class="tbl-full">    
                   <tr>
                       <th>S.N</th>
                       <th>Title</th>
                       <th>Image</th>
                       <th>Feature</th>
                       
                       <th>Active</th>
                       <th>Action</th>
                       
                       
                   </tr>
                   <?php
                    //Query to Get all the category from database
                        $sql ="SELECT * FROM tbl_categroy";
                   
                    //execute query
                    $res = mysqli_query($conn,$sql);
                   //couunt rows
                   
                   $count = mysqli_num_rows($res);
                   
                   //create seial number variable
                   $sn=1;
                   
                   //check whether we have data in database or not
                   if($count > 0)
                   {
                       //we have data in database
                       //get the data and display
                       while($row=mysqli_fetch_assoc($res))
                       {
                           $id = $row['id'];
                           $image_name = $row['image_name'];
                           $featured = $row['featured'];
                           $active = $row['active'];
                           $title = $row['title'];
                           
                           
                           ?>
                <tr>
                       <td><?php echo $sn++; ?></td>
                       <td><?php echo $title; ?></td>
                       
                       
                       <td>
                       <?php
                           //check whether image is available or not
                           if($image_name!==""){
                               //display the image
                               ?>
                               
                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px;">
                               
                               <?php
                               
                           }else{
                               //display the msg
                               echo "<div class='error'>Image not added.</div>";
                           }
                           
                       ?>
                       
                       </td>
                       
                       <td><?php echo $featured; ?> </td>
                       <td><?php echo $active;?> </td>
                       <td>
                           <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                           <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php  echo $image_name;?>" class="btn-danger">Delete Category</a>
                           
                           
                       </td>
                   </tr>
                           
                           <?php
                           
                       }
                   }
                   else{
                       //we don't have data
                       //we'll display the msg inside table
                       
                       ?>
                       
                       <tr>
                           <td colspan="6"><div class="error">No caregory Added.</div></td>
                       </tr>
                       <?php
                       
                   }
                   
                   
                   ?>

                   
               
               </table>
   </div>
    
</div>






<?php include('partials/footer.php'); ?>