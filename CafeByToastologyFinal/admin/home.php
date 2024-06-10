<?php
    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('login.php');
    }
    
    $select_admin_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
    $select_admin_profile->execute([$admin_id]);
    $fetch_profile = $select_admin_profile->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe by Toastology - Admin</Admin></title>

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
    <section id = "adminPortal">
        <h1 class="heading">Admin Portal</h1>


        <div class="admin-home">
            <div class="box">
                <h3>Welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update_admin.php" class="btn">Update Profile</a>
            </div>

            <div class="box">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    $number_of_products = $select_products->rowCount()
                ?>
                <h3><?= $number_of_products; ?></h3>
                <p>Products added</p>
                <a href="products.php" class="btn">See products</a>
            </div>

            <div class="box">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $number_of_users = $select_users->rowCount()
                ?>
                <h3><?= $number_of_users; ?></h3>
                <p> Users</p>
                <a href="users_accounts.php" class="btn">See Users</a>
            </div>

            <div class="box">
                <?php
                    $select_admins = $conn->prepare("SELECT * FROM `admins`");
                    $select_admins->execute();
                    $number_of_admins = $select_admins->rowCount()
                ?>
                <h3><?= $number_of_admins; ?></h3>
                <p>Admin </p>
                <a href="account.php" class="btn">See admins</a>
            </div>

            <div class="box">
                <?php
                    $select_messages = $conn->prepare("SELECT * FROM `messages`");
                    $select_messages->execute();
                    $number_of_messages = $select_messages->rowCount()
                ?>
                <h3><?= $number_of_messages; ?></h3>
                <p>New messages</p>
                <a href="messages.php" class="btn">See messages</a>
            </div>

            <div class="box">
                <h3> Bye! </h3>
                <p> Switch to access user's page </p>
                <div class = "logout">
                    <a href="../attributes/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">Logout</a> 
                </div>
            </div>
        </div>
    </section>

    <?php include ('../attributes/footer.php')?>
    <script src="../js/admin_script.js"></script>
</body>
</html>