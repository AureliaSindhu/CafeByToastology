<?php
    include ('attributes/connect.php');
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    };

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
        header('location:user_login.php');
    };
    
    if(isset($_POST['order'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
        $total_products = $_POST['total_products'];
        $total_price = $_POST['total_price'];
    
        $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $check_cart->execute([$user_id]);
    
        if($check_cart->rowCount() > 0){
    
        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
    
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);
    
        $message[] = 'order placed successfully!';
        }else{
        $message[] = 'your cart is empty';
        }
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
    <?php include ('attributes/header.php')?>

    <section class="checkout-orders">
        <form action="" method="POST">
            <h1>Your Orders</h1>

            <div class="display-orders">
                <?php
                    $grand_total = 0;
                    $cart_items[] = '';
                    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);
                    if($select_cart->rowCount() > 0){
                        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                        $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                        $total_products = implode($cart_items);
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                ?>
                    <p> <?= $fetch_cart['name']; ?> <span>(<?= '$'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
                <?php
                        }
                    }else{
                        echo '<p class="empty">your cart is empty!</p>';
                    }
                ?>
                
                <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
                <div class="grand-total">Grand Total : <span>$<?= $grand_total; ?></span></div>
            </div>

            <h3>place your orders</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>Name :</span>
                    <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
                </div>
                <div class="inputBox">
                    <span>Phone Number :</span>
                    <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>Payment :</span>
                    <select name="method" class="box" required>
                    <option value="cash on delivery">Cash On Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paytm">Debit Card</option>
                    <option value="paypal">Gift Card</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Address line 01 :</span>
                    <input type="text" name="flat" placeholder="e.g. Flat number" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>Address line 02 :</span>
                    <input type="text" name="street" placeholder="Street name" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" name="city" placeholder="Riverside" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>State:</span>
                    <input type="text" name="state" placeholder="California" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>Country :</span>
                    <input type="text" name="country" placeholder="United States" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>Zip Code :</span>
                    <input type="number" min="0" name="pin_code" placeholder="e.g. 56400" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
                </div>
            </div>

            <input type="submit" name="order" class="submit-btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">
        </form>
    </section>
    
    <?php include ('attributes/footer.php')?>
    <script src="js/script.js"></script>
</body>
</html>