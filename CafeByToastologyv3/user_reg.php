<?php
    include ('attributes/connect.php');
    session_start();

    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    };

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $message[] = "Invalid email format";
        // }
        $pass = sha1($_POST['pass']);
        $cpass = sha1($_POST['cpass']);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_user->execute([$email,$pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() > 0){
            $message[] = 'email already exists!';
        }else{
            if ($pass != $cpass){
                $message[] = 'confirm password not matched';
            } else{
                $insert_user = $conn->prepare("INSERT INTO `users` (name, email, password) VALUES(?,?,?)");
                $insert_user->execute([$name, $email, $cpass]);
                $message[] = 'registered successfully, now please login';
            }
            
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
    <link rel="stylesheet" href="../css/style.css">

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

    <section class="user-form">
        <form action="" method="post">
            <h3>Register Now</h3>
            <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box">
            <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="register now" class="btn" name="submit">
            <p>Already have an account?</p>
            <a href="user_login.php" class="optionn-btn">Login Now</a>
        </form>
    </section>    
    
    <?php include ('attributes/footer.php')?>
    <script src="js/script.js"></script>
</body>
</html>