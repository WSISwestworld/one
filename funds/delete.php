<?php

include "../db_conn.php";

if (isset($_GET['id'])) {

    $fundID = $_GET['id'];

    $sql_del = "DELETE FROM `fund` WHERE `fundID`='$fundID'";

    $del_result = $server_conn->query($sql_del);

    if ($del_result == TRUE) {

        echo "Fund deleted successfully.";

        header('Location: funds.php');

    } else {

        echo "Error:" . $sql_del . "<br>" . $server_conn->error;

    }

}

?>