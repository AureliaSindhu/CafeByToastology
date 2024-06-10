<?php
    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    include ('back.php');
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
    };
    
    if(isset($_POST['add_product'])){
    
        $name = $_POST['name'];
        $price = $_POST['price'];
        $details = $_POST['details'];
    
        $image_01 = $_FILES['image_1']['name'];
        $image_size_01 = $_FILES['image_1']['size'];
        $image_tmp_name_01 = $_FILES['image_1']['tmp_name'];
        $image_folder_01 = '../uploaded_img/'. $image_01;
    
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
        $select_products->execute([$name]);
    
        if($select_products->rowCount() > 0){
        $message[] = 'product name already exist!';
        }else{
            if (move_uploaded_file($image_tmp_name_01, $image_folder_01)) {
                $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_1) VALUES(?,?,?,?)");
                $insert_products->execute([$name, $details, $price, $image_01]);
                if ($insert_products) {
                    // echo "Product inserted successfully.";
                    $message[] = 'Product inserted successfully';
                } else {
                    // echo "Insert product failed";
                    $message[] = 'Failed to insert product';
                }
            } else {
                $message[] = 'Failed to upload image. Ensure the images/ directory is writable.';
            }
        }  
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_product_image->execute([$delete_id]);

        $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
        unlink('../uploaded_img/'.$fetch_delete_image['image_1']);

        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$delete_id]);

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
        $delete_cart->execute([$delete_id]);                
        header('location:products.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe by Toastology - Products</Admin></title>

    <!-- Icon -->
    <link rel="icon" href="../pic/icon.png">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" >

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <section class = "inventory"> 
        <section class="add-products">
            <h1 class="heading">Add Product</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="flex">
                    <div class="inputBox">
                        <span>Toast Name (required)</span>
                        <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
                    </div>
                    <div class="inputBox">
                        <span>Product Price (required)</span>
                        <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
                    </div>
                    <div class="inputBox">
                        <span>Image (required)</span>
                        <input type="file" name="image_1" accept="image/jpg, image/jpeg, image/png" class="box" required>
                    </div>
                    <div class="inputBox">
                        <span>Toast description (required)</span>
                        <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <input type="submit" value="add product" class="btn" name="add_product">
            </form>
        </section>

        <section class="show-products">
            <h1 class="heading">Products Added</h1>

            <div class="products">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    if($select_products->rowCount() > 0){
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                    <div class="box">
                        <img src="../uploaded_img/<?= $fetch_products['image_1']; ?>" alt="">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="price">$<span><?= $fetch_products['price']; ?></span></div>
                        <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                        <div class="flex-btn">
                            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
                            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
                        </div>
                    </div>
                <?php
                        }
                    }else{
                        echo '<p class="empty">no products added yet!</p>';
                    }
                ?>
            </div>
        </section>
    </section>

    <?php include ('../attributes/footer.php')?>
    <script src="../js/admin_script.js"></script>
</body>
</html>