<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | My Profile</title>

    <link rel="stylesheet" href="../../ls/signup_styles.css">

    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<?php

session_start();

if (isset($_POST['cancel'])) {
    header("Location: ../../dashboard/dashboard.php");
}

// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $designationErr = $phoneErr = $nicErr = $newpasswordErr = $addressErr = $regErr = "";

if (isset($_POST['update'])) {

    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $designation = test_input($_POST["designation"]);
    $nic = test_input($_POST["nic"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);

    if (empty($_POST["address"])) {
        $address = $_POST['oldaddress'];
    } else {
        $address = $_POST['address'];
    }

    $newpassword = test_input($_POST["newpassword"]);
    $confnewpassword = test_input($_POST["confnewpassword"]);

    $fname_len = strlen($fname);
    $lname_len = strlen($lname);
    $designation_len = strlen($designation);
    $email_len = strlen($email);
    $address_len = strlen($address);
    $newpassword_len = strlen($newpassword);
    $confnewpassword_len = strlen($confnewpassword);

    // required data validation
    if (empty($_POST["fname"])) {
        $fnameErr = "'First Name' is required";

    }
    if (empty($_POST["designation"])) {
        $designationErr = "'Designation' is required";

    }
    if (empty($_POST["nic"])) {
        $nicErr = "'National Identity Card Number' is required";

    }
    if (empty($_POST["phone"])) {
        $phoneErr = "'Phone Number' is required";

    }
    if (empty($_POST["email"])) {
        $emailErr = "'Email' is required";

    }
    if (empty($address)) {
        $addressErr = "'Postal Address' is required";

    }
    if (empty($_POST["newpassword"]) || empty($_POST["confnewpassword"])) {
        $newpasswordErr = "'New Password' and 'Confirm New Password' fields are required";

    }

    // check if only contains letters and whitespace
    if ((!preg_match("/^[a-zA-Z-' ]*$/", $fname)) and ($fnameErr == "")) {
        $fnameErr = "Only letters and white spaces allowed";

    }
    // check if only contains letters and whitespace or null
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lname) and !empty($_POST["lname"])) {
        $lnameErr = "Only letters and white spaces allowed";

    }
    // check if only contains letters and whitespace
    if ((!preg_match("/^[a-zA-Z-' ]*$/", $designation)) and ($designationErr == "")) {
        $designationErr = "Only letters and white spaces allowed";

    }
    // check if only contains digits with 'V' character and 10, 12 character limit
    if ((!preg_match("/^[0-9vV]{10,12}+$/", $nic)) and ($nicErr == "")) {
        $nicErr = "Only 9 digits with 'V' or 12 digits are allowed";

    }
    // check if only contains numbers and 10 digit limit
    if ((!preg_match("/^[0-9]{9,10}+$/", $phone)) and ($phoneErr == "")) {
        $phoneErr = "Only 10, 9 digit numbers are allowed";

    }
    // check if e-mail address is well-formed or null
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) and ($emailErr == "")) {
        $emailErr = "Invalid 'Email address' format";

    }
    // check if only contains certain characters
    if ((!preg_match("/^[.,\/\r\n0-9a-zA-Z-' ]*$/", $address)) and ($addressErr == "")) {
        $addressErr = "Only numbers, letters, white spaces and .,/- characters are allowed";

    }

    // data length validation 
    if (!($fname_len > 0 and $fname_len <= 100) and ($fnameErr == "")) {
        $fnameErr = "Maximum 100 characters are allowed";

    }
    if (!($lname_len >= 0 and $lname_len <= 150) and ($lnameErr == "")) {
        $lnameErr = "Maximum 150 characters are allowed";

    }
    if (!($designation_len > 0 and $designation_len <= 150) and ($designationErr == "")) {
        $designationErr = "Maximum 150 characters are allowed";

    }
    if (!($email_len > 0 and $email_len <= 150) and ($emailErr == "")) {
        $emailErr = "Maximum 150 characters are allowed";

    }
    if (!($address_len > 0 and $address_len <= 500) and ($addressErr == "")) {
        $addressErr = "Maximum 500 characters are allowed";

    }
    if (!($newpassword_len >= 8 and $newpassword_len <= 30) || !($confnewpassword_len >= 8 and $confnewpassword_len <= 30) and ($newpasswordErr == "")) {
        $newpasswordErr = "New Password must be in 8 - 30 character range";

    }

    // NIC calculations
    include_once "../../ls/nic_cal.php";

    // Call data submission
    if (
        ($fnameErr == "") and ($lnameErr == "") and ($emailErr == "") and ($designationErr == "") and ($phoneErr == "") and
        ($nicErr == "") and ($newpasswordErr == "") and ($addressErr == "") and ($regErr == "")
    ) {
        data_submission();

    }
}

