<!DOCTYPE html>
<?php 
    session_start();
    include("functions/functions.php");
    include("includes/database.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
    <div class="wrapper">
        <div class="header-wrapper">
            <a href="index.php"><img src="images/1.png" alt="" id="logo"></a>
        </div>
        <div class="menubar">
            
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All products</a></li>
                <li><a href="customer/my_account.php">My account</a></li>
                <li><a href="">Sign up</a></li>
                <li><a href="cart.php">Shopping Card</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>
            <div id="form">
                <form action="results.php" method="get" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search a product here...">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
            
        </div>

        <div class="content-wrapper"></div>
        <div id="sidebar">
        
            <div id="sidebar-title">Categories
            </div>

            <ul id="cats">
                <?php getCategories(); ?>
            </ul>


            <div id="sidebar-title">Brands
            </div>
            
            <ul id="cats">
            <?php getBrands(); ?>
            </ul>

        </div>

        <div class="content-area">
        <?php 
            cart();
        ?>
        <div id="shopping_cart">
            <span style="float:right; font-size:18px; padding:5px;line-height:40px;">
                Welcome user!<b>  Shopping Cart - </b> Total items:<?php total_items();?> Total price:<b><?php total_price();?></b>
                <a href="cart.php">Go to cart</a>
            </span>
        </div>
            <form action="customer_register.php" method="post" enctype="multipart/form-data">
                <table align="center" width="750px">
                    <tr>
                        <td><h4>Krijo nje llogari</h4></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td align="right">Emri i klientit:</td>
                        <td><input type="text" name="customer_name" required></td>
                    </tr>

                    <tr>
                        <td align="right">Email i klientit:</td>
                        <td><input type="email" name="customer_email" required></td>
                    </tr>

                    <tr>
                        <td align="right">Password i klientit:</td>
                        <td><input type="password" name="customer_password" required></td>
                    </tr>

                    <tr>
                        <td align="right">Shteti:</td>
                        <td>
                            <select name="customer_country" id="" required>
                                <option value="">Zgjedh shtetin</option>
                                <option value="Shqiperi">Shqiperi</option>
                                <option value="US">US</option>
                                <option value="UK">Uk</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Qyteti:</td>
                        <td><input type="text" name="customer_city" required></td>
                    </tr>
                    <tr>
                        <td align="right">Kontakt:</td>
                        <td><input type="text" name="customer_contact" required></td>
                    </tr>
                    <tr>
                        <td align="right">Adresa:</td>
                        <td><input type="text" name="customer_address" required></td>
                    </tr>
                    <tr>
                        <td align="right">Fotografia e profilit:</td>
                        <td><input type="file" name="customer_image" required></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="register" value="Krijo Llogari"></td>
                    </tr>

                </table>

            </form>
        </div>

        <div id="footer">
            <p>&copy;Shpend Palushi</p>
        </div>
    </div>
</body>
</html>



<?php
        if(isset($_POST['register'])){
            $ip = getIp();

            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_password = $_POST['customer_password'];
            $customer_image = $_FILES['customer_image']['name'];
            $customer_image_tmp = $_FILES['customer_image']['tmp_name'];
            $customer_country = $_POST['customer_country'];
            $customer_city = $_POST['customer_city'];
            $customer_contact = $_POST['customer_contact'];  
            $customer_address = $_POST['customer_address']; 
            move_uploaded_file($customer_image_tmp,"customer/customer_images/$customer_image");   
            $insert_customer = "insert into customers(customer_ip,customer_name, customer_email, customer_password, customer_country, customer_city, customer_contact,customer_address, customer_image)
                                values('$ip','$customer_name','$customer_email','$customer_password','$customer_country','$customer_city','$customer_contact','$customer_address','$customer_image')";

            $run_customer = mysqli_query($con,$insert_customer);

            $select_cart = "select * from cart where ip_address='$ip' ";
            $run_cart = mysqli_query($con, $select_cart);
            $check_cart = mysqli_num_rows($run_cart);

            if($check_cart ==0){
                $_SESSION['customer_email'] = $customer_email;
                echo "<script> alert('Llogaria u krijua me sukses, Faleminderit!')</script>";
                echo"<script>window.open('customer/my_account.php','_self') </script>";
            }else{
                $_SESSION['customer_email'] = $customer_email;
                echo"<script>window.open('index.php','_self') </script>";
            }
            
            
        }
?>