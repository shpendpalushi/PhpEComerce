
<?php
    include("../includes/database.php");
     $user = $_SESSION['customer_email'];
    
     $merr_perdorues = "select * from customers where customer_email='$user'";
     $_ekzekuto_perdorues = mysqli_query($con, $merr_perdorues);
     

     $rresht_perdorues = mysqli_fetch_array($_ekzekuto_perdorues);

     $id = $rresht_perdorues['customer_id'];
     $emer =  $rresht_perdorues['customer_name'];
     $email =  $rresht_perdorues['customer_email'];
     $fjalekalim =  $rresht_perdorues['customer_password'];
     $shtet =  $rresht_perdorues['customer_country'];
     $qytet =  $rresht_perdorues['customer_city'];
     $kontakt =  $rresht_perdorues['customer_contact'];
     $adrese =  $rresht_perdorues['customer_address'];
     $foto =  $rresht_perdorues['customer_image'];

?>
            <form action="" method="post" enctype="multipart/form-data">
                <table align="center" width="750px">
                    <tr>
                        <td><h4>Rirregullo llogarine</h4></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td align="right">Emri i klientit:</td>
                        <td><input type="text" name="customer_name" value="<?php echo $emer ?>" ></td>
                    </tr>

                    <tr>
                        <td align="right">Email i klientit:</td>
                        <td><input type="email" name="customer_email" value="<?php echo $email ?>" ></td>
                    </tr>

                    <tr>
                        <td align="right">Password i klientit:</td>
                        <td><input type="password" name="customer_password"  required></td>
                    </tr>

                    <tr>
                        <td align="right">Shteti:</td>
                        <td>
                            <select name="customer_country" id="" disabled>
                                <option><?php echo $shtet ?></option>
                                <option value="Shqiperi">Shqiperi</option>
                                <option value="US">US</option>
                                <option value="UK">Uk</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Qyteti:</td>
                        <td><input type="text" name="customer_city" value="<?php echo $qytet ?>" ></td>
                    </tr>
                    <tr>
                        <td align="right">Kontakt:</td>
                        <td><input type="text" name="customer_contact" value="<?php echo $kontakt ?>" ></td>
                    </tr>
                    <tr>
                        <td align="right">Adresa:</td>
                        <td><input type="text" name="customer_address" value="<?php echo $adrese ?>" ></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td align="right">Fotografia e profilit:</td>
                        <td><input type="file" name="customer_image"> <img src="customer_images/<?php echo $foto; ?>" alt="" width="50" height="50"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="update" value="Update Account"></td>
                    </tr>

                </table>

            </form>
        

<?php
        if(isset($_POST['update'])){
            $ip = getIp();

            $perdorues_id = $id;
            $emer_perdorues = $_POST['customer_name'];
            $email_perdorues = $_POST['customer_email'];
            $fjalekalim_perdorues = $_POST['customer_password'];
            $foto_perdorues = $_FILES['customer_image']['name'];
            $foto_perdorues_tmp = $_FILES['customer_image']['tmp_name'];
            $shtet_perdorues = $_POST['customer_country'];
            $qytet_perdorues = $_POST['customer_city'];
            $kontakt_perdorues = $_POST['customer_contact'];  
            $adrese_perdorues = $_POST['customer_address']; 
            move_uploaded_file($foto_perdorues_tmp,"customer_images/$foto_perdorues");   
            $rifresko_perdorues = "update customers set customer_name='$emer_perdorues', customer_email='$email_perdorues', customer_password='$fjalekalim_perdorues',
            customer_image='$foto_perdorues',customer_city='$qytet_perdorues', customer_contact='$kontakt_perdorues', customer_address='$adrese_perdorues' where customer_id='$perdorues_id'";

            $ekzekuto_rifreskim = mysqli_query($con,$rifresko_perdorues);

            if($ekzekuto_rifreskim){
                echo "<script>alert('Llogaria juaj u rinovua me sukses') </script>";
                echo "<script>window.open('my_account.php','_self')</script>";
            }
            
        }
?>