<?php include('partials/menu.php');?>




<div class="main-content">
   <div class="wrapper">
       <h1>Update Category</h1><br>
       
       
       <?php 
            //check wether the id value is set or not
    if(isset($_GET['id']))
    {
            //Get the id and allother details
             $id = $_GET['id'];

                    //SQL query for delete data from database

            $sql = "SELECT * FROM tbl_categroy WHERE id =$id";

            //Execute the query
            $res= mysqli_query($conn,$sql);

            //count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //get all data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                //redirect with msg
             //set fail msg and redirect 
              $_SESSION['no-category-found'] = "<div class='error'>
                  Category not found</div>";

            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            }

        
    }else{
        
        //redirect 
        header('location:'.SITEURL.'admin/manage-category.php');
    }
       
       
       ?>
       
       
       
       
       
       
       <form action="" method="POST" enctype="multipart/form-data">
           
        <table class="tbl-30">
           <tr>
               <td>Title :</td>
               <td>
                   <input type="text" name="title" placeholder="Category title" value="<?php echo $title;?>">
               </td>
           </tr>
           
           <tr>
               <td>current Image:</td>
               <td>
                   <?php
                    if($current_image != "")
                    {
                        //display the image
                     ?>
                      
                      
                      <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                       <?php
                        
                        
            
                    }else
                    {
                        //display the message
                        echo "<div class='error'>Image not added</div>" ;
                    }
                   ?>
               </td>
           </tr>
            <tr>
               <td>New Image:</td>
               <td>
                   <input type="file" name="image" >
               </td>
           </tr>
           
           <tr>
               <td>Featured :</td>
               <td>
                   <input <?php if($featured == "Yes"){echo"checked";} ?> type="radio" name="featured" value="Yes" >YES
                   
                   <input<?php if($featured == "No"){echo"checked";} ?> type="radio" name="featured"  value="No">NO
               </td>
           </tr>
           
           <tr>
               <td>ACTIVE :</td>
               <td>
                   <input <?php if($active == "Yes"){echo"checked";} ?> type="radio" name="active" value="Yes" >YES
                   <input <?php if($active == "Yes"){echo"checked";} ?> type="radio" name="active" value="No" >NO
               </td>
           </tr>
            
        
        <tr>
            <td>
               <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
               <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Update category" class="btn-primary">
            </td>
        </tr>
        </table>
       </form>
       
       
       
       <?php
       
        if(isset($_POST['submit']))
        {
            //get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            
            
            if($current_image != "")
            {
            
            //2.updating New image if selected
            //whether image selected or not
            if(isset($_FILES['image']['name']))
            {
                          //Get the image details
                            $image_name = $_FILES['image']['name'];

                            //check image is available or not
                            if($image_name != "")
                            {
                                //image Available
                                //upload the new image
                                //Auto rename our image
                            //getthe extention of our image (jpg,png,gif,etc)"food1.jpg"

                            $ext = end(explode('.',$image_name)); //THis code is for getting extention file like jpg,png

                            //rename the image

                            $image_name ="Food_Category".rand(000, 999).'.'.$ext; //new name is Food_Category_41.jpg

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            //finally upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check whether image upload or not
                            //and if the image is nott uploaded we will stop the process and redirect with error msg.

                            if($upload==false)
                            {
                                    //set msg

                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image. </div>";

                                    //redirect to add category page

                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    //stop the process

                                    die();//stop process
                            }

                                //remove the curret image
                                $remove_path ="../images/category/".$current_image;
                                $remove = unlink($remove_path);

                                //check image remove or not
                                if($remove == false)
                                {
                                    //failed to remove image;
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image. </div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();//stop process

                                }
                            }
                            else{

                                $image_name = $current_image;
                            }
                }else{
                
                       $image_name = $current_image;
                
                     }
                
            }else{
                
                
                
                        if(isset($_FILES['image']['name']))
                        {
                            //upload the image
                            //to uploade the image we need image name and source path and destination path

                            $image_name = $_FILES['image']['name'];

                            //upload the iamge only if image is selected

                            if($image_name != "")
                            {



                                    //Auto rename our image
                                    //getthe extention of our image (jpg,png,gif,etc)"food1.jpg"

                                    $ext = end(explode('.',$image_name)); //THis code is for getting extention         file like jpg,png

                                    //rename the image

                                    $image_name ="Food_Category".rand(000, 999).'.'.$ext; //new name is         Food_Category_41.jpg

                                   $source_path = $_FILES['image']['tmp_name'];

                                    $destination_path = "../images/category/".$image_name;

                                    //finally upload the image
                                    $upload = move_uploaded_file($source_path,$destination_path);

                                    //check whether image upload or not
                                    //and if the image is nott uploaded we will stop the process and redirect         with error msg.

                                   if($upload==false)
                                   {
                                     //set msg

                                         $_SESSION['upload'] = "<div class='error'>Failed to upload image.          </div>";

                                         //redirect to add category page

                                        header('location:'.SITEURL.'admin/manage-category.php');
                                        //stop the process

                                         die();
                                   }
                            }

                        }else{

                            //don't upload the image
                            $image_name="";
                        }
   
                
            }
            //3. update the database
             $sql2 = "UPDATE tbl_categroy SET
                title = '$title',
                featured = '$featured',
                active = '$active',
                image_name = '$image_name'
                WHERE id = $id
             
             ";
            
            //execute the query
            $res2 = mysqli_query($conn,$sql2);
            
            if($res2 == true){
                $_SESSION['update'] = "<div class='success'>
                 Update category Successfully.</div>";
                
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                $_SESSION['update'] = "<div class='error'>
                Fail to Update category Successfully.</div>";
                
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            
            //4.redirect to manage_category page
        }
       
       ?>
       
   </div>
    
</div>





<?php include('partials/footer.php'); ?>