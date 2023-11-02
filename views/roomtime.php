<?php
// define the title of the page
$title = "roomtime";

// include the config file from the root folder
require_once '../config.php';

// Connect to MongoDB
$trainingProgramCollection = new TrainingProgramCollection($client);

$trainingPrograms = $trainingProgramCollection->getAllTrainingPrograms();

// $collection = $db_handle->selectCollection('TrainingPrograms');

// // Fetch the first three training programs
// $trainingPrograms = $collection->find([], ['limit' => 3]);

// include the header files from the includes folder
include VIEWS . '/includes/userHeader.php';
?><!DOCTYPE html>
<html>

<body>
	<main>
        <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
</head>
<body>

<h2>Avaliable time for all avaliable program</h2>

<div class="card">
  <img src="http://localhost/MSP-Sprint1/views/assets/img/rooms/room1.jpeg" alt="Avatar" style="width: 100%">
  <div class="container">
    <h4><b>The Pepperoni Room</b></h4> 
    <p>Room 1 : 8.00am</p> 
    <p>Room 12 : 2.00pm</p>
    <a href="http://localhost/MSP-Sprint1/views/employeemessage.php">Talk with us for further infomation</a>
  </div>
</div>

<div class="card">
  <img src="http://localhost/MSP-Sprint1/views/assets/img/rooms/room1.jpeg" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>The Hawaian Room</b></h4> 
    <p>Room 1 : 11.00am</p> 
    <p>Room 13 : 4.00pm</p>
    <a href="http://localhost/MSP-Sprint1/views/employeemessage.php">Talk with us for further infomation</a>
  </div>
</div>

<div class="card">
  <img src="http://localhost/MSP-Sprint1/views/assets/img/rooms/room1.jpeg" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>The Meat Eaters Room</b></h4> 
    <p>Room 5 : 9.00am</p> 
    <p>Room 11 : 2.00pm</p>
    <a href="http://localhost/MSP-Sprint1/views/employeemessage.php">Talk with us for further infomation</a>
  </div>
</div>

<div class="card">
  <img src="http://localhost/MSP-Sprint1/views/assets/img/rooms/room1.jpeg" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>The Deluxe Cheese Room</b></h4> 
    <p>Room 8 : 12.00pm</p> 
    <p>Room 18 : 2.00pm</p>
    <a href="http://localhost/MSP-Sprint1/views/employeemessage.php">Talk with us for further infomation</a>
  </div>
</div>

<div class="card">
  <img src="http://localhost/MSP-Sprint1/views/assets/img/rooms/room1.jpeg" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>The Vegeterian Room</b></h4> 
    <p>Room 2 : 10.00am</p> 
    <p>Room 20 : 3.30pm</p>
    <a href="http://localhost/MSP-Sprint1/views/employeemessage.php">Talk with us for further infomation</a>
  </div>
</div>

<div class="card">
  <img src="http://localhost/MSP-Sprint1/views/assets/img/rooms/room1.jpeg" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>The Chicken Mushroom Room</b></h4> 
    <p>Room 10 : 8.00pm</p> 
    <p>Room 9 : 1.00pm</p>
    <a href="http://localhost/MSP-Sprint1/views/employeemessage.php">Talk with us for further infomation</a>
  </div>
</div>

	</main>
</body>
</html>
