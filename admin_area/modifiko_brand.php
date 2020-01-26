<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>
<?php
    include("../includes/database.php");
    if(isset($_GET['modifiko_brand'])){
        $id_brandi = $_GET['modifiko_brand'];
        $merr_brandin = "select * from brands where brand_id='$id_brandi'";
        $ekzekuto_brandin=mysqli_query($con, $merr_brandin);
        $rresht_brand = mysqli_fetch_array($ekzekuto_brandin);

        $titull_brandi = $rresht_brand['brand_title'];

    }
?>



<form action="" method="post" style="padding: 100px;">
    <b style="padding: 20px;margin:30px">Modifikoje brandin</b><br>
    <input type="text" name="brand_re" style="margin:30px" value=<?php echo $titull_brandi;?>>
    <input type="submit" name="modifikoje_brandin" value="Rregulloje brandin">
</form>

<?php
    if(isset($_POST['modifikoje_brandin'])){
        $id_modifiko = $id_brandi;
        $brand_re = $_POST['brand_re'];
        $modifiko_brand = "update brands set brand_title='$brand_re' where brand_id='$id_modifiko'";
        $ekzekuto_kontrollo = mysqli_query($con, $modifiko_brand);

            if($ekzekuto_kontrollo){
                echo "<script>alert('Brandi u modifikua me sukses')</script>";
                echo "<script>window.open('index.php?shiko_brandet','_self')</script>";
            }else{
            echo "<script>alert('Na duket sikur dicka shkoi gabim, provoje dhe nje here per siguri!')</script>";
                echo "<script>window.open('index.php?shto_brand','_self')</script>";
        }

    }
?>

<?php }?>