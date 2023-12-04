<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | My Profile</title>

    <!--<link rel="stylesheet" href="../ls/login_styles.css">-->

    <style>
        .error {
            color: #FF0000;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .header {
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .error {
            color: #c0392b;
            margin-top: 10px;
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
        <input type="submit" value="Cancel" name="cancel"><br><br>
        <input type="submit" value="Confirm" name="confirm">
    </form>

</body>

</html>