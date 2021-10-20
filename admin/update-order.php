<?php include('partials/menu.php');?>

<div class="main-content">
   <div class="wrapper">
       <h1>Update Order</h1><br><br>
       
       
       
       <?php
        if(isset($_GET['id']))
            $id = $_GET['id'];
        {
            //get the oder details
            $sql = "SELECT * FROM tbl_order WHERE id =$id";
            $res= mysqli_query($conn,$sql);
             $count = mysqli_num_rows($res);
             if($count == 1)
            {
                //get all data
                $row2 = mysqli_fetch_assoc($res);

                $food = $row2['food'];
                $price = $row2['price'];
                $qty = $row2['qty'];
                $status = $row2['status'];
                $customer_name =$row2['customer_name'];
                $customer_contact =$row2['customer_contact'];
                $customer_email =$row2['customer_email'];
                $customer_address =$row2['customer_address'];
                
            }
            else
            {
               
            header('location:'.SITEURL.'admin/manage-order.php');
            }

            
        }
       ?>


<form action="" method="POST">
    
    
    <table class="tbl-30">
        <tr>
            <td>Food Name</td>
            <td><?php echo $food; ?></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><?php echo $price; ?></td>
        </tr>
        <tr>
            <td>Qty</td>
            <td>
                <input type="number" name="qty" value="<?php echo $qty; ?>">
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="status" id="">
                    <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                    <option <?php if($status=="On Delivery"){echo "selected";}?>  value="On Delivery">On Delivery</option>
                    <option<?php if($status=="Delivered"){echo "selected";}?>  value="Delivery">Delivered</option>
                    <option <?php if($status=="Cancel"){echo "selected";}?> value="Cancel">Cancel</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Customer Name:</td>
            <td>
                <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
            </td>
        </tr>
        <tr>
            <td>Customer Contact:</td>
            <td>
                <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
            </td>
        </tr>
        <tr>
            <td>Customer Email:</td>
            <td>
                <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
            </td>
        </tr>
        <tr>
            <td>Customer Address:</td>
            <td>
                <textarea  name="customer_address" id="" cols="30" rows="5"> <?php echo $customer_address;?>
                </textarea>
        </tr>
        <tr>
           
            <td clospan="2">
               <input type="hidden" name="id" value="<?php echo $id;?> ">
               <input type="hidden" name="price" value="<?php echo $price;?> ">
                <input type="submit" name="submit" value="update order" class="btn-primary">
            </td>
            
        </tr>
    </table>
    
</form>


    </div>
</div>


<?php
       
       if(isset($_POST['submit']))
       {
           
           $id=$_POST['id'];
           $price=$_POST['price'];
           $qty=$_POST['qty'];
           
           $total = $price * $qty;
           $status=$_POST['status'];
           $customer_name=$_POST['customer_name'];
           $customer_contact=$_POST['customer_contact'];
           $customer_email=$_POST['customer_email'];
           $customer_address=$_POST['customer_address'];
           
           echo"$id ";
           echo"$price ";
           echo"$qty ";
           echo"$total ";
           echo"$status ";
           echo"$customer_name ";
           echo"$customer_contact";
           echo"$customer_email";
           echo"$customer_address";
           
           //update data
           
           $sql4 ="UPDATE tbl_order SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact ='$customer_contact',
                customer_email = '$customer_email',
                customer_address ='$customer_address'
                WHERE id=$id
                ";
           $res4 = mysqli_query($conn , $sql4);
           if($res4 == true){
                $_SESSION['update'] = "<div class='success'>
                 Update order Successfully.</div>";
                
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else{
                $_SESSION['update'] = "<div class='error'>
                Fail to Update order Successfully.</div>";
                
                header('location:'.SITEURL.'admin/manage-order.php');
            }
     
               
   
       }
       
?>






<?php include('partials/footer.php'); ?>