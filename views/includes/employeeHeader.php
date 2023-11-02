<?php
require_once '../config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if a user session exists
$loggedIn = false;
if (isset($_SESSION['userName']) && isset($_SESSION['userId']) && isset($_SESSION['typeOfUser'])) {
    if ($_SESSION['typeOfUser'] == 'employee') {
        $loggedIn = true;
        $userName = $_SESSION['userName'];
        $userId = $_SESSION['userId'];
    }
    
}
?>



<!-- // Purpose: Header for user pages -->
<!DOCTYPE html>
<html lang="en" style="--bs-warning: #0055f0;--bs-warning-rgb: 0,85,240;--bs-warning: #0055f0;--bs-warning-rgb: 0,85,240;--bs-body-color: var(--bs-btn-disabled-color);--bs-secondary: #d9d9d9;--bs-secondary-rgb: 217,217,217;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Canadian+Aboriginal&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Testimonials-images.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" >
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" >
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin></script>
    <!-- Bootstrap Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <!-- ReactJS Link -->
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <!-- React DOM Link -->
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
    
    <!-- JavaScipt CHAT Stream SDK -->
    <script src="https://cdn.jsdelivr.net/npm/stream-chat@1.2.2/dist/browser.full-bundle.min.js"></script>
    <!-- for making http request -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <!-- Our custom JavaScript code -->
    <!-- <script src="<?php // echo CONTROLLERS . "/chatScript.js"; ?>"></script> -->
    <title>
        <?php
            echo $title;
        ?>
    </title>
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54" style="--bs-warning: #0236f0;--bs-warning-rgb: 2,54,240;">
    
    <!-- Navigation Bar START -->
    <nav class="navbar bg-danger navbar-expand-lg fixed-top bg-warning" id="mainNav" style="background: #0236f0;">
        <div class="container">
            <a class="navbar-brand" href="../derrick/table.php" style="color: rgb(255,255,255);">
                Expert Training Provider
            </a>
            <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                
                <!-- Navigation Items START -->
                <ul class="navbar-nav ms-auto text-uppercase">
                    <!-- Home Navigation Item START -->
                    <li class="nav-item">
                        <a class="nav-link" href="../derrick/table.php">Home</a>
                    </li>
                    <!-- Home Navigation Item END -->
                    <!-- Rooms Navigation Item START -->
                    <li class="nav-item">
                        <a class="nav-link" href="../views/employeeViewRooms.php">Rooms</a>
                    </li>
                    <!-- Rooms Navigation Item END -->
                    <!-- About Navigation Item START -->
                    <!-- Help Navigation Item END -->
                    <!-- User Navigation Item START -->
                    <li class="nav-item">
                        <?php if ($loggedIn && isset($userName)): ?>
                            <a class="nav-link" href="../views/EmployeeProfile.php"><?= htmlspecialchars($userName) ?></a>
                        <?php else: ?>
                            <a class="nav-link" href="../views/login.php">Login</a>
                        <?php endif; ?>
                    </li>
                    <!-- User Navigation Item END -->
                    <!-- Logout Navigation Item START -->
                    <?php if ($loggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../views/logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                    <!-- Logout Navigation Item END -->
                </ul>
                <!-- Navigation Items END -->
            </div>
        </div>
    </nav>
    <!-- Navigation Bar END -->

