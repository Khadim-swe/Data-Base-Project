<?php 
// include 'components/connecion.php'; 
session_start();

if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}else{
    $user_id ="";
}

//register user
if (isset($_POST["submit"])) {
    $email = $POST['email'];
    $email =filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $POST['pass'];
    $pass =filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $POST['cpass'];
    $cpass=filter_var(cpass, FILTER_SANITIZE_STRING);

    $select_user =$conn->prepare("SELECT * FORM 'user' WHERE email =? AND password =?");
    $selec_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if($select_user->rowCount() > 0){
        $_session['user_id'] = $row['id'];
        $_session['user_name'] = $row['name'];
        $_session['user_email'] = $row['email'];
        header('location: home.php');
    }else{
        $message[] ='incorrect user password';
    }
    
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
    <title>green tea - login now</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
        <div class="title">
            <img src="/img/download.png">
            <h1>login now</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam illum placeat rerum!</p>

        </div>
        <form action="" method="post">

        <div class="input-field">
        

            <div class="input-field">
                <p>your Email <sup>*</sup></p>
                <input type="email" name="email" required placeholder="Enter your email" maxlength="50" 
                oninput="this.value = this.value.replace(/\s?g, ' ')">
            </div>

            <div class="input-field">
                <p>your Password <sup>*</sup></p>
                <input type="password" name="password" required placeholder="Enter your Password" maxlength="50" 
                oninput="this.value = this.value.replace(/\s?g, ' ')">
            </div>
            
<input type="submit" name="submit" value="login now" class="btn">
<p>do not have an account? <a href="register.php">register now</a></p>
        </form>
        </section>
    </div>

</body>
</html>