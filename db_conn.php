<?php

$server_name = "localhost";

$server_uname = "root";

$server_password = "amaya";

$server_db_name = "wsis";

// Create connection
$server_conn = mysqli_connect($server_name, $server_uname, $server_password, $server_db_name);

// Check connection
if (!$server_conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>