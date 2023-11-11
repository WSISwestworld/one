<?php

session_start();

include "../db_conn.php";

if (isset($_POST['cancel'])) {
    header("Location: ../dashboard/dashboard.php");
}

if (isset($_POST['confirm']) && isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($pass)) {

        header("Location: profile.php?error='Password' is required");

        exit();

    } else {

        // Administrator
        if (isset($_SESSION['adminID'])) {

            $sql = "SELECT * FROM admin WHERE adminID='$uname' AND Password='$pass'";

            $result = mysqli_query($server_conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['adminID'] === $uname && $row['Password'] === $pass) {

                    echo "Identity confirmed";

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

                    // Profile Update
                    header("Location: admin/admin.php");
                    exit();

                } else {

                    header("Location: profile.php?error=Incorrect 'Password'");

                    exit();
                }

            } else {

                header("Location: profile.php?error=Incorrect 'Password'");

                exit();

            }
        }

        // Construction Company
        elseif (isset($_SESSION['conComID'])) {

            $sql = "SELECT * FROM constructionCompany WHERE RegNo='$uname' AND Password='$pass'";

            $result = mysqli_query($server_conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['RegNo'] === $uname && $row['Password'] === $pass) {

                    echo "Logged in!";

                    $_SESSION['conComID'] = $row['conComID'];
                    $_SESSION['RegNo'] = $row['RegNo'];
                    $_SESSION['ComName'] = $row['ComName'];
                    $_SESSION['TIN'] = $row['TIN'];
                    $_SESSION['TelNo'] = $row['TelNo'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['PostalAddress'] = $row['PostalAddress'];

                    // Profile Update
                    header("Location: cons_company/cons_company.php");
                    exit();

                } else {

                    header("Location: profile.php?error=Incorrect 'Password'");

                    exit();
                }

            } else {

                header("Location: profile.php?error=Incorrect 'Password'");

                exit();

            }

        }
        // Information Provider
        elseif (isset($_SESSION['userID'])) {

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
                    $_SESSION['Gender'] = $row['Gender'];
                    $_SESSION['TelNo'] = $row['TelNo'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['PostalAddress'] = $row['PostalAddress'];

                    // Profile Update
                    header("Location: info_pro/info_pro.php");
                    exit();

                } else {

                    header("Location: profile.php?error=Incorrect 'Password'");

                    exit();
                }

            } else {

                header("Location: profile.php?error=Incorrect 'Password'");

                exit();

            }

        }
        // Organizational Donor
        elseif (isset($_SESSION['orgDonorID'])) {

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

                    // Profile Update
                    header("Location: org_don/org_don.php");
                    exit();

                } else {

                    header("Location: profile.php?error=Incorrect 'Password'");

                    exit();
                }

            } else {

                header("Location: profile.php?error=Incorrect 'Password'");

                exit();

            }

        }
        // Personal Donor
        elseif (isset($_SESSION['donorID'])) {

            $sql = "SELECT * FROM personalDonor WHERE Email='$uname' AND Password='$pass'";

            $result = mysqli_query($server_conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['Email'] === $uname && $row['Password'] === $pass) {

                    echo "Logged in!";

                    $_SESSION['donorID'] = $row['donorID'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['FName'] = $row['FName'];
                    $_SESSION['LName'] = $row['LName'];
                    $_SESSION['NIC'] = $row['NIC'];
                    $_SESSION['DOB'] = $row['DOB'];
                    $_SESSION['Gender'] = $row['Gender'];
                    $_SESSION['TelNo'] = $row['TelNo'];
                    $_SESSION['PostalAddress'] = $row['PostalAddress'];

                    // Profile Update
                    header("Location: personal_don/personal_don.php");
                    exit();

                } else {

                    header("Location: profile.php?error=Incorrect 'Password'");

                    exit();
                }

            } else {

                header("Location: profile.php?error=Incorrect 'Password'");

                exit();

            }

        } else {

            header("Location: ../index.php");

            exit();

        }
    }

} else {

    header("Location: ../dashboard/dashboard.php");

    exit();

}

?>