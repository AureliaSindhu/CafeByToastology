<?php
    include ('../attributes/connect.php');
    include ('../attributes/admin_msg.php');
    include ('back.php');
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
        $update_profile_name->execute([$name, $admin_id]);

        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
        $prev_pass = $_POST['prev_pass'];
        
        $old_pass = sha1($_POST['old_pass']);
        $new_pass = sha1($_POST['new_pass']);
        $confirm_pass = sha1($_POST['confirm_pass']);

        if($old_pass == $empty_pass){
            $message[] = 'please enter old password!';
        }elseif($old_pass != $prev_pass){
            $message[] = 'old password not matched!';
        }elseif($new_pass != $confirm_pass){
            $message[] = 'confirm password not matched!';
        }else{
            if($new_pass != $empty_pass){
            $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_admin_pass->execute([$confirm_pass, $admin_id]);
            $message[] = 'password updated successfully!';
            }else{
            $message[] = 'please enter a new password!';
            }
        }
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Users Account</Admin></title>

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
    <section class="update-prof">
        <form action="" method="post">
                <h3>Update Profile</h3>
                <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
                <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="old_pass" placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="new_pass" placeholder="enter new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="confirm_pass" placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="submit" value="update now" class="btn" name="submit">
            </form>
    </section>
    
    <?php include ('../attributes/footer.php')?>
    <script src="../js/admin_script.js"></script>
</body>
</html>