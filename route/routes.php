<?php
$requestUrl = $_SERVER['REQUEST_URI'];
$segments = explode('/', $requestUrl);
//$segments = explode('?', $segment[0]);
array_shift($segments);
@session_start();
$page_title = "Crimson";
include_once("view/shared/header.php");

if (isset($segments[""])) {
    
}
?>