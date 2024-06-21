<?php
include_once("model/login.php");
$obj = new loginModel();
$login = $obj->login($_POST["username"],$_POST["password"]);
if($login){
    header("Location:   /dashboard");
}
?>