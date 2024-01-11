<!-- This file is for libraian to search book resource by input keyword, and display all the relative book -->
<?php
session_start();
$error=0;
$Body="";
$input=true;

//keep the session
if (isset($_SESSION['userID'])){

    $userID = $_SESSION['userID'];
}
else {
    $Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
    ++$error;
    echo "$error";
}

// Check if the keyword has been submitted 
if(isset($_POST['submit'])){ 
    // save the keyword
    $keyword = $_POST['keyword']; 
    $message = "<h3>You have entered the keyword: " . $keyword."</h3>";
    echo $message;
    $input=false;

    //then start to search
    include("inc_digitalLibrary.php");
    $TableName = "resource";
   $sql = "SELECT * FROM $TableName where ISBN like '%$keyword%' or title like '%$keyword%' or author like '%$keyword%' or publisher like '%$keyword%' or status like '%$keyword%'";
   $qRes = mysqli_query($conn, $sql);
   if (mysqli_num_rows($qRes) > 0) {
    while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
        $avaliable[] = $Row;
    mysqli_free_result($qRes);

//display all the relative book information
echo "<h1>the related resource</h1>";
echo "<br/>";
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
    echo " <td style='text-align:center'>";

            
            echo $a['status']    .":<a href='changeStatus.php?" . SID ."&status=" . $a['status'] ."&costP=" . $a['cost_per_day'] . "&bookID=" . $a['bookNo'] . "'>"."change status</a>";
    echo "</td>\n";
    echo "</tr>\n";

}
echo "</table>\n";

}
else if (mysqli_num_rows($qRes) == 0) {
  echo "<p>sorry no resource can be found according to your key word, please try another keyword.</p>";
}
}

//if librarian hasn't input keyword, display the form for librarian to input keyword
if($input==true)&&($error==0){ 
    $Body .='<form method="post" action="" >';      
    $Body .='<p>Please enter the key word to search the resource: <input type="text" name="keyword" /></p>';
    $Body .='<p><input type="submit" name="submit" value="submit" /></p>';
    $Body .='</form>';
}

echo $Body;


?>
