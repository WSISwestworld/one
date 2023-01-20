<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $issueID = $_GET['id'];

    $sql_del = "DELETE FROM `waterSupplyIssue` WHERE `issueID`='$issueID'";

    $del_result = $server_conn->query($sql_del);

    if ($del_result == TRUE) {

        echo "Water Supply Issue deleted successfully.";

        header('Location: ../wsissues_search.php');

    } else {

        echo "Error:" . $sql_del . "<br>" . $server_conn->error;

    }

}

?>