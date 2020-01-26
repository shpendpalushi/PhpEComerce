<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<table width="795px" align="center" class="table">
    <tr>
        <td colspan="6" align="center"><h2>Shiko te gjitha produktet ketu<h2></td>
    </tr>

    <tr>
        <th>Numri</th>
        <th>Titulli i kategorise</th>
        <th>Rregulloje</th>
        <th>Fshije</th>
    </tr>
    <?php
        include("../includes/database.php");
        $merri_kategorite = "select * from categories";
        $ekzekuto_kategorite = mysqli_query($con, $merri_kategorite);
        $i = 0;
        while($rresht_kategori = mysqli_fetch_array($ekzekuto_kategorite)){
            $id_kategorie=$rresht_kategori['category_id'];
            $titull_kategorie = $rresht_kategori['category_title'];
            $i++;
        
    ?>

    <tr align="center" style="border-top:1px solid black;">
        <td><?php echo $i?></td>
        <td><?php echo $titull_kategorie?></td>
        <td><a href="index.php?modifiko_kategori=<?php echo $id_kategorie;?>">Rregullo</a></td>
        <td><a href="fshi_kategori.php?fshi_kategori=<?php echo $id_kategorie; ?>">Fshi</a></td>
    </tr>

        <?php }?>
</table>
        <?php } ?>