<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<form action="" method="post" style="padding: 100px;">
    <b style="padding: 20px;margin:30px">Shtoje nje brand te re</b><br>
    <input type="text" name="brand_ri" style="margin:30px">
    <input type="submit" name="shtoje_brandin" value="Shtoje brandin" class="btn">
</form>

<?php
    include("../includes/database.php");
    if(isset($_POST['shtoje_brandin'])){
        $brand = $_POST['brand_ri'];
        $kontrollo_brand = "Select * from brands where brand_title = '$brand'";
        $ekzekuto_kontrollo = mysqli_query($con, $kontrollo_brand);

        if(mysqli_num_rows($ekzekuto_kontrollo)==0){
            $shto_query = "insert into brands(brand_title) values ('$brand')";
            $ekzekuto_shtim = mysqli_query($con,$shto_query);

            if($ekzekuto_shtim){
                echo "<script>alert('Brandi u shtua me sukses')</script>";
                echo "<script>window.open('index.php?shiko_brandet','_self')</script>";
            }
        }else{
            echo "<script>alert('Na duket sikur branda ekziston, provoje dhe nje here per siguri!')</script>";
                echo "<script>window.open('index.php?shto_brand','_self')</script>";
        }

    }

?>

<?php }
?>