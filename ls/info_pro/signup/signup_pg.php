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
        /* Reset some default styles */
        .content{
            
    height: 100%; /* 100% of the viewport height */
    
}

.header{
    padding:20px;
}

.header img {
    width:200px;
    max-width: 200px;
}

        
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

/* Style the body background */
body {
    background: linear-gradient(to bottom, #007BFF, #2196F3);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

/* Style the container holding the form */
.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
}

/* Style the form elements */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    font-size: 18px;
    color: #007BFF;
    margin-top: 10px;
}

input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #007BFF;
    border-radius: 5px;
    outline: none;
}

select {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #007BFF;
    border-radius: 5px;
    outline: none;
}

.error {
    color: #FF0000;
    font-size: 14px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style the "Show Password" checkbox */
input[type="checkbox"] {
    margin-top: 10px;
    color: #007BFF;
}

/* Style the header/logo */
.header {
    text-align: center;
}

.center {
    display: block;
    margin: 0 auto;
}



/* Additional styling for specific elements */
.column {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
.square {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.center {
            display: block;
            margin: 0 auto;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .square {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%; /* Make sure it takes the full width */
            max-width: 600px; /* Adjust as needed */
        }

    </style>
</head>

<body>

    <?php
    // define variables and set to empty values
    $fnameErr = $lnameErr = $unameErr = $emailErr = $phoneErr = $provinceErr = $nicErr = $passwordErr = $addressErr = $regErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = test_input($_POST["fname"]);
        $uname = test_input($_POST["uname"]);
        $phone = test_input($_POST["phone"]);
        $province = test_input($_POST["province"]);
        $nic = test_input($_POST["nic"]);
        $password = test_input($_POST["password"]);
        $confpassword = test_input($_POST["confpassword"]);
        $email = test_input($_POST["email"]);
        $lname = test_input($_POST["lname"]);

        $no = test_input($_POST["no"]);
        $lane1 = test_input($_POST["lane1"]);
        $lane2 = test_input($_POST["lane2"]);
        $city = test_input($_POST["city"]);

        if (!empty($no) and !empty($lane1) and !empty($lane2) and !empty($city)) {
            $address = 'No ' . $no . ', ' . $lane1 . ', ' . $lane2 . ', ' . $city . '.';

        } elseif (!empty($no) and !empty($lane1) and !empty($city)) {
            $address = 'No ' . $no . ', ' . $lane1 . ', ' . $city . '.';

        } elseif (!empty($no) and !empty($city)) {
            $address = 'No ' . $no . ', ' . $city . '.';

        } elseif (empty($no) and empty($lane1) and empty($lane2) and empty($city)) {

        } else {
            $addressErr = "'Postal Address' format cannot be recognized";

        }

        $fname_len = strlen($fname);
        $uname_len = strlen($uname);
        $address_len = strlen($address);
        $password_len = strlen($password);
        $confpassword_len = strlen($confpassword);
        $email_len = strlen($email);
        $lname_len = strlen($lname);

        // required data validation
        if (empty($_POST["fname"])) {
            $fnameErr = "'First Name' is required";

        }
        if (empty($_POST["uname"])) {
            $unameErr = "'Username' is required";

        }
        if (empty($_POST["phone"])) {
            $phoneErr = "'Phone Number' is required";

        }
        if (empty($_POST["province"])) {
            $provinceErr = "'Province' is required";

        }
        if (empty($_POST["nic"])) {
            $nicErr = "'National Identity Card Number' is required";

        }
        if (empty($address) and ($addressErr == "")) {
            $addressErr = "'Postal Address' is required";

        }
        if (empty($_POST["password"]) || empty($_POST["confpassword"])) {
            $passwordErr = "'Password' and 'Confirm Password' fields are required";

        }

        // check if only contains letters and whitespace
        if ((!preg_match("/^[a-zA-Z-' ]*$/", $fname)) and ($fnameErr == "")) {
            $fnameErr = "Only letters and white space allowed";

        }
        // check if only contains numbers and letters
        if ((!preg_match("/^[A-Za-z0-9_]*$/", $uname)) and ($unameErr == "")) {
            $unameErr = "Only numbers and letters are allowed";

        }
        // check if only contains letters and whitespace or null
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname) and !empty($_POST["lname"])) {
            $lnameErr = "Only letters and white space allowed";

        }
        // check if only contains numbers and 10 digit limit
        if ((!preg_match("/^[0-9]{9,10}+$/", $phone)) and ($phoneErr == "")) {
            $phoneErr = "Only 10 digit numbers are allowed";

        }
        // check if only contains digits with 'V' character and 10, 12 character limit
        if ((!preg_match("/^[0-9vV]{10,12}+$/", $nic)) and ($nicErr == "")) {
            $nicErr = "Only 9 digits with 'V' or 12 digits are allowed";

        }
        // check if e-mail address is well-formed or null
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) and !empty($_POST["email"])) {
            $emailErr = "Invalid 'Email address' format";

        }
        // check if only contains alphanumeric characters
        if (
            (!preg_match("/^[\/0-9a-zA-Z-' ]*$/", $no) || !preg_match("/^[0-9a-zA-Z-' ]*$/", $lane1) ||
                !preg_match("/^[0-9a-zA-Z-' ]*$/", $lane2) || !preg_match("/^[0-9a-zA-Z-' ]*$/", $city)) and ($addressErr == "")
        ) {
            $addressErr = "Only numbers, letters and white spaces allowed";

        }

        // data length validation 
        if (!($fname_len > 0 and $fname_len <= 100) and ($fnameErr == "")) {
            $fnameErr = "Maximum 100 characters are allowed";

        }
        if (!($uname_len > 0 and $uname_len <= 10) and ($unameErr == "")) {
            $unameErr = "Maximum 10 characters are allowed";

        }
        if (!($address_len > 0 and $address_len <= 500) and ($addressErr == "")) {
            $addressErr = "Maximum 500 characters are allowed";

        }
        if (!($password_len >= 8 and $password_len <= 30) || !($confpassword_len >= 8 and $confpassword_len <= 30) and ($passwordErr == "")) {
            $passwordErr = "Password must be in 8 - 30 character range";

        }
        if (!($email_len >= 0 and $email_len <= 150) and ($emailErr == "")) {
            $emailErr = "Maximum 150 characters are allowed";

        }
        if (!($lname_len >= 0 and $lname_len <= 150) and ($lnameErr == "")) {
            $lnameErr = "Maximum 150 characters are allowed";

        }

        // NIC calculations
        include_once "../../nic_cal.php";

        // Call data submission
        if (
            ($fnameErr == "") and ($lnameErr == "") and ($unameErr == "") and ($emailErr == "") and ($phoneErr == "") and
            ($provinceErr == "") and ($nicErr == "") and ($passwordErr == "") and ($addressErr == "") and ($regErr == "")
        ) {
            data_submission();

        }
    }

    function data_submission()
    {
        include_once "../../../db_conn.php";

        global $fname, $lname, $province, $nic, $dob, $phone, $email, $address, $uname, $password, $gender;

        $sql_check_uname = "SELECT * FROM infoProvider WHERE Username='$uname'";
        $sql_check_nic = "SELECT * FROM infoProvider WHERE NIC='$nic'";

        $result_check_uname = mysqli_query($server_conn, $sql_check_uname);
        $result_check_nic = mysqli_query($server_conn, $sql_check_nic);

        global $regErr;

        // check password matching
        if ($_POST['password'] !== $_POST['confpassword']) {

            global $passwordErr;

            $passwordErr = "'Password' and 'Confirm password' should match!";

        }
        // checking already taken usernames
        elseif ((mysqli_num_rows($result_check_uname) > 0)) {

            $row = mysqli_fetch_assoc($result_check_uname);

            if ($row['Username'] === $uname) {

                $regErr = "Given 'Username' is already taken";
            }

        }
        // checking already registration
        elseif (mysqli_num_rows($result_check_nic) > 0) {

            $row = mysqli_fetch_assoc($result_check_nic);

            if ($row['NIC'] === $nic) {

                $regErr = "This 'NIC' is already registered with the system, Please use the login option";
            }

        }
        // information submission and registration success
        else {
            // system registration process
            $sql_submit = "INSERT INTO infoProvider (FName, LName, Province, NIC, DOB, TelNo, Email, PostalAddress, Username, Password, Gender)
             VALUES ('$fname','$lname','$province','$nic','$dob','$phone','$email','$address','$uname','$password','$gender')";

            if (mysqli_query($server_conn, $sql_submit)) {

                // system login process
                session_start();

                $sql_login = "SELECT * FROM infoProvider WHERE Username='$uname' AND Password='$password'";

                $result = mysqli_query($server_conn, $sql_login);

                if (mysqli_num_rows($result) === 1) {

                    $row = mysqli_fetch_assoc($result);

                    if ($row['Username'] === $uname && $row['Password'] === $password) {

                        echo "Successfully Registered & Logged in!";

                        $_SESSION['userID'] = $row['userID'];
                        $_SESSION['Username'] = $row['Username'];
                        $_SESSION['FName'] = $row['FName'];
                        $_SESSION['LName'] = $row['LName'];
                        $_SESSION['Province'] = $row['Province'];
                        $_SESSION['NIC'] = $row['NIC'];
                        $_SESSION['DOB'] = $row['DOB'];
                        $_SESSION['Gender'] = $row['Gender'];
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
                            style="text-align: center; color: #187efa;">Information Provider</a></h2>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <tr>
                            <td>
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="fname" placeholder="Your first name here..">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $fnameErr; ?>
                                </span>
                            </td>
                            <td>
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name="lname" placeholder="Your last name here..">
                            </td>
                            <td>
                                <span class="error">
                                    <?php echo $lnameErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="uname">Username</label>
                                <input type="text" id="uname" name="uname" placeholder="ex:- chamu01">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $unameErr; ?>
                                </span>
                            </td>
                            <td>
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="ex:- abcd@some.lk">
                            </td>
                            <td>
                                <span class="error">
                                    <?php echo $emailErr; ?>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="phone">Phone</label>
                                <p>(+94)</p>
                                <input type="text" id="phone" name="phone" placeholder="Telephone Number">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $phoneErr; ?>
                                </span>
                            </td>
                            <td>
                                <label for="province">Province</label>
                                <select id="province" name="province">
                                    <option value="" selected disabled hidden>- select -</option>
                                    <option value="Central Province">Central Province</option>
                                    <option value="Eastern Province">Eastern Province</option>
                                    <option value="Northern Province">Northern Province</option>
                                    <option value="Southern Province">Southern Province</option>
                                    <option value="Western Province">Western Province</option>
                                    <option value="North Western Province">North Western Province</option>
                                    <option value="North Central Province">North Central Province</option>
                                    <option value="Uva Province">Uva Province</option>
                                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                                </select>
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $provinceErr; ?>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="nic">NIC</label>
                                <input type="text" id="nic" name="nic" placeholder="National Identity Card Number">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $nicErr; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password">
                            </td>
                            <td>
                                <label for="confpassword">Confirm Password</label>
                                <input type="password" id="confpassword" name="confpassword">
                            </td>
                            <td>
                                <span class="error">*
                                    <?php echo $passwordErr; ?>
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
                                    <?php echo $addressErr; ?>
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