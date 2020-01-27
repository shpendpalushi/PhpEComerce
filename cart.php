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
                <li><a href="index.php">Kreu</a></li>
                <li><a href="all_products.php">Te gjitha produktet</a></li>
                <li><a href="customer/my_account.php">Llogaria ime</a></li>
                <li><a href="">Hyr</a></li>
                <li><a href="cart.php">Karta</a></li>
                <li><a href="">Na kontaktoni</a></li>
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
        
            <div id="sidebar-title">Kategorite
            </div>

            <ul id="cats">
                <?php getCategories(); ?>
            </ul>


            <div id="sidebar-title">Brandet
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
                        echo "<b>Mireseerdhe:</b>" . $_SESSION['customer_email']."\t";
                    }else{
                        echo "Mireserdhe i ftuar";
                    }
                ?>

                <b>Produktet:</b><?php total_items();?> <b>Cmimi total:</b><?php total_price();?>
                <a href="index.php" style="border:1px solid black; text-decoration:none;color:black;border-radius:4px">Kthehu</a>

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
                    <table align="center" width="700" class="cart_table table">
                        <thead>
                            <tr align="center" class="t_row">
                                <th>Hiq</th>
                                <th>Produkti</th>
                                <th>Sasia</th>
                                <th>Cmimi(Total) </th>
                            </tr>
                        </thead>

                        <?php 
                            
                            $total = 0;

                            global $con;
                        
                            $ip = getIp();
                            $selekto_cmim = "select * from cart where ip_address='$ip'";
                        
                            $ekzekuto_cmim = mysqli_query($con, $selekto_cmim);
                            while($p_cmim = mysqli_fetch_array($ekzekuto_cmim)){

                                $id_produkt = $p_cmim['product_id'];
                                $cmim_produkti = "select * from products where product_id = '$id_produkt' limit 1";
                                $ekzekuto_cmim_produkti = mysqli_query($con,$cmim_produkti);

                                $produkt_ne_tabele = mysqli_fetch_object($ekzekuto_cmim_produkti);
                                
                        ?>

                        <tr align="center" class="t_row">
                            <td><input type="checkbox" name="remove[]" value="<?php echo $id_produkt;?>"></td>
                            <td> <?php echo $produkt_ne_tabele->product_title ;?><br>
                            <img src="admin_area/product_images/<?php echo $produkt_ne_tabele->product_image; ?>" width="60" height="60"><br>
                            <?php echo "$ $produkt_ne_tabele->product_price;"?>
                            </td>
                            <td><input type="text" size="1" style="width:50px" name="quantity" value="<?php echo $_SESSION['quantity']; ?>"></td>
                            <?php
                                
                                if(isset($_POST['update_cart'])){
                                    $sasia = $_POST['quantity'];
                                    $rifresko_sasi = "update cart set quantity='$sasia' where product_id='$id_produkt'";
                                    
                                    $ekzekuto_sasi = mysqli_query($con, $rifresko_sasi);
                                    $_SESSION['quantity'] = $sasia;
                                    $cmim_total_produkti = $sasia * $produkt_ne_tabele->product_price;
                                    
                                }
                                    
                            ?>
                            <td><?php echo "$".$cmim_total_produkti?></td>
                        </tr>
                        <?php $total += $cmim_total_produkti;  }?>
                        <tfoot>
                            <tr class="t_row">
                                <td colspan="3">Sub Total:</td>
                                <td align="center"><?php echo "$".$total ;?></td>
                            </tr>
                            <tr align="center" class="t_row">
                                <td><input type="submit" name="update_cart" value="Update Cart"></td>
                                <td><input type="submit" name="continue" value="Continue shopping"></td>
                                <td><button><a href="checkout.php" style="text-decoration:none; color:black">Proceso</a></button></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                <?php
                        global $con;
                        $ip = getIp();
                        if(isset($_POST['update_cart'])){
                                foreach($_POST['remove'] as $hiq_id){
                                    $delete_product = "Delete from cart where product_id='$hiq_id' and ip_address='$ip'";
                                    $ekzekuto_fshirje = mysqli_query($con, $delete_product);
                                    echo "$ekzekuto_fshirje";
                                    if($ekzekuto_fshirje){
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