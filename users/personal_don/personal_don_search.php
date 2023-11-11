<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | USERS</title>

    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <!--head-->
    <div class="header">
        <img src="../../waterDropLogo.png" height="90px" width="640px" alt="Logo">
    </div>

    <?php

    session_start();

    // Administrator
    if (isset($_SESSION['adminID'])) {

        ?>

        <!--Navigation Bar-->
        <div id="navbar">
            <div class="navbar">

                <a href="../../dashboard/dashboard.php">Dashboard</a>

                <div class="dropdown">
                    <button class="help">Projects
                    </button>
                    <div class="dropdown-content">
                        <a href="../../projects/projects_search.php">Search Projects</a>
                        <a href="../../projects/projects.php">All Projects</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="help">Water Supply Issues
                    </button>
                    <div class="dropdown-content">
                        <a href="../../wsissues/wsissues_search.php">Search Water Supply Issues</a>
                        <a href="../../wsissues/wsissues.php">All Water Supply Issues</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="help">Funds
                    </button>
                    <div class="dropdown-content">
                        <a href="../../funds/funds_search.php">Search Funds</a>
                        <a href="../../funds/funds.php">All Funds</a>
                        <hr>
                        <a href="../../fundraise/fundraise_search.php">Search Fundraises</a>
                        <a href="../../fundraise/fundraise.php">All Fundraises</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="help">Users
                    </button>
                    <div class="dropdown-content">
                        <a href="../../users/admin/admin.php">All Administrators</a>
                        <hr>
                        <a href="../../users/cons_company/cons_company_search.php">Search Construction Companies</a>
                        <a href="../../users/cons_company/cons_company.php">All Construction Companies</a>
                        <hr>
                        <a href="../../users/info_pro/info_pro_search.php">Search Information Providers</a>
                        <a href="../../users/info_pro/info_pro.php">All Information Providers</a>
                        <hr>
                        <a href="../../users/org_don/org_don_search.php">Search Organizational Donors</a>
                        <a href="../../users/org_don/org_don.php">All Organizational Donors</a>
                        <hr>
                        <a href="../../users/personal_don/personal_don_search.php">Search Personal Donors</a>
                        <a href="../../users/personal_don/personal_don.php">All Personal Donors</a>
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
                        <img class="" src="../../images/user-icon.png" alt="user_icon">
                        <div class="dropdown-content">
                            <a href="../../profile/profile.php">Update My Profile</a>
                            <a href="../../logout.php">Log Out</a>
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

    } else {

        header("Location: ../../dashboard/dashboard.php");

        exit();

    }

    ?>

    <div class="content">

        <?php
        $servername = 'localhost';

        $username = "root";

        $password = "";

        try {

            $server_conn = new PDO("mysql:host=$servername;dbname=wsis", $username, $password);
            $server_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo '<br>' . $e->getMessage();
        }

        $searchErr = '';
        $search_details = '';

        if (isset($_POST['save'])) {

            if (!empty($_POST['search'])) {

                $search = $_POST['search'];

                $search_sql = $server_conn->prepare("SELECT * FROM personalDonor WHERE (donorID LIKE '%$search%') OR (FName LIKE '%$search%') OR (LName LIKE '%$search%') OR 
                (NIC LIKE '%$search%') OR (DOB LIKE '%$search%') OR (Gender LIKE '%$search%') OR (TelNo LIKE '%$search%') OR (Email LIKE '%$search%') OR (PostalAddress LIKE '%$search%')");

                $search_sql->execute();
                $search_details = $search_sql->fetchAll(PDO::FETCH_ASSOC);

            } else {

                $searchErr = "Please enter the information";
            }

        }

        ?>

        <div class="container">

            <form class="form-horizontal" action="#" method="post">
                <div class="row">
                    <div class="form-group">

                        <label class="control-label col-sm-4" for="search"><b>Search</b>:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="search" placeholder="Search here">

                        </div>
                        <div class="col-sm-2">
                            <button type="submit" name="save" class="btn btn-success btn-sm">Search</button>
                        </div>

                    </div>
                    <div class="form-group">
                        <span class="error" style="color:red;">
                            <?php echo $searchErr; ?>
                        </span>
                    </div>

                </div>
            </form>

            <br /><br />
            <h3><u>Search Results</u></h3><br />

            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>NIC</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Postal Address</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (!$search_details) {
                            echo '<tr>No data found</tr>';
                        } else {
                            foreach ($search_details as $key => $value) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $value['donorID']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['FName']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['LName']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['NIC']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['DOB']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['Gender']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['TelNo']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['Email']; ?>
                                    </td>

                                    <td>
                                        <?php echo $value['PostalAddress']; ?>
                                    </td>

                                    <td>
                                        <a href="update.php?id=<?php echo $value['donorID']; ?>">Edit</a>
                                    </td>
                                </tr>

                            <?php
                            }
                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script src="../../app.js"></script>

</body>

</html>