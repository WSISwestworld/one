<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | PROJECTS</title>

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
                            <a href="#">Profile</a>
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

    <?php

    } else {

        header("Location: ../dashboard/dashboard.php");

        exit();

    }

    ?>

    <div class="content">

        <?php
        include_once "srch_body/search.php";
        ?>

    </div>

    <script src="../app.js"></script>

</body>

</html>