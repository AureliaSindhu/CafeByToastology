<?php
    include ('attributes/connect.php');
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
        header('location:user_login.php');
    };
    
    if(isset($_POST['delete'])){
        $cart_id = $_POST['cart_id'];
        $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_cart_item->execute([$cart_id]);
    }
    
    if(isset($_GET['delete_all'])){
        $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_item->execute([$user_id]);
        header('location:cart.php');
    }
    
    if(isset($_POST['update_qty'])){
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);
        $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);
        $message[] = 'cart quantity updated';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe by Toastology</title>

    <!-- Icon -->
    <link rel="icon" href="pic/icon.png">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" >

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'attributes/header.php';?>

    <section class = "products">
        <h1 class="heading"> <?= $fetch_profile["name"]; ?>'s Shopping Cart</h1>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <img src="uploaded_img/<?= $fetch_cart['image_1']; ?>" alt="">
                <input type="hidden" name="image_1" value="<?= $fetch_product['image_1']; ?>">
                <div class="name"><?= $fetch_cart['name']; ?></div>
                <div class="flex">
                    <div class="price">$<?= $fetch_cart['price']; ?></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                </div>
                <div class="sub-total"> Sub Total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> </div>
                <input type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
            </form>
            <?php
            $grand_total += $sub_total;
                }
            }else{
                echo '<p class="empty">your cart is empty</p>';
            }
            ?>
        </div>

        <div class="cart-total">
            <p>Grand Total : <span>$<?= $grand_total; ?></span></p>
            <a href="shop.php" class="option-btn">Continue Shopping</a>
            <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">Empty Cart</a>
            <a href="checkout.php" class="option-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Checkout</a>
        </div>
    </section>
    
    <?php include ('attributes/footer.php')?>
    <script src="js/script.js"></script>
</body>
</html>