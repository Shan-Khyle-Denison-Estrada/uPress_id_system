<?php
include_once("connection/PDOModel.php");
@session_start();

class AccountManageModel{
    function addAccount($uname,$pw,$fname,$mname,$lname,$nameExt,$role,$img) {
        $conn = new PDOModel();
        $db = $conn->getDb();
<<<<<<< Updated upstream
        
        $stmt = $this->$db->prepare("INSERT INTO 'account' SET
        `uname`=:username, `pw`=:password, `fname`=:firstName, `mname`=:middleName `lname`=:lastName, 
        `nameExt`=:nameExt, `role`=:role, `img`=:accountPhoto, `status` = '0'");
        $stmt->bindParam(':username', $uname);
        $stmt->bindParam(':password', $pw);
        $stmt->bindParam(':firstName', $fname);
        $stmt->bindParam(':middleName', $mname);
        $stmt->bindParam(':lastName', $lname);
        $stmt->bindParam(':nameExt', $nameExt);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':accountPhoto', $img);
        $stmt->execute();

        $id=$this->$db->lastInsertId();
    }
    function updateAccount( $id,$uname,$pw,$fname,$lname,$nameExt,$role,$img){
        $conn = new PDOModel();
        $db = $conn->getDb();
        if($img == NULL){    
            $stmt = $this->$db->prepare("UPDATE `account` SET `uname`=:username, `pw`=:password, 
            `fname`=:firstName, `lname`=:lastName, `nameExt`=:nameExt, `role`=:role, 
            `img`=:accountPhoto,");
        } else {
            $stmt = $this->$db->prepare("UPDATE `account` SET `uname`=:username, `pw`=:password, 
            `fname`=:firstName, `lname`=:lastName, `nameExt`=:nameExt, `role`=:role, 
            `img`=:accountPhoto WHERE `id`=:id");
=======
        // var_dump("test");

        try {
            $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);
            $stmt = $db->prepare("
                INSERT INTO
                account (username, password, firstName, middleName, lastName, nameExt, role, accountPhoto)
                VALUES  (:uname, :pw, :fname, :mname, :lname, :nameExt, :role, :accountPhoto)
            ");
            // bind the parameters
            $stmt->bindParam(':uname', $uname);
            $stmt->bindParam(':pw', $hashed_pw);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':mname', $mname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':nameExt', $nameExt);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':accountPhoto', $img);
            // execute statement
            $stmt->execute();
            // var_dump($uname);
            // Optionally, you can return the ID of the inserted row
            echo $db->lastInsertId();

        } catch (PDOException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function getAccount() {
        $conn = new PDOModel();
        $db = $conn->getDb();

        $res = $db->prepare("SELECT * FROM account WHERE deletedAt IS NULL AND status = '0' ORDER BY `role` DESC");
        $res->execute();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $fetch_acc[$row['id']]=$row;
        }
        return ($res->rowCount() > 0) ? $fetch_acc :0;
    }
    function getAll() {
        $conn = new PDOModel();
        $db = $conn->getDb();

        try {
            $stmt = $db->prepare("
            SELECT * FROM account WHERE id =  
            ");
        }   catch (PDOException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function updateAccount($id,$uname,$pw,$fname,$mname,$lname,$nameExt,$role,$img){
        $conn = new PDOModel();
        $db = $conn->getDb();
        
        try {
            $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);
            $stmt = $db->prepare("
                UPDATE account 
                SET username = :uname, password = :pw, firstName = :fname, middleName = :mname, lastName = :lname, 
                nameExt = :nameExt, role = :role, accountPhoto = :accountPhoto 
                WHERE id = :id
                ");
            // bind the parameters
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(':uname', $uname);
            $stmt->bindParam(':pw', $hashed_pw);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':mname', $mname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':nameExt', $nameExt);
            $stmt->bindParam(':role', $role);
>>>>>>> Stashed changes
            $stmt->bindParam(':accountPhoto', $img);
        }
        $stmt->bindParam(':username', $uname);
        $stmt->bindParam(':password', $pw);
        $stmt->bindParam(':firstName', $fname);
        $stmt->bindParam(':lastName', $lname);
        $stmt->bindParam(':nameExt', $nameExt);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

    }
    function deleteAccount( $id ) {
        $conn = new PDOModel();
        $db = $conn->getDb();

        $stmt = $this->$db->prepare("UPDATE `account` SET `status`=1 WHERE `id`=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>