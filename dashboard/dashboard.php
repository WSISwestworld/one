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
                        <hr>
                        <a href="../fundraise/fundraise_search.php">Search Fundraises</a>
                        <a href="../fundraise/fundraise.php">All Fundraises</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="help">Users
                    </button>
                    <div class="dropdown-content">
                        <a href="../users/admin/admin.php">All Administrators</a>
                        <hr>
                        <a href="../users/cons_company/cons_company_search.php">Search Construction Companies</a>
                        <a href="../users/cons_company/cons_company.php">All Construction Companies</a>
                        <hr>
                        <a href="../users/info_pro/info_pro_search.php">Search Information Providers</a>
                        <a href="../users/info_pro/info_pro.php">All Information Providers</a>
                        <hr>
                        <a href="../users/org_don/org_don_search.php">Search Organizational Donors</a>
                        <a href="../users/org_don/org_don.php">All Organizational Donors</a>
                        <hr>
                        <a href="../users/personal_don/personal_don_search.php">Search Personal Donors</a>
                        <a href="../users/personal_don/personal_don.php">All Personal Donors</a>
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
                            <a href="../profile/profile.php">Update My Profile</a>
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
            <h1>Full Name:
                <?php echo $_SESSION['FName']; ?>
                <?php echo $_SESSION['LName']; ?>.
            </h1>
            <h1>Admin ID:
                <?php echo $_SESSION['adminID']; ?>
            </h1>
            <h1>Designation:
                <?php echo $_SESSION['Designation']; ?>
            </h1>
            <h1>NIC:
                <?php echo $_SESSION['NIC']; ?>
            </h1>
            <h1>Date Of Birth:
                <?php echo $_SESSION['DOB']; ?>
            </h1>
            <h1>Gender:
                <?php echo $_SESSION['Gender']; ?>
            </h1>
            <h1>Phone:
                (+94)
                <?php echo $_SESSION['TelNo']; ?>
            </h1>
            <h1>Email:
                <?php echo $_SESSION['Email']; ?>
            </h1>
            <h1>PostalAddress:
                <?php echo $_SESSION['PostalAddress']; ?>
            </h1>

        </div>

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
                            <a href="../profile/profile.php">Update My Profile</a>
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
            <h1>Comany Name:
                <?php echo $_SESSION['ComName']; ?>
            </h1>
            <h1>Registration Number:
                <?php echo $_SESSION['RegNo']; ?>
            </h1>
            <h1>Taxpayer Identification Number:
                <?php echo $_SESSION['TIN']; ?>
            </h1>
            <h1>Phone:
                (+94)
                <?php echo $_SESSION['TelNo']; ?>
            </h1>
            <h1>Email:
                <?php echo $_SESSION['Email']; ?>
            </h1>
            <h1>Postal Address:
                <?php echo $_SESSION['PostalAddress']; ?>
            </h1>

        </div>

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

                <a href="../funds/funds.php">Funds</a>

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
                            <a href="../profile/profile.php">Update My Profile</a>
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
            <h1>Full Name:
                <?php echo $_SESSION['FName']; ?>
                <?php echo $_SESSION['LName']; ?>.
            </h1>
            <h1>Username:
                <?php echo $_SESSION['Username']; ?>
            </h1>
            <h1>NIC:
                <?php echo $_SESSION['NIC']; ?>
            </h1>
            <h1>Date of Birth:
                <?php echo $_SESSION['DOB']; ?>
            </h1>
            <h1>Gender:
                <?php echo $_SESSION['Gender']; ?>
            </h1>
            <h1>Phone:
                (+94)
                <?php echo $_SESSION['TelNo']; ?>
            </h1>
            <h1>Email:
                <?php echo $_SESSION['Email']; ?>
            </h1>
            <h1>Province:
                <?php echo $_SESSION['Province']; ?>
            </h1>
            <h1>Postal Address:
                <?php echo $_SESSION['PostalAddress']; ?>
            </h1>

        </div>

    <?php

    }
    // Organizational Donor
    elseif (isset($_SESSION['orgDonorID'])) {

        ?>

        <!--Navigation Bar-->
        <div id="navbar">
            <div class="navbar">

                <a href="../dashboard/dashboard.php">Dashboard</a>

                <a href="#">Donations</a>

                <a href="../funds/funds.php">Funds</a>

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
                            <a href="../profile/profile.php">Update My Profile</a>
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
            <h1>Company Name:
                <?php echo $_SESSION['OrgName']; ?>
            </h1>
            <h1>Registration Number:
                <?php echo $_SESSION['RegNo']; ?>
            </h1>
            <h1>Category:
                <?php echo $_SESSION['Category']; ?>
            </h1>
            <h1>Taxpayer Identification Number:
                <?php echo $_SESSION['TIN']; ?>
            </h1>
            <h1>Phone:
                (+94)
                <?php echo $_SESSION['TelNo']; ?>
            </h1>
            <h1>Email:
                <?php echo $_SESSION['Email']; ?>
            </h1>
            <h1>Postal Address:
                <?php echo $_SESSION['PostalAddress']; ?>
            </h1>

        </div>

    <?php

    }
    // Personal Donor
    elseif (isset($_SESSION['donorID'])) {

        ?>

        <!--Navigation Bar-->
        <div id="navbar">
            <div class="navbar">

                <a href="../dashboard/dashboard.php">Dashboard</a>

                <a href="#">Donations</a>

                <div class="dropdown">
                    <button class="help">Funds
                    </button>
                    <div class="dropdown-content">
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
                            <a href="../profile/profile.php">Update My Profile</a>
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
            <h1>Full Name:
                <?php echo $_SESSION['FName']; ?>
                <?php echo $_SESSION['LName']; ?>.
            </h1>
            <h1>Email:
                <?php echo $_SESSION['Email']; ?>
            </h1>
            <h1>NIC:
                <?php echo $_SESSION['NIC']; ?>
            </h1>
            <h1>Date of Birth:
                <?php echo $_SESSION['DOB']; ?>
            </h1>
            <h1>Gender:
                <?php echo $_SESSION['Gender']; ?>
            </h1>
            <h1>Phone:
                (+94)
                <?php echo $_SESSION['TelNo']; ?>
            </h1>
            <h1>Postal Address:
                <?php echo $_SESSION['PostalAddress']; ?>
            </h1>

        </div>

    <?php

    } else {

        header("Location: ../index.php");

        exit();

    }

    ?>

    <script src="../app.js"></script>
</body>

</html>
