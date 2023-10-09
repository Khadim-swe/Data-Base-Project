<header class="header">
   <div class="flex">
      <a href="home.php" class="logo"><img src="/img/logo.jpg"></a>
      <nav class="navbar">
        <a href="home.php">home</a>
        <a href="view_products.php">products</a>
        <a href="order.php">orders</a>
        <a href="about.php">about us</a>
        <a href="contact.php">contact us</a>
      </nav>
      <div class="icons">
      <i class="fa-regular fa-user" id="user-btn"></i>
          <?php
         // $count_wishlist_item = $conn->prepare("SELECT * FROM 'wishlist' WHERE user_id = ?");
         // $count_wishlist_item->execute([user_id]);
         // $total_wishlist_item =$count_wishlist_item ->rowCount();
         ?>
         <a href="wishlist.php" class="cart-btn"><i class="fa-solid fa-heart"></i><sup><?=$total_wishlist_item ?> </sup></a>
          <?php
         // $count_cart_item = $conn->prepare("SELECT * FROM 'wishlist' WHERE user_id = ?");
         // $count_cart_item->execute([user_id]);
         // $total_cart_item =$count_cart_item ->rowCount();
         ?>
         <a href="cart.php" class="cart-btn"><i class="fa-solid fa-cart-shopping"></i><sup><?=$total_cart_item ?></sup></a>
         <i class="fa-solid fa-cart-plus"  id="menu-btn" style="font-size:2rem;"></i>
      </div>
      <div class="user-box">
        <p>username: <span><?php //echo $_SESSION['user_name']; ?></span></p>
        <p>Email: <span><?php //echo $_SESSION['user_email']; ?></span></p>
        <a href="login.php" class="btn">login</a>
        <a href="register.php" class="btn">register</a>
        <form method="post">
         <button type="submit" name="logout" class="logout-btn">log out</button>
</form>
      </div>
   </div>
</header>