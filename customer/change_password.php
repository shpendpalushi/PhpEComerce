<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/verify_passwords.js"></script>
</head>
<body>
<h4 style="align-text:center">Ndryshoni passwordin tuaj</h4>
<form action="" method="post">
    <table align="center">
        <tr>
            <td>Shkruani passwordin e vjeter:</td>
            <td><input type="password" name="current_password" size="30" required></td>
        </tr>

        <tr>
            <td>Shkruani passwordin e ri:</td>
            <td><input type="password" name="new_password" size="30"required></td>
        </tr>

        <tr>
            <td>Perseriteni passwordin e ri:</td>
            <td><input type="password" name="new_password_confirm" size="30" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center"><input type="submit" name="change_password" value="Ndryshoje Passwordin" size="30"></td>
        </tr>        
    </table>
</form>
</body>
</html>

<?php
    include("../includes/database.php");
    if(isset($_POST['change_password'])){
        $user = $_SESSION['customer_email'];
        $fjalekalimi_aktual=$_POST['current_password'];
        $fjalekalimi_ri = $_POST['new_password'];
        $fjalekalimi_ri_confirm=$_POST['new_password_confirm'];
        $zgjidh_password = "select customer_id from customers where customer_email='$user' and customer_password='$fjalekalimi_aktual'";
        $ekzekuto_password = mysqli_query($con, $zgjidh_password);
        $kontrollo_password = mysqli_num_rows($ekzekuto_password);
        if($kontrollo_password == 0){
            echo "<script>alert('Nuk e keni shkruar passwordin sakte!')</script>";
        }else if($fjalekalimi_ri != $fjalekalimi_ri_confirm){
            echo "<script>alert('Passwordet nuk po na rakordojne, ndoshta provojeni perseri')</script>";
        }
        else{
            $rifresko_password = "update customers set customer_password='$fjalekalimi_ri' where customer_email='$user'";
            $ekzekuto_rifresko_password = mysqli_query($con, $rifresko_password);
            echo "<script>alert('Passwordi u riakordua me sukses')</script>";
            echo "<script>window.open('my_account.php', '_self')</script>";
        }
        
    }
?>