<?php 
    include("includes/database.php");
?>
    <div>
        <form action="" method="post">
            <table width="500" align="center">
                <tr align="center">
                    <td><h3>Kycuni ose Regjistrohuni ne platformen tone!</h3></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" placeholder="Enter email here..." required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password here..." required></td>
                </tr>

                <tr align="right">
                    <td colspan="2"><a href="checkout.php?forgot_password">Forgot password?</a></td>
                </tr>

                <tr align="center">
                    <td rowspan="2"><input type="submit" name="login" value="Login"  size="10"></td>
                </tr>
            </table>

            <h4 style="float:right; padding-right:50px;"><a href="customer_register.php" style= "text-decoration:none; border: solid 1px black">New? Register here</a></h4>

        </form>
        <?php
            if(isset($_POST['login'])){
                $customer_email = $_POST['email'];
                $customer_password = $_POST['password'];
                $ip=getIp();
                $select_customer = "select * from customers where customer_password='$customer_password' AND customer_email='$customer_email'";

                $run_customer = mysqli_query($con, $select_customer);

                $check_customer = mysqli_num_rows($run_customer);

                if($check_customer == 0){
                    echo "<script>alert('Emaili ose Fjalekalimi eshte i pasakte, ju lutemi provoni perseri!')</script>";
                    exit();
                }
                $select_cart = "select * from cart where ip_address='$ip' ";
                $run_cart = mysqli_query($con, $select_cart);
                $check_cart = mysqli_num_rows($run_cart);

                if($check_customer && $check_cart ==0){
                    $_SESSION['customer_email'] = $customer_email;
                    echo "<script> alert('Ju u kycet me sukses, Faleminderit!')</script>";
                    echo"<script>window.open('customer/my_account.php','_self') </script>";    
                }else{
                    $_SESSION['customer_email'] = $customer_email;
                    echo "<script> alert('Ju u kycet me sukses, Faleminderit!')</script>";
                    echo"<script>window.open('checkout.php','_self') </script>";    
                }
                    
            }
        ?>
    </div>
