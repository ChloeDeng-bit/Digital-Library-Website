<?php
session_start();
$Body = "";
$error = 0;
$userID = 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>librarain main page</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<?php include ("inc_header.html"); ?>
<div style = "width:20%; text-align:center; ">
<?php include ("inc_bottonnav1.php"); ?>
</div>
<?php
    if (isset($_GET['content'])) {
        switch ($_GET['content']) {
            case 'avaliable':
                include('avaliableResource.php');
                break;
            case 'in_borrow':
                include('resourceInUse.php');
                break;
            case 'insert':
                include('insert.php');
                break;
            case 'search': 
            default:
                include('search.php');
                break;
        }
    }
    else // No button has been selected
        include('inc_home.html');
?>
<?php

$date=date('Y-m-d');
//cho $date;

if (isset($_SESSION['userID'])){

	$userID = $_SESSION['userID'];
    //echo "session set successfull";
}
else {
	$Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
	++$error;
    echo "$error";
}

    $conn = mysqli_connect ("localhost", "root", "root","digital_library");
    if(!$conn){
        die("connection fail: ".mysqli_connect_error());
    }
    $TableName = "resource";
    $SQLstring = "UPDATE $TableName
    SET borrower=null, borrow_time=null,expire_date=null,total_cost=null,status='avaliable'
    WHERE expire_date <'".$date."' ";
    //$SQLstring = "SELECT count(*) FROM $TableName" . " where email=$email";
    if(mysqli_query($conn, $SQLstring)){
        //echo "query successful";
    }
    else{
        die("changing status error: ".mysqli_error($conn));
    }

    if ($error > 0) {
        echo "<p>Please use your browser's BACK button to return " . " to the form and fix the errors indicated.</p>\n";
    }
//add table
if ($error == 0) {
    $TableName = "resource";
    $sql = "SELECT * FROM $TableName";
    $qRes = mysqli_query($conn, $sql);
    if (mysqli_num_rows($qRes) > 0) {
        while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
            $resources[] = $Row;
        mysqli_free_result($qRes);
         }
    else{

        echo "there is no any resource.\n";
    }
    //mysqli_close($conn);
    echo "<h1>all the library resource</h1>";
    //echo "<br/>";
    //table and header
    echo "<table border='1' width='100%'>\n";
echo "<tr>\n";
echo " <th style='background-color:cyan;width:100px'>BOOK NUMBER</th>\n";
echo " <th style='background-color:cyan'>ISBN</th>\n";
echo " <th style='background-color:cyan'>TITLE</th>\n";
echo " <th style='background-color:cyan'>AUTHOR</th>\n";
echo " <th style='background-color:cyan'>PUBLISHER</th>\n";
echo " <th style='background-color:cyan;width:100px'>COST PER DAY ($)</th>\n";
echo " <th style='background-color:cyan'>STATUS</th>\n";
echo "</tr>\n";
foreach ($resources as $resource) {
		echo "<tr>\n";
        echo " <td style='text-align:center'>" . htmlentities($resource['bookNo']) . "</td>\n";
		echo " <td style='text-align:center'>" . htmlentities($resource['ISBN']) . "</td>\n";
		echo " <td style='text-align:center'>" . htmlentities($resource['title']) . "</td>\n";
		echo " <td style='text-align:center'>" . htmlentities($resource['author']) . "</td>\n";
		echo " <td style='text-align:center'>" . htmlentities($resource['publisher']) . "</td>\n";
        echo " <td style='text-align:center'>" . htmlentities($resource['cost_per_day']) . "</td>\n";
		echo " <td style='text-align:center'>";

				
				echo $resource['status']    .":<a href='changeStatus.php?" . SID ."&status=" . $resource['status'] ."&costP=" . $resource['cost_per_day'] . "&bookID=" . $resource['bookNo'] . "'>"."change status</a>";
                //echo "<a href='myDelete.php?" . SID . "&FCode=" . $facility['FCode'] ."&StudentID=" . $studentID . "'>enrollment</a>";
		echo "</td>\n";
		echo "</tr>\n";
	
}
echo "</table>\n";

} 
echo "<p>Log out use this page <a href='logout.php'>log out</a></p>";
//echo "<p>Please <a href='registerAndLogin.php'>Register or Log In</a> to use this page.</p>";
?>
<?php include ("inc_footer.php"); ?>
</body>
</html>
