<?php include('partials/menu.php');
include('partials/login_check.php');
?>



<div class="main-content">
  <div class="wrapper">
   <h1>Add FOOD</h1>
   <br><br>
   <?php 
         if(isset($_SESSION['upload'])) 
                {
                    echo $_SESSION['upload']; //Displaying Session Message
                    unset($_SESSION['upload']); //Removing Session Message
                }

   
?>
             
    <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">
           <tr>
               <td>Title :</td>
               <td>
                   <input type="text" name="title" placeholder="Category title">
               </td>
           </tr>
           
           <tr>
               <td>Description:</td>
               <td>
                   <textarea name="description" id="" cols="30" rows="5" placeholder="Discription of the food"></textarea>
               </td>
           </tr>
           
           <tr>
               <td>Price :</td>
               <td>
                   <input type="number" name="price">
                   
               </td>
           </tr>
                      <tr>
               <td>Select Image:</td>
               <td>
                   <input type="file" name="image" >
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
                               
                               $id = $row['id'];
                               $title =$row['title'];
                               
                               ?>
                               
                               <option value="<?php echo $id;?>"><?php echo $title;?></option>
                               
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
               <td>Featured:</td>
               <td>
                   <input type="radio" name="featured" value="Yes" > YES
                   <input type="radio" name="featured" value="No" > NO
               </td>
           </tr>
            
           <tr>
               <td>Active :</td>
               <td>
                   <input type="radio" name="active" value="Yes" > YES
                   <input type="radio" name="active" value="No" > NO
               </td>
           </tr>
            
        
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add category" class="btn-primary">
            </td>
        </tr>
        </table>
        
    </form>
    
   
   <?php
      
      //check whether the button is clicked or not
      if(isset($_POST['submit']))
      {
          
          //1. get the data from Form
          
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          
            //for radio we need too check whether the button is selected or noot
            
            if(isset($_POST['featured'])){
                //get the from form
                $featured = $_POST['featured'];
                
            }
            else{
                //set the default value
                $featured ="No";
            }
             if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else{
                
                $active ="No";//setting defult value
            }
          
          
    
          
          
          
          
          //2. upload the image
          
          //check whether the image is selected or not
          if(isset($_FILES['image']['name']))
          {
              //Get the details of the seleted image
              $image_name = $_FILES['image']['name'];
              
              //check whether image is selected or not and upload image only if selected 
              
              if($image_name != "")
              {
                  //Image is Selected
                  //A.Rename the image
                  //get the extension of selected image (jpg,pbg,gif)
                  $ext =end( explode('.',$image_name)); //explode function use for devide the name of image in 2 part!
                  
                  //Create the name for Image
                  $image_name ="Food_Name".rand(000,999).".".$ext; //New image name will be like Food-Name-123.jpg
                  
                  
                  
                  
                  
                  //.B Upload the image
                  //Get the src path and destination path
                  
                  //Source path is the current location of thr image
                  $src =$_FILES['image']['tmp_name'];
                  
                  //Destination path for the image to be uploaded 
                  $dst = "../images/Food/".$image_name;
                  
                  //finally upload the image 
                  $upload = move_uploaded_file($src, $dst);
                  
                  // check whether image uploaded or not
                  if($upload==false){
                      //faile to upload the image
                      //redirect with msg
                      
                      $SESSION['upload'] = "<div class='error'>Fail to upload image</div>";
                      header('location:'.SITEURL.'admin/add-food.php');
                      //stop the process
                      die();
                  }
                  
              }
              
          }
          else
          {
              $image_name = ""; //setting default value is blank
          }
          
          //3.Insert into database
          
          //create a sql query to save or add food
          //For numerical we do not need to pass value inside quotes '' But for strinf value it is compulsory
          $sql2 ="INSERT INTO tbl_food SET
          
                title ='$title',
                description ='$description',
                price =$price,
                image_name ='$image_name',
                catagory_id = $category, 
                feature ='$featured',
                active = '$active'
          
          
          ";
          //Execute the query
          
          $res2 = mysqli_query($conn, $sql2);
          
          //Check the data inserted or not
          //4.redirect with msg           
          
          
          if($res2 == true)
          {
              //Data insert successfully
              
               $_SESSION['add'] = "<div class='success'>Food added sucessfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
          }
          else
          {
              //fail to insert data
              
              
               $_SESSION['fail'] = "<div class='error'>Food added Fail</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
          }
          //4.redirect with msg           
          
      }
      
      
    ?>
 






















































   </div>
    
</div>



<?php include('partials/footer.php'); ?> 