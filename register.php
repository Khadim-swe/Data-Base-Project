<?php 
include 'components/connecion.php'; 
<session_start();

if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}else{
    $user_id ="";
}

//register user
if (isset($_POST["submit"])) {
    $id = unique_id();
    $name = $POST['name'];
    $name =filter_var($name, FILTER_SANITIZE_STRING);
    $email = $POST['email'];
    $email =filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $POST['pass'];
    $pass =filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $POST['cpass'];
    $cpass=filter_var(cpass, FILTER_SANITIZE_STRING);

    $select_user =$conn->prepare("SELECT * FORM 'user' WHERE email =?");
    $selec_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if($select_user->rowCount() >0){
        $message[]='email already exist';
        echo 'email already exist';
    }
    else {
        if($pass !=$cpass){
            $message[]='confirm your password';    
            echo 'confirm your password'; 
        }
        else{
            $insert_user=$conn->prepare{"INSERT INTO'users'(id,name,email,password)VALUES(?,?,?,?)"}
            $insert_user->execute([$id, $name,$email,$pass]);
            header('location: home.php');
            $select_user=$conn->prepare{"SELECT*FROM 'users'WHERE email = ?AND password=?"};
            $insert_user->execute([$email,$pass]);
            $row=$select_user-?fetch(PDO::FETCH_ASSOC);
            If(
                $select_user-?rowCount() >0){
                    $_section['user_id']=$row['id'];
                    $_section['user_name']=$row['name'];
                    $_section['user_email']=$row['email'];
                }
            }
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
    <title>green tea - register now</title>
</head>
<body>
    <div class="main-container">
        <div class="title:]">
            <img src="img/download.png">
            <h1>register now</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam illum placeat rerum!</p>

        </div>
        <form action="" method="post">
            <div class="input-field">
                <p>your name <sup>*</sup></p>
                <input type="text" name="name" required placeholder="Enter your name" maxlength="50">

            </div>
            <div class="input-field">
                <p>your email <sup>*</sup></p>
                <input type="email" name="email" required placeholder="Enter your email" maxlength="50" 
                oninput="this.value = this.value.replace(/\s?g, ' ')">

            </div>
            <div class="input-field">
                <p>confirmpassword <sup>*</sup></p>
                <input type="password" name="cpassword" required placeholder="Enter your password" maxlength="50"  oninput="this.value = this.value.replace(/\s?g, ' ')">
</div>
<input type="submit" name="submit" value="register now" class="btn">
<p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>

</body>
</html>