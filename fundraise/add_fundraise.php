<?php

include "../db_conn.php";

session_start();

if (isset($_POST['submit'])) {

    // define variables and set to empty values
    $NameErr = $DescriptionErr = $EventDateErr = "";

    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $EventDate = $_POST['EventDate'];
    $adminID = $_POST['adminID'];

    $Name_len = strlen($Name);
    $Description_len = strlen($Description);

    // required data validation
    if (empty($_POST["Name"])) {
        $NameErr = "'Name' is required";
    }

    if (empty($_POST["Description"])) {
        $DescriptionErr = "'Description' is required";
    }

    if (empty($_POST["EventDate"])) {
        $EventDateErr = "'Event Date' is required";
    }

    // check if only contains numbers, letters and whitespaces
    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $Name)) and ($NameErr == "")) {
        $NameErr = "Only numbers, letters and whitespaces are allowed";

    }

    if ((!preg_match("/^[0-9a-zA-Z-' ]*$/", $Description)) and ($DescriptionErr == "")) {
        $DescriptionErr = "Only numbers, letters and whitespaces are allowed";

    }

    // data length validation
    if (!($Name_len > 0 and $Name_len <= 250) and ($NameErr == "")) {
        $NameErr = "Maximum 250 characters are allowed";

    }
    if (!($Description_len > 0 and $Description_len <= 600) and ($DescriptionErr == "")) {
        $DescriptionErr = "Maximum 600 characters are allowed";

    }

    if (
        ($NameErr == "") and ($DescriptionErr == "") and ($EventDateErr == "") and ($adminIDErr == "")
    ) {

        $sql_add = "INSERT INTO fundRaise (Name, Description, EventDate, adminID)
        VALUES ('$Name','$Description','$EventDate','$adminID')";

        $add_result = $server_conn->query($sql_add);

        if ($add_result == TRUE) {

            echo "New fundraise added successfully";

            header('Location: fundraise.php');

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

    <title>WSIS | FUNDRAISE</title>

    <style>
        .error {
            color: #FF0000;
        }
    </style>

</head>

<body>

    <h2>Create New Fundraise</h2>

    <form action="" method="post">

        <fieldset>

            <legend>Fundraise information:</legend>

            Name:<br>

            <input type="text" name="Name" placeholder="Name">

            <span class="error">* <?php echo $NameErr; ?></span>

            <br>

            Description:<br>

            <textarea name="Description" placeholder="Description"></textarea>

            <span class="error">* <?php echo $DescriptionErr; ?></span>

            <br>

            Date of the Event:<br>

            <input type="date" name="EventDate">

            <span class="error">* <?php echo $EventDateErr; ?></span>

            <br>

            Admin (ID):<br>

            <?php
            $sql_admin = "SELECT adminID FROM admin";
            $admin_id = $_SESSION['adminID'];
            ?>

            <select name="adminID">

                <option value='<?php echo $admin_id; ?>' selected hidden>
                    <?php echo $admin_id; ?>
                </option>

                <?php
                foreach ($server_conn->query($sql_admin) as $admin_row) { // Array or records stored in $admin_row
                
                    echo "<option value=$admin_row[adminID]>$admin_row[adminID]</option>";

                    /* Option values are added by looping through the array */

                }
                ?>

            </select>

            <span class="error">* </span>

            <br>

            <br><br>

            <input type="submit" value="Create" name="submit">

        </fieldset>

    </form>

</body>

</html>