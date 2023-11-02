<?php
// define the title of the page
$title = "Home";

// include the config file from the root folder
require_once '../config.php';
include VIEWS . '/includes/userHeader.php';

if (isset($_GET['programId']) && isset($_GET['requestId']) && isset($_GET['type'])) {
    $programId = $_GET['programId'];
    $requestId = $_GET['requestId'];
    $type = $_GET['type'];
    $employeeId = $_GET['employeeId'];

    if (isset($_GET['action'])){
        $action = $_GET['action'];
        if ($action === 'confirm') {
            $clientsCollection->updateRequestStatus($userId, $requestId, 'Confirmed');
            $employeesCollection->updateRequestStatus($employeeId, $requestId, 'Confirmed');

        } else if ($action === 'cancel') {
            $clientsCollection->updateRequestStatus($userId, $requestId, 'Cancelled');
            $employeesCollection->updateRequestStatus($employeeId, $requestId, 'Cancelled');

        }
    
    }
    
    
    // Create a new TrainingProgramCollection instance

    // Get the specific training program from your database
    $specificProgram = $trainingProgramCollection->getTrainingProgramById($programId);

    $specificClient = $clientsCollection->getClientByID($userId);
    // var_dump($specificClient['clientEmail']);

    $specificRequest = $clientsCollection->getClientSpecificRequest($userId, $requestId);

} else {
    // Redirect to homepage or show an error if the id parameter doesn't exist
    header('Location: index.php');
};

$background = '';

switch($type) {
    case 'confirm':
        $background = 'linear-gradient(171deg, var(--bs-teal) 0%, var(--bs-green) 100%), var(--bs-purple)';
        break;

    case 'cancel':
        $background = 'linear-gradient(#ff7c7c, #a40000), var(--bs-purple)';
        $text = 'Cancel';
        break;

    case 'view':
        $background = 'linear-gradient(#787777 0%, #434343 100%), var(--bs-purple)';
        break;
}

// $encodedProgram = base64_encode(serialize($specificProgram));
// var_dump($encodedProgram);


?>

<section>
    <!-- at the moment -->
    <div id="cardEntrada-2" class="p-4 text-center shadow-lg m-5 rounded-5" style="background: <?php echo $background; ?>; width: 100;">
        <h3 class="text-white text-center pt-2" style="font-size: 45px;"><span style="font-weight: normal !important;">Booking Summary</span></h3>
        <p class="fw-bold pt-1 text-white p-0 m-0" style="font-size: 47px;"><?php echo $specificProgram->getTrainingProgramName(); ?></p>
        <hr class="text-white" />
        <p class="fw-bold pt-1 text-white p-0 m-0" style="font-size: 27px;text-align: center;margin-top: -5px;padding-bottom: 0px;margin-bottom: 21px;">Program Details</p>
        <p class="fw-bold pt-1 text-white p-0 m-0" style="font-size: 21px;text-align: center;margin-bottom: 11px;"></p>
        <div class="container" style="margin-top: 23px;">
            <div class="row">
                <div class="col-md-4">
                    <p class="fw-light text-white m-0" style="text-align: center;font-size: 25px;">Tutor</p>
                </div>
                <div class="col-md-4" style="font-size: 25px;">
                    <p class="fw-light text-white m-0" style="text-align: center;font-size: 25px;">Price</p>
                </div>
                <div class="col-md-4" style="text-align: center;font-size: 25px;">
                    <p class="fw-light text-white m-0" style="text-align: center;font-size: 25px;"><strong>Date &amp; Time</strong></p>
                </div>
                <div class="col-md-4 d-xl-flex justify-content-xl-center align-items-xl-center">
                    <p class="d-xl-flex justify-content-xl-center align-items-xl-center fw-bold pt-1 text-white p-0 m-0" style="font-size: 43px;text-align: center;"><?php echo $specificProgram->getTrainingTutorName(); ?></p>
                </div>
                <div class="col-md-4 d-xl-flex justify-content-xl-center align-items-xl-center">
                    <p class="d-xl-flex justify-content-xl-center align-items-xl-center fw-bold pt-1 text-white p-0 m-0" style="font-size: 68px;text-align: center;"><?php echo $specificProgram->getTrainingProgramPrice(); ?></p>
                </div>
                <div class="col-md-4 d-xl-flex justify-content-xl-center align-items-xl-center" style="text-align: center;"><span style="color: rgb(255,255,255);font-size: 20px;"><strong><?php echo $specificRequest['requestSelectedDate'] ?></strong><br /><strong>8:00am - 10:00am</strong></span></div>
            </div>
        </div>
        <hr class="text-white" />
        <div class="container" style="margin-top: 70px;">
            <div class="row">
                <div class="col-md-4">
                    <p class="fw-light text-white m-0" style="text-align: center;font-size: 25px;">Room Name</p>
                </div>
                <div class="col-md-4" style="font-size: 25px;">
                    <p class="fw-light text-white m-0" style="text-align: center;font-size: 25px;">Payment status</p>
                </div>
                <div class="col-md-4" style="text-align: center;font-size: 25px;">
                    <p class="fw-light text-white m-0" style="text-align: center;font-size: 25px;">Attendees</p>
                </div>
                <div class="col-md-4 d-xl-flex justify-content-xl-center align-items-xl-center">
                    <p class="d-xl-flex justify-content-xl-center align-items-xl-center fw-bold pt-1 text-white p-0 m-0" style="font-size: 43px;text-align: center;"><?php echo $specificRequest['requestRoomName'] ?></p>
                </div>
                <div class="col-md-4 d-xl-flex justify-content-xl-center align-items-xl-center"><span style="color: rgb(255,255,255);font-size: 30px;"><strong><?php echo $specificRequest['requestPaymentStatus'] ?></strong></span></div> 
                <div class="col-md-4 d-xl-flex justify-content-xl-center align-items-xl-center" style="text-align: center;">
                    <p class="d-xl-flex justify-content-xl-center align-items-xl-center fw-bold pt-1 text-white p-0 m-0" style="font-size: 68px;text-align: center;"><?php echo $specificRequest['requestNumberOfAtteendes'] ?></p>
                </div>
            </div>
        </div>
        <div>
        <a href="trainingStatus.php"><button class="btn btn-primary btn-lg" role="button" data-bs-toggle="modal" style="background: linear-gradient(white 0%, #d2d2d2 100%);color: rgb(0,0,0);border-style: none;">Back</button></a>
        <a href="employeemessage.php"><button class="btn btn-primary btn-lg" role="button" data-bs-toggle="modal" style="background: linear-gradient(white 0%, #d2d2d2 100%);color: rgb(0,0,0);border-style: none;">Message Staff</button></a>

        <form action="../controllers/emailMaterials.php" method="post">
            <input type="hidden" name="email" value="<?php echo $specificClient['clientEmail'] ?>">
            <input type="hidden" name="program" value="<?php echo base64_encode(serialize($specificProgram)); ?>">
            <input type="hidden" name="user" value="<?php echo base64_encode(serialize($specificClient)); ?>">
            <br>

            <?php
            if ($type === "confirm") {
            ?>
                <button class="btn btn-primary btn-lg" role="button" data-bs-toggle="modal" style="background: linear-gradient(white 0%, #d2d2d2 100%);color: rgb(0,0,0);border-style: none;">Email me the materials!</button>
            <?php
            }
            ?>
            
        </form>
            <div id="myModal" class="modal fade" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Email sent</h4>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-muted">Check your email</p>
                        </div>
                        <div class="modal-footer">

                            <!-- Button -->
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


