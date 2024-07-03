<?php
include_once('connection/PDOModel.php');
$pdo = new PDOModel();
$title = "UPress Admin";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/svg+xml" href="../../assets/logo/upress-logo-red.svg">

    <!-- semantics -->
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>
    <div class="login-body text-center">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <!-- left box -->
                <div class="left-box col-md-5 col-sm-5 col-6">
                    <a href="/"><img src="../assets/logo/upress-logo-red.svg" class="img-fluid" alt="UPress Logo in Red"></a>
                </div>
                <!-- right box -->
                <div class="right-box col-md-6 col-sm-6">
                    <div class="row">
                        <div class="header-text mb-3">
                            <h1 class="my-3">Admin Login</h1>
                        </div>
                        <form action="login" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control bg-light" name="username" id="floatingInput" placeholder="Username">
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-5">
                                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="input-group mb-4">
                                <button type="submit" class="btn-login btn btn-lg btn-light w-50">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
        include_once("./includes/scripts.php");
    ?>
</body>
</html>
