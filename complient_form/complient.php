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

        .error {
            color: #FF0000;
        }
    </style>

</head>

<body>

    <?php

    session_start();

    // define variables and set to empty values
    $districtErr = $locationErr = $probtypeErr = $durationErr = $descriptionErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $district = test_input($_POST["district"]);
        $location = test_input($_POST["location"]);
        $probtype = test_input($_POST["probtype"]);
        $duration = test_input($_POST["duration"]);
        $description = test_input($_POST["description"]);
        $howdouknow = test_input($_POST["howdouknow"]);
        $issueStatus = test_input($_POST["issueStatus"]);

        $location_len = strlen($location);
        $description_len = strlen($description);

        // required data validation
        if (empty($_POST["district"])) {
            $districtErr = "'District' is required";

        }
        if (empty($_POST["location"])) {
            $locationErr = "'Location' is required";

        }
        if (empty($_POST["probtype"])) {
            $probtypeErr = "'Problem Type' is required";

        }
        if (empty($_POST["duration"])) {
            $durationErr = "'Problem Duration' is required";

        }
        if (empty($_POST["description"])) {
            $descriptionErr = "'Description' is required";

        }

        // check if only contains numbers, letters and white spaces
        if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $location)) and ($locationErr == "")) {
            $locationErr = "Only numbers, letters and white spaces are allowed";

        }

        // data length validation 
        if (!($location_len > 0 and $location_len <= 150) and ($locationErr == "")) {
            $locationErr = "Maximum 150 characters are allowed";

        }
        if (!($description_len > 0 and $description_len <= 1200) and ($descriptionErr == "")) {
            $descriptionErr = "Maximum 1200 characters are allowed";

        }

        // Call data submission
        if (
            ($districtErr == "") and ($locationErr == "") and ($probtypeErr == "") and ($durationErr == "") and ($descriptionErr == "")
        ) {
            data_submission();

        }
    }

    function data_submission()
    {
        include_once "../db_conn.php";

        global $district, $location, $probtype, $duration, $description, $howdouknow, $issueStatus;

        // Administrator
        if (isset($_SESSION['adminID'])) {

            $adminID = $_SESSION['adminID'];

            $sql_submit = "INSERT INTO waterSupplyIssue (IssueType, District, Location, DurationOfIssue, Description, AwareMethod, Status, adminID)
             VALUES ('$probtype','$district','$location','$duration','$description','$howdouknow','$issueStatus','$adminID')";

        }
        // Information Provider
        elseif (isset($_SESSION['userID'])) {

            $userID = $_SESSION['userID'];

            $sql_submit = "INSERT INTO waterSupplyIssue (IssueType, District, Location, DurationOfIssue, Description, AwareMethod, Status, userID)
             VALUES ('$probtype','$district','$location','$duration','$description','$howdouknow','$issueStatus','$userID')";

        } else {

            header("Location: ../dashboard/dashboard.php");

            exit();

        }

        // issue submittion process
        if (mysqli_query($server_conn, $sql_submit)) {

            echo "Successfully Submitted";

            // Administrator
            if (isset($_SESSION['adminID'])) {

                header("Location: ../wsissues/wsissues.php");

            }
            // Information Provider
            elseif (isset($_SESSION['userID'])) {

                header("Location: success.php");

                exit();

            }

        }
        // server error
        else {
            echo "Error: " . $sql_submit . "<br>" . mysqli_error($server_conn);

        }

        mysqli_close($server_conn);

    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <!--head-->
    <div class="header">
        <img src="../waterDropLogo.png" height="90px" width="640px" alt="Logo">
    </div>

    <?php

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

            <?php
            include_once "cmp_body/admin.php";
            ?>

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

            <?php
            include_once "cmp_body/info_pro.php";

            ?>

        </div>

    <?php

    } else {

        header("Location: ../dashboard/dashboard.php");

        exit();

    }

    ?>

    <script src="../app.js"></script>
</body>

</html>