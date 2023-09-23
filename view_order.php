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
if(isset($_GET['get_id'])){
   $get_id =$GET['get_id'];
}else{
   $get_id ='';
   header('location:order.php');
}
if($_POST['cancel']){
   $update_orders= $conn->prepare("UPDATE 'orders' SET status=? WHERE id=?");
   $update_order->execute(['canceled', $get_id]);
   header('location:order.php');
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
    <title>Green Coffee - order detail page</title>
</head>
<body>
<?php include 'components/header.php'; ?>
<div class="main">
<div class="banner">
   <h1>order detail</h1>
</div>
<div class="title2">
   <a href="home.php">home</a><span>order</span>
</div>
<section class="order-detail">
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
       $grand_total=0;
       $select_orders =$conn->("SELECT * FROM ;orders' WHERE id = ? LIMIT 1");
       $select_orders->execute([$get-id]);
       if($select_orders->rowCount() > 0){
        while($fetch_order =$select_orders->fetch(PDO::FETCH_ASSOC)){
         $select_product =$conn->("SELECT * FROM ;orders' WHERE id = ? LIMIT 1");
         $select_product->execute([$fetch_order['product_id']]);
         if($select_product->rowCount() > 0){
            while($fetch_product =$select_orders->fetch(PDO::FETCH_ASSOC)){
               sub_total= ($fetch_order['price']* $fetch_order['qty']);
               grand_total+= $sub_total;
               ?>
               <div class="box">
                  <div class="col">
                     <p class="title"><i class="bi bi-calender-fill"></i><?= $fetch_order['date'];</p>
                     <img src="image/<?= $fetch_product['image']; ?>" class="image">
                     <p class="price"><?= $fetch_product['price']; ?> x <?=$fetch_order['qty']; ?></p>
                     <h3 class="name"><?$fetch_product['name']; ?></h3>
                     <p class="grand_total">Total amount payable : <span>$<?= $fetch_product['image']; ?> </span></p>
                  </div>
                  <div class="col">
                  <p class="title">billing adress</p>
                  <p class="user"><i class="bi bi-person-bounding-box"></i><?= $fetch_order['name'];?></p>
                  <p class="user"><i class="bi bi-number"></i><?= $fetch_order['number'];?></p>
                  <p class="user"><i class="bi bi-envelope"></i><?= $fetch_order['email'];?></p>
                  <p class="user"><i class="bi bi-pin-map-fill"></i><?= $fetch_order['adress'];?></p>
                  <p class="title">status</p>
                  <p class="status" style="color:<?php if($fetch_order['status']=='delevered'){ echo 'green';}else if($fetch_order['status']=='canceled') {echo 'red';} else{echo 'orange';}?>"><?=$fetch_order['status'] ?></p>
                  <?php if($fetch_order['status']=='canceled') { ?>
                     <a href="checkout.php?get_id=<?= $fetch_product['id']; ?" class="btn"> order again</a>
                     <?php }else{ ?>
                        <form method="post">
                        <button type="submit" name="cancel" class="btn" onclick="return confirm('do you want to cancel this order')">cancel order</button>
                        </form>
                        <?php } ?>
                  </div>
               </div>
               <?php
            }else{
               echo '<P class="empty">product not found!</p>';
         }
        }
       }else{
         echo '<P class="empty">no oder found</p>';
       }
       ?>
</section>
    
        </div>
    </div>
<?php include 'components/footer.php';?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>