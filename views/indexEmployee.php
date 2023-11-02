<?php
$title = "Employee page";


require_once '../config.php';

$loggedIn = false;
if (isset($_SESSION['userName']) && isset($_SESSION['userId'])) {
    $loggedIn = true;
    $userName = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
}

echo "User ID: ", $userId, " User Name: ", $userName;
?>