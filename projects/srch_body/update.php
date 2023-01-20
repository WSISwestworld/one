<?php

include "../../db_conn.php";

session_start();

if (isset($_POST['update'])) {

    // define variables and set to empty values
    $titleErr = $descriptionErr = $areaErr = $timeErr = $costErr = "";

    $projectID = $_POST['projectID'];
    $ProjectTitle = $_POST['ProjectTitle'];

    if (empty($_POST["Description"])) {
        $Description = $_POST['OldDescription'];
    } else {
        $Description = $_POST['Description'];
    }

    $ProjectArea = $_POST['ProjectArea'];
    $EstimatedTime = $_POST['EstimatedTime'];
    $EstimatedCost = $_POST['EstimatedCost'];
    $ProjectStatus = $_POST['ProjectStatus'];
    $adminID = $_POST['adminID'];
    $conComID = $_POST['conComID'];

    $title_len = strlen($ProjectTitle);
    $description_len = strlen($Description);
    $area_len = strlen($ProjectArea);
    $time_len = strlen($EstimatedTime);
    $cost_len = strlen($EstimatedCost);

    // required data validation
    if (empty($_POST["ProjectTitle"])) {
        $titleErr = "'Project Title' is required";
    }

    if (empty($_POST["ProjectArea"])) {
        $areaErr = "'Project Area' is required";
    }

    if (empty($_POST["EstimatedTime"])) {
        $timeErr = "'Estimated Time' is required";
    }

    if (empty($_POST["EstimatedCost"])) {
        $costErr = "'Estimated Cost' is required";
    }


    // check if only contains numbers and letters
    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $ProjectTitle)) and ($titleErr == "")) {
        $titleErr = "Only numbers, letters and whitespaces are allowed";

    }

    if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $Description)) {
        $descriptionErr = "Only numbers, letters and whitespaces are allowed";

    }

    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $ProjectArea)) and ($areaErr == "")) {
        $areaErr = "Only numbers, letters and whitespaces are allowed";

    }

    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $EstimatedTime)) and ($timeErr == "")) {
        $timeErr = "Only numbers, letters and whitespaces are allowed";

    }

    // ERRORRRRRRRRRRRRR
    // ERRORR
    // Check Double Regix
    if ((!preg_match("/^[0-9]*$/", $EstimatedCost)) and ($costErr == "")) {
        $costErr = "Only numbers are allowed";

    }


    // data length validation
    if (!($title_len > 0 and $title_len <= 150) and ($titleErr == "")) {
        $titleErr = "Maximum 150 characters are allowed";

    }
    if (!($description_len > 0 and $description_len <= 1200) and ($descriptionErr == "")) {
        $descriptionErr = "Maximum 1200 characters are allowed";

    }
    if (!($area_len > 0 and $area_len <= 150) and ($areaErr == "")) {
        $areaErr = "Maximum 150 characters are allowed";

    }
    if (!($time_len > 0 and $time_len <= 100) and ($timeErr == "")) {
        $timeErr = "Maximum 100 characters are allowed";

    }
    if (!($cost_len > 0 and $cost_len <= 40) and ($costErr == "")) {
        $costErr = "Maximum 40 numbers are allowed";

    }


    if (($titleErr == "") and ($descriptionErr == "") and ($areaErr == "") and ($timeErr == "") and ($costErr == "")) {

        // update querry
        if ((empty($_POST['conComID'])) and (empty($_POST['adminID']))) {

            $sql_update = "UPDATE `project` SET `ProjectTitle`='$ProjectTitle',`Description`='$Description',`ProjectArea`='$ProjectArea',`EstimatedTime`='$EstimatedTime',
        `EstimatedCost`='$EstimatedCost',`ProjectStatus`='$ProjectStatus',`adminID`=NULL,`conComID`=NULL WHERE `projectID`='$projectID'";

        } elseif (empty($_POST['adminID'])) {

            $sql_update = "UPDATE `project` SET `ProjectTitle`='$ProjectTitle',`Description`='$Description',`ProjectArea`='$ProjectArea',`EstimatedTime`='$EstimatedTime',
        `EstimatedCost`='$EstimatedCost',`ProjectStatus`='$ProjectStatus',`adminID`=NULL,`conComID`='$conComID' WHERE `projectID`='$projectID'";

        } elseif (empty($_POST['conComID'])) {

            $sql_update = "UPDATE `project` SET `ProjectTitle`='$ProjectTitle',`Description`='$Description',`ProjectArea`='$ProjectArea',`EstimatedTime`='$EstimatedTime',
        `EstimatedCost`='$EstimatedCost',`ProjectStatus`='$ProjectStatus',`adminID`='$adminID',`conComID`=NULL WHERE `projectID`='$projectID'";

        } else {

            $sql_update = "UPDATE `project` SET `ProjectTitle`='$ProjectTitle',`Description`='$Description',`ProjectArea`='$ProjectArea',`EstimatedTime`='$EstimatedTime',
        `EstimatedCost`='$EstimatedCost',`ProjectStatus`='$ProjectStatus',`adminID`='$adminID',`conComID`='$conComID' WHERE `projectID`='$projectID'";

        }

        $update_result = $server_conn->query($sql_update);

        if ($update_result == TRUE) {

            echo "Project updated successfully";

            header('Location: ../projects_search.php');

        } else {

            echo "Error:" . $sql_update . "<br>" . $server_conn->error;

        }

    }

}

