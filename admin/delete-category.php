 <?php


    include('../config/constants.php'); 



    //check wether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //Remove the physical image file is available
        if($image_name != "")
        {
            //image is availble.So remove it
            
            $path ="../images/category/".$image_name;
            
            
            //remove img
            $remove =unlink($path);
            
            
            //if fail to delete image ....add an error msg and stop the process
            if($remove == false)
            {
                //set teh session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                
                //Redirect manage category page
                 header('location:'.SITEURL.'admin/manage-category.php');   
                
                //stop the process
                
                die();
            }
            
            
            
        }
        //Delete Data from database
        //SQL query for delete data from database
        
        $sql = "DELETE FROM tbl_categroy WHERE id =$id";
        //Execute the query
        $res= mysqli_query($conn,$sql);
        
        //check whether the data is delete from database or not
        if($res==true)
        {
            //set success msg and redirect 
          $_SESSION['delete'] = "<div class='success'>
              category delete successfully.</div>";
              
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
            
        }else{
            
         //set fail msg and redirect 
          $_SESSION['delete'] = "<div class='error'>
              Fail to delete category.</div>";
              
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
            
            
        }
        
        //Redirect to Manage-category page with msg

    }else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>