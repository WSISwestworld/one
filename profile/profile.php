<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | My Profile</title>

    <link rel="stylesheet" href="../ls/login_styles.css">

    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <!--head-->
    <div class="header">
        <img src="../waterDropLogo.png" height="90px" width="640px" alt="Logo">
    </div>

    <h2>Please Confirm Your Identity</h2>

    <form action="verify.php" method="post">
        <?php

        session_start();

        // Administrator
        if (isset($_SESSION['adminID'])) {

            ?>

            <label for="uname">Admin ID</label>
            <input type="text" value="<?php echo $_SESSION['adminID']; ?>" disabled>
            <input type="hidden" id="uname" name="uname" value="<?php echo $_SESSION['adminID']; ?>">

        <?php

        }
        // Construction Company
        elseif (isset($_SESSION['conComID'])) {

            ?>

            <label for="uname">Registration No</label>
            <input type="text" value="<?php echo $_SESSION['RegNo']; ?>" disabled>
            <input type="hidden" id="uname" name="uname" value="<?php echo $_SESSION['RegNo']; ?>">

        <?php

        }
        // Information Provider
        elseif (isset($_SESSION['userID'])) {

            ?>

            <label for="uname">Username</label>
            <input type="text" value="<?php echo $_SESSION['Username']; ?>" disabled>
            <input type="hidden" id="uname" name="uname" value="<?php echo $_SESSION['Username']; ?>">

        <?php

        }
        // Organizational Donor
        elseif (isset($_SESSION['orgDonorID'])) {

            ?>

            <label for="uname">Registration No</label>
            <input type="text" value="<?php echo $_SESSION['RegNo']; ?>" disabled>
            <input type="hidden" id="uname" name="uname" value="<?php echo $_SESSION['RegNo']; ?>">

        <?php

        }
        // Personal Donor
        elseif (isset($_SESSION['donorID'])) {

            ?>

            <label for="uname">Email</label>
            <input type="text" value="<?php echo $_SESSION['Email']; ?>" disabled>
            <input type="hidden" id="uname" name="uname" value="<?php echo $_SESSION['Email']; ?>">

        <?php

        } else {

            header("Location: ../index.php");

            exit();

        }

        ?>
        <br>
        <br>

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <br>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>

        <br>
        <input type="submit" value="Cancel" name="cancel">
        <input type="submit" value="Confirm" name="confirm">
    </form>

</body>

</html>