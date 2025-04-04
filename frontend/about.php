<?php

@include '../backend/config.php';

session_start();

// Function to generate a random hex color excluding white and near-white colors
function getRandomColor() {
    do {
        // Generate a random hex color
        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        
        // Convert hex to RGB
        $r = hexdec(substr($color, 1, 2));
        $g = hexdec(substr($color, 3, 2));
        $b = hexdec(substr($color, 5, 2));
        
        // Calculate brightness (perceived luminance)
        $brightness = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        
        // Ensure the color is not too light (brightness threshold)
    } while ($brightness > 200); // Adjust the threshold as needed (200 is a good value to exclude near-white colors)
    
    return $color;
}

// Generate or retrieve the random color for the user icon
if (isset($_SESSION['user_id'])) {
    // If the user is logged in, check if a color is already stored in the session
    if (!isset($_SESSION['user_icon_color'])) {
        // Generate a new random color and store it in the session
        $_SESSION['user_icon_color'] = getRandomColor();
    }
    $user_icon_color = $_SESSION['user_icon_color'];
} else {
    // If the user is not logged in, use black for the icon
    $user_icon_color = 'black';
}

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['register'])){

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn, $filter_cpass);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
       $message[] = 'user already exist!';
    }else{
       if($pass != $cpass){
        $message[] = 'confirm password not matched!';
    }else{
        mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
        $message[] = 'registered successfully!, login now please!';
        
    }
   }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:about.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

if (isset($_GET['logout'])) {
    // Clear the user icon color from the session
    unset($_SESSION['user_icon_color']);
    
    // Destroy the session
    session_unset();
    session_destroy();
    
    // Redirect to the homepage
    header('location:index.php');
}

if(isset($_POST['add_to_cart'])){

    if($user_id == ''){
        $message[] = 'please login first!';
    }else{
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $select_cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart_num) > 0){
            $message[] = 'already added to cart';
        }else{
            mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'product added to cart';
        }
    }
    
}

