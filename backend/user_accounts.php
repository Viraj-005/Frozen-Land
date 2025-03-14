<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');

    header('location:user_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts Page</title>

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

    <section class="accounts">

        <h1 class="heading">User Accounts</h1>

        <div class="box-container">

            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` ORDER BY id DESC") or die('query failed');

            if(mysqli_num_rows($select_users) > 0){
                while($fetch_users = mysqli_fetch_assoc($select_users)){

            
        ?>
            <div class="box">

                <p>user id: <span><?php echo $fetch_users['id']; ?></span></p>

                <p>username: <span><?php echo $fetch_users['name']; ?></span></p>

                <p>email: <span><?php echo $fetch_users['email']; ?></span></p>

                <div class="flex-btn">

                    <a href="user_accounts.php?delete=<?php echo $fetch_users['id']; ?>"
                        onclick="return confirm('Do you want to delete this account?')" class="delete-btn">delete</a>

                </div>


            </div>

            <?php
                }
            }else{
                echo '<p class="empty">No accounts available!</p>';
            }
        
        ?>
        </div>

    </section>

    <!--custom admin js link-->
    <script src="../js/admin_script.js"></script>
</body>

</html>