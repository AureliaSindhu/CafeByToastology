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

<header class="header">

    <section class="flex">
        <a href="index.php"><img src="pic/namee.png" alt="Logo"></a>

        <nav class="navbar">
            <div id="menu-btn"></div>    
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="shop.php">Shop Now</a>
            
            <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_counts = $count_cart_items->rowCount();
            ?>

            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= htmlspecialchars($total_cart_counts); ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
        </nav>

        <div class="profile">
            <?php          
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p> Hi, <?= $fetch_profile["name"]; ?> !</p>
            <div class = "popup">
                <a href="update_user.php" class="option-btn">Update Profile</a>
                <a href="attributes/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
            </div>
            <?php
                }else{
            ?>
            <p> Hi Toastlover! </p>
            <p>Please login or register first to proceed </p>
            <div class="flex-btn">
                <a href="user_reg.php" class="option-btn">Register</a>
                <a href="user_login.php" class="option-btn">Login</a>
            </div>
            <?php
                }
            ?>      
        </div>

    </section>

</header>