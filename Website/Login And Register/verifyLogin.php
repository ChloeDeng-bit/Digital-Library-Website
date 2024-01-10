//this file is to verify login information

//initialize session
<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>verify login</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    </head>

    <body>
        <?php include ("inc_header.html"); ?>

        <?php

        //if receive email and password successfully then save them
        if(isset($_POST["email"])){
            $email=$_POST["email"];
        }
        else{
            echo"no email";
        }

        if(isset($_POST["password"])){
            $password=$_POST["password"];

        }
        else{
            echo"no password";
        }

        include("login.class.php");


        //verify the email and password
        $login=new login();

        $errors=($login->verify($email,$password));


        $type=$login->checkType($email);

        if ($errors > 0) {
            echo "<p>Please use your browser's BACK button to return " . " to the form and fix the errors indicated.</p>\n";
            echo "<p><a href='registerAndLogin.php'>back</a></p>\n";
        }

        //if the identity verified successfully then redirect user to next page according to their user type
        if ($errors == 0) {
            if($type=="librarian"){
                
                echo "<form method='post' " . " action='libraran.php?" . SID . "'>\n";
                echo "<input type='submit' name='submit' " . " value='librarian page'>\n";
                echo "</form>\n"; 
                }
            if($type=="borrower"){

                echo "<form method='post' " . " action='borrower.php?" . SID . "'>\n";
                echo "<input type='submit' name='submit' " . " value='borrower page'>\n";
                echo "</form>\n"; 
                    }     

        }
        ?>

        <?php include ("inc_footer.php"); ?>
    </body>
</html>
