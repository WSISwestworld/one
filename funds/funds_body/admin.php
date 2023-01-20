<?php

// Get the result...
if (
    $result = $server_conn->query('SELECT * FROM fund LEFT JOIN personalDonor ON fund.donorID = personalDonor.donorID LEFT JOIN 
    fundRaise ON fund.fundRaiseID = fundRaise.fundRaiseID LEFT JOIN organizationalDonor ON fund.orgDonorID = organizationalDonor.orgDonorID 
    ORDER BY ' . $column . ' ' . $sort_order)
) {
    // Some variables need for the table.
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';

    ?>

    <div>
        <h2>All Funds</h2>
        <table>
            <tr>
                <th><a href="funds.php?column=Amount&order=<?php echo $asc_or_desc; ?>">Amount<i
                            class="fas fa-sort<?php echo $column == 'Amount' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="funds.php?column=Date&order=<?php echo $asc_or_desc; ?>">Date<i
                            class="fas fa-sort<?php echo $column == 'Date' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="funds.php?column=NIC&order=<?php echo $asc_or_desc; ?>">NIC (Personal Donor)<i
                            class="fas fa-sort<?php echo $column == 'NIC' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="funds.php?column=RegNo&order=<?php echo $asc_or_desc; ?>">Registration No (Organizational
                        Donor)<i class="fas fa-sort<?php echo $column == 'RegNo' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="funds.php?column=Name&order=<?php echo $asc_or_desc; ?>">Name (Fundraise)<i
                            class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td<?php echo $column == 'Amount' ? $add_class : ''; ?>>
                        <?php echo $row['Amount']; ?>
                        </td>

                        <td<?php echo $column == 'Date' ? $add_class : ''; ?>>
                            <?php echo $row['Date']; ?>
                            </td>

                            <td<?php echo $column == 'NIC' ? $add_class : ''; ?>>
                                <a href="details/persond_d.php?id=<?php echo $row['donorID']; ?>">
                                    <?php echo $row['NIC']; ?>
                                </a>
                                </td>

                                <td<?php echo $column == 'RegNo' ? $add_class : ''; ?>>
                                    <a href="details/orgd_d.php?id=<?php echo $row['orgDonorID']; ?>">
                                        <?php echo $row['RegNo']; ?>
                                    </a>
                                    </td>

                                    <td<?php echo $column == 'Name' ? $add_class : ''; ?>>
                                        <a href="details/fundr_d.php?id=<?php echo $row['fundRaiseID']; ?>">
                                            <?php echo $row['Name']; ?>
                                        </a>
                                        </td>

                                        <td>
                                            <a href="update.php?id=<?php echo $row['fundID']; ?>">Edit</a>&nbsp;
                                            <a href="delete.php?id=<?php echo $row['fundID']; ?>">Delete</a>
                                        </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php
    $result->free();
}
?>
<h3>Total Amount:
    <?php
    $sql_sum = "SELECT SUM(Amount) FROM fund";

    $result = $server_conn->query($sql_sum);

    //display total
    while ($row = mysqli_fetch_array($result)) {

        echo $row['SUM(Amount)'];
    }

    //close the connection
    $server_conn->close();
    ?>
</h3>