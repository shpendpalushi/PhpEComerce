<?php

$con = mysqli_connect("localhost", "root","","ecas");

function getCategories(){

    global $con;

    $merr_kategorite = "select * from categories";
    $merr_kategorite = mysqli_query($con, $merr_kategorite);

    while($rresht_kategorite = mysqli_fetch_array($merr_kategorite)) {

        $id_kategorie = $rresht_kategorite['category_id'];
        $kategori_titull = $rresht_kategorite['category_title'];
        echo "<li><a href='index.php?category=$id_kategorie'>$kategori_titull</a></li>";

    }

}


function getBrands(){

    global $con;

    $merr_brandet = "select * from brands";
    $ekzektuo_brandet = mysqli_query($con, $merr_brandet);

    while($rresht_brandet = mysqli_fetch_array($ekzektuo_brandet)) {

        $brand_id = $rresht_brandet['brand_id'];
        $titull_brand = $rresht_brandet['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'>$titull_brand</a></li>";

    }

}

function getProducts(){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){ 
            global $con;
            $merr_produktet = "select * from products order by RAND() LIMIT 0,6";
            $ekzekuto_merr_produktet = mysqli_query($con,$merr_produktet);
            while($rresht_produkt= mysqli_fetch_array($ekzekuto_merr_produktet)){
                $produkt_id = $rresht_produkt['product_id'];
                $produkt_kategori = $rresht_produkt['product_category'];
                $produkt_brand = $rresht_produkt['product_brand'];
                $titull_produkt = $rresht_produkt['product_title'];
                $produkt_cmim = $rresht_produkt['product_price'];
                $foto_produkt = $rresht_produkt['product_image'];

                echo "
                        <div id='single_product'>
                            <h3>$titull_produkt</h3>
                            
                            <img src='admin_area/product_images/$foto_produkt' width='180' height='180'>
                            <p style='text-align:center'>Price: $ $produkt_cmim</p><br>

                            <a href='details.php?product_id=$produkt_id' style='float:left'>Detaje</a>
                            <a href='index.php?add_cart=$produkt_id' style='float:right'><button style='float:right'>Shto ne karte</button></a>

                        </div>
                
                
                ";
            }
        }
    }
}


function getCategoryProducts(){
    if(isset($_GET['category'])){
        $kategoria_ime_id = $_GET['category'];
        global $con;
        $merr_kategori_products = "select * from products where product_category='$kategoria_ime_id'";
        $merr_produktet_kategori = mysqli_query($con,$merr_kategori_products);
        $count = mysqli_num_rows($merr_produktet_kategori);
        if($count==0){
            echo "<h4>Kjo kategori nuk ka ende produkte ju kerkojme ndjese!</h4>";
        }
        while($rresht_kategori_produkt= mysqli_fetch_array($merr_produktet_kategori)){
            $produkt_id = $rresht_kategori_produkt['product_id'];
            $produkt_kategori = $rresht_kategori_produkt['product_category'];
            $produkt_brand = $rresht_kategori_produkt['product_brand'];
            $titull_produkt = $rresht_kategori_produkt['product_title'];
            $produkt_cmim = $rresht_kategori_produkt['product_price'];
            $foto_produkt = $rresht_kategori_produkt['product_image'];
            
            echo "
                    <div id='single_product'>
                        <h3>$titull_produkt</h3>
                        
                        <img src='admin_area/product_images/$foto_produkt' width='180' height='180'>
                        <p style='text-align:center'>Price: $ $produkt_cmim</p><br>

                        <a href='details.php?product_id=$produkt_id' style='float:left'>Detaje</a>
                        <a href='index.php?product_id = $produkt_id' style='float:right'><button style='float:right'>Shto ne karte</button></a>

                    </div>
            
            
            ";
        }
    }
    
}


function getBrandProducts(){
    if(isset($_GET['brand'])){
        $id_brandi = $_GET['brand'];
        global $con;
        $merr_produktet_e_brandit = "select * from products where product_brand='$id_brandi'";
        $ekzekuto_produktet_e_brandit = mysqli_query($con,$merr_produktet_e_brandit);
        $count = mysqli_num_rows($ekzekuto_produktet_e_brandit);
        if($count==0){
            echo "<h4>Ky brand nuk ka ende produkte ju kerkojme ndjese!</h4>";
        }
        while($rresht_brand_produkt= mysqli_fetch_array($ekzekuto_produktet_e_brandit)){
            $produkt_id = $rresht_brand_produkt['product_id'];
            $produkt_brand = $rresht_brand_produkt['product_brand'];
            $titull_produkt = $rresht_brand_produkt['product_title'];
            $produkt_cmim = $rresht_brand_produkt['product_price'];
            $foto_produkt = $rresht_brand_produkt['product_image'];
            
            echo "
                    <div id='single_product'>
                        <h3>$titull_produkt</h3>
                        
                        <img src='admin_area/product_images/$foto_produkt' width='180' height='180'>
                        <p style='text-align:center'>Price: $ $produkt_cmim</p><br>

                        <a href='details.php?product_id=$produkt_id' style='float:left'>Detaje</a>
                        <a href='index.php?product_id = $produkt_id' style='float:right'><button style='float:right'>Shto ne karte</button></a>

                    </div>
            
            
            ";
        }
    }
}


