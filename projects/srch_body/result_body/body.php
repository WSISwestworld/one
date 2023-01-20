<?php

session_start();

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $projectID = $_GET['id'];

    // Administrator
    if (isset($_SESSION['adminID'])) {

        $sql_get = "SELECT * FROM project LEFT JOIN constructionCompany ON
        project.conComID = constructionCompany.conComID WHERE project.projectID='$projectID'";

    }
    // Construction Company
    elseif (isset($_SESSION['conComID'])) {

        $com_id = $_SESSION['conComID'];

        $sql_get = "SELECT * FROM project LEFT JOIN constructionCompany ON
        project.conComID = constructionCompany.conComID WHERE (project.conComID = '$com_id') AND (project.projectID='$projectID')";

    } else {

        header("Location: ../../dashboard/dashboard.php");

        exit();

    }

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $projectID = $row['projectID'];
            $conComID = $row['conComID'];
            $ProjectTitle = $row['ProjectTitle'];
            $Description = $row['Description'];
            $ProjectArea = $row['ProjectArea'];
            $EstimatedTime = $row['EstimatedTime'];
            $EstimatedCost = $row['EstimatedCost'];
            $ProjectStatus = $row['ProjectStatus'];
            $adminID = $row['adminID'];
            $ComName = $row['ComName'];

        }
        ?>

        <div class="container">

            <h2>Project <?php echo $ProjectTitle; ?></h2>

            <table class="table">

                <thead>

                    <tr>

                        <th>Project Title</th>

                        <th>Description</th>

                        <th>Project Area</th>

                        <th>Estimated Time</th>

                        <th>Estimated Cost</th>

                        <th>Project Status</th>

                        <th>Admin ID</th>

                        <th>Construction Company</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>
                            <?php echo $ProjectTitle; ?>
                        </td>

                        <td>
                            <?php echo $Description; ?>
                        </td>

                        <td>
                            <?php echo $ProjectArea; ?>
                        </td>

                        <td>
                            <?php echo $EstimatedTime; ?>
                        </td>

                        <td>
                            <?php echo $EstimatedCost; ?>
                        </td>

                        <td>
                            <?php echo $ProjectStatus; ?>
                        </td>

                        <td>
                            <a href="../details/admin_d.php?id=<?php echo $adminID; ?>">
                                <?php echo $adminID; ?>
                            </a>
                        </td>

                        <td>
                            <a href="../details/company_d.php?id=<?php echo $conComID; ?>">
                                <?php echo $ComName; ?>
                            </a>
                        </td>

                        <td>
                            <a href="update.php?id=<?php echo $projectID; ?>">Edit</a>&nbsp;
                            <a href="delete.php?id=<?php echo $projectID; ?>">Delete</a>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    <?php }

} else {

    header('Location: ../projects_search.php');

}
?>