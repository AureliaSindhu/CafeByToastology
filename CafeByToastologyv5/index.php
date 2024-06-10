<?php

    include 'attributes/connect.php';
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';  
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
    <link rel=" shortcut icon" href="pic/icon.png">

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

<!-- <div class="home-bg"> -->
    <section class="home">
        <div class = "home">
            <h3> Welcome to </h3>
            <img src = "pic/name.png" alt="" class ="logo">
            <p>Find out which toast perfectly complements your taste!</p>
        </div>

        <div class = "test">
            <h3> Having trouble which toast to purchase?</h3>
            <p> Take this test and try your personal toast!</p>
            <div class="toast">
                <img src="pic/test.png" class="toastology-test" alt="Test Image 1">
                <img src="pic/test2.png" class="toastology-test" alt="Test Image 2">
            </div>
            <div class = "test-btn"> 
                <a href = "https://bit.ly/toastology"> <btn> Take the test</btn> </a>
            </div>
        </div>

    </section>
<!-- </div> -->

<?php include ('attributes/footer.php')?>
<script src="js/script.js"></script>

</body>
</html>