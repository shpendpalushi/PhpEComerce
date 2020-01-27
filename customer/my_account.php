<!DOCTYPE html>
<?php 
    session_start();
    include("../functions/functions.php");

    if(!isset($_SESSION['customer_email'])){
        echo "<script>window.open('../logout.php','_self')</script>";
    }else{

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
                <li><a href="../index.php">Kreu</a></li>
                <li><a href="../all_products.php">Te gjitha produktet</a></li>
                <li><a href="customer/my_account.php">Llogaria ime</a></li>
                <li><a href="../customer_register.php">Regjistrohu</a></li>
                <li><a href="../cart.php">Karta e blerjes</a></li>
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
        
            <div id="sidebar-title">Llogaria ime
            </div>

            <ul id="cats">
                <?php
                    $user = $_SESSION['customer_email'];
                    $merr_imazhin = "select * from customers where customer_email='$user'";
                    $ekzekuto_imazhin = mysqli_query($con, $merr_imazhin);
                    $rresht_imazh = mysqli_fetch_array($ekzekuto_imazhin);

                    $klient_imazh = $rresht_imazh['customer_image'];

                    $klient_emer = $rresht_imazh['customer_name'];

                    echo "<p style='text-align:center'><img src='customer_images/$klient_imazh' width='100' height='100'></p>";
                    echo "<p style='text-align:center'><b>$klient_emer</b></p>";
                ?>
                <li><a href="my_account.php?my_orders">Porosite e mia</a></li>
                <li><a href="my_account.php?edit_account">Rregullo llogarine</a></li>
                <li><a href="my_account.php?change_password">Ndrysho fjalekalimin</a></li>
                <li><a href="my_account.php?delete_account">Fshije Llogarine</a></li>
                <li><a href="../logout.php">Shkycu</a></li>
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
                        echo "<b>Mireseerdhe:</b>" . $_SESSION['customer_email'];
                    }else{
                        echo "<b>Mireseerdhe i ftuar</b>";
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
                            echo "Shiko historine e perdoruesit:<a href='my_account.php?my_orders' 
                            style='text-decoration:none; border:solid 1px grey; margin:10px;padding-left:5px;padding-right:5px; border-radius:4px;
                             background-color:lightgrey'
                            >Histori</a>";
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

                <?php }?>