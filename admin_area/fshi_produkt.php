<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<?php

    include("../includes/database.php");
    if(isset($_GET['fshi_produkt'])){

        $fshi_produkt = $_GET['fshi_produkt'];
        $fshi_produkt_kerkese = "delete from products where product_id = '$fshi_produkt'";

        $ekzekuto_fshi_produkt = mysqli_query($con, $fshi_produkt_kerkese);

        if($ekzekuto_fshi_produkt){
            echo "<script>alert('Produkti u fshi me sukses')</script>";
            echo "<script>window.open('index.php?shiko_produktet', '_self')</script>";
        }
    }


?>

<?php } ?>