<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<?php
    include("../includes/database.php");
    if(isset($_GET['modifiko_kategori'])){
        $id_kategorie = $_GET['modifiko_kategori'];
        $merr_kategorine = "select * from categories where category_id='$id_kategorie'";
        $ekzekuto_kategorine=mysqli_query($con, $merr_kategorine);
        $rresht_kategori = mysqli_fetch_array($ekzekuto_kategorine);

        $titull_kategorie = $rresht_kategori['category_title'];

    }
?>



<form action="" method="post" style="padding: 100px;">
    <b style="padding: 20px;margin:30px">Modifikoje kategorine</b><br>
    <input type="text" name="kategori_re" style="margin:30px" value=<?php echo $titull_kategorie;?>>
    <input type="submit" name="modifikoje_kategorine" value="Rregulloje kategorine">
</form>

<?php
    if(isset($_POST['modifikoje_kategorine'])){
        $id_modifiko = $id_kategorie;
        $kategori_re = $_POST['kategori_re'];
        $modifiko_kategori = "update categories set category_title='$kategori_re' where category_id='$id_modifiko'";
        $ekzekuto_kontrollo = mysqli_query($con, $modifiko_kategori);

            if($ekzekuto_kontrollo){
                echo "<script>alert('Kategoria u modifikua me sukses')</script>";
                echo "<script>window.open('index.php?shiko_kategorite','_self')</script>";
            }else{
            echo "<script>alert('Na duket sikur dicka shkoi gabim, provoje dhe nje here per siguri!')</script>";
                echo "<script>window.open('index.php?shto_kategori','_self')</script>";
        }

    }

?>

<?php }?>