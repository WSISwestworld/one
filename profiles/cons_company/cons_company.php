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
$ComNameErr = $RegNoErr = $TINErr = $TelNoErr = $EmailErr = $PostalAddressErr = $PasswordErr = $regErr = "";

if (isset($_POST['update'])) {

    $ComName = test_input($_POST["ComName"]);
    $RegNo = test_input($_POST["RegNo"]);
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

    $ComName_len = strlen($ComName);
    $RegNo_len = strlen($RegNo);
    $TIN_len = strlen($TIN);
    $Email_len = strlen($Email);
    $PostalAddress_len = strlen($PostalAddress);
    $Password_len = strlen($Password);
    $ConfPassword_len = strlen($ConfPassword);

    // required data validation
    if (empty($_POST["ComName"])) {
        $ComNameErr = "'Company Name' is required";

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
    if (empty($PostalAddress)) {
        $PostalAddressErr = "'Postal Address' is required";

    }
    if (empty($_POST["Password"]) || empty($_POST["ConfPassword"])) {
        $PasswordErr = "'New Password' and 'Confirm New Password' fields are required";

    }

    // check if only contains numbers, letters and whitespaces
    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $ComName)) and ($ComNameErr == "")) {
        $ComNameErr = "Only numbers, letters and white spaces allowed";

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
    if ((!preg_match("/^[.,\/\r\n0-9a-zA-Z-' ]*$/", $PostalAddress)) and ($PostalAddressErr == "")) {
        $PostalAddressErr = "Only numbers, letters, white spaces and .,/- characters are allowed";

    }

    // data length validation 
    if (!($ComName_len > 0 and $ComName_len <= 150) and ($ComNameErr == "")) {
        $ComNameErr = "Maximum 150 characters are allowed";

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
    if (!($PostalAddress_len > 0 and $PostalAddress_len <= 500) and ($PostalAddressErr == "")) {
        $PostalAddressErr = "Maximum 500 characters are allowed";

    }
    if (!($Password_len >= 8 and $Password_len <= 30) || !($ConfPassword_len >= 8 and $ConfPassword_len <= 30) and ($PasswordErr == "")) {
        $PasswordErr = "Password must be in 8 - 30 character range";

    }

    // Call data submission
    if (
        ($ComNameErr == "") and ($RegNoErr == "") and ($TINErr == "") and ($TelNoErr == "") and
        ($EmailErr == "") and ($PostalAddressErr == "") and ($PasswordErr == "") and ($regErr == "")
    ) {
        data_submission();

    }
}

function data_submission()
{
    include_once "../../db_conn.php";

    $conComID = $_SESSION['conComID'];

    global $ComName, $RegNo, $TIN, $TelNo, $Email, $Password, $PostalAddress;

    $sql_check_email = "SELECT * FROM constructionCompany WHERE Email='$Email' AND conComID!='$conComID'";
    $sql_check_regno = "SELECT * FROM constructionCompany WHERE RegNo='$RegNo' AND conComID!='$conComID'";

    $result_check_email = mysqli_query($server_conn, $sql_check_email);
    $result_check_regno = mysqli_query($server_conn, $sql_check_regno);

    global $regErr;

    // check password matching
    if ($_POST['Password'] !== $_POST['ConfPassword']) {

        global $PasswordErr;

        $PasswordErr = "'Password' and 'Confirm password' should match!";

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
        $sql_update = "UPDATE constructionCompany SET ComName='$ComName', RegNo='$RegNo', TIN='$TIN', TelNo='$TelNo',
             Email='$Email', PostalAddress='$PostalAddress', Password='$Password' WHERE conComID='$conComID'";

        if (mysqli_query($server_conn, $sql_update)) {

            // system login process
            $sql_login = "SELECT * FROM constructionCompany WHERE RegNo='$RegNo' AND Password='$Password'";

            $result = mysqli_query($server_conn, $sql_login);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['RegNo'] === $RegNo && $row['Password'] === $Password) {

                    echo "Profile Successfully Updated!";

                    $_SESSION['conComID'] = $row['conComID'];
                    $_SESSION['RegNo'] = $row['RegNo'];
                    $_SESSION['ComName'] = $row['ComName'];
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

if (isset($_SESSION['conComID'])) {

    include "../../db_conn.php";

    $conComID = $_SESSION['conComID'];

    $sql_get = "SELECT * FROM constructionCompany WHERE conComID='$conComID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $conComID = $row['conComID'];
            $ComName = $row['ComName'];
            $RegNo = $row['RegNo'];
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
                        <label for="ComName">Company Name</label>
                        <input type="text" id="ComName" name="ComName" placeholder="Company Name"
                            value="<?php echo $ComName; ?>">

                        <span class="error">*
                            <?php echo $ComNameErr; ?>
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