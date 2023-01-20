<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $conComID = $_GET['id'];

    $sql_get = "SELECT * FROM constructionCompany WHERE conComID='$conComID'";

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $ComName = $row['ComName'];

            $RegNo = $row['RegNo'];

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

            <title>WSIS | PROJECTS</title>

        </head>

        <body>

            <fieldset>

                <legend>Construction Comany details:</legend>
                <h3>Comany Name: <?php echo $ComName; ?></h3>
                <h3>Registration Number: <?php echo $RegNo; ?></h3>
                <h3>Tax Identification Number: <?php echo $TIN; ?></h3>
                <h3>Phone: (+94) <?php echo $TelNo; ?></h3>
                <h3>Email: <?php echo $Email; ?></h3>
                <h3>Postal Address: <?php echo $PostalAddress; ?></h3>

            </fieldset>

        </body>

        </html>

    <?php

    } else {

        header('Location: projects.php');

    }

}
?>