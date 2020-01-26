<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<table width="795px" align="center">
    <tr>
        <td colspan="6" align="center"><h2>Shiko te gjitha produktet ketu<h2></td>
    </tr>

    <tr>
        <th>NR</th>
        <th>Titulli</th>
        <th>Foto</th>
        <th>Cmimi</th>
        <th>Rregulloje</th>
        <th>Fshije</th>
    </tr>
    <?php
        include("../includes/database.php");
        $merri_produktet = "select * from products";
        $ekzekuto_produktet = mysqli_query($con, $merri_produktet);
        $i = 0;
        while($rresht_produkt = mysqli_fetch_array($ekzekuto_produktet)){
            $id_produkti=$rresht_produkt['product_id'];
            $titull_produkti = $rresht_produkt['product_title'];
            $foto_produkti = $rresht_produkt['product_image'];
            $cmim_produkti = $rresht_produkt['product_price'];
            $i++;
        
    ?>

    <tr align="center" style="border-top:1px solid black;">
        <td><?php echo $i?></td>
        <td><?php echo $titull_produkti?></td>
        <td><img src="product_images/<?php echo $foto_produkti;?>" width="50" height="50"></td>
        <td><?php echo $cmim_produkti;?>$</td>
        <td><a href="index.php?modifiko_produkt=<?php echo $id_produkti;?>">Rregullo</a></td>
        <td><a href="fshi_produkt.php?fshi_produkt=<?php echo $id_produkti; ?>">Fshi</a></td>
    </tr>

        <?php }?>
</table>

        <?php } ?>