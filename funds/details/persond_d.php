<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $donorID = $_GET['id'];

    $sql_get = "SELECT * FROM personalDonor WHERE donorID='$donorID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $donorID = $row['donorID'];

            $FName = $row['FName'];

            $LName = $row['LName'];

            $NIC = $row['NIC'];

            $DOB = $row['DOB'];

            $TelNo = $row['TelNo'];

            $Email = $row['Email'];

            $PostalAddress = $row['PostalAddress'];
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <title>WSIS | FUNDS</title>

        </head>

        <body>

            <fieldset>

                <legend>Personal Donor details:</legend>

                <h3>Full Name: <?php echo $FName; ?>
                    <?php echo $LName; ?>.
                </h3>
                <h3>Personal Donor ID: <?php echo $donorID; ?></h3>
                <h3>Email: <?php echo $Email; ?></h3>
                <h3>NIC: <?php echo $NIC; ?></h3>
                <h3>Date of Birth: <?php echo $DOB; ?></h3>
                <h3>Phone: (+94) <?php echo $TelNo; ?></h3>
                <h3>Postal Address: <?php echo $PostalAddress; ?></h3>

            </fieldset>

        </body>

        </html>

    <?php

    } else {

        header('Location: ../funds.php');

    }

}
?>