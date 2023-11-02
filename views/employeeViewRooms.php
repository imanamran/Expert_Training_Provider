<?php
// include the config file from the root folder
// include_once dirname(__FILE__) . '/../config.php';
include_once '../config.php';
// include the header files from the includes folder
include VIEWS . '/includes/employeeHeader.php';

// echo $client;
// Create a new instane of the TrainingRoomCollection class and pass the client as a parameter
$trainingRoomCollection = new TrainingRoomCollection($client);

// Get all training rooms from the NoSQL client
$trainingRooms = $trainingRoomCollection->getAllTrainingRooms();

?>

<!-- Display Rooms START -->
<div class="container pt-5">
    <div class="row pt-5">
        <?php
        // use a foreach loop to display all training rooms inside a bootstrap card
        foreach ($trainingRooms as $trainingRoom) {

        ?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="assets/img/rooms/room1.jpeg" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"><?php echo $trainingRoom->getTrainingRoomName(); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary"> <?php echo $trainingRoom->getTrainingRoomCapacity(); ?> </button>
                                <button class="btn btn-sm btn-outline-secondary"> <?php echo "Capacity: " . $trainingRoom->getTrainigRoomAvalability(); ?> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        
        ?>

    </div>
</div>
<!-- Display Rooms END -->

    
<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';