<?php
//session_start();

$error=0;
$Body="";
$input=true;
$repeat=false;
$allInfor=true;
if(isset($_POST['submit'])){ // Check if form was submitted

    $ISBN = $_POST['ISBN']; 
    $title = $_POST['title']; 
    $author = $_POST['author']; 
    $publisher = $_POST['publisher']; 
    //$status = $_POST['status']; 
    $cost_per_day = $_POST['cost_per_day']; 
    //$message = $ISBN .$title.$author.$publisher.$status.$cost_per_day;
    //echo $message;
    $input=false;
}
if(!empty($ISBN)){
    include("inc_digitalLibrary.php");
    $TableName = "resource";
    $sql="SELECT * FROM $TableName WHERE ISBN='".$ISBN."'";
    $req=mysqli_query($conn, $sql);
    //$Row = mysqli_fetch_row($req);
    if (mysqli_fetch_row($req)!==null) {
        echo "<p>This book (" . htmlentities($ISBN) . ") has already in the resource.</p>\n";
        $repeat=true;
        mysqli_free_result($req);
    }
}

if((!empty($ISBN))&&(!empty($title))&&(!empty($author))&&(!empty($publisher))&&(!empty($cost_per_day)&&($repeat==false))){
    $allInfor=true;
    include("inc_digitalLibrary.php");
    $TableName = "resource";
    $sql="INSERT INTO $TableName (ISBN, title, author, publisher, status, cost_per_day)
    VALUES (".$ISBN.", '".$title."', '".$author."', '".$publisher."', 'avaliable',".$cost_per_day.")";
   if(mysqli_query($conn, $sql)){
       echo "the information has been insert successfully<br/>";
   }
   else{
       echo "fail to insert <br/>";
       die(mysqli_error($conn));
   }

}else if($allInfor==false){
    echo "please fill up all the information required";
}

if($input==true){ 
     $Body .="<p>Please enter the detail of the resource.</p>";
     $Body .='<form method="post" action="" >';
     $Body .='ISBN: <input type="text" name="ISBN" />&nbsp;&nbsp;';
     $Body .='Title: <input type="text" name="title" />&nbsp;&nbsp';
     $Body .='Author: <input type="text" name="author" /><br/><br/>';
     $Body .='Publisher: <input type="text" name="publisher" />&nbsp;&nbsp';
     //$Body .='Status: <input type="text" name="status" />&nbsp;&nbsp';
     $Body .='Cost per day: <input type="text" name="cost_per_day" />';
     $Body .='<p><input type="submit" name="submit" value="submit" /></p>';
     $Body .='</form>';
 }
 
     echo $Body;