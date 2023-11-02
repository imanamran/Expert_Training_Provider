<?php
require_once '../config.php';

$clientsCollection = $db_handle->selectCollection('Clients');
$cursor = $clientsCollection->find([]);

// Display the data
foreach ($cursor as $document) {
    var_dump($document); // Output the document data
    echo "<br>";
}
?>