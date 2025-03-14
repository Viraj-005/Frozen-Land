<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['register'])){

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn, $filter_cpass);

    $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE name = '$name'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
       $message[] = 'user already exist!';
    }else{
       if($pass != $cpass){
        $message[] = 'confirm password not matched!';
    }else{
        mysqli_query($conn, "INSERT INTO `admin`(name, password) VALUES('$name', '$pass')") or die('query failed');
        $message[] = 'registered successfully!, login now please!';
        
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
    <title>Admin Register Page</title>

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

    <section class="form-container">

        <form action="" method="post">
            <h3>Register Now</h3>
            <input type="text" name="name" required class="box" placeholder="Enter Your Name" maxlength="20">

            <input type="password" name="pass" required class="box" placeholder="Enter Your Password" maxlength="20">

            <input type="password" name="cpass" required class="box" placeholder="Confirm Your Password" maxlength="20">

            <input type="submit" value="Register now" name="register" class="btn">

        </form>

    </section>


    <!--custom admin js link-->
    <script src="../js/admin_script.js"></script>
</body>

</html>