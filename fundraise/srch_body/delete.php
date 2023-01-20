<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $fundRaiseID = $_GET['id'];

    $sql_del = "DELETE FROM `fundRaise` WHERE `fundRaiseID`='$fundRaiseID'";

    $del_result = $server_conn->query($sql_del);

    if ($del_result == TRUE) {

        echo "Fundraise deleted successfully.";

        header('Location: ../fundraise_search.php');

    } else {

        echo "Error:" . $sql_del . "<br>" . $server_conn->error;

    }

}

?>