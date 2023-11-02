<?php
// define the title of the page
$title = "Home";

// include the config file from the root folder
require_once '../config.php';


// include the header files from the includes folder
include VIEWS . '/includes/userHeader.php';

$statusList = $clientsCollection->getClientRequests($userId);



?>
    <section id="services" style="padding-top: 49px;">
        <div class="container py-4 py-xl-5" style="padding-top: 90px;margin-top: 37px;">

        <!-- STATUS -->
            <div class="row mb-5" style="margin-bottom: 23px;padding-bottom: 0px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h1 style="font-size: 57px;">Status</h1>
                </div>
            </div>

            <!-- APPROVED -->
            <div class="row mb-5" style="margin-bottom: 23px;padding-bottom: 0px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto" style="margin-left: 311px;padding-left: 0px;">
                    <h3 class="d-xl-flex justify-content-xl-start" style="text-align: left;">Approved</h3>
                </div>
                <div class="col"></div>
            </div>

            <!-- Cards -->
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin-bottom: 66px;">
                <?php foreach ($statusList as $request): ?>
                    <?php if ($request['requestStatus'] === "Approved"): ?>
                        <div class="col">
                            <div class="card">
                                <?php $programDetails = $clientsCollection->getTrainingProgramDetails($request['requestProgramID']); ?>
                                <img class="card-img-top w-100 d-block fit-cover" style="height: 200px;" src="assets/img/<?php echo htmlspecialchars($programDetails['trainingProgramImagePath'], ENT_QUOTES, 'UTF-8'); ?>" />
                                <div class="card-body p-4">
                                    <h4 class="card-title"><?php echo htmlspecialchars($programDetails['trainingProgramName'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <p class="card-text">Requested Date: <?php echo htmlspecialchars($request['requestSelectedDate'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    <p class="card-text">Require Room: <?php echo htmlspecialchars($request['requestNeedRoom'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    <p class="card-text">

    <a href="#" onclick="confirmAction('confirm', '<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars($programDetails['trainingEmployeeId'], ENT_QUOTES, 'UTF-8') ?>')"><button class="btn btn-success" type="button" style="text-align: center;margin-right: 5px;">Confirm</button></a>
    <a href="#" onclick="confirmAction('cancel', '<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>', '<?php echo htmlspecialchars($programDetails['trainingEmployeeId'], ENT_QUOTES, 'UTF-8') ?>')"><button class="btn btn-danger" type="button" style="text-align: center;margin-right: 5px;">Cancel</button></a>
    <a href="trainingConfirmation.php?programId=<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>&requestId=<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>&type=view"><button class="btn btn-dark" type="button" style="text-align: center;">View</button></a>
</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>




            <!-- OTHERS -->
            <div class="row mb-5" style="margin-bottom: 23px;padding-bottom: 0px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto" style="margin-left: 311px;padding-left: 0px;">
                    <h1 class="text-center d-xl-flex justify-content-xl-center" style="text-align: center;font-size: 57px;">Others</h1>
                </div>
            </div>

            <!-- Cards -->
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin-bottom: 66px;">
                            <?php foreach ($statusList as $request): ?>
                <?php $programDetails = $clientsCollection->getTrainingProgramDetails($request['requestProgramID']); ?>

                <!-- Confirmed -->
                <?php if ($request['requestStatus'] === "Confirmed"): ?>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body text-bg-success p-4" style="height: 63px;padding-bottom: 28px;">
                                <p style="text-align: center;font-size: 24px;margin-top: -15px;"><strong>Confirmed</strong></p>
                            </div>
                            <img class="card-img w-100 d-block fit-cover" style="height: 200px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;" src="assets/img/<?php echo htmlspecialchars($programDetails['trainingProgramImagePath'], ENT_QUOTES, 'UTF-8'); ?>" />
                            <div class="card-body text-bg-success p-4">
                                <h4 class="card-title" style="margin-bottom: 18px;"><span style="font-weight: normal !important;"><?php echo htmlspecialchars($programDetails['trainingProgramName'], ENT_QUOTES, 'UTF-8'); ?></span></h4>
                                <p class="card-text" style="margin-bottom: 3px;">Requested Date: <?php echo htmlspecialchars($request['requestSelectedDate'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text">Require Room: <?php echo htmlspecialchars($request['requestNeedRoom'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <a href="trainingConfirmation.php?programId=<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>&requestId=<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>&type=confirm">
    <button class="btn btn-light" type="button" style="text-align: center;">View</button>
</a>

                            </div>
                        </div>
                    </div>

                <!-- Denied -->
                <?php elseif ($request['requestStatus'] === "Denied"): ?>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body text-bg-danger p-4" style="height: 63px;padding-bottom: 28px;">
                                <p style="text-align: center;font-size: 24px;margin-top: -15px;"><strong>Denied</strong></p>
                            </div>
                            <img class="card-img w-100 d-block fit-cover" style="height: 200px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;" src="assets/img/<?php echo htmlspecialchars($programDetails['trainingProgramImagePath'], ENT_QUOTES, 'UTF-8'); ?>" />
                            <div class="card-body text-bg-danger p-4">
                                <h4 class="card-title" style="margin-bottom: 18px;"><span style="font-weight: normal !important;"><?php echo htmlspecialchars($programDetails['trainingProgramName'], ENT_QUOTES, 'UTF-8'); ?></span></h4>
                                <p class="card-text" style="margin-bottom: 3px;">Requested Date: <?php echo htmlspecialchars($request['requestSelectedDate'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text">Require Room: <?php echo htmlspecialchars($request['requestNeedRoom'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <a href="trainingConfirmation.php?programId=<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>&requestId=<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>&type=cancel">
    <button class="btn btn-light" type="button" style="text-align: center;">View</button>
</a>
                            </div>
                        </div>
                    </div>


                    <!-- Cancelled -->
                <?php elseif ($request['requestStatus'] === "Cancelled"): ?>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body text-bg-danger p-4" style="height: 63px;padding-bottom: 28px;">
                                <p style="text-align: center;font-size: 24px;margin-top: -15px;"><strong>Cancelled</strong></p>
                            </div>
                            <img class="card-img w-100 d-block fit-cover" style="height: 200px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;" src="assets/img/<?php echo htmlspecialchars($programDetails['trainingProgramImagePath'], ENT_QUOTES, 'UTF-8'); ?>" />
                            <div class="card-body text-bg-danger p-4">
                                <h4 class="card-title" style="margin-bottom: 18px;"><span style="font-weight: normal !important;"><?php echo htmlspecialchars($programDetails['trainingProgramName'], ENT_QUOTES, 'UTF-8'); ?></span></h4>
                                <p class="card-text" style="margin-bottom: 3px;">Requested Date: <?php echo htmlspecialchars($request['requestSelectedDate'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text">Require Room: <?php echo htmlspecialchars($request['requestNeedRoom'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <a href="trainingConfirmation.php?programId=<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>&requestId=<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>&type=cancel">
    <button class="btn btn-light" type="button" style="text-align: center;">View</button>
</a>
                            </div>
                        </div>
                    </div>

                <!-- Pending -->
                <?php elseif ($request['requestStatus'] === "Pending"): ?>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body text-bg-dark p-4" style="height: 63px;padding-bottom: 28px;">
                                <p style="text-align: center;font-size: 24px;margin-top: -15px;"><strong>Pending</strong></p>
                            </div>
                            <img class="card-img w-100 d-block fit-cover" style="height: 200px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;" src="assets/img/<?php echo htmlspecialchars($programDetails['trainingProgramImagePath'], ENT_QUOTES, 'UTF-8'); ?>" />
                            <div class="card-body text-bg-dark p-4">
                                <h4 class="card-title" style="margin-bottom: 18px;"><span style="font-weight: normal !important;"><?php echo htmlspecialchars($programDetails['trainingProgramName'], ENT_QUOTES, 'UTF-8'); ?></span></h4>
                                <p class="card-text" style="margin-bottom: 3px;">Requested Date: <?php echo htmlspecialchars($request['requestSelectedDate'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text">Require Room: <?php echo htmlspecialchars($request['requestNeedRoom'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <a href="trainingConfirmation.php?programId=<?php echo htmlspecialchars($request['requestProgramID'], ENT_QUOTES, 'UTF-8'); ?>&requestId=<?php echo htmlspecialchars($request['requestID'], ENT_QUOTES, 'UTF-8'); ?>&type=view">
    <button class="btn btn-light" type="button" style="text-align: center;">View</button>
</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>    
            </div>



            
        </div>
    </section>

    <section id="contact" style="background-image: url('map-image.png');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Contact Us</h2>
                    <h3 class="text-muted section-subheading">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="contactForm" name="contactForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3"><input id="name" class="form-control" type="text" placeholder="Your Name *" required /><small class="form-text text-danger flex-grow-1 lead"></small></div>
                                <div class="form-group mb-3"><input id="email" class="form-control" type="email" placeholder="Your Email *" required /><small class="form-text text-danger lead"></small></div>
                                <div class="form-group mb-3"><input class="form-control" type="tel" placeholder="Your Phone *" required /><small class="form-text text-danger lead"></small></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3"><textarea id="message" class="form-control" placeholder="Your Message *" required></textarea><small class="form-text text-danger lead"></small></div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div><button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit" style="--bs-primary: #0236f0;--bs-primary-rgb: 2,54,240;background: rgb(2,54,240);border-style: none;">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
function confirmAction(type, programId, requestId, employeeId) {
    let message = 'Are you sure you want to ' + type + ' this request?';
    if(confirm(message)) {
        window.location.href = 'trainingConfirmation.php?programId=' + programId + '&requestId=' + requestId + '&type=' + type+ '&action=' + type + '&employeeId=' + employeeId;
    }
}
</script>

<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';