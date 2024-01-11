<!--This file is to connect database-->

<?php
$ErrorMsgs = array();
//try {
    $conn = new mysqli("localhost", "root", "root", "digital_library");

    if ($conn->connect_errno) {
        error_log('Connection error: ' . $mysqli->connect_errno);
    }

