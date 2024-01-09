<?php
//session_start();
$error=0;
if (isset($_SESSION['userID'])){

	$userID = $_SESSION['userID'];
    //echo "session set successfull";
}
else {
	$Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
	++$error;
    echo "$error";
}

include("inc_digitalLibrary.php");


if ($error > 0) {
    echo "<p>Please use your browser's BACK button to return " . " to the form and fix the errors indicated.</p>\n";
}
//add table
if ($error == 0) {
$TableName = "resource";
$sql = "SELECT * FROM $TableName where status='in_borrow'";
$qRes = mysqli_query($conn, $sql);
if (mysqli_num_rows($qRes) > 0) {
    while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
        $avaliable[] = $Row;
    mysqli_free_result($qRes);
//mysqli_close($conn);
echo "<h1>Resource in borrow</h1>";

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
foreach ($avaliable as $a) {
    echo "<tr>\n";
    echo " <td style='text-align:center'>" . htmlentities($a['bookNo']) . "</td>\n";
    echo " <td style='text-align:center'>" . htmlentities($a['ISBN']) . "</td>\n";
    echo " <td style='text-align:center'>" . htmlentities($a['title']) . "</td>\n";
    echo " <td style='text-align:center'>" . htmlentities($a['author']) . "</td>\n";
    echo " <td style='text-align:center'>" . htmlentities($a['publisher']) . "</td>\n";
    echo " <td style='text-align:center'>" . htmlentities($a['cost_per_day']) . "</td>\n";
    echo " <td style='text-align:center;width:300px'>" . htmlentities($a['status']) . "</td>\n";

            
    echo "</tr>\n";

}
echo "</table>\n";

     }
else{

    echo "there is no any resource avaliable.\n";
}


} 