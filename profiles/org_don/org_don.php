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
$OrgNameErr = $RegNoErr = $TINErr = $TelNoErr = $EmailErr = $PostalAddressErr = $PasswordErr = $regErr = "";

if (isset($_POST['update'])) {

    $OrgName = test_input($_POST["OrgName"]);
    $RegNo = test_input($_POST["RegNo"]);
    $Category = test_input($_POST["Category"]);
    $TIN = test_input($_POST["TIN"]);
    $TelNo = test_input($_POST["TelNo"]);
    $Email = test_input($_POST["Email"]);
    $Password = test_input($_POST["Password"]);
    $ConfPassword = test_input($_POST["ConfPassword"]);

    if (empty($_POST["PostalAddress"])) {
        $PostalAddress = $_POST['OldPostalAddress'];
    } else {
        $PostalAddress = $_POST['PostalAddress'];
    }

    $OrgName_len = strlen($OrgName);
    $RegNo_len = strlen($RegNo);
    $TIN_len = strlen($TIN);
    $Email_len = strlen($Email);
    $PostalAddress_len = strlen($PostalAddress);
    $Password_len = strlen($Password);
    $ConfPassword_len = strlen($ConfPassword);

    // required data validation
    if (empty($_POST["OrgName"])) {
        $OrgNameErr = "'Organization Name' is required";

    }
    if (empty($_POST["RegNo"])) {
        $RegNoErr = "'Registration Number' is required";

    }
    if (empty($_POST["TIN"])) {
        $TINErr = "'Taxpayer Identification Number' is required";

    }
    if (empty($_POST["TelNo"])) {
        $TelNoErr = "'Phone Number' is required";

    }
    if (empty($_POST["Email"])) {
        $EmailErr = "'Email' is required";

    }
    if (empty($_POST["Password"]) || empty($_POST["ConfPassword"])) {
        $PasswordErr = "'New Password' and 'Confirm New Password' fields are required";

    }

    // check if only contains numbers, letters and whitespaces
    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $OrgName)) and ($OrgNameErr == "")) {
        $OrgNameErr = "Only numbers, letters and white spaces allowed";

    }
    // please check about business Registration numbers
    // check if only contains letters and whitespace or null
    if (!preg_match("/^[0-9a-zA-Z]*$/", $RegNo) and ($RegNoErr == "")) {
        $RegNoErr = "Only letters and numbers allowed";

    }
    // please check about taxpayer identification numbers
    // check if only contains letters and whitespace or null
    if (!preg_match("/^[0-9a-zA-Z]*$/", $TIN) and ($TINErr == "")) {
        $TINErr = "Only letters and numbers allowed";

    }
    // check if only contains numbers and 10 digit limit
    if ((!preg_match("/^[0-9]{9,10}+$/", $TelNo)) and ($TelNoErr == "")) {
        $TelNoErr = "Only 10 digit numbers are allowed";

    }
    // check if e-mail address is well-formed or null
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL) and ($EmailErr == "")) {
        $EmailErr = "Invalid 'Email address' format";

    }
    // check if only contains certain characters
    if ((!preg_match("/^[.,\/\r\n0-9a-zA-Z-' ]*$/", $PostalAddress)) and !empty($PostalAddress)) {
        $PostalAddressErr = "Only numbers, letters, white spaces and .,/- characters are allowed";

    }

    // data length validation 
    if (!($OrgName_len > 0 and $OrgName_len <= 150) and ($OrgNameErr == "")) {
        $OrgNameErr = "Maximum 150 characters are allowed";

    }
    if (!($RegNo_len > 0 and $RegNo_len <= 20) and ($RegNoErr == "")) {
        $RegNoErr = "Maximum 20 characters are allowed";

    }
    if (!($TIN_len > 0 and $TIN_len <= 20) and ($TINErr == "")) {
        $TINErr = "Maximum 20 characters are allowed";

    }
    if (!($Email_len > 0 and $Email_len <= 150) and ($EmailErr == "")) {
        $EmailErr = "Maximum 150 characters are allowed";

    }
    if (!($PostalAddress_len >= 0 and $PostalAddress_len <= 500) and ($PostalAddressErr == "")) {
        $PostalAddressErr = "Maximum 500 characters are allowed";

    }
    if (!($Password_len >= 8 and $Password_len <= 30) || !($ConfPassword_len >= 8 and $ConfPassword_len <= 30) and ($PasswordErr == "")) {
        $PasswordErr = "Password must be in 8 - 30 character range";

    }

    // Call data submission
    if (
        ($OrgNameErr == "") and ($RegNoErr == "") and ($TINErr == "") and ($TelNoErr == "") and
        ($EmailErr == "") and ($PostalAddressErr == "") and ($PasswordErr == "") and ($regErr == "")
    ) {
        data_submission();

    }
}

