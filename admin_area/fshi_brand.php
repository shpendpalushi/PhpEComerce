<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<?php

    include("../includes/database.php");
    if(isset($_GET['fshi_brand'])){

        $fshi_brand = $_GET['fshi_brand'];
        $fshi_brand_kerkese = "delete from brands where brand_id = '$fshi_brand'";

        $ekzekuto_fshi_brand = mysqli_query($con, $fshi_brand_kerkese);

        if($ekzekuto_fshi_brand){
            echo "<script>alert('Brandi u fshi me sukses')</script>";
            echo "<script>window.open('index.php?shiko_brandet', '_self')</script>";
        }
    }


?>

<?php }?>