<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | DASHBOARD</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!--head-->
    <div class="header">
        <img src="../waterDropLogo.png" height="90px" width="640px" alt="Logo">
    </div>

    <?php

    session_start();

    // Administrator
    if (isset($_SESSION['adminID'])) {

        ?>

        <!--Navigation Bar-->
        <div id="navbar">
            <div class="navbar">

                <a href="../dashboard/dashboard.php">Dashboard</a>

                <div class="dropdown">
                    <button class="help">Projects
                    </button>
                    <div class="dropdown-content">
                        <a href="../projects/projects_search.php">Search Projects</a>
                        <a href="../projects/projects.php">All Projects</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="help">Water Supply Issues
                    </button>
                    <div class="dropdown-content">
                        <a href="../wsissues/wsissues_search.php">Search Water Supply Issues</a>
                        <a href="../wsissues/wsissues.php">All Water Supply Issues</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="help">Funds
                    </button>
                    <div class="dropdown-content">
                        <a href="../funds/funds_search.php">Search Funds</a>
                        <a href="../funds/funds.php">All Funds</a>
                        <a href="../fundraise/fundraise_search.php">Search Fundraises</a>
                        <a href="../fundraise/fundraise.php">All Fundraises</a>
                    </div>
                </div>

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

            <h1>Role: Administrator.</h1>
            <br>
            <h1>Full Name: <?php echo $_SESSION['FName']; ?>
                <?php echo $_SESSION['LName']; ?>.
            </h1>
            <h1>Admin ID: <?php echo $_SESSION['adminID']; ?></h1>
            <h1>Designation: <?php echo $_SESSION['Designation']; ?></h1>
            <h1>NIC: <?php echo $_SESSION['NIC']; ?></h1>
            <h1>Date Of Birth: <?php echo $_SESSION['DOB']; ?></h1>
            <h1>Phone: (+94) <?php echo $_SESSION['TelNo']; ?></h1>
            <h1>Email: <?php echo $_SESSION['Email']; ?></h1>
            <h1>PostalAddress: <?php echo $_SESSION['PostalAddress']; ?></h1>

        <?php

    }
    // Construction Company
    elseif (isset($_SESSION['conComID'])) {

        ?>

            <!--Navigation Bar-->
            <div id="navbar">
                <div class="navbar">

                    <a href="../dashboard/dashboard.php">Dashboard</a>

                    <div class="dropdown">
                        <button class="help">Projects
                        </button>
                        <div class="dropdown-content">
                            <a href="../projects/projects_search.php">Search Projects</a>
                            <a href="../projects/projects.php">All Projects</a>
                        </div>
                    </div>

                    <div class="dropdown">
                        <button class="help">Information
                        </button>
                        <div class="dropdown-content">
                            <a href="../wsissues/wsissues_search.php">Search Information</a>
                            <a href="../wsissues/wsissues.php">All Information</a>
                        </div>
                    </div>

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
                                $username = $_SESSION['ComName'];

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

                <h1>Role: Construction Comany.</h1>
                <br>
                <h1>Comany Name: <?php echo $_SESSION['ComName']; ?></h1>
                <h1>Registration Number: <?php echo $_SESSION['RegNo']; ?></h1>
                <h1>Tax Identification Number: <?php echo $_SESSION['TIN']; ?></h1>
                <h1>Phone: (+94) <?php echo $_SESSION['TelNo']; ?></h1>
                <h1>Email: <?php echo $_SESSION['Email']; ?></h1>
                <h1>Postal Address: <?php echo $_SESSION['PostalAddress']; ?></h1>

            <?php

    }
    // Information Provider
    elseif (isset($_SESSION['userID'])) {

        ?>

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

                    <h1>Role: Information Provider.</h1>
                    <br>
                    <h1>Full Name: <?php echo $_SESSION['FName']; ?>
                        <?php echo $_SESSION['LName']; ?>.
                    </h1>
                    <h1>Username: <?php echo $_SESSION['Username']; ?></h1>
                    <h1>NIC: <?php echo $_SESSION['NIC']; ?></h1>
                    <h1>Date of Birth: <?php echo $_SESSION['DOB']; ?></h1>
                    <h1>Phone: (+94) <?php echo $_SESSION['TelNo']; ?></h1>
                    <h1>Email: <?php echo $_SESSION['Email']; ?></h1>
                    <h1>Province: <?php echo $_SESSION['Province']; ?></h1>
                    <h1>Postal Address: <?php echo $_SESSION['PostalAddress']; ?></h1>

                <?php

    }
    // Organizational Donor
    elseif (isset($_SESSION['orgDonorID'])) {

        ?>

                    <!--Navigation Bar-->
                    <div id="navbar">
                        <div class="navbar">

                            <a href="../dashboard/dashboard.php">Dashboard</a>

                            <a href="#">Information</a>

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
                                        $username = $_SESSION['OrgName'];

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

                        <h1>Role: Organizational Donor.</h1>
                        <br>
                        <h1>Company Name: <?php echo $_SESSION['OrgName']; ?></h1>
                        <h1>Registration Number: <?php echo $_SESSION['RegNo']; ?></h1>
                        <h1>Category: <?php echo $_SESSION['Category']; ?></h1>
                        <h1>Tax Identification Number: <?php echo $_SESSION['TIN']; ?></h1>
                        <h1>Phone: (+94) <?php echo $_SESSION['TelNo']; ?></h1>
                        <h1>Email: <?php echo $_SESSION['Email']; ?></h1>
                        <h1>Postal Address: <?php echo $_SESSION['PostalAddress']; ?></h1>

                    <?php

    }
    // Personal Donor
    elseif (isset($_SESSION['donorID'])) {

        ?>

                        <!--Navigation Bar-->
                        <div id="navbar">
                            <div class="navbar">

                                <a href="../dashboard/dashboard.php">Dashboard</a>

                                <a href="#">Information</a>

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

                            <h1>Role: Personal Donor.</h1>
                            <br>
                            <h1>Full Name: <?php echo $_SESSION['FName']; ?>
                                <?php echo $_SESSION['LName']; ?>.
                            </h1>
                            <h1>Email: <?php echo $_SESSION['Email']; ?></h1>
                            <h1>NIC: <?php echo $_SESSION['NIC']; ?></h1>
                            <h1>Date of Birth: <?php echo $_SESSION['DOB']; ?></h1>
                            <h1>Phone: <?php echo $_SESSION['TelNo']; ?></h1>
                            <h1>Postal Address: <?php echo $_SESSION['PostalAddress']; ?></h1>

                        <?php

    } else {

        header("Location: ../index.php");

        exit();

    }

    ?>
                    </div>

                    <script src="../app.js"></script>
</body>

</html>