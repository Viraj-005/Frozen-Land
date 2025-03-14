<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $cat = mysqli_real_escape_string($conn, $_POST['category']);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'upload_images/'.$image;

    $select_product_name = mysqli_query($conn, "SELECT * FROM `products` WHERE name = '$name'") or die('query failed');

    if(mysqli_num_rows($select_product_name) > 0){
        $message[] = 'product name already exist!';
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, category, price, image) VALUES('$name', '$cat', '$price', '$image')") or die('query failed');

        if($insert_product){
            if($image_size > 20000000){
                $message[] = 'image size is too large!';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Product Added Successfully!';
            }
        }
    }


}
if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('upload_images/'.$fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');

    mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');

    header('location:admin_products.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>

    <!--Font awsome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Custom admin css link-->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php

if(isset($message)){
        foreach($message as $message){
            echo '
                <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }
?>

    <?php @include 'admin_header.php'; ?>

    <section class="add-products">

        <h1 class="heading">Add New Products</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" class="box" name="name" required maxlength="100" placeholder="Enter product name"
                oninvalid="this.setCustomValidity('Type the product name')"
                onchange="try{setCustomValidity('')}catch(e){}">

            <input type="number" min="0" class="box" required max="999999999" placeholder="Enter product price"
                onkeypress="if(this.valu.length == 10) return false;" name="price"
                oninvalid="this.setCustomValidity('Type the product price')"
                onchange="try{setCustomValidity('')}catch(e){}">

            <select name="category" class="box" required oninvalid="this.setCustomValidity('Select product category')"
                onchange="try{setCustomValidity('')}catch(e){}">
                <option value="" disabled selected>select category --</option>
                <option value="Sundaes">Sundaes</option>
                <option value="Sherbet">Sherbet</option>
                <option value="Flavors">Flavors</option>
                <option value="No-sugar added">No-Sugar Added</option>
                <option value="Icecones">Cone Icecream</option>
                <option value="Fancy">Fancy</option>
            </select>

            <input type="file" class="box" name="image" accept="image/jpg, image/jpeg, image/png" required
                oninvalid="this.setCustomValidity('Select the image file')"
                onchange="try{setCustomValidity('')}catch(e){}">

            <input type="submit" value="add product" class="btn" name="add_product">
        </form>

    </section>


    <section class="show-products">

        <div class="search-form">
            <form action="" method="POST">
                <input type="text" class="box" placeholder="search product or categories" required name="search_box"
                    oninvalid="this.setCustomValidity('Type the product name or categoery name you want to search')"
                    onchange="try{setCustomValidity('')}catch(e){}">
                <button type="submit" class="fa fa-search" name="search_btn">
            </form>
        </div>

        <div class="find-container">
            <?php
            if(isset($_POST['search_box']) || isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category LIKE '%{$search_box}%' || name LIKE '%{$search_box}%'");
            
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
            <div class="box">
                <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
                <img src="../images/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="category"><?php echo $fetch_products['category']; ?></div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="flex-btn">
                    <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>"
                        class="option-btn">Update</a>
                    <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                        onclick="return confirm('delete this product?');">Delete</a>
                </div>
            </div>
            <?php
              }
            }else{
                echo '<p class="empty">No such product or category added yet!</p>';
            }
    
        }
        ?>
        </div>

        <h1 class="heading">Added All Products</h1>

        <div class="box-container">

            <?php 

           $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
           

           if(mysqli_num_rows($select_products) > 0){
              while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
            <div class="box">
                <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
                <img src="../images/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="category"><?php echo $fetch_products['category']; ?></div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="flex-btn">
                    <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>"
                        class="option-btn">Update</a>
                    <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                        onclick="return confirm('Do you want to delete this product?');">Delete</a>
                </div>
            </div>
            <?php
              }
           }else{
            echo '<p class="empty">No products added yet!</p>';
           }
        ?>

        </div>

    </section>


    <!--custom admin js link-->
    <script src="../js/admin_script.js"></script>

</body>

</html>