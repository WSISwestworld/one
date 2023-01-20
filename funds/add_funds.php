<?php

include "../db_conn.php";

session_start();

if (isset($_POST['submit'])) {

    // define variables and set to empty values
    $AmountErr = $DateErr = $IDErr = "";

    $Amount = $_POST['Amount'];
    $Date = $_POST['Date'];
    $donorID = $_POST['donorID'];
    $orgDonorID = $_POST['orgDonorID'];
    $fundRaiseID = $_POST['fundRaiseID'];

    $Name_len = strlen($Name);
    $Description_len = strlen($Description);

    // required data validation
    if (empty($_POST["Amount"])) {
        $AmountErr = "'Amount' is required";
    }

    if (empty($_POST["Date"])) {
        $DateErr = "'Date' is required";
    }

    // ID validation
    if (empty($donorID) and empty($orgDonorID) and empty($fundRaiseID)) {

        $IDErr = "Least One ID should be added";

    } elseif (empty($donorID) and empty($orgDonorID)) {

        $sql_add = "INSERT INTO fund (Amount, Date, fundRaiseID)
        VALUES ('$Amount','$Date','$fundRaiseID')";

    } elseif (empty($orgDonorID) and empty($fundRaiseID)) {

        $sql_add = "INSERT INTO fund (Amount, Date, donorID)
        VALUES ('$Amount','$Date','$donorID')";

    } elseif (empty($fundRaiseID) and empty($donorID)) {

        $sql_add = "INSERT INTO fund (Amount, Date, orgDonorID)
        VALUES ('$Amount','$Date','$orgDonorID')";

    } else {

        $IDErr = "Only One ID should be added";

    }


    if (
        ($AmountErr == "") and ($DateErr == "") and ($IDErr == "")
    ) {

        $add_result = $server_conn->query($sql_add);

        if ($add_result == TRUE) {

            echo "New fund added successfully";

            header('Location: funds.php');

        } else {

            echo "Error:" . $sql_add . "<br>" . $server_conn->error;

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | FUNDS</title>

    <style>
        .error {
            color: #FF0000;
        }
    </style>

</head>

<body>

    <h2>Add New Fund</h2>

    <form action="" method="post">

        <fieldset>

            <legend>Fund information:</legend>

            Amount:<br>

            <input type="number" step="0.01" name="Amount" placeholder="RS.">

            <span class="error">* <?php echo $AmountErr; ?></span>

            <br>

            Date:<br>

            <input type="date" name="Date">

            <span class="error">* <?php echo $DateErr; ?></span>

            <br>

            Personal Donor (ID):<br>

            <?php
            $sql_pdon = "SELECT * FROM personalDonor";
            ?>

            <select name="donorID">

                <option value="" selected>
                    None
                </option>

                <?php
                foreach ($server_conn->query($sql_pdon) as $pdon_row) { // Array or records stored in $admin_row
                
                    echo "<option value=$pdon_row[donorID]>$pdon_row[donorID]" . " - " .
                        "$pdon_row[FName]" . " - " . "$pdon_row[NIC]</option>";

                    /* Option values are added by looping through the array */

                }
                ?>

            </select>

            <br>

            Organizational Donor (ID):<br>

            <?php
            $sql_orgdon = "SELECT * FROM organizationalDonor";
            ?>

            <select name="orgDonorID">

                <option value="" selected>
                    None
                </option>

                <?php
                foreach ($server_conn->query($sql_orgdon) as $orgdon_row) { // Array or records stored in $admin_row
                
                    echo "<option value=$orgdon_row[orgDonorID]>$orgdon_row[orgDonorID]" . " - " .
                        "$orgdon_row[OrgName]" . " - " . "$orgdon_row[RegNo]</option>";

                    /* Option values are added by looping through the array */

                }
                ?>

            </select>

            <br>

            Fundraise (ID):<br>

            <?php
            $sql_fundraise = "SELECT * FROM fundRaise";
            ?>

            <select name="fundRaiseID">

                <option value="" selected>
                    None
                </option>

                <?php
                foreach ($server_conn->query($sql_fundraise) as $fundraise_row) { // Array or records stored in $admin_row
                
                    echo "<option value=$fundraise_row[fundRaiseID]>$fundraise_row[fundRaiseID]" . " - " .
                        "$fundraise_row[Name]" . " - " . "$fundraise_row[EventDate]</option>";

                    /* Option values are added by looping through the array */

                }
                ?>

            </select>

            <br>

            <span class="error"><?php echo $IDErr; ?></span>

            <br><br>

            <input type="submit" value="Create" name="submit">

        </fieldset>

    </form>

</body>

</html>