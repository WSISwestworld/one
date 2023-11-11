<?php

// Get the result...
if (
    $result = $server_conn->query('SELECT * FROM fund ORDER BY ' . $column . ' ' . $sort_order)
) {
    // Some variables need for the table.
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';

    ?>

    <div>
        <h2>Funds</h2>
        <table>
            <tr>
                <th><a href="funds.php?column=Amount&order=<?php echo $asc_or_desc; ?>">Amount<i
                            class="fas fa-sort<?php echo $column == 'Amount' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="funds.php?column=Date&order=<?php echo $asc_or_desc; ?>">Date<i
                            class="fas fa-sort<?php echo $column == 'Date' ? '-' . $up_or_down : ''; ?>"></i></a>
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