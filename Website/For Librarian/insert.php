<!-- This file is for librarian to insert new book resource,
it will check if all the book information has been input and if the book exist before save in the database. -->

<?php
session_start();

$error=0;
$Body="";
$input=true;
$repeat=false;
$allInfor=true;

// Check if the book information has been submitted and save them
if(isset($_POST['submit'])){ 

    $ISBN = $_POST['ISBN']; 
    $title = $_POST['title']; 
    $author = $_POST['author']; 
    $publisher = $_POST['publisher'];  
    $cost_per_day = $_POST['cost_per_day']; 
    $input=false;
}

//keep the session
if (isset($_SESSION['userID'])){

    $userID = $_SESSION['userID'];
}
else {
    $Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
    ++$error;
    echo "$error";
}

//check if the book exist already or not
if(!empty($ISBN)){
    include("inc_digitalLibrary.php");
    $TableName = "resource";
    $sql="SELECT * FROM $TableName WHERE ISBN='".$ISBN."'";
    $req=mysqli_query($conn, $sql);

    if (mysqli_fetch_row($req)!==null) {
        echo "<p>This book (" . htmlentities($ISBN) . ") has already in the resource.</p>\n";
        $repeat=true;
        mysqli_free_result($req);
    }
}

//if the book is not exist in the database and all the book information has been saved successfully 
//save the add this book information into resource table
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

//else echo the warning
}else if($allInfor==false){
    echo "please fill up all the information required";
}

//if the information haven't been input then display the form for librarian to input book information
if($input==true)&&($error==0){ 
     $Body .="<p>Please enter the detail of the resource.</p>";
     $Body .='<form method="post" action="" >';
     $Body .='ISBN: <input type="text" name="ISBN" />&nbsp;&nbsp;';
     $Body .='Title: <input type="text" name="title" />&nbsp;&nbsp';
     $Body .='Author: <input type="text" name="author" /><br/><br/>';
     $Body .='Publisher: <input type="text" name="publisher" />&nbsp;&nbsp';
     $Body .='Cost per day: <input type="text" name="cost_per_day" />';
     $Body .='<p><input type="submit" name="submit" value="submit" /></p>';
     $Body .='</form>';
 }
 
     echo $Body;
     ?>
