<?php
    include ('attributes/connect.php');
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = 'guest';
    };

    if(isset($_POST['send'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $msg = $_POST['msg'];
        
        $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
        $select_message->execute([$name, $email, $number, $msg]);

        if($select_message->rowCount() > 0){
            $message[] = 'already sent message!';
        }else{
            $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
            $insert_message->execute([$user_id, $name, $email, $number, $msg]);

            $message[] = 'sent message successfully!';
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
    <link rel="icon" href="../pic/icon.png">

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

    <section class="contact">
        <form action="" method="post">
            <h3> Leave Us a Message</h3>
            <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
            <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
            <input type="number" name="number" min="0" max="9999999999" placeholder="enter your phone number" required onkeypress="if(this.value.length == 10) return false;" class="box">
            <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
    </section>

    <?php include ('attributes/footer.php')?>
    <script src="js/script.js"></script>
</body>
</html>