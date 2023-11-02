<?php
$title = "Training Programs";
require_once '../config.php';
include VIEWS . '/includes/userHeader.php';

if (isset($_GET['room-name']) && isset($_GET['room-id'])) {
    $roomName = $_GET['room-name'];
    $roomId = $_GET['room-id'];

    echo $roomId;

    $clientsCollection->appendRoomToFavList($userId, $roomName);

    echo "
    <br>
    <br>
    <br>
    <br>
    <div class='alert alert-success' role='alert'>
        <h4 class='alert-heading'>Success!</h4>
        <p>The room '$roomName' has been added to your favorites.</p>
        <hr>
        <p class='mb-0'>You can return to the room page by clicking the button below.</p>
        <br>
        <a href='roomSpecific.php?id=$roomId'>view room</a>
    </div>
    ";
} else {
    header('Location: index.php');
}
?>
