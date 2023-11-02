<?php
require_once '../config.php';

$clientsCollection = new ClientsCollection($client);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    // $clients = $clientsCollection->getClientByEmailAndPassword($email, $password);

    // If get ID proceed
    // If get false, shows invalid input

    // Validate the inputs
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Query the Clients collection to find a matching email and password
        $clientsCollection = $db_handle->selectCollection('Clients');
        $client = $clientsCollection->findOne(['clientEmail' => $email, 'clientPassword' => $password]);

        if ($client) {
            // Success: email and password match
            session_start();
            $clientName = (string) $client['clientName'];
            $clientId = (string) $client['clientID']; // Get the client's ID
            $_SESSION['clientName'] = $clientName;
            $_SESSION['clientId'] = $clientId; // Store the client's ID in the session
            header("Location: ../views/index.php"); // Redirect to a success page
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
