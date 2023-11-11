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

        header("Location: login_pg.php?error='Admin ID' and 'Password' are required");

        exit();

    } else if (empty($pass)) {

        header("Location: login_pg.php?error='Admin ID' and 'Password' are required");

        exit();

    } else {

        $sql = "SELECT * FROM admin WHERE adminID='$uname' AND Password='$pass'";

        $result = mysqli_query($server_conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['adminID'] === $uname && $row['Password'] === $pass) {

                echo "Logged in!";

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

                header("Location: ../../../dashboard/dashboard.php");
                exit();

            } else {

                header("Location: login_pg.php?error=Incorrect 'Admin ID' or 'Password'");

                exit();
            }

        } else {

            header("Location: login_pg.php?error=Incorrect 'Admin ID' or 'Password'");

            exit();

        }
    }

} else {

    header("Location: login_pg.php");

    exit();

}

?>