<?php
    include ('attributes/connect.php');
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        header('Location: user_login.php');
    };
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

    <section class="products">
        <h1 class="heading">Available Products</h1>
        <div class="box-container">
            <?php
                $select_products = $conn->prepare("SELECT * FROM `products`"); 
                $select_products->execute();
                if($select_products->rowCount() > 0){
                while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                <input type="hidden" name="details" value="<?= $fetch_product['details']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
                <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                <a href="#" class="fas fa-eye"></a>
                <img src="uploaded_img/<?= $fetch_product['image_1']; ?>" alt="">
                <div class="name"><?= $fetch_product['name']; ?></div>
                <div class="details"><?= $fetch_product['details']; ?></div>
                <div class="flex">
                    <div class="price"><span>$</span><?= $fetch_product['price']; ?></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                </div>
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            </form>
            <?php
                }
            }else{
                echo '<p class="empty">no products found!</p>';
            }
            ?>
        </div>

    </section>
    
    <?php
        if(isset($_POST['add_to_cart'])){
            if($user_id == ''){
                header('user_login.php');
            } else{
                $pid = $_POST['pid'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $image = $_POST['image']; 

                $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
                $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
        
                $message[] = 'added to cart!';
            }
        }
    ?>

    <?php include ('attributes/footer.php')?>
    <script src="js/script.js"></script>
</body>
</html>