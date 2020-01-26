
<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<table width="795px" align="center" class="table">
    <tr>
        <td colspan="6" align="center"><h2>Shiko te gjitha brandet ketu<h2></td>
    </tr>

    <tr>
        <th>Numri</th>
        <th>Titulli i brandit</th>
        <th>Rregulloje</th>
        <th>Fshije</th>
    </tr>
    <?php
        include("../includes/database.php");
        $merri_brandte = "select * from brands";
        $ekzekuto_brandte = mysqli_query($con, $merri_brandte);
        $i = 0;
        while($rresht_brand = mysqli_fetch_array($ekzekuto_brandte)){
            $id_brandi=$rresht_brand['brand_id'];
            $titull_brandi = $rresht_brand['brand_title'];
            $i++;
        
    ?>

    <tr align="center" style="border-top:1px solid black;">
        <td><?php echo $i?></td>
        <td><?php echo $titull_brandi?></td>
        <td><a href="index.php?modifiko_brand=<?php echo $id_brandi;?>">Rregullo</a></td>
        <td><a href="fshi_brand.php?fshi_brand=<?php echo $id_brandi; ?>">Fshi</a></td>
    </tr>

        <?php }?>
</table>    

<?php } ?>