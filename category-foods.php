<?php include('partials-front/menu.php');?>
    
<?php

    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //cat ud is ser and get the id
        $category_id = $_GET['category_id'];
        //get the category title based on category id
        
        $sql = "SELECT title FROM tbl_categroy WHERE id = $category_id";
        //execute query
         $res = mysqli_query($conn,$sql);
                
        $row = mysqli_fetch_assoc($res);
        
        $category_title = $row['title'];
    }
    else
    {
        //cat id not passed
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
                //create SQL query to get food based on selected category
                $sql2 ="SELECT * FROM tbl_food WHERE  catagory_id =$category_id";
                //execute query
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2 > 0)
                {
                    //food avaible
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title =$row2['title'];
                        $price =$row2['price'];
                        $description =$row2['description'];
                        $image_name =$row2['image_name'];
                        
                        
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                   <?php
                                        if($image_name == "")
                                        {
                                           //image not avaible 
                                            echo "<div class='error'>image not found.</div>";
                                        }
                                        else
                                        {
                                            //image avaible
                                            ?>
                                            
                                           <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                        
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title ;?></h4>
                                    <p class="food-price"><?php echo $price;?></p>
                                    <p class="food-detail">
                                       <?php echo $description;?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        
                        <?php
                    }
                }
                else
                {
                    //not avaible
                     //Cat not avaible
                    echo "<div class='error'>Cat not found.</div>";
                }
            
            
            ?>


           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>