<?php
    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    session_start();

    $admin_id = $_SESSION['admin_id'];
    $message = array();

    if(!isset($admin_id)){
        header('location:admin_login.php');
        exit();
    }

    if(isset($_POST['update'])){

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $details = $_POST['details'];

        if(strlen($details) > 500){
            $message[] = 'Details cannot exceed 500 characters!';
        } else {
            $update_product = $conn->prepare("UPDATE `products` SET name =?, price =?, details =? WHERE id =?");
            $update_product->execute([$name, $price, $details, $pid]);

            $message[] = 'Product updated successfully!';

            $old_image_01 = $_POST['old_image_1'];
            $image_01 = $_FILES['image_1']['name'];
            $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
            $image_size_01 = $_FILES['image_1']['size'];
            $image_tmp_name_01 = $_FILES['image_1']['tmp_name'];
            $image_folder_01 = '../uploaded_img/'.$image_01;

            if(!empty($image_01)){
                if($image_size_01 > 2000000){
                    $message[] = 'Image size is too large!';
                } else {
                    if(is_uploaded_file($image_tmp_name_01)){
                        $update_image_01 = $conn->prepare("UPDATE `products` SET image_1 =? WHERE id =?");
                        $update_image_01->execute([$image_01, $pid]);
                        if(move_uploaded_file($image_tmp_name_01, $image_folder_01)){
                            unlink('../uploaded_img/'.$old_image_01);
                            $message[] = 'Image updated successfully!';
                        } else {
                            $message[] = 'Failed to transfer uploaded file!';
                        }
                    } else {
                        $message[] = 'File was not uploaded successfully!';
                    }
                }
            }
        }
    }

    if(isset($message)){
        foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
        }
    }

    $update_id = $_GET['update'];
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id =?");
    $select_products->execute([$update_id]);
    if($select_products->rowCount() > 0){
        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>
    <section class="update-product">
        <h1 class="heading">Update Product</h1>

        <?php
        $update_id = $_GET['update'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$update_id]);
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="old_image_1" value="<?= $fetch_products['image_1']; ?>">

            <div class="imagee">
                <img src="../uploaded_img/<?= $fetch_products['image_1']; ?>" alt="">
            </div>

            <span>Update Name</span>
            <input type="text" name="name" required class="box" maxlength="100" placeholder="Enter product name" value="<?= $fetch_products['name']; ?>">
            <span>Update Price</span>
            <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="Enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
            <span>Update Details</span>
            <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
            <span>Update Image</span>
            <input type="file" name="image_1" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            <div class="flex-btn">
                <input type="submit" name="update" class="btn" value="Update">
                <a href="products.php" class="btn">Cancel</a>
                <div class="viewAll">
                    <a href="products.php" class=""btn >View All Products</a>
                </div>
            </div>
        </form>
            
        <?php
            }
        } else {
            echo '<p class="empty">No product found!</p>';
        }
        ?>
    </section>

    <?php include ('../attributes/footer.php')?>
    <script src="../js/admin_script.js"></script>
</body>
</html>

<?php
        }
    } else {
        echo '<p class="empty">No product found!</p>';
    }
?>