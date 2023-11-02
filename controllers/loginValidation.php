<?php
require_once '../config.php';

$userType = $_POST['userType'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate the inputs
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Query the appropriate collection based on user type
        if ($userType == 'client') {
            $usersCollection = $db_handle->selectCollection('Clients');
            $user = $usersCollection->findOne(['clientEmail' => $email, 'clientPassword' => $password]);
            $typeOfUserField = 'client';
            $userIdField = 'clientID';
            $userNameField = 'clientName';
            $redirect = "../views/index.php";
        } else { // Assume 'employee'
            $usersCollection = $db_handle->selectCollection('Employees');
            $user = $usersCollection->findOne(['employeeEmail' => $email, 'employeePassword' => $password]);
            $typeOfUserField = 'employee';
            $userIdField = 'employeeID';
            $userNameField = 'employeeName';
            $redirect = "../derrick/table.php";
        }

        if ($user) {
            // Success: email and password match
            // session_start();
            $userName = (string) $user[$userNameField];
            $userId = (string) $user[$userIdField];
            $_SESSION['typeOfUser'] = $typeOfUserField;
            $_SESSION['userName'] = $userName;
            $_SESSION['userId'] = $userId;
            header("Location: $redirect");
            exit;
        } else {
            // Failure: email and password do not match
            $error = "Invalid email or password.";
        }
    }
}

// If there was an error or the form hasn't been submitted yet, show the login page
if (isset($error)) {
    header("Location: ../views/login.php?error=" . urlencode($error));
} else {
    header("Location: ../views/login.php");
}
exit;