function data_submission()
{
    include "../../db_conn.php";

    $adminID = test_input($_POST["adminID"]);

    global $fname, $lname, $designation, $nic, $dob, $gender, $phone, $email, $address, $newpassword;

    $sql_check_email = "SELECT * FROM admin WHERE Email='$email' AND adminID!='$adminID'";
    $sql_check_nic = "SELECT * FROM admin WHERE NIC='$nic' AND adminID!='$adminID'";

    $result_check_email = mysqli_query($server_conn, $sql_check_email);
    $result_check_nic = mysqli_query($server_conn, $sql_check_nic);

    global $regErr, $newpasswordErr;

    // check new password matching
    if ($_POST['newpassword'] !== $_POST['confnewpassword']) {

        $newpasswordErr = "'New Password' and 'Confirm New Password' should match!";

    }
    // checking already registered emails
    elseif (mysqli_num_rows($result_check_email) > 0) {

        $row = mysqli_fetch_assoc($result_check_email);

        if ($row['Email'] === $email) {

            $regErr = "Given 'Email Address' is already registered with the system, Please use the login option";
        }

    }
    // checking already registration
    elseif (mysqli_num_rows($result_check_nic) > 0) {

        $row = mysqli_fetch_assoc($result_check_nic);

        if ($row['NIC'] === $nic) {

            $regErr = "Given 'NIC' is already registered with the system, Please use the login option";
        }

    }
    // information submission and update success
    else {
        // system update process
        $sql_update = "UPDATE `admin` SET `FName`='$fname', `LName`='$lname', `Designation`='$designation', `NIC`='$nic', `DOB`='$dob', `TelNo`='$phone',
        `Email`='$email', `PostalAddress`='$address', `Password`='$newpassword', `Gender`='$gender' WHERE `adminID`='$adminID'";

        if (mysqli_query($server_conn, $sql_update)) {

            // system login process
            $sql_login = "SELECT * FROM admin WHERE adminID='$adminID' AND Password='$newpassword'";

            $result = mysqli_query($server_conn, $sql_login);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['adminID'] === $adminID && $row['Password'] === $newpassword) {

                    echo "Profile Successfully Updated!";

                    $_SESSION['adminID'] = $row['adminID'];
                    $_SESSION['FName'] = $row['FName'];
                    $_SESSION['LName'] = $row['LName'];
                    $_SESSION['Designation'] = $row['Designation'];
                    $_SESSION['NIC'] = $row['NIC'];
                    $_SESSION['DOB'] = $row['DOB'];
                    $_SESSION['Gender'] = $row['Gender'];
                    $_SESSION['TelNo'] = $row['TelNo'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['PostalAddress'] = $row['PostalAddress'];

                    header("Location: ../../dashboard/dashboard.php");
                    exit();
                }
            }
            exit();
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

if (isset($_SESSION['adminID'])) {

    include "../../db_conn.php";

    $adminID = $_SESSION['adminID'];

    $sql_get = "SELECT * FROM admin WHERE adminID='$adminID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $adminID = $row['adminID'];
            $FName = $row['FName'];
            $LName = $row['LName'];
            $Designation = $row['Designation'];
            $NIC = $row['NIC'];
            $TelNo = $row['TelNo'];
            $Email = $row['Email'];
            $PostalAddress = $row['PostalAddress'];

        }

        ?>

        <body>
            <!--head-->
            <div class="header">
                <img src="../../waterDropLogo.png" height="90px" width="640px" alt="Logo" class="center">
            </div>

            <div class="content">

                <form action="" method="POST">

                    <fieldset>

                        <legend>Your Profile</legend>
                        <br>

                        <label for="adminID">Admin (ID)</label>
                        <input type="text" value="<?php echo $adminID; ?>" disabled>
                        <input type="hidden" name="adminID" value="<?php echo $adminID; ?>">
                        <br>
                        <br>

                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="Your first name here.."
                            value="<?php echo $FName; ?>">

                        <span class="error">*
                            <?php echo $fnameErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Your last name here.."
                            value="<?php echo $LName; ?>">

                        <span class="error">
                            <?php echo $lnameErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="designation">Designation</label>
                        <input type="text" id="designation" name="designation" placeholder="Designation"
                            value="<?php echo $Designation; ?>">

                        <span class="error">*
                            <?php echo $designationErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="ex:- abcd@some.lk"
                            value="<?php echo $Email; ?>">

                        <span class="error">*
                            <?php echo $emailErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="phone">Phone (+94)</label>
                        <input type="text" id="phone" name="phone" placeholder="Telephone Number" value="<?php echo $TelNo; ?>">

                        <span class="error">*
                            <?php echo $phoneErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="nic">NIC</label>
                        <input type="text" id="nic" name="nic" placeholder="National Identity Card Number"
                            value="<?php echo $NIC; ?>">

                        <span class="error">*
                            <?php echo $nicErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="newpassword">New Password</label>
                        <input type="password" id="password" name="newpassword">

                        <label for="confnewpassword">Confirm New Password</label>
                        <input type="password" id="confpassword" name="confnewpassword">

                        <span class="error">*
                            <?php echo $newpasswordErr; ?>
                        </span>
                        <br>
                        <!-- toggle between password visibility -->
                        <input type="checkbox" onclick="shPass()">Show Password
                        <br>
                        <br>

                        <label for="address">Postal Address</label>
                        <br>
                        <textarea name="address" placeholder="<?php echo $PostalAddress; ?>"></textarea>

                        <span class="error">*
                            <?php echo $addressErr; ?>
                        </span>

                        <input type="hidden" name="oldaddress" value="<?php echo $PostalAddress; ?>">
                        <br>

                        <span class="error">
                            <?php echo $regErr; ?>
                        </span>
                        <br>

                        <input type="submit" value="Cancel" name="cancel">
                        <input type="submit" value="Update" name="update">

                    </fieldset>

                </form>
            </div>

            <script src="../../ls/pass.js"></script>

        </body>
    <?php

    } else {

        header('Location: ../../dashboard/dashboard.php');

    }

}
?>

</html>