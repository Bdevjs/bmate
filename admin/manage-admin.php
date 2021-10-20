  
        <!-- Menu section start-->

        <?php include('partials/menu.php');
            include('partials/login_check.php');
        ?>
   
        <!-- Menu section Ends-->
        
        
        
        <!-- Content section start-->
        <div class="main-content">
           <div class="wrapper">
              <h1>MANAGE ADMIN</h1>
              <br /><br />
              
              
              
              <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Displaying Session Message
                    unset($_SESSION['add']); //Removing Session Message
                }
               
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete']; //Displaying Session Message
                    unset($_SESSION['delete']); //Removing Session Message
                }
               if(isset($_SESSION['update'])) //[link with update admin page line 107]
                {
                    echo $_SESSION['update']; //Displaying Session Message
                    unset($_SESSION['update']); //Removing Session Message
                }
               if(isset($_SESSION['update-pass'])) //[link with update admin page line 107]
                {
                    echo $_SESSION['update-pass']; //Displaying Session Message
                    unset($_SESSION['update-pass']); //Removing Session Message
                }
               if(isset($_SESSION['match-pass'])) //[link with update admin page line 107]
                {
                    echo $_SESSION['match-pass']; //Displaying Session Message
                    unset($_SESSION['match-pass']); //Removing Session Message
                }
               if(isset($_SESSION['user-not-found'])) //[link with update admin page line 107]
                {
                    echo $_SESSION['user-not-found']; //Displaying Session Message
                    unset($_SESSION['user-not-found']); //Removing Session Message
                }
               ?>
               
               <br> <br><br>
              <!--Button to add admin-->
              
              <a href="add-admin.php" class="btn-primary">Add Admin</a>
              <br /><br />
              
              
               <table class="tbl-full">    
                   <tr>
                       <th>S.N</th>
                       <th>Full Name</th>
                       <th>User Name</th>
                       <th>Action</th>
                       
                   </tr>
                   
                   
                   <?php
                        
                   //query to get all admin
                   
                   $sql = "SELECT * FROM tbl_reg";
                    
                    //execute the query
                 
                    $res = mysqli_query($conn, $sql);
                   
                   //Check whether query execute or not
                   
                   if($res == TRUE)
                   {
                       //Count the rows ....how many rows in database
                       
                       $count = mysqli_num_rows($res); // function t get all the rows in database
                       
                       $sn =1; //create variable and assign the value
                       
                       //check the number of rows
                       
                       if($count>0)
                       {
                           //we have data in database
                           while($rows=mysqli_fetch_assoc($res))
                           {
                               //using while loop for get all the data from database one by one
                               
                               //get individule data
                               
                               $id=$rows['id'];
                               $full_name=$rows['full_name'];
                               $username=$rows['username'];
                               
                               
                               
                               //display the value in our table
                               ?>
                               
                               
                               
                        <tr>
                           <td><?php echo $sn++; ?></td>
                           <td> <?php echo $full_name; ?></td>
                           <td> <?php echo $username; ?></td>
                           <td>
                              <a href="<?php echo SITEURL;?>admin/update-password.php? id=<?php echo $id;?>" class="btn-primary">Change password</a>
                              
                              <a href="<?php echo SITEURL;?>admin/update-admin.php? id=<?php echo $id;?>" class="btn-secondary">Update admin</a>
                              
                              <a href="<?php echo SITEURL;?>admin/delete-admin.php? id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                           
                           
                           </td>
                       </tr>
                                   
                       <?php
                               
                               
                           }
                       }
                       else{
                           
                           
                       }
                   }
                   ?>
                   

               
               </table>

               
           </div>
            
        </div>
        
        <!-- Content section Ends-->
        
        
        
        <!-- Footer section start-->
        
        <?php include('partials/footer.php'); ?> 

        <!-- Footer section ends-->
