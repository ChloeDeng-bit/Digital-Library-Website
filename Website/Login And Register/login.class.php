<?php
//build a login class
class login {
	private $conn = NULL;
	private $email;
	private $password ;
    
    //connect to database
	function __construct() {
		include("inc_digitalLibrary.php");
		$this->conn = $conn;

	}
	
    public function verify($email,$password){
        try {
            //check if user with the email and password exist in database
            $this->email= $email;
            $this->password = $password;
            $errors=0;
            $sql = "SELECT * FROM user where email = '" . stripslashes($this->email). "' and password='".md5(stripslashes($this->password))."'";
            $qRes = $this->conn->query($sql);
            //id doesn't exist then report error
            if($qRes->num_rows==0){
                echo "<p>The e-mail address/password " . " combination entered is not valid. </p>\n";
                ++$errors ;
            }
            
            //if does exist then save the user ID into SESSION
            else {
                $Row = $qRes->fetch_assoc();
                
                $userID = $Row['ID'];
                $userName = $Row['name'] . " " . $Row['surname'];
                echo "<h3>Welcome back, $userName!</h3>\n";
                $_SESSION['userID'] = $userID;
               
                
            }
        }
        catch (mysqli_sql_exception $e){
            echo $e->getCode() . "." . $e->getMessage();
         
        }
     
        return $errors ;

    }
    
    //function to check the type of user
    public function checkType($email){
        $this->email= $email;
        $sql = "SELECT * FROM user where email = '" . stripslashes($this->email)."'";
        $qRes = $this->conn->query($sql);
        $row= $qRes->fetch_assoc();
        echo "<h3>As a ".$row['type']." please enter the main page of library.";
        return $row['type'];
    

    }

}
