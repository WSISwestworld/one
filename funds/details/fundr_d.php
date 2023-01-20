<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $fundRaiseID = $_GET['id'];

    $sql_get = "SELECT * FROM fundRaise WHERE fundRaiseID='$fundRaiseID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $fundRaiseID = $row['fundRaiseID'];

            $Name = $row['Name'];

            $Description = $row['Description'];

            $EventDate = $row['EventDate'];

            $adminID = $row['adminID'];
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

                <legend>Fundraise details:</legend>

                <h3>Name / Title: <?php echo $Name; ?></h3>
                <h3>Fundraise ID: <?php echo $fundRaiseID; ?></h3>
                <h3>Description: <?php echo $Description; ?></h3>
                <h3>Date of the Event: <?php echo $EventDate; ?></h3>
                <h3>Admin ID:
                    <a href="admin_d.php?id=<?php echo $adminID; ?>">
                        <?php echo $adminID; ?>
                    </a>
                </h3>

            </fieldset>

        </body>

        </html>

    <?php

    } else {

        header('Location: ../funds.php');

    }

}
?>