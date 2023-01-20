<?php

session_start();

include "../../../db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: login_pg.php?error='Registration Number' and 'Password' are required");

        exit();

    } else if (empty($pass)) {

        header("Location: login_pg.php?error='Registration Number' and 'Password' are required");

        exit();

    } else {

        $sql = "SELECT * FROM organizationalDonor WHERE RegNo='$uname' AND Password='$pass'";

        $result = mysqli_query($server_conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['RegNo'] === $uname && $row['Password'] === $pass) {

                echo "Logged in!";

                $_SESSION['orgDonorID'] = $row['orgDonorID'];
                $_SESSION['RegNo'] = $row['RegNo'];
                $_SESSION['OrgName'] = $row['OrgName'];
                $_SESSION['Category'] = $row['Category'];
                $_SESSION['TIN'] = $row['TIN'];
                $_SESSION['TelNo'] = $row['TelNo'];
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['PostalAddress'] = $row['PostalAddress'];

                header("Location: ../../../dashboard/dashboard.php");
                exit();

            } else {

                header("Location: login_pg.php?error=Incorect 'Registration Number' or 'Password'");

                exit();
            }

        } else {

            header("Location: login_pg.php?error=Incorect 'Registration Number' or 'Password'");

            exit();

        }
    }

} else {

    header("Location: login_pg.php");

    exit();

}