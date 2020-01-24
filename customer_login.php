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
                    <td><input type="text" name="email" placeholder="Shrkuani emailin ketu ..." required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Shkruani passwordin ketu..." required></td>
                </tr>

                <tr align="right">
                    <td colspan="2"><a href="checkout.php?forgot_password">E harruat passwordin?</a></td>
                </tr>

                <tr align="center">
                    <td rowspan="2"><input type="submit" name="login" value="Login"  size="10"></td>
                </tr>
            </table>

            <h4 style="float:right; padding-right:50px;"><a href="customer_register.php" style= "text-decoration:none; border: solid 1px black">Jeni te rinj? Regjistrohuni ketu</a></h4>

        </form>
        <?php
            if(isset($_POST['login'])){
                $perdorues_email = $_POST['email'];
                $perdorues_fjalekalim = $_POST['password'];
                $ip=getIp();
                $zgjidh_klient = "select * from customers where customer_password='$perdorues_fjalekalim' AND customer_email='$perdorues_email'";

                $ekzekuto_perdorues = mysqli_query($con, $zgjidh_klient);

                $kontrollo_perdorues = mysqli_num_rows($ekzekuto_perdorues);

                if($kontrollo_perdorues == 0){
                    echo "<script>alert('Emaili ose Fjalekalimi eshte i pasakte, ju lutemi provoni perseri!')</script>";
                    exit();
                }
                $zgjidh_karte = "select * from cart where ip_address='$ip' ";
                $run_cart = mysqli_query($con, $zgjidh_karte);
                $check_cart = mysqli_num_rows($run_cart);

                if($kontrollo_perdorues && $check_cart ==0){
                    $_SESSION['customer_email'] = $perdorues_email;
                    echo "<script> alert('Ju u kycet me sukses, Faleminderit!')</script>";
                    echo"<script>window.open('customer/my_account.php','_self') </script>";    
                }else{
                    $_SESSION['customer_email'] = $perdorues_email;
                    echo "<script> alert('Ju u kycet me sukses, Faleminderit!')</script>";
                    echo"<script>window.open('checkout.php','_self') </script>";    
                }
                    
            }
        ?>
    </div>
