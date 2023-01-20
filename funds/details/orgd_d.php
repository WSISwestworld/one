<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $orgDonorID = $_GET['id'];

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

                <legend>Organizational Donor details:</legend>

                <h3>Company Name: <?php echo $OrgName; ?></h3>
                <h3>Organizational Donor ID: <?php echo $orgDonorID; ?></h3>
                <h3>Registration Number: <?php echo $RegNo; ?></h3>
                <h3>Category: <?php echo $Category; ?></h3>
                <h3>Tax Identification Number: <?php echo $TIN; ?></h3>
                <h3>Phone: (+94) <?php echo $TelNo; ?></h3>
                <h3>Email: <?php echo $Email; ?></h3>
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