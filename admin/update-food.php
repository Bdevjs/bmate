<?php include('partials/menu.php');?>

<div class="main-content">
   <div class="wrapper">
       <h1>Update Food</h1><br>
<?php 
            //check wether the id value is set or not
    if(isset($_GET['id']))
    {
            //Get the id and allother details
             $id = $_GET['id'];

                    //SQL query for delete data from database

            $sql2 = "SELECT * FROM tbl_food WHERE id =$id";

            //Execute the query
            $res2= mysqli_query($conn,$sql2);

            //count the rows to check whether the id is valid or not
            $count2 = mysqli_num_rows($res2);
            if($count2 == 1)
            {
                //get all data
                $row2 = mysqli_fetch_assoc($res2);

                $title = $row2['title'];
                $current_image = $row2['image_name'];
                $featured = $row2['feature'];
                $active = $row2['active'];
                $category =$row2['catagory_id'];
                $price = $row2['price'];
                $description = $row2['description'];
                
            }
            else
            {
                //redirect with msg
             //set fail msg and redirect 
              $_SESSION['no-food-found'] = "<div class='error'>
                  Category not found</div>";

            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-food.php');
            }

        
    }else{
        
        //redirect 
        header('location:'.SITEURL.'admin/manage-food.php');
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
               <td>Description:</td>
               <td>
                   <textarea name="description" id="" cols="30" rows="5"><?php   echo $description; ?></textarea>
               </td>
           </tr>
           <tr>
               <td>Price :</td>
               <td>
                   <input type="number" name="price" value="<?php echo $price;?>">
                   
               </td>
           </tr>
           
           
           
           
            <tr>
               <td>Category:</td>
               <td>
                   <select name="category" id="">
 <?php
                       
                       //Create PHP  CODE  to display categories from database
                       //1.Create SQL to get all active categories from database
                       
                       $sql = "SELECT * FROM tbl_categroy WHERE active ='YES'";
                       $res = mysqli_query($conn,$sql);
                       
                       //count the rows whether we have category or not
                       
                       $count = mysqli_num_rows($res);
                       
                       //If count > 0 ,we have categorys else we havn't category
                       
                       if($count > 0)
                       {
                           //we have category
                           
                           while($row = mysqli_fetch_assoc($res))
                           {
                               //Get the details of categories
                               
                               $cat_id = $row['id'];
                               $title =$row['title'];
                               
                               ?>
                               
                               <option value="<?php echo $cat_id;?>"><?php echo $title;?></option>
                               
                               <?php
                           }
                             
                           
                       }
                       else{
                           //we havn't category
                           ?>
                           
                           <option value="0">No category found</option>
                           
                           <?php
                       }
                       
                       //2.Display on dropdown
                        
             ?>
                      

                   </select>
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
                      
                      
                      <img src="<?php echo SITEURL;?>images/Food/<?php echo $current_image;?>" width="150px">
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
                <input type="submit" name="submit" value="Update Food" class="btn-primary">
            </td>
        </tr>
        </table>
       </form>
       
 <?php
       
        if(isset($_POST['submit']))
        {
            //get all the values from our form
//            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category = $_POST['category'];
                        
         
            
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
                                $a=explode('.',$image_name);

                             $ext = end($a);//THis code is for getting extention file like jpg,png

                            //rename the image

                            $image_name ="Food_Name".rand(000, 999).'.'.$ext; //new name is Food_Category_41.jpg

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/Food/".$image_name;

                            //finally upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check whether image upload or not
                            //and if the image is nott uploaded we will stop the process and redirect with error msg.

                            if($upload==false)
                            {
                                    //set msg

                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image. </div>";

                                    //redirect to add category page

                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    //stop the process

                                    die();//stop process
                            }
                                if($current_image != "")
                                {
                                    

                                //remove the curret image
                                $remove_path ="../images/Food/".$current_image;
                                $remove = unlink($remove_path);
                                

                                //check image remove or not
                                if($remove == false)
                                {
                                    //failed to remove image;
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image. </div>";
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    die();//stop process

                                }
                                }
                            }
                            
                }
                else{
                
                       $image_name = $current_image;
                
                     }
            
            //3. update the database
             $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
        
                catagory_id ='$category',
                feature = '$featured',
                active = '$active'
                WHERE id = $id
             
             ";
            
            //execute the query
            $res3 = mysqli_query($conn,$sql3);
            
              if($res3 == true){
                $_SESSION['up'] = "<div class='success'>
                 Update category Successfully.</div>";
                
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                $_SESSION['up'] = "<div class='error'>
                Fail to Update category Successfully.</div>";
                
                header('location:'.SITEURL.'admin/manage-food.php');
            }

            
            //4.redirect to manage_category page
       }
       
?>
       
   </div>
    
</div>
<?php include('partials/footer.php'); ?>