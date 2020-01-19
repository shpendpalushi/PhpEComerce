<!DOCTYPE html>
<?php 
    session_start();
    include("functions/functions.php");
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
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
                <?php 
                    if(isset($_SESSION['customer_email'])){
                        echo "<b>Welcome:</b>" . $_SESSION['customer_email']."\t";
                    }else{
                        echo "Welcome guest";
                    }
                ?>

                <b>Total items:</b><?php total_items();?> <b>Total price:</b><?php total_price();?>
                <a href="index.php" style="border:1px solid black; text-decoration:none;color:black;border-radius:4px">Back to shop</a>

                <?php
                    if(!isset($_SESSION['customer_email'])){
                        echo "<a href='checkout.php' style='border:1px solid black; text-decoration:none;color:black;border-radius:4px'>Login</a>";
                    }else{
                        echo "<a href='logout.php' style='border:1px solid black; text-decoration:none; color:black;border-radius:4px'>Logout</a>";
                    }
                ?>

            </span>
        </div>
            <div id="products_box">
                <form action="" method="post" enctype="multipart/form-data">
                    <table align="center" width="700" class="cart_table">
                        <tr align="center" class="t_row">
                            <th>Hiq</th>
                            <th>Produkti</th>
                            <th>Sasia</th>
                            <th>Cmimi(Total) </th>
                        </tr>

                        <?php 
                            
                            $total = 0;

                            global $con;
                        
                            $ip = getIp();
                            $select_price = "select * from cart where ip_address='$ip'";
                        
                            $run_price = mysqli_query($con, $select_price);
                            while($p_price = mysqli_fetch_array($run_price)){

                                $product_id = $p_price['product_id'];
                                $product_price = "select * from products where product_id = '$product_id' limit 1";
                                $run_product_price = mysqli_query($con,$product_price);

                                $product_in_table = mysqli_fetch_object($run_product_price);
                                
                        ?>

                        <tr align="center" class="t_row">
                            <td><input type="checkbox" name="remove[]" value="<?php echo $product_id;?>"></td>
                            <td> <?php echo $product_in_table->product_title ;?><br>
                            <img src="admin_area/product_images/<?php echo $product_in_table->product_image; ?>" width="60" height="60"><br>
                            <?php echo "$ $product_in_table->product_price;"?>
                            </td>
                            <td><input type="text" size="1" style="width:50px" name="quantity" value="<?php echo $_SESSION['quantity']; ?>"></td>
                            <?php
                                
                                if(isset($_POST['update_cart'])){
                                    $quantity = $_POST['quantity'];
                                    $update_quantity = "update cart set quantity='$quantity' where product_id='$product_id'";
                                    
                                    $run_quantity = mysqli_query($con, $update_quantity);
                                    $_SESSION['quantity'] = $quantity;
                                    $total_price_product = $quantity * $product_in_table->product_price;
                                    
                                }
                                    
                            ?>
                            <td><?php echo "$".$total_price_product?></td>
                        </tr>
                        <?php $total += $total_price_product;  }?>
                        <tr class="t_row">
                            <td colspan="3">Sub Total:</td>
                            <td align="center"><?php echo "$".$total ;?></td>
                        </tr>
                        <tr align="center" class="t_row">
                            <td><input type="submit" name="update_cart" value="Update Cart"></td>
                            <td><input type="submit" name="continue" value="Continue shopping"></td>
                            <td><button><a href="checkout.php" style="text-decoration:none; color:black">Checkout</a></button></td>
                        </tr>
                    </table>
                </form>
                <?php
                    
                        echo "Function called";
                        global $con;
                        $ip = getIp();
                        if(isset($_POST['update_cart'])){
                                foreach($_POST['remove'] as $remove_id){
                                    $delete_product = "Delete from cart where product_id='$remove_id' and ip_address='$ip'";
                                    $run_delete = mysqli_query($con, $delete_product);
                                    echo "$run_delete";
                                    if($run_delete){
                                        echo "<script> window.open('cart.php', '_self')</script>";
                                    }else{
                                        echo "<script> window.open('cart.php', '_self')</script>";
                                    }
                                }
                            }
                        if(isset($_POST['continue'])){
                            echo "<script> window.open('cart.php', '_self')</script>";
                        }
                
                    
                ?>
            </div>
        </div>

        <div id="footer">
            <p>&copy;Shpend Palushi</p>
        </div>
    </div>
</body>
</html>