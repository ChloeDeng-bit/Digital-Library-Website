<!-- This file is to change the status of the book, if all the information of the book has been set and get,
save the information. If the book status is in borrow, change the status to avaliable, if the book status is avaliable,
echo the form for librarian to input borrower's information. If the borrower's information has been submit, 
then add borrower's information and all the other relative information for borrowing. -->

<?php
session_start();
?>

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
        $name="";
        $borrowerID="";
        $Body = "";
        $error = 0;
        $userID = 0;
        $input=true;

        // Check if borrower's information has been submitted
        if(isset($_POST['submit'])){ 

            // save the borrower information
            $name = $_POST['borrower']; 
            $borrowerID=$_POST['borrowerID'];
            //no need form to input borrower's information
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
        
        //check if also receive other book relative information and save the information
        if(isset($_GET["status"])){
            $status=$_GET["status"];
        }
        else{
            echo"didn't get status from GET";
            exit;
        }

        if(isset($_GET["bookID"])){
            $bookID=$_GET["bookID"];
        }
        else{
            echo"didn't get book id from GET";
            exit;
        }

        if(isset($_GET["costP"])){
            $costP=$_GET["costP"];
        }
        else{
            echo"didn't get book id from GET";
            exit;
        }

        //if borrower's information has been submitted, then append borrower's information to the book
        if($input==false){

            $date=date('Y-m-d');
            $expire=date('Y-m-d', strtotime($date. ' +30 day'));
            $tcost=$costP*30;
            
            include("inc_digitalLibrary.php");

            //add borrower's information as well as borrow data, cost, expire date
            $SQL = "UPDATE resource
            SET status='in_borrow', borrowerID= '".$borrowerID."' ,borrower='".$name."' ,borrow_time='".$date."' ,total_cost='".$tcost."' ,expire_date='".$expire."'
            WHERE bookNo ='".$bookID."' ";

            if(mysqli_query($conn, $SQL)){
                $Body .= "<h3>the status of this book has been changed to in borrow.</h3>";
            }
            else{
                die("changing status error: ".mysqli_error($conn));
            }
        }

        //if connect to database successfully
        if ($error == 0) {
            
                $conn = mysqli_connect("localhost", "root","root","digital_library");

                if(!$conn){
                $Body .= "error: ".mysqli_connect_error();
                $Body .= "<p>Unable to execute the query.</p>\n";
                ++$errors;

            }

            //check the book status, if the book is in borrow then change the status to avaliable
            if($status=="in_borrow"){

                $TableName = "resource";
                $SQLstring = "UPDATE $TableName
                SET borrower=null, borrowerID=null , borrow_time=null,expire_date=null,total_cost=null, status='avaliable'
                WHERE bookNo ='".$bookID."' ";
                if(mysqli_query($conn, $SQLstring)){
                    $Body .="<h3>the status of this has been changed to avaliable</h3>";
                }
                else{
                    die("changing status error: ".mysqli_error($conn));
                }
            }

            //if the book status is avaliable and librarian has not input borrower's information
            //Then present the form to for librarian to submit the borrower's information
            if($status=="avaliable"){
                if($input==true)
                {$Body .='<form method="post" action="">';
                
                $Body .='<p>Please enter the name of borrower: <input type="text" name="borrower" /></p>';
                $Body .='<p>Please enter the name of borrower ID: <input type="text" name="borrowerID" /></p>';
                $Body .='<p><input type="submit" name="submit" value="submit" /></p>';
                $Body .='</form>';}

            }   

        }

            $Body .= "<p>Return to the <a href='libraran.php?". SID . "'>Main page</a> page.</p>\n";

            $Body .= "<p>Please <a href='registerAndLogin.php'>Register or Log In</a> to use this page.</p>\n";

        echo $Body
        ?>

    </body>
</html>
