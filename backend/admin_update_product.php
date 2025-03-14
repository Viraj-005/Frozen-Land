<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['update_product'])){

    $update_p_id = $_POST['update_p_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $cat = mysqli_real_escape_string($conn, $_POST['category']);

    mysqli_query($conn, "UPDATE `products` SET name = '$name', price ='$price', category = '$cat' WHERE id = '$update_p_id'") or die('query failed');

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../upload_images/'.$image; 
    $old_image = $_POST['update_p_image'];

    if(!empty($image)){
        if($image_size > 2000000){
            $message[] = 'image file size is too large!';
        }else{
            mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('../upload_images/'.$old_image);

            $message[] = 'Image updated successfully!';
        }
    }

    $message[] = 'Product updated successfully!';


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>

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

    <section class="update-product">

        <h1 class="heading">Update Products</h1>

        <?php

        /*$_GET['update'] = '';*/
        $update_id = $_GET['update'];
        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){

    
    
    ?>

        <form action="" method="post" enctype="multipart/form-data">

            <img src="../upload_images/<?php echo $fetch_products['image']; ?>" class="image" alt="">

            <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">

            <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">

            <input type="text" class="box" name="name" value="<?php echo $fetch_products['name']; ?>" required
                maxlength="100" placeholder="Update product name">

            <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required
                max="999999999" placeholder="Update product price" onkeypress="if(this.valu.length == 10) return false;"
                name="price">

            <select name="category" class="box" required>
                <option selected value="<?php echo $fetch_products['category']; ?>">
                    <?php echo $fetch_products['category']; ?></option>
                <option value="Sundaes">Sundaes</option>
                <option value="Sherbet">Sherbet</option>
                <option value="Flavors">Flavors</option>
                <option value="No-sugar added">No-Sugar Added</option>
                <option value="Icecones">Cone Icecream</option>
                <option value="Fancy">Fancy</option>
            </select>

            <input type="file" class="box" name="image" accept="image/jpg, image/jpeg, image/png">

            <div class="flex-btn">
                <input type="submit" value="update product" class="btn" name="update_product">

                <a href="admin_products.php" class="option-btn">Go back</a>
            </div>


        </form>

        <?php
        }
    }else{
        echo '<p class="empty">No update product select yet!</p>';
    }
    ?>

    </section>


    <!--custom admin js link-->
    <script src="../js/admin_script.js"></script>
</body>

</html>