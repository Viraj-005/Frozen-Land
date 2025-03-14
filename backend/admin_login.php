<?php

@include 'config.php';

session_start();

if(isset($_POST['login'])){

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);


    $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE name = '$name' AND password = '$pass'") or die('query failed');


    if(mysqli_num_rows($select_users) > 0){
        $row = mysqli_fetch_assoc($select_users);

                
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_pass'] = $row['pass'];
            
        header('location:admin_page.php');

        }else{
            $message[] = 'Incorrect name or password!, Try again!';
            
    }      
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!--Font awsome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Custom css link-->
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



    <section class="form-container">

        <img src="../images/loginback1.jpg" class="bgimg">

        <form action="" method="post">
            <h3>login now</h3>
            <p>Default username = <span>admin</span> & password = <span>111</span></p>
            <input type="text" name="name" required placeholder="enter your username" maxlength="20" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="enter your password" maxlength="20" class="box"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="login now" class="btn" name="login">
        </form>

    </section>

    <!--custom admin js link-->
    <script src="../js/admin_script.js"></script>
</body>

</html>