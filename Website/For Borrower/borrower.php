<!-- This file the main page for borrower.
It includes the navigation to access different function and list all the book resource information.
Once user login and enter the page, all the expired resource will change status into available. -->

<?php
session_start();
$Body = "";
$error = 0;
$userID = 0;
?>

<!-- display the borrower main page with navigation -->
<!DOCTYPE html>
<html>
    <head>
        <title>Borrower main page</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    </head>

    <body>
        <?php include ("inc_header.html"); ?>
        <div style = "width:20%; text-align:center; ">

        <!-- include navigation button -->
        <?php include ("inc_bottonnav2.php"); ?>
        </div>
        <?php
        
        //once the navigation buttons be clicked, then display corresponding functions
            if (isset($_GET['content'])) {
                switch ($_GET['content']) {
                    case 'myBorrow':
                        include('myBorrow.php');
                        break;
                    case 'in_borrow':
                        include('resourceInBorrow.php');
                        break;
                    case 'search': 
                    default:
                        include('borrowerSearch.php');
                        break;
                }
            }
            // if no button has been selected still in the home page
            else 
                include('inc_home.html');
        ?>
        <?php

        //save current data
        $date=date('Y-m-d');

        //keep session
        if (isset($_SESSION['userID'])){

            $userID = $_SESSION['userID'];
        }
        else {
            $Body .= "<p>You have not logged in or registered. Please return to the <a href='registerAndLogin.php'>Registration / Log In page</a>.</p>";
            ++$error;
            echo "$error";
        }

        //set all the expired resource to avaliable by comparing the book expire date with current data
            $conn = mysqli_connect ("localhost", "root", "root","digital_library");
            if(!$conn){
                die("connection fail: ".mysqli_connect_error());
            }
            $TableName = "resource";
            $SQLstring = "UPDATE $TableName
            SET borrower=null, borrow_time=null,expire_date=null,total_cost=null,status='avaliable'
            WHERE expire_date <'".$date."' ";
           
            if(mysqli_query($conn, $SQLstring)){
              
            }
            else{
                die("changing status error: ".mysqli_error($conn));
            }

            if ($error > 0) {
                echo "<p>Please use your browser's BACK button to return " . " to the form and fix the errors indicated.</p>\n";
            }

        //display available resource
        if ($error == 0) {
            $TableName = "resource";
            $sql = "SELECT * FROM $TableName where status='avaliable'";
            $qRes = mysqli_query($conn, $sql);
            if (mysqli_num_rows($qRes) > 0) {
                while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
                    $resources[] = $Row;
                mysqli_free_result($qRes);
                }
            else{

                echo "there is no any resource.\n";
            }
            
            echo "<h1>all the avaliable library resource</h1>";

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

                        
                        echo $resource['status']    .":<a href='borrow.php?" . SID ."&status=" . $resource['status'] ."&costP=" . $resource['cost_per_day'] . "&bookID=" . $resource['bookNo'] . "'>"."borrow</a>";
                       
                echo "</td>\n";
                echo "</tr>\n";
            
        }
        echo "</table>\n";

        } 
        echo "<p>Log out use this page <a href='logout.php'>log out</a></p>";
       
        ?>
        <?php include ("inc_footer.php"); ?>
    </body>
</html>
