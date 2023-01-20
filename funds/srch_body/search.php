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
$funds_details = '';

if (isset($_POST['save'])) {

    if (!empty($_POST['search'])) {

        $search = $_POST['search'];

        $search_sql = $server_conn->prepare("SELECT * FROM fund LEFT JOIN personalDonor ON fund.donorID = personalDonor.donorID LEFT JOIN 
        fundRaise ON fund.fundRaiseID = fundRaise.fundRaiseID LEFT JOIN organizationalDonor ON fund.orgDonorID = organizationalDonor.orgDonorID
        WHERE (Amount LIKE '%$search%') OR (Date LIKE '%$search%') OR (NIC LIKE '%$search%') OR (RegNo LIKE '%$search%') OR (Name LIKE '%$search%')");

        $search_sql->execute();
        $funds_details = $search_sql->fetchAll(PDO::FETCH_ASSOC);

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
                    <th>#</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>NIC (Personal Donor)</th>
                    <th>Registration No (Organizational Donor)</th>
                    <th>Name (Fundraise)</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!$funds_details) {
                    echo '<tr>No data found</tr>';
                } else {
                    foreach ($funds_details as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>

                                <td>
                                    <?php echo $value['Amount']; ?>
                                </td>

                                <td><?php echo $value['Date']; ?></td>

                                <td>
                                    <?php echo $value['NIC']; ?>
                                </td>

                                <td>
                                    <?php echo $value['RegNo']; ?>
                                </td>

                                <td><?php echo $value['Name']; ?></td>

                            <td>
                                <a href="srch_body/result.php?id=<?php echo $value['fundID']; ?>">Open</a>
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