<?php include('partials/menu.php'); 


?>
  
   
    
    <!-- Account page--->
    
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/5-2-burger-png.png" width="100%" alt="">
                </div>
                
               <div class="col-2">
                   <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="Indicator">
                        <?php
                        
                             if(isset($_SESSION['login']))
                            {
                                echo $_SESSION['login']; 
                                unset($_SESSION['login']); 
                            }
                        
                        if(isset($_SESSION['no-login-msg']))
                            {
                                echo $_SESSION['no-login-msg']; 
                                unset($_SESSION['no-login-msg']); 
                            }
                        ?>
                    </div>  
                    
                    <form id="LoginFrom" action="" method="POST" class="form-in">
                        <input type="text" placeholder="Enter Username" name="username">
                        
                        <input type="password" placeholder="Enter Password" name="password">
                        
                        <button type="submit" name="submit" class="btn">Login</button>
                        <a href="">Forgot password</a>
                    
                    </form>
                    
                    

    
    
    <?php

        if(isset($_POST['submit'])){
            //prcess for login
            //1.get the value from login form
             $username = $_POST['username'];
            $password =md5($_POST['password']);
            
            //2. sql to check whether the user with username and password exist or not
            
            $sql = "SELECT * FROM tbl_reg WHERE username='$username' AND password='$password'";
            
            //3.Execute the query
            
            $res = mysqli_query($conn,$sql);
            
            //4.cont the rows to check weather the user exists or not
            
            $count = mysqli_num_rows($res);
            
            if($count == 1){
                
                //user available and login success
                $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
                
                $_SESSION['user'] = $username;
                
                
                header('location:'.SITEURL.'admin/');
                
            }else{
                //user not available
                $_SESSION['login'] = "<div class='error'>Login not Successfull</div>";
                header('location:'.SITEURL.'admin/login.php');
            }
        }

    ?>
    
                        
                    
                    
                    
                    
                    
                    
                    
        <form id="RegFrom" action="" method="POST"class="form-in">
                        <input type="text" placeholder="Full name" name="full">
                         
                        <input type="text" placeholder="Name" name="user">
                        
                        <input type="password" placeholder="Password" name="pass">
                        
                        <button type="submit" name="submit" class="btn">Register</button>
                        
                    </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <?php
    
    
    //process the valu from form and save it in database
    // Check whether the submit button is clicked or not
    
    if(isset($_POST['submit']))
    {
        //button clicked
       // echo"Button click";
        
        
        //1. get the data from our form
        
       $full_name = $_POST['full'];
       $username = $_POST['user'];
       $password = md5($_POST['pass']); //md5 for incript password
        
        
        
        //2. SQL query to save the date into database
        
        $sql2 = "INSERT INTO tbl_reg SET
            full_name = '$full_name',
            username ='$username',
            password ='$password'
        
        ";
        
        
        
        //3.Execute Query and save data in database
        
        $res2 = mysqli_query($conn,$sql2) or die(mysqli_error());
    }

    
    ?>
    
    
    
    
    
    
    
    <!--------js for toggle form--->
    
    
    <script>
    
        var LoginFrom = document.getElementById("LoginFrom");
        var RegFrom = document.getElementById("RegFrom");
        var Indicator = document.getElementById("Indicator");
        
        function register(){
            RegFrom.style.transform = "translateX(0px)";
            LoginFrom.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
            
        }
        
        function login(){
            RegFrom.style.transform = "translateX(300px)";
            LoginFrom.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
            
        }
    
    </script>
    
    
    
    
    
    <?php include('partials/footer.php'); ?> 
    
    
    
    
    
    
    
    
    