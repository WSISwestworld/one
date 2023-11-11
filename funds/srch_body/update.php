<?php

include "../../db_conn.php";

session_start();

if (isset($_POST['update'])) {

    // define variables and set to empty values
    $AmountErr = $DateErr = $IDErr = "";

    $fundID = $_POST['fundID'];
    $Amount = $_POST['Amount'];
    $Date = $_POST['Date'];
    $donorID = $_POST['donorID'];
    $orgDonorID = $_POST['orgDonorID'];
    $fundRaiseID = $_POST['fundRaiseID'];

    $Name_len = strlen($Name);
    $Description_len = strlen($Description);

    // required data validation
    if (empty($_POST["Amount"])) {
        $AmountErr = "'Amount' is required";
    }

    if (empty($_POST["Date"])) {
        $DateErr = "'Date' is required";
    }

    // ID validation
    if (empty($donorID) and empty($orgDonorID) and empty($fundRaiseID)) {

        $IDErr = "Least One ID should be added";

    } elseif (empty($donorID) and empty($orgDonorID)) {

        $sql_update = "UPDATE fund SET `Amount`='$Amount', `Date`='$Date', `fundRaiseID`='$fundRaiseID' 
        WHERE `fundID`='$fundID'";

    } elseif (empty($orgDonorID) and empty($fundRaiseID)) {

        $sql_update = "UPDATE fund SET `Amount`='$Amount', `Date`='$Date', `donorID`='$donorID' 
        WHERE `fundID`='$fundID'";

    } elseif (empty($fundRaiseID) and empty($donorID)) {

        $sql_update = "UPDATE fund SET `Amount`='$Amount', `Date`='$Date', `orgDonorID`='$orgDonorID' 
        WHERE `fundID`='$fundID'";

    } else {

        $IDErr = "Only One ID should be added";

    }


    if (
        ($AmountErr == "") and ($DateErr == "") and ($IDErr == "")
    ) {

        $add_result = $server_conn->query($sql_update);

        if ($add_result == TRUE) {

            echo "Fund updated successfully";

            header('Location: ../funds_search.php');

        } else {

            echo "Error:" . $sql_update . "<br>" . $server_conn->error;

        }
    }
}

if (isset($_GET['id'])) {

    $fundID = $_GET['id'];

    $sql_get = "SELECT * FROM fund LEFT JOIN personalDonor ON fund.donorID = personalDonor.donorID LEFT JOIN fundRaise ON 
    fund.fundRaiseID = fundRaise.fundRaiseID LEFT JOIN organizationalDonor ON fund.orgDonorID = organizationalDonor.orgDonorID WHERE fund.fundID='$fundID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $fundID = $row['fundID'];

            $Amount = $row['Amount'];

            $Date = $row['Date'];


            // Personal Donor
            $FName = $row['FName'];

            $NIC = $row['NIC'];

            $donorID = $row['donorID'];


            // Organizational Donor
            $OrgName = $row['OrgName'];

            $RegNo = $row['RegNo'];

            $orgDonorID = $row['orgDonorID'];


            // Fundraise
            $Name = $row['Name'];

            $EventDate = $row['EventDate'];

            $fundRaiseID = $row['fundRaiseID'];

        }
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <title>WSIS | FUNDS</title>

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
                <h2>Update Fund</h2>

                <form action="" method="post">

                    <fieldset>

                        <legend>Fund information:</legend>

                        Amount:<br>

                        <input type="number" step="0.01" name="Amount" placeholder="RS." value="<?php echo $Amount; ?>">

                        <span class="error">*
                            <?php echo $AmountErr; ?>
                        </span>

                        <input type="hidden" name="fundID" value="<?php echo $fundID; ?>">

                        <br>

                        Date:<br>

                        <input type="date" name="Date" value="<?php echo $Date; ?>">

                        <span class="error">*
                            <?php echo $DateErr; ?>
                        </span>

                        <br>

                        Personal Donor (ID):<br>

                        <?php
                        $sql_pdon = "SELECT * FROM personalDonor";
                        ?>

                        <select name="donorID">

                            <option value="<?php echo $donorID; ?>" selected hidden>
                                <?php echo $donorID . " - " . $FName . " - " . $NIC; ?>
                            </option>

                            <option value="">
                                None
                            </option>

                            <?php
                            foreach ($server_conn->query($sql_pdon) as $pdon_row) { // Array or records stored in $admin_row
                    
                                echo "<option value=$pdon_row[donorID]>$pdon_row[donorID]" . " - " .
                                    "$pdon_row[FName]" . " - " . "$pdon_row[NIC]</option>";

                                /* Option values are added by looping through the array */

                            }
                            ?>

                        </select>


                        <br>

                        Organizational Donor (ID):<br>

                        <?php
                        $sql_orgdon = "SELECT * FROM organizationalDonor";
                        ?>

                        <select name="orgDonorID">

                            <option value="<?php echo $orgDonorID; ?>" selected hidden>
                                <?php echo $orgDonorID . " - " . $OrgName . " - " . $RegNo; ?>
                            </option>

                            <option value="">
                                None
                            </option>

                            <?php
                            foreach ($server_conn->query($sql_orgdon) as $orgdon_row) { // Array or records stored in $admin_row
                    
                                echo "<option value=$orgdon_row[orgDonorID]>$orgdon_row[orgDonorID]" . " - " .
                                    "$orgdon_row[OrgName]" . " - " . "$orgdon_row[RegNo]</option>";

                                /* Option values are added by looping through the array */

                            }
                            ?>

                        </select>

                        <br>

                        Fundraise (ID):<br>

                        <?php
                        $sql_fundraise = "SELECT * FROM fundRaise";
                        ?>

                        <select name="fundRaiseID">

                            <option value="<?php echo $fundRaiseID; ?>" selected hidden>
                                <?php echo $fundRaiseID . " - " . $Name . " - " . $EventDate; ?>
                            </option>

                            <option value="">
                                None
                            </option>

                            <?php
                            foreach ($server_conn->query($sql_fundraise) as $fundraise_row) { // Array or records stored in $admin_row
                    
                                echo "<option value=$fundraise_row[fundRaiseID]>$fundraise_row[fundRaiseID]" . " - " .
                                    "$fundraise_row[Name]" . " - " . "$fundraise_row[EventDate]</option>";

                                /* Option values are added by looping through the array */

                            }
                            ?>

                        </select>

                        <br>

                        <span class="error">
                            <?php echo $IDErr; ?>
                        </span>

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

        header('Location: ../funds_search.php');
    }
}
?>