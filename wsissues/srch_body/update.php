<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | WATER SUPPLY ISSUES</title>

    <link rel="stylesheet" href="../styles.css">

    <Style>
        .error {
            color: #FF0000;
        }
    </Style>

</head>

<body>

    <?php
    session_start();

    include_once "../../db_conn.php";

    // define variables and set to empty values
    $locationErr = $durationErr = $descriptionErr = "";

    if (isset($_POST['update'])) {

        $issueID = test_input($_POST["issueID"]);
        $district = test_input($_POST["district"]);
        $location = test_input($_POST["location"]);
        $probtype = test_input($_POST["probtype"]);
        $duration = test_input($_POST["duration"]);

        if (empty($_POST["description"])) {
            $description = test_input($_POST['OldDescription']);
        } else {
            $description = test_input($_POST['description']);
        }

        $issueStatus = test_input($_POST["issueStatus"]);
        $adminID = test_input($_POST["adminID"]);

        $location_len = strlen($location);
        $description_len = strlen($description);

        // required data validation
        if (empty($_POST["location"])) {
            $locationErr = "'Location' is required";

        }
        if (empty($_POST["duration"])) {
            $durationErr = "'Problem Duration' is required";

        }
        if (empty($description)) {
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
        if (!($description_len > 0 and $description_len <= 1200)) {
            $descriptionErr = "Maximum 1200 characters are allowed";

        }

        // Call data submission
        if (
            ($locationErr == "") and ($durationErr == "") and ($descriptionErr == "")
        ) {

            if (empty($_POST["adminID"])) {

                $sql_update = "UPDATE `waterSupplyIssue` SET `IssueType`='$probtype',`District`='$district',`Location`='$location',
                `DurationOfIssue`='$duration',`Description`='$description',`Status`='$issueStatus',`adminID`=NULL WHERE `issueID`='$issueID'";

            } else {

                $sql_update = "UPDATE `waterSupplyIssue` SET `IssueType`='$probtype',`District`='$district',`Location`='$location',
                `DurationOfIssue`='$duration',`Description`='$description',`Status`='$issueStatus',`adminID`='$adminID' WHERE `issueID`='$issueID'";

            }

            // issue submittion process
            if (mysqli_query($server_conn, $sql_update)) {

                echo "Issue Updated Successfully";

                header('Location: ../wsissues_search.php');

            }
            // server error
            else {

                echo "Error: " . $sql_update . "<br>" . mysqli_error($server_conn);

            }

            mysqli_close($server_conn);

        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_GET['id'])) {

        $issueID = $_GET['id'];

        $sql_get = "SELECT * FROM `waterSupplyIssue` WHERE issueID='$issueID'";

        $get_result = $server_conn->query($sql_get);

        if ($get_result->num_rows > 0) {

            while ($row = $get_result->fetch_assoc()) {

                $issueID = $row['issueID'];

                $IssueType = $row['IssueType'];

                $District = $row['District'];

                $Location = $row['Location'];

                $DurationOfIssue = $row['DurationOfIssue'];

                $Description = $row['Description'];

                $Status = $row['Status'];

                $adminID = $row['adminID'];

            }
            ?>

            <!--head-->
            <div class="header">
                <img src="../../waterDropLogo.png" height="90px" width="640px" alt="Logo">
            </div>

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
                            <a href="../../fundraise/fundraise_search.php">Search Fundraises</a>
                            <a href="../../fundraise/fundraise.php">All Fundraises</a>
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
                                <a href="#">Profile</a>
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

                <h3 style="text-align: center; color: #187efa;">Update Water Supply Issue</h3>

                <table class="container">
                    <form action="" method="post">
                        <tr>
                            <td>
                                <label for="district">District</label>

                                <select id="district" name="district">

                                    <option hidden value="<?php echo $District; ?>">
                                        <?php echo $District; ?>
                                    </option>
                                    <option value="Ampara">Ampara</option>
                                    <option value="Anuradhapura">Anuradhapura</option>
                                    <option value="Badulla">Badulla</option>
                                    <option value="Batticaloa">Batticaloa</option>
                                    <option value="Colombo">Colombo</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Gampaha">Gampaha</option>
                                    <option value="Hambantota">Hambantota</option>
                                    <option value="Jaffna">Jaffna</option>
                                    <option value="Kalutara">Kalutara</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Kegalle">Kegalle</option>
                                    <option value="Kilinochchi">Kilinochchi</option>
                                    <option value="Kurunegala">Kurunegala</option>
                                    <option value="Mannar">Mannar</option>
                                    <option value="Matale">Matale</option>
                                    <option value="Matara">Matara</option>
                                    <option value="Monaragala">Monaragala</option>
                                    <option value="Mullaitivu">Mullaitivu</option>
                                    <option value="Nuwara eliya">Nuwara Eliya</option>
                                    <option value="Polonnaruwa">Polonnaruwa</option>
                                    <option value="Puttalam">Puttalam</option>
                                    <option value="Ratnapura">Ratnapura</option>
                                    <option value="Trincomalee">Trincomalee</option>
                                    <option value="Vavuniya">Vavuniya</option>
                                </select>
                            </td>
                            <td>
                                <span class="error">*</span>
                            </td>
                            <td>
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" value="<?php echo $Location; ?>">
                            </td>
                            <td>
                                <span class="error">* <?php echo $locationErr; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="probtype">Problem Type</label>
                                <select id="probtype" name="probtype">

                                    <option hidden value="<?php echo $IssueType; ?>">
                                        <?php echo $IssueType; ?>
                                    </option>
                                    <option value="typ1">Type1</option>
                                    <option value="typ2">Type2</option>
                                </select>
                            </td>
                            <td>
                                <span class="error">*</span>
                            </td>
                            <td>
                                <label for="duration">How long did you facing the problem?<br>(In months)</label>
                                <input type="number" id="duration" name="duration" min="1" max="240"
                                    value="<?php echo $DurationOfIssue; ?>">
                            </td>
                            <td>
                                <span class="error">* <?php echo $durationErr; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="description">Description</label>
                                <textarea id="description" name="description" placeholder="<?php echo $Description; ?>"
                                    style="height:200px"></textarea>
                            </td>
                            <td>
                                <span class="error">* <?php echo $descriptionErr; ?></span>

                                <input type="hidden" name="OldDescription" value="<?php echo $Description; ?>">
                            </td>
                            <td>
                                <label for="status">Status</label>

                                <select name="issueStatus">
                                    <option hidden value="<?php echo $Status; ?>">
                                        <?php echo $Status; ?>
                                    </option>
                                    <option value="Pending..">Pending..</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Ignored">Ignored</option>
                                    <option value="Further investigation required">Further investigation required</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="status">Admin (ID)</label>

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
                            </td>
                            <td>
                                <input type="hidden" name="issueID" value="<?php echo $issueID; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Update" name="update">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>

        <?php

        } else {

            header('Location: ../wsissues.php');

        }
    }

    ?>

    <script src="../../app.js"></script>

</body>

</html>