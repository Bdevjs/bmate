<?php include('partials/menu.php');
include('partials/login_check.php');
?>



<div class="main-content">
  <div class="wrapper">
   <h1>Add Category</h1>
   
   
            <!--Add category form start-->
            
            <?php
             if(isset($_SESSION['add'])) 
                {
                    echo $_SESSION['add']; //Displaying Session Message
                    unset($_SESSION['add']); //Removing Session Message
                }
      
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
               <td>Select Image:</td>
               <td>
                   <input type="file" name="image" >
               </td>
           </tr>
           
           <tr>
               <td>Featured :</td>
               <td>
                   <input type="radio" name="featured" value="Yes" >YES
                   <input type="radio" name="featured"  value="No">NO
               </td>
           </tr>
           
           <tr>
               <td>ACTIVE :</td>
               <td>
                   <input type="radio" name="active" value="Yes" >YES
                   <input type="radio" name="active" value="No" >NO
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
      
      //check the submit button click or not
        if(isset($_POST['submit']))
        {
                    //get the value from category from
            
            echo $title = $_POST['title'];
            
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
                $active ="No";
            }
            //check the is selected or not
            //print_r($_FILES['image']); 
            //die();
        
            
            //choosen image file
            
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
                    
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    
                    die();
                }
        }
                
            }else{
                
                //don't upload the image
                $image_name="";
            }
            
            //create sql query to insert catagory into database.
            $sql ="INSERT INTO tbl_categroy SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active ='$active'
                
            
            ";
            
            //3.Execute the query and save in database
            $res = mysqli_query($conn,$sql);
            
            if($res= true){
                //query execute and category added 
                $_SESSION['add']="<div class='success'>Category added successfully.</div>";
                //redirect t manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                //failed to add 
                $_SESSION['add']="<div class='error'>Category fail to added .</div>";
                //redirect t manage category page
                header('location:'.SITEURL.'admin/add-category.php');
            }
            
            
        }
      
      ?>

   </div>
    
</div>



<?php include('partials/footer.php'); ?> 
















































