<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('query failed');

    header('location:user_messages.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages Page</title>

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

    <section class="messages">

        <h1 class="heading">messages</h1>

        <div class="box-container">

            <?php
          $select_messages = mysqli_query($conn, "SELECT * FROM `messages` ORDER BY id DESC") or die('query failed');
          if(mysqli_num_rows($select_messages) > 0){
            while($fetch_messages = mysqli_fetch_assoc($select_messages)){
        ?>
            <div class="box">
                <p> name : <span><?php echo $fetch_messages['name']; ?></span> </p>
                <p> number : <span><?php echo $fetch_messages['number']; ?></span> </p>
                <p> email : <span><?php echo $fetch_messages['email']; ?></span> </p>
                <p> message : <span><?php echo $fetch_messages['message']; ?></span> </p>
                <a href="user_messages.php?delete=<?php echo $fetch_messages['id']; ?>" class="delete-btn"
                    onclick="return confirm('Do you want to delete this message?');">delete</a>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">you have no messages</p>';
            }
        ?>

        </div>

    </section>













    <!--custom admin js link-->
    <script src="js/admin_script.js"></script>
</body>

</html>