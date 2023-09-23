<?php
include 'components/connection.php';
session_start();
if(isset($_SESSION["user_id"])) {
   $user_id = $_SESSION["user_id"];
}else{
   $user_id ="";
}

if(issset($_POST['logout'])){
   session_destroy();
   header("location:login.php");
}
?>
<style type="text/css">
    <?php include 'style.css'; ?>
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - home page</title>
</head>
<body>
<?php include 'components/header.php'; ?>
<div class="main">
<div class="banner">
   <h1>contact  us</h1>
</div>
<div class="title2">
   <a href="home.php">home</a><span>contact us</span>
</div>
<section class="services">
     <div class="box-container">
        <div class="box">
           <img src="img/icpon2.png">
           <div class="detail">
             <h3>great savings</h3>
             <p>save big every order</p>
           </div>
        </div>
        <div class="box">
        <img src="img/icpon1.png">
        <div class="detail">
        <h3>24*7 support</h3>
        <p>one-on-one support</p>
        </div>
     </div>
     <div class="box">
     <img src="img/icpon0.png">
     <div class="detail">
     <h3>gift vouchers</h3>
     <p>vouchers on every festivals</p>
     </div>
</div>
<div class="box">
<img src="img/icpon.png">
<div class="detail">
<h3>worldwide delivery</h3>
<p>dropship worldwide</p>
</div>
</div>
</section>
<div class="form-container">
    <form method="post">
        <div class="title">
            <img src="img/download.png" class="logo">
            <h1>leave a message</h1>
        </div>
        <div class="input-field">
            <p>your name <sup>*</sup></p>
            <input type="text" name="name">
        </div>
        <div class="input-field">
            <p>your email <sup>*</sup></p>
            <input type="email" name="email">
        </div>
        <div class="input-field">
            <p>your number <sup>*</sup></p>
            <input type="text" name="number">
        </div>
        <div class="input-field">
            <p>your message<sup>*</sup></p>
            <textarea name="message"></textarea>
        </div>
        <button type="submit" name="submit-btn">send message</button>

    </form>
</div>
<div class="adress">
    <div class="title">
            <img src="img/download.png" class="logo">
            <h1>contact detail</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat ducimus, architecto </p>
        </div>
        <div class="box-container">
        <div class="box">
            <i class="bx bxs-map-pin"></i>
            <div>
                <h4>adress</h4>
                <p>1092 Merigold Lane,Coral Way</p>
            </div>
            <div class="box">
            <i class="bx bxs-phone-call"></i>
            <div>
                <h4>phone number</h4>
                <p>8866889955</p>
            </div>
            <div class="box">
            <i class="bx bxs-map-pin"></i>
            <div>
                <h4>email</h4>
                <p>selenaAnsari@gmail.com</p>
            </div>
        </div>
        </div>
    </div>
<?php include 'comonents/footer.php';?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>