if(isset($_POST['order'])){

    if($user_id == ''){
        $message[] = 'please login first!';
    }else{
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $method = mysqli_real_escape_string($conn, $_POST['method']);
        $address = mysqli_real_escape_string($conn, 'No.'. $_POST['add_no'].', '. $_POST['street'].' - '. $_POST['postal_code']);
        $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
        $total_products = mysqli_real_escape_string($conn, $_POST['total_products']);

        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_cart) > 0){
            $order_query = mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, method, address, total_price, total_products) VALUES('$user_id', '$name', '$number', '$method', '$address', '$total_price', '$total_products')") or die('query failed');
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $message[] = 'order placed successfully!';
        }else{
            $message[] = 'your cart is empty!';
        }

    }

}
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!--Font awsome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Custom css link-->
    <link rel="stylesheet" href="../css/style.css">
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

    <!--header section-->

    <header class="header">

        <section class="flex">
            <a href="index.php" class="logo">Frozen<span class="col">Land&#127848;</span></a>

            <nav class="navbar">
                <a href="about.php">about</a>
                <a href="menu.php">menu</a>
                <a href="order.php">order</a>
                <a href="contact.php">contact</a>
                <a href="faq.php">faq</a>


            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars" title="Menu"></div>
                <a href="search.php">
                    <div class="fas fa-search" title="Search"></div>
                </a>
                <div id="user-btn" class="fas fa-user" title="Account" style="color: <?php echo $user_icon_color; ?>;">
                </div>
                <div id="order-btn" class="fas fa-box" title="My Orders"></div>
                <?php
                        $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                        $cart_num_rows = mysqli_num_rows($select_cart_count);
                    ?>
                <div id="cart-btn" class="fas fa-shopping-cart" title="Cart">
                    <span>(<?php echo $cart_num_rows; ?>)</span>
                </div>


            </div>
        </section>

    </header>

    <section class="heading">

    </section>

    <div class="user-account">

        <section>

            <div id="close-account"><span>close</span></div>

            <div class="user">

                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');

                    if(mysqli_num_rows($select_users) > 0){
                        while($fetch_users = mysqli_fetch_assoc($select_users)){
                            echo '<p>Welcome! <span>'.$fetch_users['name'].'</span></p>';
                            echo '<a href="index.php?logout" class="btn">logout</a>';
                        }
                    }else{
                        echo '<p><span>You are not logged in now!</span></p>';
                    }

                ?>

            </div>


            <div class="display-orders">

                <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){

                            echo '<p>'.$fetch_cart['name'].' <span>('.$fetch_cart['price'].' x '.$fetch_cart['quantity'].')</span></p>';
  
                        }
                    }else{
                        echo '<p class="empty">your cart is empty</p>';
                    }   
                ?>

            </div>

            <div class="flex">

                <form action="login.php" method="post">
                    <h3>Login now</h3>
                    <input type="email" name="email" required class="box1" placeholder="Enter Your Email"
                        maxlength="50">

                    <input type="password" name="pass" required class="box" placeholder="Enter Your Password"
                        maxlength="20">

                    <input type="submit" value="login now" name="login" class="btn">

                </form>

                <form action="" method="post">
                    <h3>Register now</h3>
                    <input type="text" name="name" required class="box" placeholder="Enter Your Name" maxlength="20"
                        pattern="^[A-Z]\w*$"
                        oninvalid="this.setCustomValidity('Please make first letter of your name as capital')"
                        onchange="try{setCustomValidity('')}catch(e){}">

                    <input type="email" name="email" required class="box1" placeholder="Enter Your Email" maxlength="50"
                        oninvalid="this.setCustomValidity('Please give valid format, like @yahoo.com or @gmail.com, etc,.')"
                        onchange="try{setCustomValidity('')}catch(e){}">

                    <input type="password" name="pass" required class="box" placeholder="Enter Your Password"
                        maxlength="20" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z]).{6,10}"
                        title="Password should be of 6-10 length and should contain atleast one character and one number">

                    <input type="password" name="cpass" required class="box" placeholder="Confirm Your Password"
                        maxlength="20">

                    <input type="submit" value="Register now" name="register" class="btn">

                </form>

            </div>

        </section>

    </div>

    <div class="my-orders">

        <section>

            <div id="close-orders"><span>close</span></div>

            <h3 class="title">My orders</h3>

            <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>

            <div class="box">
                <p>Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                <p>name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
                <p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
                <p>payment method : <span><?php echo $fetch_orders['method']; ?></span></p>
                <p>your orders : <span><?php echo $fetch_orders['total_products']; ?></span></p>
                <p>total price : <span>Rs.<?php echo $fetch_orders['total_price']; ?>/-</span></p>
                <p>payment status : <span
                        style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?php echo $fetch_orders['payment_status']; ?></span>
                </p>
            </div>

            <?php
                    }
                }else{
                     echo '<p class="empty">no orders placed yet!</p>';
                }
            ?>

        </section>

    </div>

    <div class="shopping-cart">

        <section>
            <div id="close-cart"><span>close</span></div>

            <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
                        $grand_total += $sub_total; 
            ?>

            <div class="box">
                <a href="about.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times"></a>
                <img src="../upload_images/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="content">
                    <p><?php echo $fetch_cart['name']; ?> <span>(<?php echo $fetch_cart['price']; ?> x
                            <?php echo $fetch_cart['quantity']; ?>)</span></p>

                    <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                        <input type="number" class="qty" name="cart_quantity" min="1" max="100"
                            value="<?php echo $fetch_cart['quantity']; ?>"
                            onkeypress="if(this.value.length == 2) return false;">
                        <button type="submit" class="fas fa-edit" name="update_quantity"
                            title="Update Quantity"></button>
                    </form>
                </div>
            </div>

            <?php
                    }
                }else{
                    echo '<p class="empty"><span>your cart is empty!</span></p>';
                }
            ?>

            <div class="cart-total"> grand total : <span>Rs.<?= $grand_total; ?>/-</span></div>
            <a href="order.php" class="btn">order now</a>


        </section>
    </div>


    <section class="about" id="about">

        <p class="breadcrumb"><a href="index.php">Home </a>/ about</p>
        <h1 class="heading">About us</h1>

        <div class="row">

            <div class="image">
                <img src="../images/aboutus.jpg" alt="about us">
            </div>

            <div class="content">
                <h3>home made ice cream for you</h3>
                <p>At FrozenLand, we're not just another ice cream shop; we're a labor of love and a celebration of all
                    things sweet.
                    Nestled in the heart of Panadura, we've been churning out happiness one scoop at a time since 2000.
                </p>
                <p>Our story is simple yet delicious. It all began with a passion for creating handcrafted ice creams
                    that would transport our customers to a world of pure indulgence.
                    So, whether you're strolling down memory lane, sharing laughs with loved ones, or simply savoring a
                    moment of solitude with a cone in hand, we invite you to join us on this delightful journey.</p>
                <p>Thank you for being a part of our story, and we can't wait to serve you a scoop of happiness!
                    Indulge, smile, and savor the sweet life at FrozenLand.</p>
                <a href="menu.php" class="btn">Our menu</a>
            </div>

        </div>

    </section>



    <?php @include('footer.php'); ?>
    <?php @include('loader.php'); ?>

    <!--custom js link-->
    <script src="../js/script.js"></script>

</body>

</html>