<?php
include_once("connection/PDOModel.php");
@session_start();

class AccountManageModel{
    function addAccount($uname,$pw,$fname,$mname,$lname,$nameExt,$role,$img) {
        $conn = new PDOModel();
        $db = $conn->getDb();
        
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