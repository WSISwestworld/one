<?php

session_start();

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $issueID = $_GET['id'];

    // Administrator
    if (isset($_SESSION['adminID'])) {

        $sql_get = "SELECT * FROM waterSupplyIssue WHERE issueID='$issueID'";

    }
    // Construction Company
    elseif (isset($_SESSION['conComID'])) {

        $sql_get = "SELECT * FROM waterSupplyIssue WHERE issueID='$issueID' AND Status='Verified'";

    } else {

        header("Location: ../../dashboard/dashboard.php");

        exit();

    }

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $issueID = $row['issueID'];
            $IssueType = $row['IssueType'];
            $District = $row['District'];
            $Location = $row['Location'];
            $DurationOfIssue = $row['DurationOfIssue'];
            $Description = $row['Description'];
            $AwareMethod = $row['AwareMethod'];
            $Status = $row['Status'];
            $userID = $row['userID'];
            $adminID = $row['adminID'];

        }
        ?>

        <div class="container">

            <h2>
                <?php echo $IssueType . ': ' . $District . ' ' . $Location; ?>
            </h2>

            <table class="table">

                <thead>

                    <tr>

                        <?php
                        // Administrator
                        if (isset($_SESSION['adminID'])) {
                            ?>
                            <th>Type of the Issue</th>
                            <th>District</th>
                            <th>Location</th>
                            <th>Duration Of the Issue (in Months)</th>
                            <th>Description</th>
                            <th>Awareness Method</th>
                            <th>Status</th>
                            <th>Information Provider ID</th>
                            <th>Admin ID</th>
                        <?php
                        }
                        // Construction Company
                        elseif (isset($_SESSION['conComID'])) {
                            ?>
                            <th>Type of the Issue</th>
                            <th>District</th>
                            <th>Location</th>
                            <th>Duration Of the Issue (in Months)</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Admin ID</th>
                        <?php
                        }
                        ?>

                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>
                            <?php echo $IssueType; ?>
                        </td>

                        <td>
                            <?php echo $District; ?>
                        </td>

                        <td>
                            <?php echo $Location; ?>
                        </td>

                        <td>
                            <?php echo $DurationOfIssue; ?>
                        </td>

                        <td>
                            <?php echo $Description; ?>
                        </td>

                        <?php
                        // Administrator
                        if (isset($_SESSION['adminID'])) {
                            ?>

                            <td>
                                <?php echo $AwareMethod; ?>
                            </td>

                            <td>
                                <?php echo $Status; ?>
                            </td>

                            <td>
                                <a href="../details/user_d.php?id=<?php echo $userID; ?>">
                                    <?php echo $userID; ?>
                                </a>
                            </td>

                            <td>
                                <a href="../details/admin_d.php?id=<?php echo $adminID; ?>">
                                    <?php echo $adminID; ?>
                                </a>
                            </td>

                            <td>
                                <a href="update.php?id=<?php echo $issueID; ?>">Edit</a>&nbsp;
                                <a href="delete.php?id=<?php echo $issueID; ?>">Delete</a>
                            </td>

                        <?php
                        }
                        // Construction Company
                        elseif (isset($_SESSION['conComID'])) {
                            ?>

                            <td>
                                <?php echo $Status; ?>
                            </td>

                            <td>
                                <a href="../details/admin_d.php?id=<?php echo $adminID; ?>">
                                    <?php echo $adminID; ?>
                                </a>
                            </td>

                        <?php
                        }
                        ?>

                    </tr>

                </tbody>

            </table>

        </div>

    <?php }

} else {

    header('Location: ../wsissues_search.php');

}
?>