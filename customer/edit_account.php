
<?php
    include("../includes/database.php");
     $user = $_SESSION['customer_email'];
    
     $get_customer = "select * from customers where customer_email='$user'";
     $run_customer = mysqli_query($con, $get_image);
     

     $row_customer = mysqli_fetch_array($run_customer);

     $id = $row_customer['customer_id'];
     $name =  $row_customer['customer_name'];
     $email =  $row_customer['customer_email'];
     $passsword =  $row_customer['customer_password'];
     $country =  $row_customer['customer_country'];
     $city =  $row_customer['customer_city'];
     $contact =  $row_customer['customer_contact'];
     $address =  $row_customer['customer_address'];
     $image =  $row_customer['customer_image'];

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
                        <td><input type="text" name="customer_name" value="<?php echo $name ?>" ></td>
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
                                <option><?php echo $country ?></option>
                                <option value="Shqiperi">Shqiperi</option>
                                <option value="US">US</option>
                                <option value="UK">Uk</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Qyteti:</td>
                        <td><input type="text" name="customer_city" value="<?php echo $city ?>" ></td>
                    </tr>
                    <tr>
                        <td align="right">Kontakt:</td>
                        <td><input type="text" name="customer_contact" value="<?php echo $contact ?>" ></td>
                    </tr>
                    <tr>
                        <td align="right">Adresa:</td>
                        <td><input type="text" name="customer_address" value="<?php echo $address ?>" ></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td align="right">Fotografia e profilit:</td>
                        <td><input type="file" name="customer_image"> <img src="customer_images/<?php echo $image; ?>" alt="" width="50" height="50"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="update" value="Update Account"></td>
                    </tr>

                </table>

            </form>
        

<?php
        if(isset($_POST['update'])){
            $ip = getIp();

            $customer_id = $id;
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_password = $_POST['customer_password'];
            $customer_image = $_FILES['customer_image']['name'];
            $customer_image_tmp = $_FILES['customer_image']['tmp_name'];
            $customer_country = $_POST['customer_country'];
            $customer_city = $_POST['customer_city'];
            $customer_contact = $_POST['customer_contact'];  
            $customer_address = $_POST['customer_address']; 
            move_uploaded_file($customer_image_tmp,"customer_images/$customer_image");   
            $update_customer = "update customers set customer_name='$customer_name', customer_email='$customer_email', customer_password='$customer_password',
            customer_image='$customer_image',customer_city='$customer_city', customer_contact='$customer_contact', customer_address='$customer_address' where customer_id='$customer_id'";

            $run_update = mysqli_query($con,$update_customer);

            if($run_update){
                echo "<script>alert('Llogaria juaj u rinovua me sukses') </script>";
                echo "<script>window.open('my_account.php','_self')</script>";
            }
            
        }
?>