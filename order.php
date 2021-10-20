<?php include('partials-front/menu.php');?>
    
    <?php

        //check whether food is is set or not
        if(isset($_GET['food_id']))
        {
            //get the food id and detailes of selected food
            $food_id = $_GET['food_id'];
            //Get the details of the selected food
            $sql ="SELECT * fROM tbl_food WHERE id = $food_id";
            //Execute the query
            $res = mysqli_query($conn,$sql);
            
            //count the row
            $count = mysqli_num_rows($res);
            
            if($count==1)
            {
                //we have data
                //get the data
                $row = mysqli_fetch_assoc($res);
                $title =$row['title'];
                $price =$row['price'];
                $image_name =$row['image_name'];
                
            }
        }
        else
        {
            //redirect to home page
            header('location:'.SITEURL);
        }
    ?>
    


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                       
                       <?php
                            //check wether the image is abailabe or not
                            if($image_name != "")
                            {
                                //image not avaiable
                                ?>
                                <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                
                                <?php
                            }
                            else
                            {
                                                    //food are not avaible
                                    echo "<div class='error'>image not found.</div>";
                            }
                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            
            <?php
            
                //check submit button is checked or not
                if(isset($_POST['submit']))
                {
                    //Get the all details from form.
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    
                    $total = $price * $qty;
                    
                    $order_date = date("Y-m-d h:i:sa");
                    
                    $status = "ordered";
                    
                    $customer_name = $_POST['full-name']; //first part is rendom name and second part is form name like name="full-name"
                    
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    
                    
                    //save the data from databaase
                    
                    $sql2="INSERT INTO tbl_order SET
                    
                        food ='$food',
                        price='$price',
                        qty='$qty',
                        total='$total',
                        order_date='$order_date',
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                    
                    ";
                    
                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);
                    
                    if($res2==true)
                    {
                        //query execute and order saved
                        $_SESSION['order'] ="<div class='success text-center'> FOOD ORDER SUCCESSFULLY.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                         $_SESSION['order'] ="<div class='error text-center'> FOOD ORDER NOT SUCCESSFULLY.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>    

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php');?>