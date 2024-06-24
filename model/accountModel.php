<?php
include_once("connection/PDOModel.php");
@session_start();
class accountModel{
    function getAccount() {
        $conn = new PDOModel();
        $db = $conn->getDb();

        $res = $db->prepare("SELECT * FROM `account` WHERE `status` = '0' ORDER BY `role` DESC");
        $res->execute();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $fetch_acc[$row['id']]=$row;
        }
        return ($res->rowCount() > 0) ? $fetch_acc :0;
    }
}
?>