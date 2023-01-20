<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | WATER SUPPLY ISSUES</title>

    <link rel="stylesheet" href="styles.css">

    <Style>
        /*User icon and username*/
        .username {
            float: right;
            font-size: 16px;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin-right: auto;
        }

        .user_log {
            margin-left: 90%;
            margin-right: auto;
            margin-top: 3px;
        }
    </style>

</head>

<body>

    <?php
    session_start();
    ?>

    <!--head-->
    <div class="header">
        <img src="../waterDropLogo.png" height="90px" width="640px" alt="Logo">
    </div>

    <!--Navigation Bar-->
    <div id="navbar">
        <div class="navbar">
            <a href="../dashboard/dashboard.php">Dashboard</a>

            <a href="../complient_form/complient.php">Water Supply Issues</a>

            <a href="../fund/fund.php">Fund</a>

            <div class="dropdown">
                <button class="help">Help
                </button>
                <div class="dropdown-content">
                    <a href="#">Q & A</a>
                    <a href="#">About Us</a>
                </div>
            </div>

            <div class="user_log">
                <div class="dropdown">
                    <img class="" src="../images/user-icon.png" alt="user_icon">
                    <div class="dropdown-content">
                        <a href="#">gg</a>
                        <a href="../logout.php">Log Out</a>
                    </div>
                    <div class="username">

                        <?php
                        $username = $_SESSION['FName'];

                        if (strlen($username) > 10) {
                            echo mb_substr($username, 0, 10) . "..";
                        } else {
                            echo $username;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">

        <h3 style="text-align: center; color:  #1471ff;">Complain Submitted Successfully.<br>Thank you!</h3>

        <a href="complient.php">Another Complain?</a>

    </div>

</body>

</html>