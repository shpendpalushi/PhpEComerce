



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
        $password = $_POST['password'];

        $check_password = "select * from customers where customer_email='$user' and customer_password='$password'";
        $run_check_password = mysqli_query($con, $check_password);

        $num_check_password = mysqli_num_rows($run_check_password);

        if($num_check_password == 0){
            echo "<script>alert('Nuk e keni shkruar mire passwordin, mendojeni edhe nje here fshirjen, mos u nxitoni!')</script>";
        }else{
            $delete_user = "delete from customers where customer_email='$user'";
            $run_delete_user = mysqli_query($con, $delete_user);
            echo "<script>window.open('../index.php','_self')</script>";
            session_destroy();
        }
    }
?>