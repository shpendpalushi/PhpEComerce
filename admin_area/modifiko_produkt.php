<?php

    if(!isset($_SESSION['user_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        
?>

<!DOCTYPE html>
<html>
<?php
    include("../includes/database.php");
    if(isset($_GET['modifiko_produkt'])){
        $merre_id = $_GET['modifiko_produkt'];
        $merri_produktet = "select * from products where product_id='$merre_id'";
        $ekzekuto_produktet = mysqli_query($con, $merri_produktet);
        $i = 0;
        $rresht_produkt = mysqli_fetch_array($ekzekuto_produktet);

            $id_produkti=$rresht_produkt['product_id'];
            $titull_produkti = $rresht_produkt['product_title'];
            $foto_produkti = $rresht_produkt['product_image'];
            $cmim_produkti = $rresht_produkt['product_price'];
            $pershkrim_produkti = $rresht_produkt['product_description'];
            $fjale_kyce_produkti = $rresht_produkt['product_keywords'];
            $kategori_produkti = $rresht_produkt['product_category'];
            $brand_produkti = $rresht_produkt['produ ct_brand'];
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://cdn.tiny.cloud/1/g447jb1j5haeghb1xa76cxn2tcm6vo134dxu1o6fxa734uml/tinymce/5/tinymce.min.js' referrerpolicy="origin">
  </script>
  <script>
    tinymce.init({
      selector: '#mytextarea',
      force_br_newlines : false,
      force_p_newlines : false,
      forced_root_block : '',
    });
  </script>
    <title>Document</title>
</head>
<body bgcolor="aquamarine">
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="795px">
            <tr>
                <td colspan="2" align="center"><h2>Rregulloje dhe modifikoje produktin ketu</h2></td>
            </tr>

            <tr>
                <td align="right" >Kategoria e produktit: </td>
                <td>
                    <select name="product_category" id="">
                    <option ><?php echo $kategori_produkti?></option>
                        <?php
                            $merr_kategorite = "select * from categories";
                            $ekzekuto_kategorite = mysqli_query($con, $merr_kategorite);

                            while($rresht_kategorite = mysqli_fetch_array($ekzekuto_kategorite)) {
                        
                                $titull_id = $rresht_kategorite['category_id'];
                                $titull_kategori = $rresht_kategorite['category_title'];
                                echo "<option value='$titull_id'>$titull_kategori</option>";
                        
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right">Brandi i produktit: </td>
                <td>
                <select name="product_brand" id="">
                    <option><?php echo $brand_produkti?></option>
                        <?php
                            $merr_brandet = "select * from brands";
                            $ekzekuto_brandet = mysqli_query($con, $merr_brandet);
                        
                            while($rreshtat_brand = mysqli_fetch_array($ekzekuto_brandet)) {
                        
                                $brand_id = $rreshtat_brand['brand_id'];
                                $titull_brand = $rreshtat_brand['brand_title'];
                                echo "<option value='$brand_id'>$titull_brand</option>";
                        
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right">Titulli i produktit: </td>
                <td><input type="text" name="product_title" value="<?php echo $titull_produkti;?>"></td>
            </tr>

            <tr>
                <td align="right">Cmimi i Produktit: </td>
                <td colspan="3"><input type="text" name="product_price" value="<?php echo $cmim_produkti?>"></td>
            </tr>

            <tr>
                <td align="right">Pershkrimi i Produktit: </td>
                <td height="300"><textarea name="product_description" rows="20" cols="20" id="mytextarea"><?php echo $pershkrim_produkti?></textarea></td>
            </tr>

            <tr>
                <td align="right">Fotoja e produktit: </td>
                <td><input type="file" name="product_image"><img src="product_images/<?php echo $foto_produkti?>" alt="" width="50" height="50"></td>
            </tr>

            <tr>
                <td align="right">Fjalet kyce per produktin: </td>
                <td><input type="text"  align="center" name="product_keywords" value="<?php echo $fjale_kyce_produkti?>"></td>
            </tr>

            <tr>
                <td  colspan="2" align="center"><input type="submit" name="modifiko_produktin" value="Modifiko Produktin"></td>
            </tr>



        </table>
    </form>
</body>
</html>

<?php
    if(isset($_POST['modifiko_produktin'])){
        $id_produkt = $id_produkti;
         $titull_produkt = $_POST['product_title'];
         $kategoril_produkt = $_POST['product_category'];
         $brand_produkt = $_POST['product_brand'];
         $cmim_produkt = $_POST['product_price'];
         $pershkrim_produkt = $_POST['product_description'];
         $fjale_kyce_produkt = $_POST['product_keywords'];


         $foto_produkt = $_FILES['product_image']['name'];
         $foto_produkt_tmp = $_FILES['product_image']['tmp_name'];
        
         move_uploaded_file($foto_produkt_tmp, "product_images/$foto_produkt");

         $modifiko_produkt_query= "update products set product_category='$kategoril_produkt', product_title='$titull_produkt', product_brand='$brand_produkt', 
                                product_price='$cmim_produkt', product_description='$pershkrim_produkt', product_keywords='$fjale_kyce_produkt', product_image='$foto_produkt'
                                where product_id='$id_produkt'";

         $modifiko_produkt = mysqli_query($con, $modifiko_produkt_query);

         if($modifiko_produkt){
             echo "<script>alert('Info successfully updated to database')</script>";
             echo "<script>window.open('index.php?shiko_produktet', '_self')</script>";
         }
    }
?>
<?php } ?>