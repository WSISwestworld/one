<?php

include "../../db_conn.php";

if (isset($_GET['id'])) {

    $projectID = $_GET['id'];

    $sql_del = "DELETE FROM `project` WHERE `projectID`='$projectID'";

    $del_result = $server_conn->query($sql_del);

    if ($del_result == TRUE) {

        echo "Project deleted successfully.";

        header('Location: ../projects_search.php');

    } else {

        echo "Error:" . $sql_del . "<br>" . $server_conn->error;

    }

}

?>