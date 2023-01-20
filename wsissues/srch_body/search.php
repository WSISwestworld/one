<?php
$servername = 'localhost';

$username = "root";

$password = "";

try {

    $server_conn = new PDO("mysql:host=$servername;dbname=wsis", $username, $password);
    $server_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo '<br>' . $e->getMessage();
}

$searchErr = '';
$wsi_details = '';

if (isset($_POST['save'])) {

    if (!empty($_POST['search'])) {

        $search = $_POST['search'];

        // Administrator
        if (isset($_SESSION['adminID'])) {

            $search_sql = $server_conn->prepare("SELECT * FROM waterSupplyIssue WHERE (IssueType LIKE '%$search%') OR (District LIKE '%$search%') OR (Location LIKE '%$search%') OR (DurationOfIssue LIKE '%$search%') OR
            (Description LIKE '%$search%') OR (AwareMethod LIKE '%$search%') OR (Status LIKE '%$search%') OR (userID LIKE '%$search%') OR (adminID LIKE '%$search%')");

        }
        // Construction Company
        elseif (isset($_SESSION['conComID'])) {

            $search_sql = $server_conn->prepare("SELECT * FROM waterSupplyIssue WHERE (`Status` = 'Verified') AND ((IssueType LIKE '%$search%') OR (District LIKE '%$search%') OR (Location LIKE '%$search%') OR (DurationOfIssue LIKE '%$search%') OR
            (Description LIKE '%$search%') OR (Status LIKE '%$search%') OR (adminID LIKE '%$search%'))");

        } else {

            header("Location: ../dashboard/dashboard.php");

            exit();

        }

        $search_sql->execute();
        $wsi_details = $search_sql->fetchAll(PDO::FETCH_ASSOC);

    } else {

        $searchErr = "Please enter the information";
    }

}

?>

<div class="container">

    <form class="form-horizontal" action="#" method="post">
        <div class="row">
            <div class="form-group">

                <label class="control-label col-sm-4" for="search"><b>Search</b>:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="search" placeholder="Search here">

                </div>
                <div class="col-sm-2">
                    <button type="submit" name="save" class="btn btn-success btn-sm">Search</button>
                </div>

            </div>
            <div class="form-group">
                <span class="error" style="color:red;">
                    <?php echo $searchErr; ?>
                </span>
            </div>

        </div>
    </form>

    <br /><br />
    <h3><u>Search Results</u></h3><br />

    <div class="table-responsive">

        <table class="table">

            <thead>
                <tr>
                    <?php
                    // Administrator
                    if (isset($_SESSION['adminID'])) {
                        ?>
                        <th>#</th>
                        <th>Type of the Issue</th>
                        <th>District</th>
                        <th>Location</th>
                        <th>Duration Of the Issue (in Months)</th>
                        <th>Description</th>
                        <th>Awareness Method</th>
                        <th>Status</th>
                        <th>Information Provider ID</th>
                        <th>Admin ID</th>
                    <?php
                    }
                    // Construction Company
                    elseif (isset($_SESSION['conComID'])) {
                        ?>
                        <th>#</th>
                        <th>Type of the Issue</th>
                        <th>District</th>
                        <th>Location</th>
                        <th>Duration Of the Issue</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Admin ID</th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!$wsi_details) {
                    echo '<tr>No data found</tr>';
                } else {
                    foreach ($wsi_details as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>

                            <?php
                            // Administrator
                            if (isset($_SESSION['adminID'])) {
                                ?>

                                <td>
                                    <?php echo $value['IssueType']; ?>
                                </td>

                                <td><?php echo $value['District']; ?></td>

                                <td>
                                    <?php echo $value['Location']; ?>
                                </td>

                                <td><?php echo $value['DurationOfIssue']; ?></td>

                                <td>
                                    <?php echo $value['Description']; ?>
                                </td>

                                <td><?php echo $value['AwareMethod']; ?></td>

                                <td>
                                    <?php echo $value['Status']; ?>
                                </td>

                                <td><?php echo $value['userID']; ?></td>

                                <td>
                                    <?php echo $value['adminID']; ?>
                                </td>

                            <?php
                            }
                            // Construction Company
                            elseif (isset($_SESSION['conComID'])) {
                                ?>

                                <td>
                                    <?php echo $value['IssueType']; ?>
                                </td>

                                <td><?php echo $value['District']; ?></td>

                                <td>
                                    <?php echo $value['Location']; ?>
                                </td>

                                <td><?php echo $value['DurationOfIssue']; ?></td>

                                <td>
                                    <?php echo $value['Description']; ?>
                                </td>

                                <td>
                                    <?php echo $value['Status']; ?>
                                </td>

                                <td>
                                    <?php echo $value['adminID']; ?>
                                </td>

                            <?php
                            }
                            ?>

                            <td>
                                <a href="srch_body/result.php?id=<?php echo $value['issueID']; ?>">Open</a>
                            </td>

                        </tr>

                    <?php
                    }
                }
                ?>

            </tbody>

        </table>

    </div>

</div>