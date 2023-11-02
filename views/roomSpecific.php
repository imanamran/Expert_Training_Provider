<?php
$title = "Room Specific";
require_once '../config.php';

    // Make sure the id parameter exists in the URL
if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    
    // Create a new TrainingProgramCollection instance

    // Get the specific training program from your database
    $specificRoom = $trainingRoomCollection->getTrainingRoomById($roomId);
    $roomName = $specificRoom->getTrainingRoomName();

} else {
    // Redirect to homepage or show an error if the id parameter doesn't exist
    header('Location: index.php');
}
include VIEWS . '/includes/userHeader.php';

?>


<header class="masthead" style="background: linear-gradient(black 7%, var(--bs-border-color-translucent) 100%), url(&quot;assets/img/rooms/room<?php echo $specificRoom->getTrainingRoomImageLink(); ?>.jpeg&quot;) top / cover;filter: blur(0px);margin-top: 52px;">
    <div class="container">
        <div class="intro-text" style="--bs-primary: #0236F0;--bs-primary-rgb: 2,54,240;padding-top: 238px;">
            <div class="intro-lead-in"></div>
            <span class="text-center" style="font-size: 101px;font-family: 'Abhaya Libre', serif;"><?php echo $specificRoom->getTrainingRoomName(); ?></span>
            <div class="intro-heading text-uppercase"><span></span></div>
        </div>
    </div>
</header>

        <section id="services" style="padding-top: 49px;">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4 col-xl-7">
                        <h4 class="text-start section-heading">Program Details</h4>
                        <p class="text-start text-muted">Availability: <?php echo $specificRoom->getTrainigRoomAvalability(); ?></p>
                        <p class="text-start text-muted">Capacity: <?php echo $specificRoom->getTrainingRoomCapacity(); ?></p>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-primary border-0"></div>
                    </div>
                    <div class="col">
                    <div class="card text-white bg-primary border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-bold text-white mb-0" style="text-align: left;">Add to favourites</h5>
                                </div>
                            </div>
                            <div></div>
                            <a class="btn btn-primary d-block w-100 bg-white-300" role="button" 
                                href="<?php echo ($loggedIn) ? 'roomFav.php?room-name=' . $roomName . '&room-id=' . $roomId: 'login.php'; ?>" 
                                style="border-style: solid;">
                                    <?php echo ($loggedIn) ? 'Save' : 'Log in to request'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';
?>
