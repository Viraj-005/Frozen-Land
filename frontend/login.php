<?php

@include '../backend/config.php';

session_start();


if(isset($_POST['login'])){

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);


    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select_users) > 0){
        $row = mysqli_fetch_assoc($select_users);

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_pass'] = $row['pass'];
            header('location:index.php');

        }else{
            $message[] = 'Incorrect name or password!, Try again!';
            header('location:index.php');
            
    }
    header('location:index.php');
    
} 

?>

<?php @include('loader.php'); ?>