<!DOCTYPE html>
<?php 
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
            <div id="shopping_cart">
                <span style="float:right; font-size:18px; padding:5px;line-height:40px;">
                    Welcome user!<b>  Shopping Cart - </b> Total items: Total price:
                    <a href="cart.php">Go to cart</a>
                </span>
            </div>
                <div id="products_box">
                <?php
                    if(isset($_GET['search'])){
                        $search_query = $_GET['user_query'];
                        
                        $get_products = "select * from products where product_keywords like '%$search_query%'";
                        $run_get_products = mysqli_query($con,$get_products);
                        while($row_product= mysqli_fetch_array($run_get_products)){
                            $product_id = $row_product['product_id'];
                            $product_category = $row_product['product_category'];
                            $product_brand = $row_product['product_brand'];
                            $product_title = $row_product['product_title'];
                            $product_price = $row_product['product_price'];
                            $product_image = $row_product['product_image'];

                            echo "
                                    <div id='single_product'>
                                        <h3>$product_title</h3>
                                        
                                        <img src='admin_area/product_images/$product_image' width='180' height='180'>
                                        <p style='text-align:center'>$ $product_price</p>

                                        <a href='details.php?product_id=$product_id' style='float:left'>Details</a>
                                        <a href='index.phpproduct_id = $product_id' style='float:right'><button style='float:right'>Add to Cart</button></a>

                                    </div>
                            
                            
                            ";
                        }
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