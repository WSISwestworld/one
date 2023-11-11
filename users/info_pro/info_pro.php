<?php
include "../../db_conn.php";

$columns = array('userID', 'Username', 'FName', 'LName', 'Province', 'NIC', 'DOB', 'Gender', 'TelNo', 'Email', 'PostalAddress');

$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | USERS</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <link rel="stylesheet" href="../styles.css">

    <style>
        /* table formattings */
        html {
            font-family: Tahoma, Geneva, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 500px;
        }

        th {
            background-color: #54585d;
            border: 1px solid #54585d;
        }

        th:hover {
            background-color: #64686e;
        }

        th a {
            display: block;
            text-decoration: none;
            padding: 10px;
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
        }

        th a i {
            margin-left: 5px;
            color: rgba(255, 255, 255, 0.4);
        }

        td {
            padding: 10px;
            color: #636363;
            border: 1px solid #dddfe1;
        }

        tr {
            background-color: #ffffff;
        }

        tr .highlight {
            background-color: #f9fafb;
        }
    </style>

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
                        <a href="../../projects/admin.php">All Projects</a>
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

        <div class="content">

            <?php

            // Get the result...
            if (
                $result = $server_conn->query('SELECT * FROM infoProvider ORDER BY ' . $column . ' ' . $sort_order)
            ) {
                // Some variables need for the table.
                $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
                $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
                $add_class = ' class="highlight"';

                ?>

                <div>
                    <h2>All Information Providers</h2>
                    <table>
                        <tr>
                            <th><a href="info_pro.php?column=userID&order=<?php echo $asc_or_desc; ?>">ID<i
                                        class="fas fa-sort<?php echo $column == 'userID' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=Username&order=<?php echo $asc_or_desc; ?>">Username<i
                                        class="fas fa-sort<?php echo $column == 'Username' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=FName&order=<?php echo $asc_or_desc; ?>">First Name<i
                                        class="fas fa-sort<?php echo $column == 'FName' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=LName&order=<?php echo $asc_or_desc; ?>">Last Name<i
                                        class="fas fa-sort<?php echo $column == 'LName' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=Province&order=<?php echo $asc_or_desc; ?>">Province<i
                                        class="fas fa-sort<?php echo $column == 'Province' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=NIC&order=<?php echo $asc_or_desc; ?>">NIC<i
                                        class="fas fa-sort<?php echo $column == 'NIC' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=DOB&order=<?php echo $asc_or_desc; ?>">Date Of Birth<i
                                        class="fas fa-sort<?php echo $column == 'DOB' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=Gender&order=<?php echo $asc_or_desc; ?>">Gender<i
                                        class="fas fa-sort<?php echo $column == 'Gender' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=TelNo&order=<?php echo $asc_or_desc; ?>">Phone<i
                                        class="fas fa-sort<?php echo $column == 'TelNo' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=Email&order=<?php echo $asc_or_desc; ?>">Email<i
                                        class="fas fa-sort<?php echo $column == 'Email' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>

                            <th><a href="info_pro.php?column=PostalAddress&order=<?php echo $asc_or_desc; ?>">Postal Address<i
                                        class="fas fa-sort<?php echo $column == 'PostalAddress' ? '-' . $up_or_down : ''; ?>"></i></a>
                            </th>
                        </tr>

                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td<?php echo $column == 'userID' ? $add_class : ''; ?>>
                                    <?php echo $row['userID']; ?>
                                    </td>

                                    <td<?php echo $column == 'Username' ? $add_class : ''; ?>>
                                        <?php echo $row['Username']; ?>
                                        </td>

                                        <td<?php echo $column == 'FName' ? $add_class : ''; ?>>
                                            <?php echo $row['FName']; ?>
                                            </td>

                                            <td<?php echo $column == 'LName' ? $add_class : ''; ?>>
                                                <?php echo $row['LName']; ?>
                                                </td>

                                                <td<?php echo $column == 'Province' ? $add_class : ''; ?>>
                                                    <?php echo $row['Province']; ?>
                                                    </td>

                                                    <td<?php echo $column == 'NIC' ? $add_class : ''; ?>>
                                                        <?php echo $row['NIC']; ?>
                                                        </td>

                                                        <td<?php echo $column == 'DOB' ? $add_class : ''; ?>>
                                                            <?php echo $row['DOB']; ?>
                                                            </td>

                                                            <td<?php echo $column == 'Gender' ? $add_class : ''; ?>>
                                                                <?php echo $row['Gender']; ?>
                                                                </td>

                                                                <td<?php echo $column == 'TelNo' ? $add_class : ''; ?>>
                                                                    <?php echo $row['TelNo']; ?>
                                                                    </td>

                                                                    <td<?php echo $column == 'Email' ? $add_class : ''; ?>>
                                                                        <?php echo $row['Email']; ?>
                                                                        </td>

                                                                        <td<?php echo $column == 'PostalAddress' ? $add_class : ''; ?>>
                                                                            <?php echo $row['PostalAddress']; ?>
                                                                            </td>

                                                                            <td>
                                                                                <a href="update.php?id=<?php echo $row['userID']; ?>">Edit</a>
                                                                            </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>

                <?php
                $result->free();
            }
            ?>

            <h3>Total:

                <?php

                $total_rec = "SELECT COUNT(userID) FROM infoProvider";

                $result = $server_conn->query($total_rec);

                //display total
                while ($row = mysqli_fetch_array($result)) {

                    echo $row['COUNT(userID)'];
                }

                //close the connection
                $server_conn->close();

                ?> Information Providers
            </h3>

        </div>

    <?php

    } else {

        header("Location: ../../dashboard/dashboard.php");

        exit();

    }

    ?>

    <script src="../../app.js"></script>

</body>
</html>