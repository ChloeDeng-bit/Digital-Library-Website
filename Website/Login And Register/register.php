<!--This file is to check the register information format and report the error.
Once all the format correct save the user information into database-->


<?php
//initialize a session 
session_start();
?>

<!DOCTYPE html>

<html>

    <head>
        <title>LogIn/REGISTER</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    </head>

    <body>
        <?php include ("inc_header.html"); ?>

        <?php
        $errors = 0;
        $email = "";

        //verify if all the input in the right form
        if(empty($_POST['first'])||empty($_POST['last'])){
            ++$errors;
            echo "<p>You need to enter your name.</p>\n";  
        }
        if(empty($_POST['phone'])){
            ++$errors;
            echo "<p>You need to enter your phone number.</p>\n";  
        }
        else{
            $phone=$_POST["phone"];
            if (preg_match('/^[0-9]{10}+$/', $phone) == 0) {
                ++$errors;
                echo "<p>You need to enter a valid " . "phone number.</p>\n";
                $phone= "";
            }
        }

        if (empty($_POST['email'])) {
            ++$errors;
            echo "<p>You need to enter an e-mail address.</p>\n";
            }
        else {
            $email = stripslashes($_POST['email']);
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email) == 0) {
                ++$errors;
                echo "<p>You need to enter a valid " . "e-mail address.</p>\n";
                $email = "";
            }
        }

        if (empty($_POST['password'])) {
            ++$errors;
            echo "<p>You need to enter a password.</p>\n"; 
            $password = "";
        }
        else
            $password = stripslashes($_POST['password']);

        if (empty($_POST['password2'])) {
            ++$errors;
            echo "<p>You need to enter a confirmation password.</p>\n";
            $password2 = "";
        }
        else
            $password2 = stripslashes($_POST['password2']);

        if ((!(empty($password))) && (!(empty($password2)))) {
            if (strlen($password) < 6) {
                ++$errors;
                echo "<p>The password is too short.</p>\n";
                $password = "";
                $password2 = "";
            }
            if ($password <> $password2) {
                ++$errors;
                echo "<p>The passwords do not match.</p>\n";
                $password = "";
                $password2 = "";
            }
        }

        //if all the input in right format then connect to database
        if ($errors == 0) {
            try {
                $conn = mysqli_connect ("localhost", "root", "root","digital_library");

                //check if the user exist
                $TableName = "user";
                $SQLstring = "SELECT count(*) FROM $TableName where email ='".$email."' ";
                $QueryResult = mysqli_query($conn, $SQLstring);
                $Row = mysqli_fetch_row($QueryResult);
                if ($Row[0]>0) {
                    echo "<p>The email address entered (" . htmlentities($email) . ") is already registered.</p>\n";
                    ++$errors;
                }
            }
            //catch the error if connect to database unsuccessfully
            catch (mysqli_sql_exception $e) {
                    echo "<p>Unable to connect to the database </p>\n";
                    ++$errors;
            }
        }

        //if there's any error then prompt user the error and provide the link to register and login page
        if ($errors > 0) {
            echo "<p>Please use your browser's BACK button to return" . " to the form and fix the errors indicated.</p>\n";
            echo "<p><a href='registerAndLogin.php'>back</a></p>\n";
        }

        //if there's no error then save the user information into database
        if ($errors == 0) {
            $first = stripslashes($_POST['first']);
            $last = stripslashes($_POST['last']);
            $type=stripslashes($_POST['register']);
            
            $SQLstring = "INSERT INTO $TableName " . " (name, surname, phone, email, type, password) " . " VALUES( '$first', '$last', '$phone', '$email', '$type', " . " '" . md5($password) . "')";
            if(mysqli_query($conn, $SQLstring)){
                echo "<h3>Your register as a user is successfull.<h3>";
                echo "<h3>Go to your main page click button below.<h3>";
            }
            else{
                echo "<p>Unable to insert record </p>\n";
                die("error:".mysqli_error($conn));
                ++$errors;
            }
            $userID = mysqli_insert_id($conn);
            $_SESSION['userID'] = $userID;
            mysqli_close($conn);
        
            
        }

        //if the data save successfully then user back to different web page according to their user type
        if ($errors == 0) {
            if($type=="librarian"){
                echo "<form method='post' " . " action='librarian.php?" . SID . "'>\n";
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
