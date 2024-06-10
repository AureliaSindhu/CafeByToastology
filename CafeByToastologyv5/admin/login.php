<?php
    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    session_start();

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $pass = sha1($_POST['pass']);

        $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
        $select_admin->execute([$name, $pass]);
        $row = $select_admin->fetch(PDO::FETCH_ASSOC);

        if($select_admin->rowCount() > 0){
            $_SESSION['admin_id'] = $row['id'];
            echo "successful";
            header('location:home.php');
        }else{
            $message[] = 'incorrect username or password!';
            echo 'incorrect username or password';
        }
    }
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
    <div class = "admin-login">
        <section class="admin-form">
            <form action="" method="post">
                <h3>Login now</h3>
                <p>Default username = <span>admin</span> & password = <span>1212</span></p>
                <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="submit" value="login now" class="btn" name="submit">
            </form>

            <div class = "switch">
                <a href ="../index.php" class = "btn"> Back to User View </a>
            </div>
        </section>      
    </div>
    
    <?php include ('../attributes/footer.php')?>
    <script src="../js/admin_script.js"></script>
</body>
</html>