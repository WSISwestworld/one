<?php

include "../db_conn.php";

session_start();

if (isset($_POST['submit'])) {

    // define variables and set to empty values
    $titleErr = $descriptionErr = $areaErr = $timeErr = $costErr = $statusErr = "";

    $ProjectTitle = $_POST['ProjectTitle'];
    $Description = $_POST['Description'];
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

    if (empty($_POST["Description"])) {
        $descriptionErr = "'Description' is required";
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

    if (empty($_POST["ProjectStatus"])) {
        $statusErr = "'Project Status' is required";
    }


    // check if only contains numbers and letters
    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $ProjectTitle)) and ($titleErr == "")) {
        $titleErr = "Only numbers, letters and whitespaces are allowed";

    }

    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $Description)) and ($descriptionErr == "")) {
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


    if (
        ($titleErr == "") and ($descriptionErr == "") and ($areaErr == "") and ($timeErr == "") and
        ($costErr == "") and ($statusErr == "") and ($conComErr == "")
    ) {

        if ((empty($_POST['conComID'])) and (empty($_POST['adminID']))) {

            $sql_add = "INSERT INTO project (ProjectTitle, Description, ProjectArea, EstimatedTime, EstimatedCost, ProjectStatus)
        VALUES ('$ProjectTitle','$Description','$ProjectArea','$EstimatedTime','$EstimatedCost','$ProjectStatus')";

        } elseif (empty($_POST['adminID'])) {

            $sql_add = "INSERT INTO project (ProjectTitle, Description, ProjectArea, EstimatedTime, EstimatedCost, ProjectStatus, conComID)
        VALUES ('$ProjectTitle','$Description','$ProjectArea','$EstimatedTime','$EstimatedCost','$ProjectStatus','$conComID')";

        } elseif (empty($_POST['conComID'])) {

            $sql_add = "INSERT INTO project (ProjectTitle, Description, ProjectArea, EstimatedTime, EstimatedCost, ProjectStatus, adminID)
        VALUES ('$ProjectTitle','$Description','$ProjectArea','$EstimatedTime','$EstimatedCost','$ProjectStatus','$adminID')";

        } else {

            $sql_add = "INSERT INTO project (ProjectTitle, Description, ProjectArea, EstimatedTime, EstimatedCost, ProjectStatus, adminID, conComID)
        VALUES ('$ProjectTitle','$Description','$ProjectArea','$EstimatedTime','$EstimatedCost','$ProjectStatus','$adminID','$conComID')";

        }


        $add_result = $server_conn->query($sql_add);

        if ($add_result == TRUE) {

            echo "New Project added successfully";

            header('Location: projects.php');

        } else {

            echo "Error:" . $sql_add . "<br>" . $server_conn->error;

        }

    }

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

    <h2>Create New Project</h2>

    <form action="" method="post">

        <fieldset>

            <legend>Project information:</legend>

            Project Title:<br>

            <input type="text" name="ProjectTitle" placeholder="Project Title">

            <span class="error">* <?php echo $titleErr; ?></span>

            <br>

            Description:<br>

            <textarea name="Description" placeholder="Description"></textarea>

            <span class="error">* <?php echo $descriptionErr; ?></span>

            <br>

            Project Area:<br>

            <input type="text" name="ProjectArea" placeholder="Project Area">

            <span class="error">* <?php echo $areaErr; ?></span>

            <br>

            Estimated Time:<br>

            <input type="text" name="EstimatedTime" placeholder="Estimated Time">

            <span class="error">* <?php echo $timeErr; ?></span>

            <br>

            Estimated Cost:<br>

            <input type="text" name="EstimatedCost" placeholder="Estimated Cost">

            <span class="error">* <?php echo $costErr; ?></span>

            <br>

            <?php

            // Administrator
            if (isset($_SESSION['adminID'])) {

                ?>

                Project Status:<br>

                <select name="ProjectStatus">
                    <option value="Approval pending">Approval pending</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="On hold">On hold</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Completed">Completed</option>
                    <option value="Discontinued">Discontinued</option>

                </select>

                <span class="error">* <?php echo $statusErr; ?></span>

                <br>

                Admin (ID):<br>

                <?php
                $sql_admin = "SELECT adminID FROM admin";
                ?>

                <select name="adminID">

                    <option value="" selected>Pending..</option>

                    <?php
                    foreach ($server_conn->query($sql_admin) as $admin_row) { // Array or records stored in $admin_row
                
                        echo "<option value=$admin_row[adminID]>$admin_row[adminID]</option>";

                        /* Option values are added by looping through the array */

                    }
                    ?>

                </select>

                <span class="error">* </span>

                <br>

                Construction Company:<br>

                <?php
                $sql_con_com = "SELECT ComName, conComID FROM constructionCompany";
                ?>

                <select name="conComID">

                    <option value="" selected>Pending..</option>

                    <?php
                    foreach ($server_conn->query($sql_con_com) as $con_com_row) { // Array or records stored in $con_com_row
                
                        echo "<option value=$con_com_row[conComID]>$con_com_row[ComName]</option>";

                        /* Option values are added by looping through the array */

                    }
                    ?>
                </select>

                <span class="error">* <?php echo $conComErr; ?></span>


            <?php

            }
            // Construction Company
            elseif (isset($_SESSION['conComID'])) {

                ?>

                Project Status:<br>

                <select disabled>

                    <option selected>Approval pending</option>

                </select>

                <input type="hidden" name="ProjectStatus" value="Approval pending">

                <br>

                Admin (ID):<br>

                <select disabled>

                    <option selected>Pending..</option>

                </select>

                <input type="hidden" name="adminID" value="">

                <br>

                Construction Company:<br>

                <?php

                $conCom_id = $_SESSION['conComID'];
                $conCom_na = $_SESSION['ComName'];

                ?>

                <select disabled>

                    <option selected>
                        <?php echo $conCom_na; ?>
                    </option>

                </select>

                <input type="hidden" name="conComID" value="<?php echo $conCom_id; ?>">
            <?php

            }

            ?>

            <br>

            <br><br>

            <input type="submit" value="Create" name="submit">

        </fieldset>

    </form>

</body>

</html>