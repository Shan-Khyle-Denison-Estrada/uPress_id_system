<?php
include_once("connection/PDOModel.php");
@session_start();
class loginModel {
    // Function to handle the login process
    function login($uname, $pw) {
        $conn = new PDOModel();
        $db = $conn->getDb();

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM `account` WHERE `username` = :username AND `password` = :password";
        
        // Prepare the statement
        $stmt = $db->prepare($query);
        
        // Bind the parameters
        $stmt->bindParam(':username', $uname);
        $stmt->bindParam(':password', $pw);

        // Execute the statement
        $stmt->execute();
        
        // Check if any user exists with the provided username and password
        $userExist = $stmt->rowCount();
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if( $userExist == 1) {
            $_SESSION['isLogin'] = 1;
            $_SESSION["role"] = $userRow['role'];
        } else {
            echo '<script language="javascript">';  
            echo 'alert("USER UNKNOWN")';
            echo '</script>';
            // header("location: /admin");
            // return;
        }
        
        return $userExist;
    }
}
?>
