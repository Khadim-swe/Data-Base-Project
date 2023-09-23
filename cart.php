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
//update product in cart

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

    $update_qty = $conn-> prepare("UPDATE 'cart' SET 'qty'= ? WHERE id = ?");
    $update_qty->execute([$qty,$cart_id]);

    $success_msg[] = 'cart quantity update successfully';
}

//delete item from wishlist
if(isset($_POST['delete_item'])){
    $cart_id =$_POST['cart_id'];
    $cart_id = filter_var($cart_id,FILTER_SANITIZE_STRING);

    $varift_delete-items=$conn->prepare ("SELECT * FROM 'cart' WHERE id =?");
    $varift_delete-items->execute([$wishlist_id]);

    if($varift_delete-items->rowCount()>0){
        $delete_cartt_id = $conn->prepare("DELETE FROM 'cart' WHERE id =?");
        $delete_cartt_id->execute([$cart_id]);
        $success_msg[] = "cartt item delete successfully";
    }else{
        $warning_msg[] ='cart item already deleted';
    }
}

//empty cart
if(isset($_post['empty cart'])){
    $verify_empty_item =$conn->prepare("SELECT * FROM 'cart' WHERE user_id =?")
    $verify_empty_item ->execute([user_id]);

    if($verify_empty_item->rowCount() >0){
        $delete_cart_id = $conn->prepare("DELETE FROM 'cart' WHERE user_id=?");
        $delete_cart_id->execute([user_id]);
        $success_msg[] = "empty successfully";
    }else {
        $warning_msg[] = "cart item already delete";
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - product detail page</title>
</head>
<body>
<?php include 'components/header.php'; ?>
<div class="main">
<div class="banner">
   <h1>my cart</h1>
</div>
<div class="title2">
   <a href="home.php">home</a><span>cart</span>
</div>
<section class="products">
    <h1 class="title">products added in cart</h1>
    <div class="box-container">
    <?php 
        $grand_total =0;
        $select_cart =$conn->prepare("SELECT * FROM 'cart' WHERE user_id =?");
        $select_cart->execute([$user_id]);
    if($select_cart->rowCOUNT()> 0){
            while($fetch_cart =$select_cart->fetch(PDO::FETCH_ASSOC)){
                $select_products =$conn->("SELECT * FROM 'products' WHERE user_id =?");
                $select_products->execute([fetch_cart['product_id']]);
                if($select_product->rowCount()> 0){
                    $fetch_products =$select_products->fetch(PDO::FETCH_ASSOC)
                
        ?>
        <form method="post" action="" vlass="box">
            <input type="hidden" name="cart_id" value="<?=$fetch_cartt['id']; ?>">
            <img src="image/<?=$fetch_products['image']; ?>" class="img">
            <h3 class="name"><?=$fetch_products['name']; ?></h3>
            <div class="flex">
                <p class="price">price$<?=$fetch_products['price']; ?>/-</p>
            </div>
            
            <div class="flex">
                <p class="price">price$<?=$fetch_products['price']; ?>/-</p>
                <input type="number" class="qty" requiredmin="1" values="<?=$fetch-cart['qty']; ?>" max="99" maxlength="2" class="qty">
                <button type="submit" name="update_cart" class="bx bxs-edit fa-edit"></button> 
            </div>
            <p class="sub-total">sub total : <span>$<?=$sub_total=($fetch_cart['qty']*$fetch_cart['price']) ?></span></p>

            <button type="submit" name="delate_item" class=" btn" onclick="return confirm('delate this item')"> delete</button>

        </form>
        <?php
        $grand_total+=$sub_total;
        }else{
            echo'<p class="empty">product was not found</p>';
        }
    }
}else{
    echo'<p class="empty">no products added yet!</p>';
}
?>
    </div>  
    <?php 
    if($grand_total !=0){
    ?>
     <di class="cart_total">
        <p>total aamount payable: <span>$ <?= $grand_total; ?>/-</span></p>
        <div class="button">
        <form method="post">
            <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure empty your cart')">empty cart</button>
        </form>
         <a href="checkout.php" class="btn">proceed to checkout</a>
        </div>
     </div>
     <?php } ?>
</section> 
<?php include 'comonents/footer.php';?>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>