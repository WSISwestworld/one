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
$fundraise_details = '';

if (isset($_POST['save'])) {

    if (!empty($_POST['search'])) {

        $search = $_POST['search'];

        // Administrator
        if (isset($_SESSION['adminID'])) {

            $search_sql = $server_conn->prepare("SELECT * FROM fundRaise WHERE (fundRaiseID LIKE '%$search%') OR (Name LIKE '%$search%') OR 
            (Description LIKE '%$search%') OR (EventDate LIKE '%$search%') OR (adminID LIKE '%$search%')");

        }
        // Personal Donor
        elseif (isset($_SESSION['donorID'])) {

            $search_sql = $server_conn->prepare("SELECT * FROM fundRaise WHERE (Name LIKE '%$search%') OR 
            (Description LIKE '%$search%') OR (EventDate LIKE '%$search%') OR (adminID LIKE '%$search%')");

        } else {

            header("Location: ../dashboard/dashboard.php");

            exit();

        }

        $search_sql->execute();
        $fundraise_details = $search_sql->fetchAll(PDO::FETCH_ASSOC);

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

                        <th>ID</th>

                    <?php
                    }
                    ?>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date of the Event</th>
                    <th>Admin ID</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!$fundraise_details) {
                    echo '<tr>No data found</tr>';
                } else {
                    foreach ($fundraise_details as $key => $value) {
                        ?>
                        <tr>
                            <?php
                            // Administrator
                            if (isset($_SESSION['adminID'])) {
                                ?>

                                <td>
                                    <?php echo $value['fundRaiseID']; ?>
                                </td>

                            <?php
                            }
                            ?>

                            <td>
                                <?php echo $value['Name']; ?>
                            </td>

                            <td>
                                <?php echo $value['Description']; ?>
                            </td>

                            <td>
                                <?php echo $value['EventDate']; ?>
                            </td>

                            <td>
                                <?php echo $value['adminID']; ?>
                            </td>

                            <td>
                                <a href="srch_body/result.php?id=<?php echo $value['fundRaiseID']; ?>">Open</a>
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