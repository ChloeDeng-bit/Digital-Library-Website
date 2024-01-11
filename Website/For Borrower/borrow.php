<!-- This file is for borrower to borrow books, from session ID to obtain borrower's name,
calculate expire date and cost, and change the status of the book into in-borrow and update corresponding 
(name, expire date, cost)in the database. -->

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

    //keep session
    if (isset($_SESSION['userID'])){

        $userID = $_SESSION['userID'];
        
    }
    else {
        $Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
        ++$error;
    
    }

    //connect database
    include("inc_digitalLibrary.php");

    //get the borrower's name
    $sql="SELECT * FROM user WHERE ID = $userID";
    $qRes = mysqli_query($conn, $sql);
    if (($Row=mysqli_fetch_assoc($qRes))!== 0) {

            $name=$Row["name"];
            $surname=$Row['surname'];
            $fullName=$name." ".$surname;

        }
    else{

        echo "there is no any resource.\n";
    }

    //check if get book information from GET, and save coresponding information 
    if(isset($_GET["bookID"])){
        $bookID=$_GET["bookID"];
    }
    else{
        echo"didn't get book id from GET";
    }

    if(isset($_GET["costP"])){
        $costP=$_GET["costP"];
    }
    else{
        echo"didn't get book id from GET";
    }

    //if get borrower's name and book information and session still working
    if(!(empty($fullName)&&empty($costP)&&empty($date)&&empty($bookID))&&($error==0)){
        //calculate expire date and the cost 
        $date=date('Y-m-d');
        $expire=date('Y-m-d', strtotime($date. ' +30 day'));
        $tcost=$costP*30;
        
        //save all the corresponding borrow information into database
        include("inc_digitalLibrary.php");

        $sql = "UPDATE resource
        SET status='in_borrow', borrower='".$fullName."' ,borrow_time='".$date."' ,total_cost='".$tcost."' ,expire_date='".$expire."' ,borrowerID='".$userID."'
        WHERE bookNo ='".$bookID."' ";
        
        //inform borrower whether borrow successful or not
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

    echo $Body;

    ?>

    </body>
</html>
