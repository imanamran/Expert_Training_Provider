<?php
// Include the config file from the root folder
require_once '../config.php';

$collection = $db_handle->selectCollection('TrainingPrograms');

// Get the search query from the GET request
$searchQuery = $_GET['query'];

// Create a regex pattern for a case-insensitive search
$regex = new MongoDB\BSON\Regex($searchQuery, 'i');

// Perform the search
$result = $collection->find([
    'trainingProgramName' => $regex
]);

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode(iterator_to_array($result));
