<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<table width="795px" align="center" class="table">
    <tr>
        <td colspan="6" align="center"><h2>Shiko te gjithe klientet ketu<h2></td>
    </tr>

    <tr>
        <th>NR</th>
        <th>Emri</th>
        <th>Email</th>
        <th>Adresa</th>
        <th>Kontakti</th>
        <th>Fshije</th>
    </tr>
    <?php
        include("../includes/database.php");
        $merri_klientet = "select * from customers";
        $ekzekuto_klientet = mysqli_query($con, $merri_klientet);
        $i = 0;
        while($rresht_klient = mysqli_fetch_array($ekzekuto_klientet)){
            $id_klienti=$rresht_klient['customer_id'];
            $emer_klienti = $rresht_klient['customer_name'];
            $email_klienti = $rresht_klient['customer_email'];
            $adrese_klienti = $rresht_klient['customer_address'];
            $foto_klienti = $rresht_klient['customer_image'];
            $kontakt_klienti = $rresht_klient['customer_contact'];
            $i++;
        
    ?>

    <tr align="center" style="border-top:1px solid black;">
        <td><?php echo $i?></td>
        <td><?php echo $emer_klienti?></td>
        <td><?php echo $email_klienti;?></td>
        <td><?php echo $adrese_klienti;?></td>
        <td><?php echo $kontakt_klienti;?></td>
        <td><a href="fshi_llogari.php?fshi_llogari=<?php echo $id_klienti; ?>">Fshi</a></td>
    </tr>

        <?php }?>
</table>

        <?php } ?>