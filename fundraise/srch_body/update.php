<?php

include "../../db_conn.php";

session_start();

if (isset($_POST['update'])) {

    // define variables and set to empty values
    $NameErr = $DescriptionErr = $EventDateErr = "";

    $fundRaiseID = $_POST['fundRaiseID'];
    $Name = $_POST['Name'];

    if (empty($_POST["Description"])) {
        $Description = $_POST['OldDescription'];
    } else {
        $Description = $_POST['Description'];
    }

    $EventDate = $_POST['EventDate'];
    $adminID = $_POST['adminID'];

    $Name_len = strlen($Name);
    $Description_len = strlen($Description);

    // required data validation
    if (empty($_POST["Name"])) {
        $NameErr = "'Name' is required";
    }

    if (empty($Description)) {
        $DescriptionErr = "'Description' is required";
    }

    if (empty($_POST["EventDate"])) {
        $EventDateErr = "'Event Date' is required";
    }

    // check if only contains numbers, letters and whitespaces
    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $Name)) and ($NameErr == "")) {
        $NameErr = "Only numbers, letters and whitespaces are allowed";

    }

    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $Description)) and ($DescriptionErr == "")) {
        $DescriptionErr = "Only numbers, letters and whitespaces are allowed";

    }

    // data length validation
    if (!($Name_len > 0 and $Name_len <= 250) and ($NameErr == "")) {
        $NameErr = "Maximum 250 characters are allowed";

    }
    if (!($Description_len > 0 and $Description_len <= 600) and ($DescriptionErr == "")) {
        $DescriptionErr = "Maximum 600 characters are allowed";

    }

    if (
        ($NameErr == "") and ($DescriptionErr == "") and ($EventDateErr == "") and ($adminIDErr == "")
    ) {

        $sql_update = "UPDATE `fundRaise` SET `Name`='$Name',`Description`='$Description',`EventDate`='$EventDate',`adminID`='$adminID' WHERE `fundRaiseID`='$fundRaiseID'";

        $update_result = $server_conn->query($sql_update);

        if ($update_result == TRUE) {

            echo "Fundraise Updated Successfully";

            header('Location: ../fundraise_search.php');

        } else {

            echo "Error:" . $sql_update . "<br>" . $server_conn->error;

        }
    }
}

if (isset($_GET['id'])) {

    $fundRaiseID = $_GET['id'];

    $sql_get = "SELECT * FROM `fundRaise` WHERE fundRaiseID='$fundRaiseID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $fundRaiseID = $row['fundRaiseID'];

            $Name = $row['Name'];

            $Description = $row['Description'];

            $EventDate = $row['EventDate'];

            $adminID = $row['adminID'];

        }
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <title>WSIS | FUNDRAISE</title>

            <link rel="stylesheet" href="../styles.css">

            <style>
                .error {
                    color: #FF0000;
                }
            </style>

        </head>

        <body>

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
                <h2>Update Fundraise</h2>

                <form action="" method="post">

                    <fieldset>

                        <legend>Fundraise information:</legend>

                        Name:<br>

                        <input type="text" name="Name" placeholder="Name" value="<?php echo $Name; ?>">

                        <span class="error">*
                            <?php echo $NameErr; ?>
                        </span>

                        <input type="hidden" name="fundRaiseID" value="<?php echo $fundRaiseID; ?>">

                        <br>

                        Description:<br>

                        <textarea name="Description" placeholder="<?php echo $Description; ?>"></textarea>

                        <span class="error">*
                            <?php echo $DescriptionErr; ?>
                        </span>

                        <input type="hidden" name="OldDescription" value="<?php echo $Description; ?>">

                        <br>

                        Date of the Event:<br>

                        <input type="date" name="EventDate" value="<?php echo $EventDate; ?>">

                        <span class="error">*
                            <?php echo $EventDateErr; ?>
                        </span>

                        <br>

                        Admin (ID):<br>

                        <?php
                        $sql_admin = "SELECT adminID FROM admin";
                        ?>

                        <select name="adminID">

                            <option value='<?php echo $adminID; ?>' selected hidden>
                                <?php echo $adminID; ?>
                            </option>

                            <?php
                            foreach ($server_conn->query($sql_admin) as $admin_row) { // Array or records stored in $admin_row
                    
                                echo "<option value=$admin_row[adminID]>$admin_row[adminID]</option>";

                                /* Option values are added by looping through the array */

                            }
                            ?>

                        </select>

                        <span class="error">* </span>

                        <br>

                        <br><br>

                        <input type="submit" value="Update" name="update">

                    </fieldset>

                </form>
            </div>

            <script src="../../app.js"></script>
        </body>

        </html>

    <?php
    } else {

        header('Location: fundraise_search.php');
    }
}
?>