<?php
    include ('attributes/connect.php');
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';  
    };

    $creatorInfo = array(
        'name' => 'Aurelia Sindhunirmala',
        'role' => 'Second Year Computer Science Student',
        'links' => array(
            'linkedin' => 'https://www.linkedin.com/in/aurelia-sindhunirmala-b14280216/',
            'github' => 'https://github.com/AureliaSindhu',
            'email' => 'aurelia.sindhu@gmail.com'
        )
    );

    $serializedCreatorInfo = json_encode($creatorInfo);
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
    <?php include ('attributes/connect.php')?>
    <?php include ('attributes/header.php')?>

    <div class = "about">
        <h1> About Us </h1>
        <p> A virtual cafe where we sell numerous delicious toast. In addition, we also partner up with our team's other project, Toastology. A personality test that defines your specific toast.</p>

        <h1> Creator </h1>
        <section class = "bg-creator">
            <div class="creator">
                <img src="pic/meee.png" class="me">
                <div class = "info">
                    <h3> Made by: Aurelia Sindhunirmala </h3>
                    <p> Second Year Computer Science Student </p>
                    <br>
                    <h2> Find me on: </h2>
                    <a href="https://www.linkedin.com/in/aurelia-sindhunirmala-b14280216/" class="icon"><i class='bx bxl-linkedin-square'></i></a>
                    <a href="https://github.com/AureliaSindhu" class="icon"><i class='bx bxl-github'></i></a>
                    <a href="mailto: aurelia.sindhu@gmail.com" class="icon"><i class='bx bxl-gmail'></i></a>
                </div>
            </div>
        </section>
    </div>

    <script>
        var creatorInfo = <?php echo $serializedCreatorInfo; ?>;
        console.log(creatorInfo);
    </script>

    <?php include ('attributes/footer.php')?>
    <script src="js/script.js"></script>
</body>
</html>