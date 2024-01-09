<?php
$ErrorMsgs = array();
//try {
    $conn = new mysqli("localhost", "root", "root", "digital_library");

    if ($conn->connect_errno) {
        /* Use your preferred error logging method here */
        error_log('Connection error: ' . $mysqli->connect_errno);
    }
//}
// catch (mysqli_sql_exception $e) {
// 	$ErrorMsgs[] = "The database server is not available. Error: " . $e->getCode() . "." . $e->getMessage();
// }
?>
