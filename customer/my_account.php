<!DOCTYPE html>
<?php 
    session_start();
    include("../functions/functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/customer_styles.css" media="all">
</head>
<body>
    <div class="wrapper">
        <div class="header-wrapper">
            <a href="../index.php"><img src="../images/1.png" alt="" id="logo"></a>
        </div>
        <div class="menubar">
            
            <ul id="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../all_products.php">All products</a></li>
                <li><a href="customer/my_account.php">My account</a></li>
                <li><a href="../customer_register.php">Sign up</a></li>
                <li><a href="../cart.php">Shopping Card</a></li>
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
        
            <div id="sidebar-title">My account
            </div>

            <ul id="cats">
                <?php
                    $user = $_SESSION['customer_email'];
                    $get_image = "select * from customers where customer_email='$user'";
                    $run_image = mysqli_query($con, $get_image);
                    $row_image = mysqli_fetch_array($run_image);

                    $customer_image = $row_image['customer_image'];

                    $customer_name = $row_image['customer_name'];

                    echo "<p style='text-align:center'><img src='customer_images/$customer_image' width='100' height='100'></p>";
                    echo "<p style='text-align:center'><b>$customer_name</b></p>";
                ?>
                <li><a href="my_account.php?my_orders">My orders</a></li>
                <li><a href="my_account.php?edit_account">Edit account</a></li>
                <li><a href="my_account.php?change_password">Change password</a></li>
                <li><a href="my_account.php?delete_account">Delete account</a></li>
                <li><a href="../logout.php">Logout</a></li>
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
                        echo "<b>Welcome guest</b>";
                    }
                ?>
                <?php
                    if(!isset($_SESSION['customer_email'])){
                        echo "<a href='../checkout.php'>Login</a>";
                    }else{
                        echo "<a href='../logout.php'>Logout</a>";
                    }
                ?>
            </span>
        </div>
            <div id="products_box">
                <?php 
                    
                    if(!isset($_GET['my_orders']) && !isset($_GET['edit_account']) 
                        && !isset($_GET['change_password']) && !isset($_GET['change_account'])){
                            echo "See your orders history:<a href='my_account.php?my_orders' 
                            style='text-decoration:none; border:solid 1px grey; margin:10px;padding-left:5px;padding-right:5px; border-radius:4px;
                             background-color:lightgrey'
                            >History</a>";
                    }
                ?>

                <?php 
                    if(isset($_GET['edit_account'])){
                        include("edit_account.php");
                    }
                    if(isset($_GET['change_password'])){
                        include("change_password.php");
                    }
                    if(isset($_GET['delete_account'])){
                        include("delete_account.php");
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