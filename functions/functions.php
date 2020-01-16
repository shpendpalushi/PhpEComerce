<?php

$con = mysqli_connect("localhost", "root","","ecas");

function getCategories(){

    global $con;

    $get_categories = "select * from categories";
    $run_categories = mysqli_query($con, $get_categories);

    while($row_categories = mysqli_fetch_array($run_categories)) {

        $category_id = $row_categories['category_id'];
        $category_title = $row_categories['category_title'];
        echo "<li><a href='index.php?category=$category_id'>$category_title</a></li>";

    }

}


function getBrands(){

    global $con;

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($con, $get_brands);

    while($row_brands = mysqli_fetch_array($run_brands)) {

        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";

    }

}

function getProducts(){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){ 
            global $con;
            $get_products = "select * from products order by RAND() LIMIT 0,6";
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
                            <p style='text-align:center'>Price: $ $product_price</p><br>

                            <a href='details.php?product_id=$product_id' style='float:left'>Details</a>
                            <a href='index.php?add_cart=$product_id' style='float:right'><button style='float:right'>Add to Cart</button></a>

                        </div>
                
                
                ";
            }
        }
    }
}


function getCategoryProducts(){
    if(isset($_GET['category'])){
        $my_category_id = $_GET['category'];
        global $con;
        $get_category_products = "select * from products where product_category='$my_category_id'";
        $run_category_products = mysqli_query($con,$get_category_products);
        $count = mysqli_num_rows($run_category_products);
        if($count==0){
            echo "<h4>Kjo kategori nuk ka ende produkte ju kerkojme ndjese!</h4>";
        }
        while($row_category_product= mysqli_fetch_array($run_category_products)){
            $product_id = $row_category_product['product_id'];
            $product_category = $row_category_product['product_category'];
            $product_brand = $row_category_product['product_brand'];
            $product_title = $row_category_product['product_title'];
            $product_price = $row_category_product['product_price'];
            $product_image = $row_category_product['product_image'];
            
            echo "
                    <div id='single_product'>
                        <h3>$product_title</h3>
                        
                        <img src='admin_area/product_images/$product_image' width='180' height='180'>
                        <p style='text-align:center'>Price: $ $product_price</p><br>

                        <a href='details.php?product_id=$product_id' style='float:left'>Details</a>
                        <a href='index.phpproduct_id = $product_id' style='float:right'><button style='float:right'>Add to Cart</button></a>

                    </div>
            
            
            ";
        }
    }
    
}


function getBrandProducts(){
    if(isset($_GET['brand'])){
        $my_brand_id = $_GET['brand'];
        global $con;
        $get_brand_products = "select * from products where product_brand='$my_brand_id'";
        $run_brand_products = mysqli_query($con,$get_brand_products);
        $count = mysqli_num_rows($run_brand_products);
        if($count==0){
            echo "<h4>Ky brand nuk ka ende produkte ju kerkojme ndjese!</h4>";
        }
        while($row_brand_product= mysqli_fetch_array($run_brand_products)){
            $product_id = $row_brand_product['product_id'];
            $product_brand = $row_brand_product['product_brand'];
            $product_brand = $row_brand_product['product_brand'];
            $product_title = $row_brand_product['product_title'];
            $product_price = $row_brand_product['product_price'];
            $product_image = $row_brand_product['product_image'];
            
            echo "
                    <div id='single_product'>
                        <h3>$product_title</h3>
                        
                        <img src='admin_area/product_images/$product_image' width='180' height='180'>
                        <p style='text-align:center'>Price: $ $product_price</p><br>

                        <a href='details.php?product_id=$product_id' style='float:left'>Details</a>
                        <a href='index.phpproduct_id = $product_id' style='float:right'><button style='float:right'>Add to Cart</button></a>

                    </div>
            
            
            ";
        }
    }
}


function getAllProducts(){ 
    global $con;
    $get_products = "select * from products";
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
                    <p style='text-align:center'>Price: $ $product_price</p><br>

                    <a href='details.php?product_id=$product_id' style='float:left'>Details</a>
                    <a href='index.php?product_id = $product_id' style='float:right'><button style='float:right'>Add to Cart</button></a>

                </div>
        
        
        ";
    }
}

function getDetailsForProduct(){
    global $con;
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $get_my_product = "select * from products where product_id = '$product_id'";

        $run_query = mysqli_query($con, $get_my_product);

        while($row_product = mysqli_fetch_array($run_query)){
            $product_id = $row_product['product_id'];
            
            $product_title = $row_product['product_title'];
            $product_price = $row_product['product_price'];
            $product_image = $row_product['product_image'];
            $product_description = $row_product['product_description'];

            echo "
            <div id='single_product'>
                <h3>$product_title</h3>
                
                <img src='admin_area/product_images/$product_image' width='400' height='400'>
                <p>Price: $$product_price</p><br>
                <p>$product_description</p><br>

                <a href='index.php' style='float:left'>Go Back</a>
                <a href='index.php?product_id = $product_id' style='float:right'><button style='float:right'>Add to Cart</button></a>

            </div>
    
    
            ";
        }

    }
}

function cart(){
    if(isset($_GET['add_cart'])){
        global $con;
        $ip = getIp();
         $product_id = $_GET['add_cart'];
         $check_product= "select * from cart where ip_address = '$ip' AND product_id='$product_id'";
         $run_check = mysqli_query($con, $check_pro);

         if(mysqli_num_rows($run_check)>0){
             echo "";
         }else{
             $insert_product = "insert into cart (product_id, ip_address) values('$product_id','$ip')";

             $run_product = mysqli_query($con, $insert_product);
             echo "<script>
                window.opend('index.php', '_self');
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

?>












