<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirmation']);

    // Validate the inputs
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password) || empty($passwordConfirmation)) {
        $error = "Please fill in all fields.";
    } elseif ($password !== $passwordConfirmation) {
        $error = "Passwords do not match.";
    } else {
        // Insert the new user into the Clients collection
        $clientsCollection = $db_handle->selectCollection('Clients');
        $newClient = [
            'clientID' => substr(uniqid(), -12),
            'clientToken' => "",
            'clientName' => $firstName . ' ' . $lastName,
            'clientEmail' => $email,
            'clientPhone' => $phone,
            'clientPassword' => $password,
            'listOfRequests' => []
        ];
        $clientsCollection->insertOne($newClient);

        header("Location: ../views/login.php?success=" . urlencode("Registration successful!"));
        exit;
    }
}

// If there was an error or the form hasn't been submitted yet, show the register page
if (isset($error)) {
    header("Location: ../views/register.php?error=" . urlencode($error));
} else {
    header("Location: ../views/register.php");
}
exit;