if (isset($_GET['id'])) {

    $projectID = $_GET['id'];

    $sql_get = "SELECT * FROM project LEFT JOIN constructionCompany ON
    project.conComID = constructionCompany.conComID WHERE project.projectID='$projectID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $projectID = $row['projectID'];

            $ProjectTitle = $row['ProjectTitle'];

            $Description = $row['Description'];

            $ProjectArea = $row['ProjectArea'];

            $EstimatedTime = $row['EstimatedTime'];

            $EstimatedCost = $row['EstimatedCost'];

            $ProjectStatus = $row['ProjectStatus'];

            $adminID = $row['adminID'];

            $conComID = $row['conComID'];

            $ComName = $row['ComName'];

        }

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <title>WSIS | PROJECTS</title>

            <style>
                .error {
                    color: #FF0000;
                }
            </style>

        </head>

        <body>

            <h2>Update Project</h2>

            <form action="" method="post">

                <fieldset>

                    <legend>Project information:</legend>

                    Project Title:<br>

                    <input type="text" name="ProjectTitle" value="<?php echo $ProjectTitle; ?>">

                    <span class="error">* <?php echo $titleErr; ?></span>

                    <input type="hidden" name="projectID" value="<?php echo $projectID; ?>">

                    <br>

                    Description:<br>

                    <textarea name="Description" placeholder="<?php echo $Description; ?>"></textarea>

                    <span class="error">* <?php echo $descriptionErr; ?></span>

                    <input type="hidden" name="OldDescription" value="<?php echo $Description; ?>">

                    <br>

                    Project Area:<br>

                    <input type="text" name="ProjectArea" value="<?php echo $ProjectArea; ?>">

                    <span class="error">* <?php echo $areaErr; ?></span>

                    <br>

                    Estimated Time:<br>

                    <input type="text" name="EstimatedTime" value="<?php echo $EstimatedTime; ?>">

                    <span class="error">* <?php echo $timeErr; ?></span>

                    <br>

                    Estimated Cost:<br>

                    <input type="text" name="EstimatedCost" value="<?php echo $EstimatedCost; ?>">

                    <span class="error">* <?php echo $costErr; ?></span>

                    <br>

                    <?php

                    // Administrator
                    if (isset($_SESSION['adminID'])) {

                        ?>

                        Project Status:<br>

                        <select name="ProjectStatus">

                            <option hidden value="<?php echo $ProjectStatus; ?>">
                                <?php echo $ProjectStatus; ?>
                            </option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="On hold">On hold</option>
                            <option value="Approval pending">Approval pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Completed">Completed</option>
                            <option value="Discontinued">Discontinued</option>

                        </select>

                        <span class="error">*</span>

                        <br>

                        Admin (ID):<br>

                        <?php
                        $sql_admin = "SELECT adminID FROM admin";
                        ?>

                        <select name="adminID">

                            <option hidden value="<?php echo $adminID; ?>">
                                <?php echo $adminID; ?>
                            </option>

                            <option value="">Pending..</option>

                            <?php
                            foreach ($server_conn->query($sql_admin) as $admin_row) { // Array or records stored in $admin_row
                
                                echo "<option value=$admin_row[adminID]>$admin_row[adminID]</option>";

                                /* Option values are added by looping through the array */

                            }
                            ?>

                        </select>

                        <span class="error">*</span>

                        <br>

                        Construction Company:<br>

                        <?php
                        $sql_con_com = "SELECT ComName, conComID FROM constructionCompany";
                        ?>

                        <select name="conComID">

                            <option hidden value="<?php echo $conComID; ?>">
                                <?php echo $ComName; ?>
                            </option>

                            <option value="">Pending..</option>

                            <?php
                            foreach ($server_conn->query($sql_con_com) as $con_com_row) { // Array or records stored in $con_com_row
                
                                echo "<option value=$con_com_row[conComID]>$con_com_row[ComName]</option>";

                                /* Option values are added by looping through the array */

                            }
                            ?>
                        </select>

                        <span class="error">*</span>

                    <?php

                    }

                    // Construction Company
                    elseif (isset($_SESSION['conComID'])) {

                        ?>

                        Project Status:<br>

                        <select disabled>

                            <option selected>
                                <?php echo $ProjectStatus; ?>
                            </option>

                        </select>

                        <input type="hidden" name="ProjectStatus" value="<?php echo $ProjectStatus; ?>">

                        <br>

                        Admin (ID):<br>

                        <select disabled>

                            <option selected>
                                <?php echo $adminID; ?>
                            </option>

                        </select>

                        <input type="hidden" name="adminID" value="<?php echo $adminID; ?>">

                        <br>

                        Construction Company:<br>

                        <select disabled>

                            <option selected>
                                <?php echo $ComName; ?>
                            </option>

                        </select>

                        <input type="hidden" name="conComID" value="<?php echo $conComID; ?>">

                    <?php

                    }

                    ?>

                    <br>

                    <br><br>

                    <input type="submit" value="Update" name="update">

                </fieldset>

            </form>

        </body>

        </html>

    <?php

    } else {

        header('Location: ../projects_search.php');

    }

}

?>