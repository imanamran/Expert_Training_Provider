<?php

class Database {

}
// use Exception;
// use MongoDB\Client;
// use MongoDB\Driver\ServerApi;

// // Replace the placeholder with your Atlas connection string
// $uri = 'mongodb+srv://yiuxian02:M4MkDA7CpgV9UdDn@experttraining.0ucsg8s.mongodb.net/?retryWrites=true&w=majority';

// // Specify Stable API version 1
// $apiVersion = new ServerApi(ServerApi::V1);

// // Create a new client and connect to the server
// $database = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);

// try {
//     // Send a ping to confirm a successful connection
//     $database->selectDatabase('ExpertTraining')->command(['ping' => 1]);
//     echo "Pinged your deployment. You successfully connected to MongoDB!\n";
// } catch (Exception $e) {
//     printf($e->getMessage());
// }
// Create the Expert Training NoSQL database using mongodb
// The Expert Training database will store the client, employee, training room, and training program documents

// $database = new MongoDB\Client('mongodb+srv://yiuxian02:M4MkDA7CpgV9UdDn@experttraining.0ucsg8s.mongodb.net/?retryWrites=true&w=majority');


// $database->createDatabase();
// // Set the database to the ExpertTraining database
// $database->setDatabase('ExpertTraining');



// // Create the Client collection in the Expert Training database
// // The client collection will store the client's name, email address, password, needRoom(bool), and listOfRequests(array)
// $clientCollection =  $database->createCollection('Clients');

// // Create the Employee document in the Expert Training database
// // The employee document will store the employee's employeeId, name, email address, password, and listOfRequestsApproved, and listOfRequestsDenied
// $employeeColleciton = $database->createCollection('Employees');

// // Create the Training Room document in the Expert Training database
// // The training room document will store the training room's name, roomNo, avalability(datetime) and capacity
// $roomCollection = $database->createCollection('Training Rooms');

// // Create the Training Programs document in the Expert Training database
// // The training programs document will store the training program's programID, name, description, tutorName,  and duration
// $roomCollection = $database->createCollection('Training Programs');
