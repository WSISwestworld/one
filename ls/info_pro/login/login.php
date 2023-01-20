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

        header("Location: login_pg.php?error='Username' and 'Password' are required");

        exit();

    } else if (empty($pass)) {

        header("Location: login_pg.php?error='Username' and 'Password' are required");

        exit();

    } else {

        $sql = "SELECT * FROM infoProvider WHERE Username='$uname' AND Password='$pass'";

        $result = mysqli_query($server_conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['Username'] === $uname && $row['Password'] === $pass) {

                echo "Logged in!";

                $_SESSION['userID'] = $row['userID'];
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['FName'] = $row['FName'];
                $_SESSION['LName'] = $row['LName'];
                $_SESSION['Province'] = $row['Province'];
                $_SESSION['NIC'] = $row['NIC'];
                $_SESSION['DOB'] = $row['DOB'];
                $_SESSION['TelNo'] = $row['TelNo'];
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['PostalAddress'] = $row['PostalAddress'];

                header("Location: ../../../dashboard/dashboard.php");
                exit();

            } else {

                header("Location: login_pg.php?error=Incorect 'Username' or 'Password'");

                exit();
            }

        } else {

            header("Location: login_pg.php?error=Incorect 'Username' or 'Password'");

            exit();

        }
    }

} else {

    header("Location: login_pg.php");

    exit();

}