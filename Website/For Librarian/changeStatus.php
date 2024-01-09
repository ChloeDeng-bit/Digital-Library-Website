<!DOCTYPE html>
<html>
<head>
<title>librarain main page</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<h1>librarain  page</h1>
<h2>library resource status change</h2>

<?php
session_start();
$name="";
$borrowerID="";
$Body = "";
$error = 0;
$userID = 0;
$input=true;

if(isset($_POST['submit'])){ // Check if form was submitted

    $name = $_POST['borrower']; // Get input text
    $borrowerID=$_POST['borrowerID'];
    //$message = "Success! You entered: " . $name;
    //echo $message;
    $input=false;
}

if (isset($_SESSION['userID'])){

	$userID = $_SESSION['userID'];
    //echo "session set successfull";
}
else {
	$Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
	++$error;
    echo "$error";
}

if(isset($_GET["status"])){
    $status=$_GET["status"];
    //echo "status is ".$status;
}
else{
    echo"didn't get status from GET";
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
if($input==false){

    $date=date('Y-m-d');
    $expire=date('Y-m-d', strtotime($date. ' +30 day'));
    $tcost=$costP*30;
    
    include("inc_digitalLibrary.php");
    //echo $expire;
    //echo serialize($conn);
    $SQL = "UPDATE resource
    SET status='in_borrow', borrowerID= '".$borrowerID."' ,borrower='".$name."' ,borrow_time='".$date."' ,total_cost='".$tcost."' ,expire_date='".$expire."'
    WHERE bookNo ='".$bookID."' ";
    //$qRes = $this->conn->query($sql);
    if(mysqli_query($conn, $SQL)){
        echo "<h3>the status of this book has been changed to in borrow.</h3>";
    }
    else{
        die("changing status error: ".mysqli_error($conn));
    }
}
if ($error == 0) {
    
        $conn = mysqli_connect("localhost", "root","root","digital_library");

        if(!$conn){
        echo "conection error".mysqli_connect_error();
        $Body .= "error: ".mysqli_connect_error();
        $Body .= "<p>Unable to execute the query.</p>\n";
        ++$errors;

    }
    if($status=="in_borrow"){
        //$status="avaliable";
        $TableName = "resource";
        $SQLstring = "UPDATE $TableName
        SET borrower=null, borrowerID=null , borrow_time=null,expire_date=null,total_cost=null, status='avaliable'
        WHERE bookNo ='".$bookID."' ";
        //$SQLstring = "SELECT count(*) FROM $TableName" . " where email=$email";
        if(mysqli_query($conn, $SQLstring)){
            echo "<h3>the status of this has been changed to avaliable</h3>";
        }
        else{
            die("changing status error: ".mysqli_error($conn));
        }
    }
    if($status=="avaliable"){
        if($input==true)
        {$Body .='<form method="post" action="">';
        
        $Body .='<p>Please enter the name of borrower: <input type="text" name="borrower" /></p>';
        $Body .='<p>Please enter the name of borrower ID: <input type="text" name="borrowerID" /></p>';
        //$Body .='<p>please enter the date of borrowing: <input type="date" name="password" /></p>';
        $Body .='<p><input type="submit" name="submit" value="submit" /></p>';
        $Body .='</form>';}

    }   

}

	$Body .= "<p>Return to the <a href='libraran.php?". SID . "'>Main page</a> page.</p>\n";

	$Body .= "<p>Please <a href='registerAndLogin.php'>Register or Log In</a> to use this page.</p>\n";

// if ($errors == 0)
// 	setcookie("LastRequestDate", urlencode($DisplayDate), time()+60*60*24*7); //, "/examples/internship/");
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
