<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>&#129482;Admin Panel</title>

    <!--Font awsome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

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


    <section class="dashboard">

        <h1 class="heading">Dashboard</h1>

        <div class="daybox-container">

            <!--=============== TIME OF DAY ===============-->
            <div class="box">
                <?php
                date_default_timezone_set('Asia/Colombo');

                $currentTime = date('H:i:s');

                if($currentTime >= '05:00:00' && $currentTime < '12:00:00'){
                    $name = "Good Morning";
                    $image = "morningps.jpg";
                }elseif($currentTime >= '12:00:00' && $currentTime < '16:00:00'){
                    $name = "Good Afternoon";
                    $image = "afternoonpsorg.jpg";
                }else{
                    $name = "Good Evening";
                    $image = "evening.jpg";
                }
            ?>
                <h3><?php echo $name; ?></h3>
                <img src="../images/<?php echo $image; ?>" alt="Time of Day">
            </div>

            <!--=============== DATE & TIME ===============-->
            <div class="box1">
                <h3>Time & Date</h3>
                <h3><i class="fas fa-clock"></i> <span id="time"></span></h3>
                <h3><i class="fas fa-calendar"></i> <span id="date"></span></h3>
            </div>

            <!--=============== BATTERY ===============-->
            <div class="battery">
                <div class="battery__card">
                    <div class="battery__data">
                        <p class="battery__text">Battery</p>
                        <h1 class="battery__percentage">
                            20%
                        </h1>

                        <p class="battery__status">
                            Low battery <i class="ri-plug-line"></i>
                        </p>
                    </div>

                    <div class="battery__pill">
                        <div class="battery__level">
                            <div class="battery__liquid"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="box-container">

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status= 'pending'") or die('query failed');
                while($fetch_pendings = mysqli_fetch_assoc($select_pendings)){
                    $total_pendings += $fetch_pendings['total_price'];
                };
            ?>
                <h3>Rs.<?php echo $total_pendings; ?>/-</h3>
                <p>Total pendings</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php
                $total_completes = 0;
                $select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status= 'completed'") or die('query failed');
                while($fetch_completes = mysqli_fetch_assoc($select_completes)){
                    $total_completes += $fetch_completes['total_price'];
                };
            ?>
                <h3>Rs.<?php echo $total_completes; ?>/-</h3>
                <p>Completed Payments</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                $number_of_orders = mysqli_num_rows($select_orders);
            ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Orders Placed</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                $number_of_products = mysqli_num_rows($select_products);
            ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>Products Added</p>
                <a href="admin_products.php" class="btn">see products</a>
            </div>

            <div class="box">
                <?php
                $select_admins = mysqli_query($conn, "SELECT * FROM `admin`") or die('query failed');
                $number_of_admins = mysqli_num_rows($select_admins);
            ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>See Admins</p>
                <a href="admin_accounts.php" class="btn">see admins</a>
            </div>

            <div class="box">
                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
            ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>See Users</p>
                <a href="user_accounts.php" class="btn">see users</a>
            </div>

            <div class="box">
                <?php
                $select_messages = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
                $number_of_messages = mysqli_num_rows($select_messages);
            ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>See Messages</p>
                <a href="user_messages.php" class="btn">see messages</a>
            </div>

        </div>


    </section>


    <!--custom admin js link-->
    <script src="../js/admin_script.js"></script>
    <script src="../js/battery_script.js"></script>
</body>

</html>