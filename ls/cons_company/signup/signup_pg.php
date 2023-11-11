<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | Register</title>

    <link rel="stylesheet" href="../../signup_styles.css">

    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    // define variables and set to empty values
    $ComNameErr = $RegNoErr = $TINErr = $TelNoErr = $EmailErr = $PostalAddressErr = $PasswordErr = $regErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ComName = test_input($_POST["ComName"]);
        $RegNo = test_input($_POST["RegNo"]);
        $TIN = test_input($_POST["TIN"]);
        $TelNo = test_input($_POST["TelNo"]);
        $Email = test_input($_POST["Email"]);
        $Password = test_input($_POST["Password"]);
        $ConfPassword = test_input($_POST["ConfPassword"]);

        $no = test_input($_POST["no"]);
        $lane1 = test_input($_POST["lane1"]);
        $lane2 = test_input($_POST["lane2"]);
        $city = test_input($_POST["city"]);

        if (!empty($no) and !empty($lane1) and !empty($lane2) and !empty($city)) {
            $PostalAddress = 'No ' . $no . ', ' . $lane1 . ', ' . $lane2 . ', ' . $city . '.';

        } elseif (!empty($no) and !empty($lane1) and !empty($city)) {
            $PostalAddress = 'No ' . $no . ', ' . $lane1 . ', ' . $city . '.';

        } elseif (!empty($no) and !empty($city)) {
            $PostalAddress = 'No ' . $no . ', ' . $city . '.';

        } elseif (empty($no) and empty($lane1) and empty($lane2) and empty($city)) {

        } else {
            $PostalAddressErr = "'Postal Address' format cannot be recognized";

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
            $PasswordErr = "'Password' and 'Confirm Password' fields are required";

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
        if ((!preg_match("/^[0-9]{10}+$/", $TelNo)) and ($TelNoErr == "")) {
            $TelNoErr = "Only 10 digit numbers are allowed";

        }
        // check if e-mail address is well-formed or null
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL) and ($EmailErr == "")) {
            $EmailErr = "Invalid 'Email address' format";

        }
        // check if only contains alphanumeric characters or null
        if (
            (!preg_match("/^[\/0-9a-zA-Z-' ]*$/", $no) || !preg_match("/^[0-9a-zA-Z-' ]*$/", $lane1) ||
                !preg_match("/^[0-9a-zA-Z-' ]*$/", $lane2) || !preg_match("/^[0-9a-zA-Z-' ]*$/", $city)) and ($PostalAddressErr == "")
        ) {
            $PostalAddressErr = "Only numbers, letters and white spaces allowed";

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
        include_once "../../../db_conn.php";

        global $ComName, $RegNo, $TIN, $TelNo, $Email, $Password, $PostalAddress;

        $sql_check_email = "SELECT * FROM constructionCompany WHERE Email='$Email'";
        $sql_check_regno = "SELECT * FROM constructionCompany WHERE RegNo='$RegNo'";

        $result_check_email = mysqli_query($server_conn, $sql_check_email);
        $result_check_regno = mysqli_query($server_conn, $sql_check_regno);

        global $regErr;

        // check password matching
        if ($_POST['Password'] !== $_POST['ConfPassword']) {

            global $PasswordErr;

            $PasswordErr = "'Password' and 'Confirm password' should match!";

        }
        // checking already registered emails
        elseif ((mysqli_num_rows($result_check_email) > 0)) {

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
        // information submission and registration success
        else {
            // system registration process
            $sql_submit = "INSERT INTO constructionCompany (ComName, RegNo, TIN, TelNo, Email, PostalAddress, Password)
             VALUES ('$ComName','$RegNo','$TIN','$TelNo','$Email','$PostalAddress','$Password')";

            if (mysqli_query($server_conn, $sql_submit)) {

                // system login process
                session_start();

                $sql_login = "SELECT * FROM constructionCompany WHERE RegNo='$RegNo' AND Password='$Password'";

                $result = mysqli_query($server_conn, $sql_login);

                if (mysqli_num_rows($result) === 1) {

                    $row = mysqli_fetch_assoc($result);

                    if ($row['RegNo'] === $RegNo && $row['Password'] === $Password) {

                        echo "Successfully Registered & Logged in!";

                        $_SESSION['conComID'] = $row['conComID'];
                        $_SESSION['RegNo'] = $row['RegNo'];
                        $_SESSION['ComName'] = $row['ComName'];
                        $_SESSION['TIN'] = $row['TIN'];
                        $_SESSION['TelNo'] = $row['TelNo'];
                        $_SESSION['Email'] = $row['Email'];
                        $_SESSION['PostalAddress'] = $row['PostalAddress'];

                        header("Location: ../../../dashboard/dashboard.php");
                        exit();
                    }
                }
                exit();
            }
            // server error
            else {
                echo "Error: " . $sql_submit . "<br>" . mysqli_error($server_conn);

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

    ?>

    <!--head-->
    <div class="header">
        <img src="../../../waterDropLogo.png" height="90px" width="640px" alt="Logo" class="center">
    </div>

    <div class="content">

        <div class="column">
            <div class="square">

                <table class="container">
                    <br>

                    <h2 style="text-align: center; color: #187efa;">Register as a <a href="../../role_sign.php"
                            style="text-align: center; color: #187efa;">Construction Company</a></h2>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <tr>
                            <td>
                                <label for="ComName">Company Name</label>
                                <input type="text" id="ComName" name="ComName" placeholder="Company Name">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $ComNameErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="RegNo">Registration Number</label>
                                <input type="text" id="RegNo" name="RegNo" placeholder="Registration Number">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $RegNoErr; ?>
                                </span>
                            </td>
                            <td>
                                <label for="TIN">Taxpayer Identification Number</label>
                                <input type="text" id="TIN" name="TIN" placeholder="Taxpayer Identification Number">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $TINErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Email">Email</label>
                                <input type="email" id="Email" name="Email" placeholder="ex:- abcd@some.lk">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $EmailErr; ?>
                                </span>
                            </td>
                            <td>
                                <label for="TelNo">Phone</label>
                                <p>(+94)</p>
                                <input type="text" id="TelNo" name="TelNo" placeholder="Telephone Number">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $TelNoErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Password">Password</label>
                                <input type="password" id="password" name="Password">
                            </td>
                            <td>
                                <label for="ConfPassword">Confirm Password</label>
                                <input type="password" id="confpassword" name="ConfPassword">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $PasswordErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- toggle between password visibility -->
                                <input type="checkbox" onclick="shPass()">Show Password
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="address">Postal Address</label>
                                <p>No: </p><input type="text" name="no">
                                <p>Lane 01: </p><input type="text" name="lane1">
                                <p>Lane 02: </p><input type="text" name="lane2">
                                <p>City: </p><input type="text" name="city">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $PostalAddressErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="error">
                                    <?php echo $regErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Register">
                            </td>
                            <td>
                                <p>Already have an account? <a href="../login/login_pg.php">Login</a></p>
                            </td>
                        </tr>
                    </form>

                </table>
            </div>
        </div>

    </div>
    <script src="../../pass.js"></script>
</body>

</html>