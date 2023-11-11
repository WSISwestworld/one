<?php

// Get the result...
if (
    $result = $server_conn->query('SELECT * FROM fundRaise ORDER BY ' . $column . ' ' . $sort_order)
) {
    // Some variables need for the table.
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';

    ?>

    <div>
        <h2>All Fundraise</h2>
        <table>
            <tr>
                <th><a href="fundraise.php?column=Name&order=<?php echo $asc_or_desc; ?>">Name<i
                            class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="fundraise.php?column=Description&order=<?php echo $asc_or_desc; ?>">Description<i
                            class="fas fa-sort<?php echo $column == 'Description' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="fundraise.php?column=EventDate&order=<?php echo $asc_or_desc; ?>">Date of the Event<i
                            class="fas fa-sort<?php echo $column == 'EventDate' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="fundraise.php?column=adminID&order=<?php echo $asc_or_desc; ?>">Admin ID<i
                            class="fas fa-sort<?php echo $column == 'adminID' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td<?php echo $column == 'Name' ? $add_class : ''; ?>>
                        <?php echo $row['Name']; ?>
                        </td>

                        <td<?php echo $column == 'Description' ? $add_class : ''; ?>>
                            <?php echo $row['Description']; ?>
                            </td>

                            <td<?php echo $column == 'EventDate' ? $add_class : ''; ?>>
                                <?php echo $row['EventDate']; ?>
                                </td>

                                <td<?php echo $column == 'adminID' ? $add_class : ''; ?>>
                                    <a href="details/admin_d.php?id=<?php echo $row['adminID']; ?>">
                                        <?php echo $row['adminID']; ?>
                                    </a>
                                    </td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php
    $result->free();
}
?>