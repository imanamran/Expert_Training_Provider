<?php

$title = "Updating request";
require_once '../config.php';

if (isset($_GET['userId']) &&
    isset($_GET['requestId']) &&
    isset($_GET['programId']) &&
    isset($_GET['companyName']) &&
    isset($_GET['paymentType']) &&
    isset($_GET['paymentStatus']) &&
    isset($_GET['requestStatus']) &&
    isset($_GET['selectedDate']) &&
    isset($_GET['attendees']) &&
    isset($_GET['roomNeeded']) &&
    isset($_GET['roomName'])) {

    $userId = $_GET['userId'];
    $programId = $_GET['programId'];
    $trainingProgram = $trainingProgramCollection->getTrainingProgramById($programId);
    $employeeId = $trainingProgram->getTrainingEmployeeId();

    $userRequest = array(
        'requestID' => $_GET['requestId'],
        'requestCompanyName' => $_GET['companyName'],
        'requestProgramID' => $_GET['programId'],
        'requestPaymentType' => $_GET['paymentType'],
        'requestPaymentStatus' => $_GET['paymentStatus'],
        'requestStatus' => $_GET['requestStatus'],
        'requestSelectedDate' => $_GET['selectedDate'],
        'requestNumberOfAtteendes' => $_GET['attendees'],
        'requestNeedRoom' => $_GET['roomNeeded'],
        'requestRoomName' => $_GET['roomName'],
    );

    $clientsCollection->appendUserRequest($userId, $userRequest);
    $employeesCollection->appendUserRequestToEmployee($employeeId, $userRequest);
    // Now you can use $userRequest array as needed
}

header("Location: trainingStatus.php");
exit();
?>
