



<h3 style="text-align:cnter">Fshije llogarine tende</h3>

<form action="" method="post">
    <table align="center">
        <tr>
            <td>Shkruaje passwordin per konfirmim: </td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="2"><input type="submit" name="delete" value="Fshije Llogarine"></td>
        </tr>
    </table>
</form>

<?php
    include("../includes/database.php");
    if(isset($_POST['delete'])){
        $user = $_SESSION['customer_email'];
        $fjalekalim = $_POST['password'];

        $kontroll_fjalekalim = "select * from customers where customer_email='$user' and customer_password='$fjalekalim'";
        $ekzekuto_kontroll_fjalekalim = mysqli_query($con, $kontroll_fjalekalim);

        $numer_kontroll_fjalekalim = mysqli_num_rows($ekzekuto_kontroll_fjalekalim);

        if($numer_kontroll_fjalekalim == 0){
            echo "<script>alert('Nuk e keni shkruar mire passwordin, mendojeni edhe nje here fshirjen, mos u nxitoni!')</script>";
        }else{
            $fshi_perdorues = "delete from customers where customer_email='$user'";
            $ekzekuto_fshi_perdorues = mysqli_query($con, $fshi_perdorues);
            echo "<script>window.open('../index.php','_self')</script>";
            session_destroy();
        }
    }
?>