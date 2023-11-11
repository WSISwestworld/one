<?php

// Get the result...
if (
    $result = $server_conn->query('SELECT * FROM project LEFT JOIN constructionCompany ON
    project.conComID = constructionCompany.conComID ORDER BY ' . $column . ' ' . $sort_order)
) {
    // Some variables need for the table.
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';

    ?>

    <div>
        <h2>All Projects</h2>
        <table>
            <tr>
                <th><a href="projects.php?column=ProjectTitle&order=<?php echo $asc_or_desc; ?>">Project Title<i
                            class="fas fa-sort<?php echo $column == 'ProjectTitle' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=Description&order=<?php echo $asc_or_desc; ?>">Description<i
                            class="fas fa-sort<?php echo $column == 'Description' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=ProjectArea&order=<?php echo $asc_or_desc; ?>">Project Area<i
                            class="fas fa-sort<?php echo $column == 'ProjectArea' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=EstimatedTime&order=<?php echo $asc_or_desc; ?>">Estimated Time<i
                            class="fas fa-sort<?php echo $column == 'EstimatedTime' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=EstimatedCost&order=<?php echo $asc_or_desc; ?>">Estimated Cost<i
                            class="fas fa-sort<?php echo $column == 'EstimatedCost' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=ProjectStatus&order=<?php echo $asc_or_desc; ?>">Project Status<i
                            class="fas fa-sort<?php echo $column == 'ProjectStatus' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=adminID&order=<?php echo $asc_or_desc; ?>">Admin ID<i
                            class="fas fa-sort<?php echo $column == 'adminID' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>

                <th><a href="projects.php?column=ComName&order=<?php echo $asc_or_desc; ?>">Construction Company<i
                            class="fas fa-sort<?php echo $column == 'ComName' ? '-' . $up_or_down : ''; ?>"></i></a>
                </th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td<?php echo $column == 'ProjectTitle' ? $add_class : ''; ?>>
                        <?php echo $row['ProjectTitle']; ?>
                        </td>

                        <td<?php echo $column == 'Description' ? $add_class : ''; ?>>
                            <?php echo $row['Description']; ?>
                            </td>

                            <td<?php echo $column == 'ProjectArea' ? $add_class : ''; ?>>
                                <?php echo $row['ProjectArea']; ?>
                                </td>

                                <td<?php echo $column == 'EstimatedTime' ? $add_class : ''; ?>>
                                    <?php echo $row['EstimatedTime']; ?>
                                    </td>

                                    <td<?php echo $column == 'EstimatedCost' ? $add_class : ''; ?>>
                                        <?php echo "RS." . $row['EstimatedCost']; ?>
                                        </td>

                                        <td<?php echo $column == 'ProjectStatus' ? $add_class : ''; ?>>
                                            <?php echo $row['ProjectStatus']; ?>
                                            </td>

                                            <td<?php echo $column == 'adminID' ? $add_class : ''; ?>>
                                                <a href="details/admin_d.php?id=<?php echo $row['adminID']; ?>">
                                                    <?php echo $row['adminID']; ?>
                                                </a>
                                                </td>

                                                <td<?php echo $column == 'ComName' ? $add_class : ''; ?>>
                                                    <a href="details/company_d.php?id=<?php echo $row['conComID']; ?>">
                                                        <?php echo $row['ComName']; ?>
                                                    </a>
                                                    </td>

                                                    <td>
                                                        <a href="update.php?id=<?php echo $row['projectID']; ?>">Edit</a>&nbsp;
                                                        <a href="delete.php?id=<?php echo $row['projectID']; ?>">Delete</a>
                                                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php
    $result->free();
}
?>