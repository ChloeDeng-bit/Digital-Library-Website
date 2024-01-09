<!DOCTYPE html>


<html>


<head>


<title>Create DATABASE</title>


<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />


</head>


<body>


<?php


$servername = "localhost";


$username = "root";


$password = "root";



// Create connection


    $conn = mysqli_connect($servername, $username, $password); 
    
    if (!$conn)                           //or (mysqli_errno() !=0)

                   die("Connection failed: ". mysqli_connect_errno() . " - " .  mysqli_connect_error());



// Create database


$sql = "CREATE DATABASE digital_library";



    if (mysqli_query($conn, $sql))


    echo "Database created successfully"; 


 else{


    die("Error creating database: " . mysqli_error($conn)); }



mysqli_close($conn);


?>


</body>


</html>
