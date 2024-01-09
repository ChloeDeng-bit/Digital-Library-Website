<!DOCTYPE html>
<html>
<head>
<title>borrow page</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h1>Borrow page</h1>
<h2>library resource</h2>

<?php
session_start();
$name="";
$Body = "";
$error = 0;
$userID = 0;



if (isset($_SESSION['userID'])){

	$userID = $_SESSION['userID'];
    //echo "session set successfull";
}
else {
	$Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
	++$error;
   // echo "$error";
}

include("inc_digitalLibrary.php");
$sql="SELECT * FROM user WHERE ID = $userID";
$qRes = mysqli_query($conn, $sql);
 if (($Row=mysqli_fetch_assoc($qRes))!== 0) {
         //print_r($Row);

         $name=$Row["name"];
         $surname=$Row['surname'];
         $fullName=$name." ".$surname;
         //echo $fullName;
     }
else{

    echo "there is no any resource.\n";
}

if(isset($_GET["bookID"])){
    $bookID=$_GET["bookID"];
    //echo "book id is ".$bookID;
}
else{
    echo"didn't get book id from GET";
}

if(isset($_GET["costP"])){
    $costP=$_GET["costP"];
    //echo "cost is ".$costP;
}
else{
    echo"didn't get book id from GET";
}

if(!(empty($fullName)&&empty($costP)&&empty($date)&&empty($bookID))){
    $date=date('Y-m-d');
    $expire=date('Y-m-d', strtotime($date. ' +30 day'));
    $tcost=$costP*30;
    
    include("inc_digitalLibrary.php");

    $sql = "UPDATE resource
    SET status='in_borrow', borrower='".$fullName."' ,borrow_time='".$date."' ,total_cost='".$tcost."' ,expire_date='".$expire."' ,borrowerID='".$userID."'
    WHERE bookNo ='".$bookID."' ";
    //$qRes = $this->conn->query($sql);
    if(mysqli_query($conn, $sql)){
        echo "<h3>You have borrowed this book successfully<br/></h3>";
        echo "<h3>the duration of the borrowing is 30 days,
        the expire date is $expire, and the cost of the 
        borrowing total is $$tcost.</h3>";
    }
    else{
        die("changing status error: ".mysqli_error($conn));
    }

}


	$Body .= "<p>Return to the <a href='borrower.php?". SID . "'>Main page</a> page.</p>\n";

	$Body .= "<p>Please <a href='registerAndLogin.php'>Register or Log In</a> to use this page.</p>\n";

?>
<!DOCTYPE html>
<html>
<head>
<title>library</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
echo $Body;
?>
</body>
</html>
