<?php include('partials/menu.php');
include('partials/login_check.php');
?>
      
  <div class="main-content">
  <div class="wrapper">
   <h1>Manage Food</h1>
   <br /><br />
             
             
             

              <!--Button to add admin-->
              
              <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
              <br /><br />
              
              
              
                <?php
      
      
      
      
               if(isset($_SESSION['add'])) 
                {
                    echo $_SESSION['add']; //Displaying Session Message
                    unset($_SESSION['add']); //Removing Session Message
                }
      
                if(isset($_SESSION['fail'])) 
                {
                    echo $_SESSION['fail']; //Displaying Session Message
                    unset($_SESSION['fail']); //Removing Session Message
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
      
               if(isset($_SESSION['no-food-found'])) 
                {
                    echo $_SESSION['no-food-found']; //Displaying Session Message
                    unset($_SESSION['no-food-found']); //Removing Session Message
                }
      
                if(isset($_SESSION['update'])) 
                {
                    echo $_SESSION['update']; //Displaying Session Message
                    unset($_SESSION['update']); //Removing Session Message
                }
               if(isset($_SESSION['failed-remove'])) 
                {
                    echo $_SESSION['failed-remove']; //Displaying Session Message
                    unset($_SESSION['failed-remove']); //Removing Session Message
                }
                if(isset($_SESSION['up'])) 
                {
                    echo $_SESSION['up']; //Displaying Session Message
                    unset($_SESSION['up']); //Removing Session Message
                }
      
      
               ?>
              
              
               <table class="tbl-full">    
                   <tr>
                       <th>S.N</th>
                       <th>title</th>
                       <th>Price</th>
                       <th>Description</th>
                       <th>Image</th>
                       <th>Featured</th>
                       <th>Active</th>
                       <th>Actions</th>
                       
                   </tr>
                   
                   <?php
                    //create sql query to get all the food
                   
                    $sql = "SELECT * FROM tbl_food";
                   
                   //Execute the query
                   $res =mysqli_query($conn, $sql);
                   
                   //count rows to check whether we have foods or not
                   $count = mysqli_num_rows($res);
                   $sn=1;
                   if($count>0)
                   {
                       //We have food in database
                       
                       //get the food from database
                       
                       while($row = mysqli_fetch_assoc($res))
                       {
                           $id = $row['id'];
                           $title = $row['title'];
                           $price = $row['price'];
                           $description = $row['description'];
                           $image_name = $row['image_name'];
                           $featured = $row['feature'];
                           $active = $row['active'];
                           ?>
                                <tr>
                                   <td><?php echo $sn++; ?></td>
                                   <td><?php echo $title; ?></td>
                                   <td><?php echo $price; ?></td>
                                   <td><?php echo $description; ?></td>
                                   <td>
                                       <?php
                           
                                        //check whether we have image or not
                                        if($image_name != "")
                                        {
                                            
                                            
                                             ?>
                                            
                                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name;?>" width="100px;">
                               
                                            
                                            <?php

                                            
                                            
                                        }
                                        else
                                        {
                                            
                                            
                                             //We have no image & display error msg
                                            echo "<div class='error'>Image not added.</div>";
                                            
                                           

                                        }
                           
                       
                                            
                           
                                        ?>
                                        
                                   </td>
                                   <td><?php echo $featured; ?></td>
                                   <td><?php echo $active; ?></td>
                                   <td>
                                       <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                       
                                       
                                       <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php  echo $image_name;?>"class="btn-danger">Delete food</a>


                                   </td>
                               </tr>
                           
                           
                           <?php
                           
                       }
                   }
                    else
                   {
                       //Food not added in database]
                        echo "<tr><td colspan='7' class = 'error '>Food Not ADDed Yet.</td> </tr>";
                       
                   }
                   
                   
                   
                   ?>

                  
               
               </table>
   </div>
    
</div>
    
           
<?php include('partials/footer.php'); ?>\




























