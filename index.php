<?php

include "db_conn.php";

$sql_water_supply_issue = "SELECT * FROM `waterSupplyIssue`";
$sql_project = "SELECT * FROM `project` WHERE `ProjectStatus` = 'Ongoing' OR `ProjectStatus` = 'Completed'";
$sql_fundraise = "SELECT * FROM `fundRaise`";

$issues_result = $server_conn->query($sql_water_supply_issue);
$project_result = $server_conn->query($sql_project);
$fundraise_result = $server_conn->query($sql_fundraise);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | HOME</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <style>
        /*logo align*/
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <!--head-->
    <div class="header">
        <img src="waterDropLogo.png" height="90px" width="640px" alt="Logo" class="center">
    </div>


    <a href="ls/role_log.php">
        <img src="images/login_btn.png" height="20%" width="20%" alt="Login_btn">
    </a>

    <a href="ls/role_sign.php">
        <img src="images/reg_btn.png" height="20%" width="20%" alt="Login_btn">
    </a>


    <div class="container">

        <h2>Water Supply Issues</h2>

        <table class="table">

            <thead>

                <tr>

                    <th>Type of the Issue</th>

                    <th>District</th>

                    <th>Description</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <?php

                if ($issues_result->num_rows > 0) {

                    while ($row1 = $issues_result->fetch_assoc()) {

                        ?>

                        <tr>

                            <td>
                                <?php echo $row1['IssueType']; ?>
                            </td>

                            <td>
                                <?php echo $row1['District']; ?>
                            </td>

                            <td>
                                <?php echo $row1['Description']; ?>
                            </td>

                            <td>
                                <?php echo $row1['Status']; ?>
                            </td>

                        </tr>

                    <?php }

                }

                ?>

            </tbody>

        </table>

    </div>

    <!--projects-->
    <div class="container">

        <h2>Projects</h2>

        <table class="table">

            <thead>

                <tr>

                    <th>Project Title</th>

                    <th>Description</th>

                    <th>Project Area</th>

                    <th>Estimated Time</th>

                    <th>Estimated Cost</th>

                    <th>Project Status</th>

                </tr>

            </thead>

            <tbody>

                <?php

                if ($project_result->num_rows > 0) {

                    while ($row2 = $project_result->fetch_assoc()) {

                        ?>

                        <tr>

                            <td>
                                <?php echo $row2['ProjectTitle']; ?>
                            </td>

                            <td>
                                <?php echo $row2['Description']; ?>
                            </td>

                            <td>
                                <?php echo $row2['ProjectArea']; ?>
                            </td>

                            <td>
                                <?php echo $row2['EstimatedTime']; ?>
                            </td>

                            <td>
                                <?php echo $row2['EstimatedCost']; ?>
                            </td>

                            <td>
                                <?php echo $row2['ProjectStatus']; ?>
                            </td>

                        </tr>

                    <?php }

                }

                ?>

            </tbody>

        </table>

    </div>

    <!--fundraise-->
    <div class="container">

        <h2>Fundraise Events</h2>

        <table class="table">

            <thead>

                <tr>

                    <th>Name</th>

                    <th>Description</th>

                    <th>Date of the Event</th>

                </tr>

            </thead>

            <tbody>

                <?php

                if ($fundraise_result->num_rows > 0) {

                    while ($row3 = $fundraise_result->fetch_assoc()) {

                        ?>

                        <tr>

                            <td>
                                <?php echo $row3['Name']; ?>
                            </td>

                            <td>
                                <?php echo $row3['Description']; ?>
                            </td>

                            <td>
                                <?php echo $row3['EventDate']; ?>
                            </td>

                        </tr>

                    <?php }

                }

                ?>

            </tbody>

        </table>

    </div>

</body>

</html>