<!DOCTYPE html>
<html>
<?php
    include("../includes/database.php");
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
    <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <table align="center" width="1000px" border="1">
            <tr>
                <td colspan="2" align="center"><h2>Shto produkt ketu</h2></td>
            </tr>

            <tr>
                <td align="right" >Product category: </td>
                <td>
                    <select name="product_category" id="">
                    <option value="">Zgjidhe kategorine</option>
                        <?php
                            $merr_kategorite = "select * from categories";
                            $ekzekuto_kategorite = mysqli_query($con, $merr_kategorite);

                            while($rresht_kategorite = mysqli_fetch_array($ekzekuto_kategorite)) {
                        
                                $titull_idi = $rresht_kategorite['category_id'];
                                $titull_kategori = $rresht_kategorite['category_title'];
                                echo "<option value='$titull_idi'>$titull_kategori</option>";
                        
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right">Brandi i produktit: </td>
                <td>
                <select name="product_brand" id="">
                    <option value="">Zgjidh brandin:</option>
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
                <td align="right">Product Title: </td>
                <td><input type="text" name="product_title"></td>
            </tr>

            <tr>
                <td align="right">Cmimi i Produktit: </td>
                <td colspan="3"><input type="text" name="product_price"></td>
            </tr>

            <tr>
                <td align="right">Pershkrimi i Produktit: </td>
                <td height="300"><textarea name="product_description" rows="20" cols="20" id="mytextarea"></textarea></td>
            </tr>

            <tr>
                <td align="right">Fotoja e produktit: </td>
                <td><input type="file" name="product_image"></td>
            </tr>

            <tr>
                <td align="right">Fjalet kyce per produktin: </td>
                <td><input type="text"  align="center" name="product_keywords"></td>
            </tr>

            <tr>
                <td  colspan="2" align="center"><input type="submit" name="insert_post" value="Insert Product"></td>
            </tr>



        </table>
    </form>
</body>
</html>

<?php
    if(isset($_POST['insert_post'])){
         $titull_produkt = $_POST['product_title'];
         $kategoril_produkt = $_POST['product_category'];
         $brand_produkt = $_POST['product_brand'];
         $product_price = $_POST['product_price'];
         $pershkrim_produkt = $_POST['product_description'];
         $fjale_kyce_produkt = $_POST['product_keywords'];


         $foto_produkt = $_FILES['product_image']['name'];
         $foto_produkt_tmp = $_FILES['product_image']['tmp_name'];
        
         move_uploaded_file($foto_produkt_tmp, "product_images/$foto_produkt");

         $shto_produkt_query= "insert into products (product_category, product_brand, product_title, product_price,product_description, product_image,product_keywords)
         values('$kategoril_produkt','$brand_produkt','$titull_produkt','$product_price','$pershkrim_produkt','$foto_produkt','$fjale_kyce_produkt')";

         $shto_produkt = mysqli_query($con, $shto_produkt_query);

         if($shto_produkt){
             echo "<script>alert('Info successfully inserted to database')</script>";
             echo "<script>window.open('insert_product.php', '_self')</script>";
         }
    }
?>