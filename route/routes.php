<?php

$requestUrl = $_SERVER['REQUEST_URI'];
$segments = explode('/', $requestUrl);
$segmentPage = explode('?', $segments[0]);
array_shift($segments);
@session_start();


if(isset($_SESSION["isLogin"]) == 1){
    if($_SESSION["role"] == "super_admin"){
        $title = "Super Admin";
        if(isset($segments[0])){
            switch($segments[0]){
                case "dashboard":
                    require_once("view/admin/dashboard.php");
                break;
                case "logout":
                    session_destroy();
                    header("location: /admin");
                    break;
                default:
                include_once("view/login/index.php");
                break;
            }
        }
    } else {
        $title = "Admin";
        if(isset($segments[0])){
            switch($segments[0]){   
                case "dashboard":
                    include_once("view/admin/dashboard.php");
                    include_once("view/admin/dashboard-nav.php");
                break;
                case "logout":
                    session_destroy();
                    header("location: /admin");
                    break;
                default:
                include_once("view/login/index.php");
                break;
            }
        }
    }
    // else if($_SESSION["role"] == "admin"){
        // $title = "Admin";
        // if(isset($segments[0])){
        //     switch($segments[0]){   
        //         case "dashboard":
        //             require_once("view/admin/dashboard.php");
        //         break;
        //         case "logout":
        //             session_destroy();
        //             header("location: /admin");
        //             break;
        //         default:
        //         include_once("view/login/index.php");
        //         break;
        //     }
        // }
    // }
} else {
    
    if(isset($segments[0])){
        if($segments[0] !="admin"){
            include_once("view/shared/header.php");
            include_once("view/shared/offcanvas-nav.php");
        }
        switch($segments[0]){
            case "about-us":
                require_once("view/about/about-us.php");
            break;
            case "tutorial":
                require_once("view/guide/tutorial.php");
            break;
            case "get-id-now":
                require_once("view/form/id-form.php");
            break;
            case "admin":
                include_once("view/login/index.php");
                break;
            case "login":
                require_once("controller/loginController.php");
                break;
            default:
                include_once("view/shared/body-content.php");
            break;
        }
        if($segments[0] !="admin"){
        include_once("view/shared/footer.php");
        }
    }
    
}

?>