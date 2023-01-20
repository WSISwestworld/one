<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $fundRaiseID = $_GET['id'];

    // Administrator
    if (isset($_SESSION['adminID'])) {

        $sql_get = "SELECT * FROM fundRaise WHERE fundRaiseID='$fundRaiseID'";

    } else {

        header("Location: ../../dashboard/dashboard.php");

        exit();

    }

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

        <div class="container">

            <h2>
                Fundraise: <?php echo $Name; ?>
            </h2>

            <table class="table">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date of the Event</th>
                        <th>adminID</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>
                            <?php echo $fundRaiseID; ?>
                        </td>

                        <td>
                            <?php echo $Name; ?>
                        </td>

                        <td>
                            <?php echo $Description; ?>
                        </td>

                        <td>
                            <?php echo $EventDate; ?>
                        </td>

                        <td>
                            <a href="../details/admin_d.php?id=<?php echo $adminID; ?>">
                                <?php echo $adminID; ?>
                            </a>
                        </td>

                        <td>
                            <a href="update.php?id=<?php echo $fundRaiseID; ?>">Edit</a>&nbsp;
                            <a href="delete.php?id=<?php echo $fundRaiseID; ?>">Delete</a>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    <?php }

} else {

    header('Location: ../fundraise_search.php');

}
?>