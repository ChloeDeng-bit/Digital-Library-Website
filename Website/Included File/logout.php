<?php
#when you login, the session will be destroyed
#start session
session_start();
#the session array will be empty
$_SESSION = array();
#destroy session
session_destroy();

echo "<p>You have logged out this web page.</p>";
echo "<p>if you want to login in again use this page <a href='registerAndLogin.php'>Register or Log In</a></p>";
?>