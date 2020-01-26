<?php
    session_start();

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles/admin_style.css">
</head>
<body>
    <div class="main_wrapper">
        <div id="header" style="text-align:center;"><a href="index.php" style="text-decoration:none; color:snow;"><h2 style="text-align:center; padding-top:50px">Llogaria e administratorit</h2></a></div>
        <div id="right">
            <h2 style="margin:6px; padding:6px">Menaxho permbajtjen</h2>
            <a href="index.php?shto_produkt">Shto produkt</a>
            <a href="index.php?shiko_produktet">Shiko te gjitha produktet</a>
            <a href="index.php?shto_kategori">Shto kategori te re</a>
            <a href="index.php?shiko_kategorite">Shiko te gjitha kategorite</a>
            <a href="index.php?shto_brand">Shto nje brand te ri</a>
            <a href="index.php?shiko_brandet">Shiko te gjitha brandet</a>
            <a href="index.php?shiko_klientet">Shiko klientet</a>
            <a href="index.php?shiko_porosite">Shiko porosite</a>
            <a href="index.php?shiko_pagesat">Shiko pagesat</a>
            <a href="logout.php">Shkycu si admin</a>

        </div>
        <div id="left">
            <?php
                if(isset($_GET['shto_produkt'])){
                    include("insert_product.php");
                }

                if(isset($_GET['shiko_produktet'])){
                    include("shiko_produktet.php");
                }
                if(isset($_GET['modifiko_produkt'])){
                    include("modifiko_produkt.php");
                }

                if(isset($_GET['shto_kategori'])){
                    include("shto_kategori.php");
                }

                if(isset($_GET['shiko_kategorite'])){
                    include("shiko_kategorite.php");
                }

                if(isset($_GET['modifiko_kategori'])){
                    include("modifiko_kategori.php");
                }
                if(isset($_GET['shto_brand'])){
                    include("shto_brand.php");
                }
                if(isset($_GET['shiko_brandet'])){
                    include("shiko_brandet.php");
                }
                if(isset($_GET['modifiko_brand'])){
                    include("modifiko_brand.php");
                }
                if(isset($_GET['shiko_klientet'])){
                    include("shiko_klientet.php");
                }
                // if(isset($_GET['fshi_llogari'])){
                //     include("fshi_llogari.php");
                // }
            ?>
        </div>
    </div>
</body>
</html>

<?php } ?>