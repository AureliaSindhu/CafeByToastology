<?php

    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    include ('back.php');

    session_start();
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
        $delete_admins->execute([$delete_id]);
        header('location:account.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Accounts</title>

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
        <h1 class="heading">Admin Accounts</h1>

        <div class="box1">
            <a href="register_admin.php" class="option-btn">Register New Admin</a>
        </div>
        
        <div class="admin-acc">
            <?php
                $select_accounts = $conn->prepare("SELECT * FROM `admins`");
                $select_accounts->execute();
                if($select_accounts->rowCount() > 0){
                    while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
            ?>
            
            <div class="box">
                <p> Admin Id : <span><?= $fetch_accounts['id']; ?></span> </p>
                <p> Admin Username : <span><?= $fetch_accounts['name']; ?></span> </p>
                <div class="flex-btn">
                    <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>
                    <a href="update_admin.php?id=<?= $fetch_accounts['id']; ?>" class="option-btn">update</a>
                </div>
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