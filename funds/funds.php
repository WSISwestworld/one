<?php
include "../db_conn.php";

session_start();

$columns = array('Amount', 'Date', 'NIC', 'RegNo', 'Name');

$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | FUNDS</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <link rel="stylesheet" href="styles.css">

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
                            <a href="#">Profile</a>
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

            include_once "funds_body/admin.php";
            ?>

            <div>
                <a href="add_funds.php">Add New Fund</a>
            </div>

        <?php

    } else {

        header("Location: ../dashboard/dashboard.php");

        exit();

    }

    ?>

    </div>

    <script src="../app.js"></script>

</body>

</html>