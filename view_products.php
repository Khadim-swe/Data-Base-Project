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
//adding products in wishlist
if(isset($POST['add_to_wishlist'])){
    $id =unique_id();
    $product_id = $_POST['product_id'];
    $verify_wishlist = $conn->prepare("SELECT*FROM 'wishlist' WHERE user_id =? AND product_id =?");
    $verify_wishlist->execute([$user_id,$product_id]);

    $cart_num =$conn->prepare("SELECT*FROM 'cart' WHERE user_id =? AND product_id =?");
    $cart_num->execute([$user_id,$product_id]);

    if($varify_wishlist->rowCount() > 0) {
        $warning_msg[] ='product already exit in your wishlist';
    }else if($cart_num->rowCount() > 0){
        $warning_msg[] ='product already exit in your cart';
    }else{
        $select_price = $conn->prepare("SELECT * FROM 'products' WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_wishlist = $conn->prepare("INSERT INTO 'wishlist' (id, user_id, product_id, price) VALUES (?,?,?,?)");
        $insert_wishlist->execute([$id, $user_id, $fetch_price['price']]);
        $success_msg[] = 'product added to wishlist successfully';

    }  
}
 //adding products in cart
 if(isset($POST['add_to_cart'])){
    $id =unique_id();
    $product_id = $_POST['product_id'];
    $qty = $_POST ['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $verify_cart =$conn->prepare("SELECT*FROM 'cart' WHERE user_id =? AND product_id =?");
    $verify_cart->execute([$user_id,$product_id]);


    $max_cart_item = $conn->prepare("SELECT * FROM 'cart' WHERE id = ?");
    $max_cart_item->execute([$user_id]);

    if($varify_cart->rowCount() > 0) {
        $warning_msg[] ='product already exit in your wishlist';
    }else if($max_cart_item->rowCount() > 20){
        $warning_msg[] =' cart is full';
    }else{
        $select_price = $conn->prepare("SELECT * FROM 'products' WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO 'cart' (id, user_id, product_id, price,qty) VALUES (?,?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $fetch_price['price'],$qty]);
        $success_msg[] = 'product added to cart successfully';

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
    <title>Green Coffee - shop page</title>
</head>
<body>
<?php include 'components/header.php'; ?>
<div class="main">
<div class="banner">
   <h1>shop</h1>
</div>
<div class="title2">
   <a href="home.php">home</a><span>our shop</span>
</div>
<section class="products">
    <div class="box-container">
        <?php
   $select_products=$conn->prepare("SELECT * FROM 'products'");
   $select products->execute();
   if($select_products->rowCount() > 0){
    while($fetch_products=$select products->fetch(PDO::FETCH_ASSOC)){

        ?>
        <form action="" method="post" class="box">
            <img src="img/<?=$fetch_products['image'];?>>" class="img">
            <div class="button">
                <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bxs-show" </a>
            </div>
            <h3 class="name"> <?=$fetch_products['name'];?> </h3>
            <input type="hidden" name="products_id" value="<?=$fetch_products['id']; ?>">
            <div class="fles">
                <p class="price">price $<?=$fetch_products['price']; ?>/-</p>
                <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
            </div>
            <a href="checkout.php>get_id=<?=$fetch_products['id']; ?>" class="btn">buy now </a>
        </form> 
        >?php 
    }
}else{
    echo'<p class="empty">no products added yet!</p>';
}
        ?>

    </div>

</section>
    
        </div>
    </div>
<?php include 'comonents/footer.php';?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>