<?php
include 'components/connection.php';
session_start();
if(isset($_SESSION["user_id"])) {
   $user_id = $_SESSION["user_id"];
}else{
   $user_id ="";
}

if(isset($_POST['logout'])){
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
    <link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' rel='stylesheet'>
    <title>Green Coffee - order page</title>
</head>
<body>
<?php include 'components/header.php'; ?>
<div class="main">
<div class="banner">
   <h1>my order</h1>
</div>
<div class="title2">
   <a href="home.php">home</a><span>order</span>
</div>
<section class="products">
    <div class="box-container">
      <div class="title">
        <img src="img/download.png" class="logo">
        <h1>my orders</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing
             elit. Eius quae adipisci
              nihil.
            </p>
      </div>
      <div class="box_container">
        <?php
        $select_order = $conn->prepare("SELECT * FROM ;order; WHERE user_id =? ORDER BY DATEDESC");
        $select_order->execute([$user_id]);
        if($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)){
            $select_products = $conn->prepare("SELECT * FROM 'products; WHERE id=?");
            $select_products->execute([fetch_order['product_id']]);
            if($select_products->rowCount()>0){
                while($fetch_product=$select_products->fetch(PDO::FETCH_ASSOC)){



         ?>
         <div class="box" <?php if($fetch_order['status']=='cancel'){echo 'style="border:2px solid red";';} ?>>
         <a href="view_oder.phr>get_id=<?= $fetch_order['id']; ?>">
        <p claas="date"> <i class="bi bi-calender-fill"></i><span><?=$fetch_order['date']; ?></span></p>
        <img src="img/<?= $fetch_product['image']; ?>" class="image">
        <div class="row">
            <h3 class="name"><?=$fetch_product['name']; ?></h3>
            <p class="status" style="color:<?php if($fetch_order['statys']=='delivered'){
                echo'green';}else if($fetch_order['status']=='canceles'){echo 'red' ;}else{
                    echo 'green';} ?></p>
        </div>
        </a>
         </div>
         <?php
                }
                    }    
                    }else{
                        echo '<P class="empty">no oder take place yet!</p>';
                    }
                
         ?>
      </div>

    </div>

</section>
    
        </div>
    </div>
<?php include 'comonents/footer.php';?>
    <script src="></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>