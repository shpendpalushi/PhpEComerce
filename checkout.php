<!DOCTYPE html>
<?php 
    session_start();
    include("functions/functions.php");
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
                        echo "<b>Welcome:</b>" . $_SESSION['customer_email'];
                    }else{
                        echo "Welcome guest";
                    }
                ?>
                
                <b>  Shopping Cart - </b> <b>Total items:</b><?php total_items();?> <b>Total price</b>:<?php total_price();?>
                <a href="cart.php">Go to cart</a>
            </span>
        </div>
            <div id="products_box">
                <?php
                    if(!isset($_SESSION['customer_email'])){
                        include("customer_login.php");
                    }else{
                        include("payment.php"); 
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