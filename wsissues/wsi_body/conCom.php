<?php

$sql = "SELECT * FROM waterSupplyIssue WHERE `Status` = 'Verified' ORDER BY $column $sort_order";

// Get the result...
if (
    $result = $server_conn->query($sql)
) {
    // Some variables need for the table.
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';

    ?>

    <div>
        <h2>Verified Water Supply Issues</h2>
        <table>
            <tr>
                <th><a href="wsissues.php?column=IssueType&order=<?php echo $asc_or_desc; ?>">Type of the Issue<i
                            class="fas fa-sort<?php echo $column == 'IssueType' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="wsissues.php?column=District&order=<?php echo $asc_or_desc; ?>">District<i
                            class="fas fa-sort<?php echo $column == 'District' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="wsissues.php?column=Location&order=<?php echo $asc_or_desc; ?>">Location<i
                            class="fas fa-sort<?php echo $column == 'Location' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="wsissues.php?column=DurationOfIssue&order=<?php echo $asc_or_desc; ?>">Duration Of the Issue<i
                            class="fas fa-sort<?php echo $column == 'DurationOfIssue' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="wsissues.php?column=Description&order=<?php echo $asc_or_desc; ?>">Description<i
                            class="fas fa-sort<?php echo $column == 'Description' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="wsissues.php?column=Status&order=<?php echo $asc_or_desc; ?>">Status<i
                            class="fas fa-sort<?php echo $column == 'Status' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="wsissues.php?column=adminID&order=<?php echo $asc_or_desc; ?>">Admin ID<i
                            class="fas fa-sort<?php echo $column == 'adminID' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td<?php echo $column == 'IssueType' ? $add_class : ''; ?>>
                        <?php echo $row['IssueType']; ?>
                        </td>

                        <td<?php echo $column == 'District' ? $add_class : ''; ?>>
                            <?php echo $row['District']; ?>
                            </td>

                            <td<?php echo $column == 'Location' ? $add_class : ''; ?>>
                                <?php echo $row['Location']; ?>
                                </td>

                                <td<?php echo $column == 'DurationOfIssue' ? $add_class : ''; ?>>
                                    <?php
                                    if ($row['DurationOfIssue'] >= 12) {
                                        echo floor(($row['DurationOfIssue']) / 12) . " Years";
                                    } else {
                                        echo ($row['DurationOfIssue']) . " Months";
                                    }
                                    ?>
                                    </td>

                                    <td<?php echo $column == 'Description' ? $add_class : ''; ?>>
                                        <?php echo $row['Description']; ?>
                                        </td>

                                        <td<?php echo $column == 'Status' ? $add_class : ''; ?>>
                                            <?php echo $row['Status']; ?>
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