<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<?php

    include("../includes/database.php");
    if(isset($_GET['fshi_llogari'])){

        $fshi_llogari = $_GET['fshi_llogari'];
        $fshi_llogari_kerkese = "delete from customers where customer_id = '$fshi_llogari'";

        $ekzekuto_fshi_llogari = mysqli_query($con, $fshi_llogari_kerkese);

        if($ekzekuto_fshi_llogari){
            echo "<script>alert('llogaria u fshi me sukses')</script>";
            echo "<script>window.open('index.php?shiko_klientet', '_self')</script>";
        }
    }


?>
<?php }?>