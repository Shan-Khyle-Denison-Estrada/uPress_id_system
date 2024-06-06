<?php
$requestUrl = $_SERVER['REQUEST_URI'];
$segments = explode('/', $requestUrl);
//$segments = explode('?', $segment[0]);
array_shift($segments);
@session_start();
$page_title = "Crimson";
include_once("pages/shared/head_index.php");
include_once("pages/shared/navbar_index.php");

if (isset($segments[""])) {
    
}
?>