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
                <td colspan="2" align="center"><h2>Insert a new product here</h2></td>
            </tr>

            <tr>
                <td align="right" >Product category: </td>
                <td>
                    <select name="product_category" id="">
                    <option value="">Select Category</option>
                        <?php
                            $get_categories = "select * from categories";
                            $run_categories = mysqli_query($con, $get_categories);

                            while($row_categories = mysqli_fetch_array($run_categories)) {
                        
                                $category_id = $row_categories['category_id'];
                                $category_title = $row_categories['category_title'];
                                echo "<option value='$category_id'>$category_title</option>";
                        
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right">Product Brand: </td>
                <td>
                <select name="product_brand" id="">
                    <option value="">Select Brand</option>
                        <?php
                            $get_brands = "select * from brands";
                            $run_brands = mysqli_query($con, $get_brands);
                        
                            while($row_brands = mysqli_fetch_array($run_brands)) {
                        
                                $brand_id = $row_brands['brand_id'];
                                $brand_title = $row_brands['brand_title'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                        
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
                <td align="right">Product Price: </td>
                <td colspan="3"><input type="text" name="product_price"></td>
            </tr>

            <tr>
                <td align="right">Product Descrption: </td>
                <td height="300"><textarea name="product_description" rows="20" cols="20" id="mytextarea"></textarea></td>
            </tr>

            <tr>
                <td align="right">Product Image: </td>
                <td><input type="file" name="product_image"></td>
            </tr>

            <tr>
                <td align="right">Product Keywords: </td>
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
         $product_title = $_POST['product_title'];
         $product_category = $_POST['product_category'];
         $product_brand = $_POST['product_brand'];
         $product_price = $_POST['product_price'];
         $product_description = $_POST['product_description'];
         $product_keywords = $_POST['product_keywords'];


         $product_image = $_FILES['product_image']['name'];
         $product_image_tmp = $_FILES['product_image']['tmp_name'];
        
         move_uploaded_file($product_image_tmp, "product_images/$product_image");

         $insert_product_query= "insert into products (product_category, product_brand, product_title, product_price,product_description, product_image,product_keywords)
         values('$product_category','$product_brand','$product_title','$product_price','$product_description','$product_image','$product_keywords')";

         $insert_product = mysqli_query($con, $insert_product_query);

         if($insert_product){
             echo "<script>alert('Info successfully inserted to database')</script>";
             echo "<script>window.open('insert_product.php', '_self')</script>";
         }
    }
?>