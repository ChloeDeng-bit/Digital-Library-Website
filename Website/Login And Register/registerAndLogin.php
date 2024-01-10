//This file is the interface that allows users to register or login.

//set up session
<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>

<html>
    <head>
    <title>LogIn/REGISTER</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    </head>

    <body>
    <?php include ("inc_header.html"); ?>

    <p>If you're a new user, please fill out the top form to register. Returning users, kindly complete the second form to log in.</p>
    <hr/>

    //the form for new user to register
    <h3>New User Registration</h3>

        <form method="post" action="register.php" >
        <p>Enter your name: 
        First <input type="text" name="first" />
        Last: <input type="text" name="last" /></p>
        <p>Enter your phone number: <input type="text" name="phone" /></p>
        <p><em>(Phone number are 10 integer)</em></p>
        <p>Enter your e-mail address: <input type="text" name="email" /></p>

        <p>Enter a password for your account: <input type="password" name="password" /></p>
        <p>Confirm your password: <input type="password" name="password2" /></p>
        <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>

            <table>
                <tr><th>register as a librarian<br/> click here</th><th>register as a borrower<br/>  click here</th><th>reset form <br/>click here</th></tr>
                <tr><td style="text-align: center"><input type="submit" name="register" value="librarian" /></td>
                <td style="text-align: center;width: 300px"><input type="submit" name="register" value="borrower"/></td>
                <td><input type="reset" name="reset" value="Reset Registration Form" /></td>
            </tr>
            </table>
        </form>
    <hr/>

    //the form for Returning User to login
    <h3>Returning User Login</h3>
        <form method="post" action="VerifyLogin.php" >
        <p>Enter your e-mail address: <input type="text" name="email" /></p>
        <p>Enter your password: <input type="password" name="password" /></p>
        <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p>

            <table>
                <tr><th>user login</th><th>reset login form <br/>click here</th></tr>
                <tr><td style="text-align: center;width: 250px"><input type="submit" name="login" value="login" /></td>
                <td><input type="reset" name="reset" value="Reset Login Form" /></td>
            </tr>
            </table>
        </form>
    <hr/>
    </body>
    
</html>