function data_submission()
{
    include_once "../../db_conn.php";

    $orgDonorID = $_SESSION['orgDonorID'];

    global $OrgName, $Category, $RegNo, $TIN, $TelNo, $Email, $Password, $PostalAddress;

    $sql_check_email = "SELECT * FROM organizationalDonor WHERE Email='$Email' AND orgDonorID!='$orgDonorID'";
    $sql_check_regno = "SELECT * FROM organizationalDonor WHERE RegNo='$RegNo' AND orgDonorID!='$orgDonorID'";

    $result_check_email = mysqli_query($server_conn, $sql_check_email);
    $result_check_regno = mysqli_query($server_conn, $sql_check_regno);

    global $regErr;

    // check password matching
    if ($_POST['Password'] !== $_POST['ConfPassword']) {

        global $PasswordErr;

        $PasswordErr = "'New Password' and 'Confirm New Password' should match!";

    }
    // checking already registered emails
    elseif (mysqli_num_rows($result_check_email) > 0) {

        $row = mysqli_fetch_assoc($result_check_email);

        if ($row['Email'] === $Email) {

            $regErr = "Given 'Email Address' is already registered with the system, Please use the login option";
        }

    }
    // checking already registration
    elseif (mysqli_num_rows($result_check_regno) > 0) {

        $row = mysqli_fetch_assoc($result_check_regno);

        if ($row['RegNo'] === $RegNo) {

            $regErr = "Given 'Registration Number' is already registered with the system, Please use the login option";
        }

    }
    // information submission and update success
    else {
        // system update process
        $sql_update = "UPDATE organizationalDonor SET OrgName='$OrgName', RegNo='$RegNo', Category='$Category', TIN='$TIN', TelNo='$TelNo',
             Email='$Email', PostalAddress='$PostalAddress', Password='$Password' WHERE orgDonorID='$orgDonorID'";

        if (mysqli_query($server_conn, $sql_update)) {

            // system login process
            $sql_login = "SELECT * FROM organizationalDonor WHERE RegNo='$RegNo' AND Password='$Password'";

            $result = mysqli_query($server_conn, $sql_login);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['RegNo'] === $RegNo && $row['Password'] === $Password) {

                    echo "Profile Successfully Updated!";

                    $_SESSION['orgDonorID'] = $row['orgDonorID'];
                    $_SESSION['RegNo'] = $row['RegNo'];
                    $_SESSION['OrgName'] = $row['OrgName'];
                    $_SESSION['Category'] = $row['Category'];
                    $_SESSION['TIN'] = $row['TIN'];
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

if (isset($_SESSION['orgDonorID'])) {

    include "../../db_conn.php";

    $orgDonorID = $_SESSION['orgDonorID'];

    $sql_get = "SELECT * FROM organizationalDonor WHERE orgDonorID='$orgDonorID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $orgDonorID = $row['orgDonorID'];
            $OrgName = $row['OrgName'];
            $RegNo = $row['RegNo'];
            $Category = $row['Category'];
            $TIN = $row['TIN'];
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
                        <label for="OrgName">Organization Name</label>
                        <input type="text" id="OrgName" name="OrgName" placeholder="Organization Name"
                            value="<?php echo $OrgName; ?>">

                        <span class="error">*
                            <?php echo $OrgNameErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="RegNo">Registration Number</label>
                        <input type="text" id="RegNo" name="RegNo" placeholder="Registration Number"
                            value="<?php echo $RegNo; ?>">

                        <span class="error">*
                            <?php echo $RegNoErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="Category">Category</label>
                        <select id="Category" name="Category">

                            <option value="<?php echo $Category; ?>" selected hidden><?php echo $Category; ?></option>
                            <option value="Food Services">Food Services</option>
                            <option value="Accommodation and Food Services">Accommodation and Food Services
                            </option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Arts, Culture, Entertainment and Design">Arts, Culture, Entertainment
                                and Design</option>
                            <option value="Construction">Construction</option>
                            <option value="Education and Training">Education and Training</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Financial and Insurance">Financial and Insurance</option>
                            <option value="Fitness and Sport">Fitness and Sport</option>
                            <option value="Healthcare and Social Assistance">Healthcare and Social Assistance
                            </option>
                            <option value="Marketing and Advertising">Marketing and Advertising</option>
                            <option value="Mining">Mining</option>
                            <option value="Hairdressing and Beauty Services">Hairdressing and Beauty Services
                            </option>
                            <option value="Retail Trade">Retail Trade</option>
                            <option value="Wholesale Trade">Wholesale Trade</option>
                            <option value="Security">Security</option>
                            <option value="Telecommunication Services">Telecommunication Services</option>
                            <option value="IT Services">IT Services</option>
                            <option value="Public Services">Public Services</option>
                            <option value="Innovations">Innovations</option>
                            <option value="Other">Other</option>
                        </select>
                        <br>
                        <br>

                        <label for="TIN">Taxpayer Identification Number</label>
                        <input type="text" id="TIN" name="TIN" placeholder="Taxpayer Identification Number"
                            value="<?php echo $TIN; ?>">

                        <span class="error">*
                            <?php echo $TINErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="Email">Email</label>
                        <input type="email" id="Email" name="Email" placeholder="ex:- abcd@some.lk"
                            value="<?php echo $Email; ?>">

                        <span class="error">*
                            <?php echo $EmailErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="TelNo">Phone (+94)</label>
                        <input type="text" id="TelNo" name="TelNo" placeholder="Telephone Number" value="<?php echo $TelNo; ?>">

                        <span class="error">*
                            <?php echo $TelNoErr; ?>
                        </span>
                        <br>
                        <br>

                        <label for="Password">New Password</label>
                        <input type="password" id="password" name="Password">

                        <label for="ConfPassword">Confirm New Password</label>
                        <input type="password" id="confpassword" name="ConfPassword">

                        <span class="error">*
                            <?php echo $PasswordErr; ?>
                        </span>
                        <br>
                        <!-- toggle between password visibility -->
                        <input type="checkbox" onclick="shPass()">Show Password
                        <br>
                        <br>

                        <label for="address">Postal Address</label>
                        <br>
                        <textarea name="PostalAddress" placeholder="<?php echo $PostalAddress; ?>"></textarea>

                        <span class="error">*
                            <?php echo $PostalAddressErr; ?>
                        </span>

                        <input type="hidden" name="OldPostalAddress" value="<?php echo $PostalAddress; ?>">
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