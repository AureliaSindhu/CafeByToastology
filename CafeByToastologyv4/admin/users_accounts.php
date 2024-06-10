<?php
    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    include ('back.php');
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
    header('location:admin_login.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_user->execute([$delete_id]);
        $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
        $delete_orders->execute([$delete_id]);
        $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
        $delete_messages->execute([$delete_id]);
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$delete_id]);
        header('location:users_accounts.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Accounts</Admin></title>

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
    <section class="accounts">
        <h1 class="heading">User accounts</h1>
        <div class="user-acc">
            <?php
            $select_accounts = $conn->prepare("SELECT * FROM `users`");
            $select_accounts->execute();
            if($select_accounts->rowCount() > 0){
                while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
            ?>
            <div class="box">
                <p> User id : <span><?= $fetch_accounts['id']; ?></span> </p>
                <p> Username : <span><?= $fetch_accounts['name']; ?></span> </p>
                <p> Email : <span><?= $fetch_accounts['email']; ?></span> </p>
                <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')" class="delete-btn">delete</a>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">no accounts available!</p>';
            }
            ?>

        </div>
    </section>
    
    <?php include ('../attributes/footer.php')?>
    <script src="../js/admin_script.js"></script>
</body>
</html>