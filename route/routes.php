<?php
$requestUrl = $_SERVER['REQUEST_URI'];
$segments = explode('/', $requestUrl);
$segmentPage = explode('?', $segments[0]);
array_shift($segments);
@session_start();
include_once("view/shared/header.php");
include_once("view/shared/offcanvas-nav.php");
if(isset($segments[0])){
    switch($segments[0]){
        case "about-us":
            require_once("view/background/about-us.php");
        break;
        case "tutorial":
            require_once("view/guide/tutorial.php");
        break;
        case "get-id-now":
            require_once("view/form/id-form.php");
        break;
        
        default:
            include_once("view/shared/body-content.php");
        break;
    }
}

include_once("view/shared/footer.php");
?>