function getAllProducts(){ 
    global $con;
    $merr_produktet = "select * from products";
    $ekzekuto_merr_produktet = mysqli_query($con,$merr_produktet);
    while($rresht_produkt= mysqli_fetch_array($ekzekuto_merr_produktet)){
        $produkt_id = $rresht_produkt['product_id'];
        $produkt_kategori = $rresht_produkt['product_category'];
        $produkt_brand = $rresht_produkt['product_brand'];
        $titull_produkt = $rresht_produkt['product_title'];
        $produkt_cmim = $rresht_produkt['product_price'];
        $foto_produkt = $rresht_produkt['product_image'];

        echo "
                <div id='single_product'>
                    <h3>$titull_produkt</h3>
                    
                    <img src='admin_area/product_images/$foto_produkt' width='180' height='180'>
                    <p style='text-align:center'>Price: $ $produkt_cmim</p><br>

                    <a href='details.php?product_id=$produkt_id' style='float:left'>Detaje</a>
                    <a href='all_products.php?add_cart=$produkt_id' style='float:right'><button style='float:right'>Shto ne karte</button></a>

                </div>
        
        
        ";
    }
}

function getDetailsForProduct(){
    global $con;
    if(isset($_GET['product_id'])){
        $produkt_id = $_GET['product_id'];
        $merr_produktin_tim = "select * from products where product_id = '$produkt_id'";

        $ekzekuto_kerkesen = mysqli_query($con, $merr_produktin_tim);

        while($rresht_produkt = mysqli_fetch_array($ekzekuto_kerkesen)){
            $produkt_id = $rresht_produkt['product_id'];
            
            $titull_produkt = $rresht_produkt['product_title'];
            $produkt_cmim = $rresht_produkt['product_price'];
            $foto_produkt = $rresht_produkt['product_image'];
            $foto_pershkrim = $rresht_produkt['product_description'];

            echo "
            <div id='single_product'>
                <h3>$titull_produkt</h3>
                
                <img src='admin_area/product_images/$foto_produkt' width='400' height='400'>
                <p>Price: $$produkt_cmim</p><br>
                <p>$foto_pershkrim</p><br>

                <a href='index.php' style='float:left'>Go Back</a>
                <a href='index.php?product_id = $produkt_id' style='float:right'><button style='float:right'>Shto ne karte</button></a>

            </div>
    
    
            ";
        }

    }
}

function cart(){
    if(isset($_GET['add_cart'])){
        global $con;
        $ip = getIp();
         $produkt_id = $_GET['add_cart'];
         $kontrollo_produkt= "select * from cart where ip_address = '$ip' AND product_id='$produkt_id'";
         $ekzekuto_kontroll = mysqli_query($con, $kontrollo_produkt);

         if(mysqli_num_rows($ekzekuto_kontroll)>0){
             echo "";
         }else{
             $shto_product = "insert into cart (product_id, ip_address) values('$produkt_id','$ip')";

             $ekzekuto_produkt = mysqli_query($con, $shto_product);
             echo "<script>
                window.open('index.php', '_self');
             </script>";
         }
    }   
}

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

function total_items(){
    global $con;
    if(isset($_GET['add_cart'])){
        $ip = getIp();
        $merr_artikuj = "select * from cart where ip_address = '$ip'";
        $ekzektuo_aritkuj = mysqli_query($con, $merr_artikuj);
        $numero_artkuj = mysqli_num_rows($ekzektuo_aritkuj);
    }else{
        global $con;
        $ip = getIp();
        $merr_artikuj = "select * from cart where ip_address = '$ip'";
        $ekzektuo_aritkuj = mysqli_query($con, $merr_artikuj);
        $numero_artkuj = mysqli_num_rows($ekzektuo_aritkuj);
    }
    echo $numero_artkuj;
}

function total_price(){
    $total = 0;

    global $con;

    $ip = getIp();
    $zgjidh_cmim = "select * from cart where ip_address='$ip'";

    $ekzekuto_cmim = mysqli_query($con, $zgjidh_cmim);
    while($p_cmim = mysqli_fetch_array($ekzekuto_cmim)){
        $produkt_id = $p_cmim['product_id'];
        $produkt_cmim = "select * from products where product_id = '$produkt_id'";
        $ekzektuo_produkt_cmim = mysqli_query($con,$produkt_cmim);
        while($pp_cmim=mysqli_fetch_array($ekzektuo_produkt_cmim)){
            $produkt_tabele_cmim = array($pp_cmim['product_price']);
        }
        $vlerat=array_sum($produkt_tabele_cmim);
        $total += $vlerat;
    }
    echo "$".$total;
}


?>












