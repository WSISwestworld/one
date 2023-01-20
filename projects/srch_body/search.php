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
$project_details = '';

if (isset($_POST['save'])) {

    if (!empty($_POST['search'])) {

        $search = $_POST['search'];

        // Administrator
        if (isset($_SESSION['adminID'])) {

            $search_sql = $server_conn->prepare("SELECT * FROM project LEFT JOIN constructionCompany ON project.conComID = constructionCompany.conComID WHERE
            (project.ProjectTitle LIKE '%$search%') OR (project.Description LIKE '%$search%') OR (project.ProjectArea LIKE '%$search%') OR (project.EstimatedTime LIKE '%$search%') OR
            (project.EstimatedCost LIKE '%$search%') OR (project.ProjectStatus LIKE '%$search%') OR (project.adminID LIKE '%$search%') OR (constructionCompany.ComName LIKE '%$search%')");

        }
        // Construction Company
        elseif (isset($_SESSION['conComID'])) {

            $com_id = $_SESSION['conComID'];

            $search_sql = $server_conn->prepare("SELECT * FROM project LEFT JOIN constructionCompany ON project.conComID = constructionCompany.conComID WHERE (project.conComID = '$com_id') AND 
            ((project.ProjectTitle LIKE '%$search%') OR (project.Description LIKE '%$search%') OR (project.ProjectArea LIKE '%$search%') OR (project.EstimatedTime LIKE '%$search%') OR
            (project.EstimatedCost LIKE '%$search%') OR (project.ProjectStatus LIKE '%$search%') OR (project.adminID LIKE '%$search%') OR (constructionCompany.ComName LIKE '%$search%'))");

        } else {

        header("Location: ../dashboard/dashboard.php");

        exit();

        }

        $search_sql->execute();
        $project_details = $search_sql->fetchAll(PDO::FETCH_ASSOC);

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
                    <span class="error" style="color:red;"><?php echo $searchErr; ?></span>
                </div>

            </div>
        </form>

        <br /><br />
        <h3><u>Search Results</u></h3><br />

        <div class="table-responsive">

            <table class="table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Title</th>
                        <th>Description</th>
                        <th>Project Area</th>
                        <th>Estimated Time</th>
                        <th>Estimated Cost</th>
                        <th>Project Status</th>
                        <th>Admin ID</th>
                        <th>Construction Company</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!$project_details) {
                        echo '<tr>No data found</tr>';
                    } else {
                        foreach ($project_details as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>

                                <td>
                                    <?php echo $value['ProjectTitle']; ?>
                                </td>

                                <td><?php echo $value['Description']; ?></td>

                                <td>
                                    <?php echo $value['ProjectArea']; ?>
                                </td>

                                <td><?php echo $value['EstimatedTime']; ?></td>

                                <td>
                                    <?php echo $value['EstimatedCost']; ?>
                                </td>

                                <td><?php echo $value['ProjectStatus']; ?></td>

                                <td>
                                    <?php echo $value['adminID']; ?>
                                </td>

                                <td><?php echo $value['ComName']; ?></td>

                                <td>
                                    <a href="srch_body/result.php?id=<?php echo $value['projectID']; ?>">Open</a>
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