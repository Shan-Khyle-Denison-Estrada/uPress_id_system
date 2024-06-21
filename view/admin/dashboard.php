<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/svg+xml" href="../../assets/logo/upress-logo-red.svg">

    <!-- semantics -->
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="dashboard">
                        <img src="../../assets/logo/wmsu-logo.svg" id="nav-logo" alt="WMSU Logo">
                        University Press
                    </a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                         <?php echo $title; ?>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard" class="sidebar-link">
                            <i class="fa-solid fa-chart-simple"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="transaction" class="sidebar-link">
                            <i class="fa-solid fa-right-left"></i>
                            Transactions
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?" class="sidebar-link collapsed" data-bs-target="#layouts" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-sliders"></i>     
                            Identification Card Layout
                        </a>
                        <ul id="layouts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="student-layout" class="sidebar-link">
                                    <i class="fa-regular fa-id-card"></i>
                                    Student
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="employee-layout" class="sidebar-link">
                                    <i class="fa-solid fa-id-card"></i>
                                    Employee
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="manage-accounts" class="sidebar-link">
                            <i class="fa-solid fa-user-tie"></i>
                            Account Management
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="dash-content">
            <nav class="navbar">
                <button class="btn">
                    <span class="navbar-toggler-icon"></span>    
                </button>
            </nav>
        </div>
    </div>

    <?php
        include_once("./includes/scripts.php");
    ?>
</body>
</html>