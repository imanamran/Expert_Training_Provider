
<?php
// Import necessary files and start the session
include_once '../config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id']) && isset($_GET['clientId'])) {
    $requestId = $_GET['id'];
    $userId = $_SESSION['userId'];  // Assuming the user's ID is stored in the session
    $clientId = $_GET['clientId'];  // Assuming the user's ID is stored in the session
    $newStatus = "Approved";

    echo $requestId;


    if ($employeesCollection->updateRequestStatus($userId, $requestId, $newStatus)) {
        $clientsCollection->updateRequestStatus($clientId, $requestId, $newStatus);
        echo "Request status updated successfully.";
    } else {
        echo "Failed to update request status.";
    }
} else {
    echo "No request ID provided.";
}

header("Location: ../derrick/table.php");
exit();
?>
