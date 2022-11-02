<?php
require 'config/constants.php';

// get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname']  ?? null;
$username = $_SESSION['signup-data']['username']  ?? null;
$email = $_SESSIN['signup-data']['email']  ?? null;
$createpassword = $_SESSION['signup-data']['createpassword']  ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword']  ?? null;
// delete signup data session
unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bogl</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Sign Up</h2>
            <?php if (isset($_SESSION['signup'])) : ?>
                <div class="alert-message error">
                    <p>
                        <?= $_SESSION['signup'];
                        unset($_SESSION['signup']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?=$firstname?>" id="" placeholder="First Name">
                <input type="text" name="lastname" value="<?=$lastname?>" id="" placeholder="Last Name">
                <input type="text" name="username" value="<?=$username?>" id="" placeholder="Username">
                <input type="email" name="email" value="<?=$email?>" id="" placeholder="Email">
                <input type="password" name="createpassword" value="<?=$createpassword?>" id="" placeholder="Create Psassword">
                <input type="password" name="confirmpassword" value="<?=$confirmpassword?>" id="" placeholder="Confirm Password">
                <div class="form-control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Sign Up</button>
                <small>Already have an account? <a href="signin.php">Sign In</a></small>
            </form>
        </div>
    </section>

    <script src="./main.js"></script>
</body>

</html>