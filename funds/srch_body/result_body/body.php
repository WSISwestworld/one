<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $fundID = $_GET['id'];

    // Administrator
    if (isset($_SESSION['adminID'])) {

        $sql_get = "SELECT * FROM fund LEFT JOIN personalDonor ON fund.donorID = personalDonor.donorID LEFT JOIN 
        fundRaise ON fund.fundRaiseID = fundRaise.fundRaiseID LEFT JOIN organizationalDonor ON fund.orgDonorID = organizationalDonor.orgDonorID
        WHERE fundID='$fundID'";

    } else {

        header("Location: ../../dashboard/dashboard.php");

        exit();

    }

    $get_result = $server_conn->query($sql_get);

    if ($get_result->num_rows > 0) {

        while ($row = $get_result->fetch_assoc()) {

            $fundID = $row['fundID'];
            $Amount = $row['Amount'];
            $Date = $row['Date'];
            $NIC = $row['NIC'];
            $RegNo = $row['RegNo'];
            $Name = $row['Name'];
            $donorID = $row['donorID'];
            $orgDonorID = $row['orgDonorID'];
            $fundRaiseID = $row['fundRaiseID'];
        }
        ?>

        <div class="container">

            <h2>
                Fund: <?php echo $fundID; ?>
            </h2>

            <table class="table">

                <thead>

                    <tr>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>NIC (Personal Donor)</th>
                        <th>Registration No (Organizational Donor)</th>
                        <th>Name (Fundraise)</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>
                            <?php echo $Amount; ?>
                        </td>

                        <td>
                            <?php echo $Date; ?>
                        </td>

                        <td>
                            <a href="../details/persond_d.php?id=<?php echo $donorID; ?>">
                                <?php echo $NIC; ?>
                            </a>
                        </td>

                        <td>
                            <a href="../details/orgd_d.php?id=<?php echo $orgDonorID; ?>">
                                <?php echo $RegNo; ?>
                            </a>
                        </td>

                        <td>
                            <a href="../details/fundr_d.php?id=<?php echo $fundRaiseID; ?>">
                                <?php echo $Name; ?>
                            </a>
                        </td>

                        <td>
                            <a href="update.php?id=<?php echo $fundID; ?>">Edit</a>&nbsp;
                            <a href="delete.php?id=<?php echo $fundID; ?>">Delete</a>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    <?php }

} else {

    header('Location: ../funds_search.php');

}
?>