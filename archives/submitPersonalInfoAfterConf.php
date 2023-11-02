<?php
// define the title of the page
$title = "Personal Information";

// include the config file from the root folder
include '../config.php';
// include the header files from the includes folder
include VIEWS . '/includes/userHeader.php';

// Create a form to submit the personal information with the following fields:
// name, date, expected attendance, trainingNeeded, trainingProgram, paymentMethod, cardNumber, expiry, CVC, and submit button
// The form should be submitted to the submitPersonalInfoAfterConf.php page
// The form should be validated using PHP
?>



<section class="pt-5 pt-lg-5">
    <div class="container pt-5">
        <div class="row pt-5">
            <span class="text-center">
                <h2 class="p3"><strong>YOU'RE ALMOST THERE</strong></h2>
            </span>

        
                    <div class="d-flex align-items-stretch col-lg-10 ms-auto position-relative">
                        <!-- Image -->
                        <div class="col-lg-6">
                            <img src="assets/img/emotional-intelligence.jpg" class="rounded-3" alt="" style="object-fit: cover; height: 100%;">
                        </div>
                        <!-- Personal info form -->
                        <div class="col-lg-6 col-11 col-sm-10 col-xl-6 position-relative ms-lg-8 ms-xl-7 d-flex align-items-stretch">
                            <div class="card shadow pb-0 mt-n7 mt-sm-n8 mt-lg-0" style="width: 100%;">
                                <!-- Card header -->
                                <div class="text-center card-header p-2 p-sm-2">
                                    <h5 class="card-title mb-0">PROVIDE THE DETAILS BELOW</h5>
                                    <small>Please type out the values in the fields you'd like to request a change on</small>
                                </div>
                                <!-- Card body START -->
                                <form class="bg-secondary card-body form-control-border p-4 p-sm-4">
                                    <!-- Tabs content START -->
                                    <div class="d-flex">
                                        <!-- Left Div START -->
                                        <div class="left m-2">
                                            <!-- Company Name START -->
                                            <div class="mb-4 mt-4">
                                                <label for="company_name" class="form-label bg-transparent text-dark">
                                                    <strong>Company Name<span class="text-danger">*</span></strong>
                                                </label>
                                                <input type="text" class="form-control" id="company_name" placeholder="Monica's Cookie Shop">
                                            </div>
                                            <!-- Company Name END -->
                                            
                                            <!-- Selected Date START -->
                                            <div class="mb-4 mt-4">
                                                <label for="selected_date" class="form-label bg-transparent text-dark">
                                                    <strong>Selected Date<span class="text-danger">*</span></strong>
                                                </label>
                                                <div class="input-group">
                                                    <input id="selected_date" type="date" class="form-control" value="23-07-2023" aria-label="Selected Date" aria-describedby="change_date">
                                                    <button class="btn btn-primary text-light p-1" style="max-width:40%" type="button" id="change_date">Change</button>
                                                </div>
                                            </div>
                                            <!-- Selected Date END -->
                                            
                                            <!-- Expected Attendees START -->
                                            <div class="mb-4 mt-4">
                                                <label for="expected_attendees" class="form-label bg-transparent text-dark">
                                                    <strong>Expected Attendees<span class="text-danger">*</span></strong>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input id="expected_attendees" type="number" class="form-control" value="30" aria-label="Expected Attendeed" aria-describedby="change_attendees">
                                                    <button class="btn btn-primary text-light p-1" style="max-width:40%" type="button" id="change_attendees">Change</button>
                                                </div>
                                            </div>
                                            <!-- Expected Attendees END -->
                                            
                                            <!-- Training Room Needed START -->
                                            <div class="mb-4 mt-4">
                                                <p for="room_needed" class="form-label bg-transparent text-dark"> <strong>Training Room Needed<span class="text-danger">*</span></strong> </p>
                                                

                                            </div>
                                            <!-- Training Room Needed END -->
                                            </div>
                                            <!-- Left Div END -->
                                            <!-- Right Div START -->
                                            <div class="right m-2">
                                                <!-- Program Name START -->
                                                <div class="mb-4 mt-4">
                                                    <label for="program_name" class="form-label bg-transparent text-dark">
                                                        <strong>Program Name<span class="text-danger">*</span></strong>
                                                    </label>
                                                    <div class="d-block">
                                                        <input id="program_name" type="text" class="form-control" value="Web Facing Design" aria-label="Selected Date" aria-describedby="change_progam">
                                                        <button class="btn btn-primary text-light p-1" type="button" id="change_progam">Change</button>
                                                    </div>
                                                </div>
                                                <!-- Program Name END -->
                                                
                                                <!-- Payment Method START -->
                                                <div class="mb-4 mt-4">
                                                    <label for="payment_method" class="form-label bg-transparent text-dark">
                                                        <strong>Payment Method<span class="text-danger">*</span></strong>
                                                    </label>
                                                    <ul class="list-inline mb-0 mt-3">
                                                        <li class="list-inline-item"> <button class="btn btn-primary text-light mr-1" >Paypal<i class="bi bi-paypal"></i></button></li>
                                                        <li class="list-inline-item"> <button class="btn btn-primary text-light mr-1" >Credit/Debit<i class="bi bi-credit-card"></i></i></button></li>

                                                        <li class="list-inline-item"> <button class="btn btn-primary text-light" >e-wallet<i class="bi bi-wallet"></i></button></li>
                                                    </ul>
                                                </div>
                                                <!-- Payment Method END -->
                                            </div>
                                            <!-- Right Div END -->
                                        
                                        </div>
                                        <!-- Tabs content END -->

                                        <!-- Button -->
                                        <div class="d-grid">
                                            <button class="btn btn-dark mb-0">Submit</button>
                                        </div>
                                    
                                    </form>
                                    <!-- Card-body END -->
                                </div>
                            </div>
                        </div>





                    
                    
                        <div class="container pt-5">
                        <div class="d-flex">
                            <div class="text-center p-3 w-75">
                                <h4>Training Program Description</h4>
                                <div class="text-left bg-secondary rounded-3 p-3">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur blandit sed erat dignissim finibus. Donec libero purus, scelerisque ac lectus sed, posuere laoreet mi. Etiam sed tempus ligula. Pellentesque accumsan ex ipsum, sit amet finibus nisl malesuada nec. Nulla orci neque, convallis sit amet molestie at, tristique quis libero. Sed nec orci nec lectus vestibulum condimentum sed id ligula. Fusce ut eros arcu. Etiam at est a quam elementum faucibus sit amet nec arcu. Nulla facilisi. Sed est sem, lacinia ac facilisis vitae, lacinia vel tortor. Cras finibus dolor convallis fringilla faucibus. Curabitur varius, lorem quis efficitur consectetur, dui leo lacinia ex, ut dictum ante justo sed risus. Aliquam tortor lorem, blandit vitae arcu sit amet, tincidunt scelerisque sem. Donec dignissim sem in magna tristique, quis venenatis orci faucibus. Nullam sit amet dolor vitae sapien tempus luctus.
                                    </p>
                                    <p>
                                        Proin sit amet tellus sed ante tempor semper. Aliquam pulvinar tristique ultrices. Curabitur dapibus sapien et ligula euismod, id gravida dui rhoncus. Nunc blandit id nulla sed consequat. Donec condimentum ullamcorper mattis. Sed et tempus sapien. Nulla ultrices nulla vel dapibus sodales. Nunc maximus mauris diam, nec convallis odio aliquet a. Integer id justo augue. Nunc eget dapibus elit. Nam venenatis, metus sed ultrices ultrices, mauris dui mollis mauris, eget consequat arcu mauris quis massa. Mauris a magna lobortis ante ornare porttitor ut vitae ligula. Vivamus molestie nibh ac neque consequat pellentesque. Vestibulum fringilla vulputate quam, vitae auctor lectus efficitur molestie.
                                    </p>
                                </div>
                            </div>

                            <div class="d-block p-3 w-25">
                                <div class="text-center">
                                    <h4>Price</h4>
                                    <div class="p-4 bg-secondary rounded-3 mb-3">
                                        <p>$127/head</p>
                                    </div>
                                </div>
                                
                                
                                <div class="text-center">
                                    <h4>Date & Time</h4>
                                    <div class="p-4 bg-secondary rounded-3 mb-3">
                                        <p>28th June, 2023</p>
                                        <p>9:00am - 10:30am</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


        </div> <!-- Row END -->
    </div>
</section>

<script>
    $('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');  
    
    if ($(this).find('.btn-primary').size()>0) {
        $(this).find('.btn').toggleClass('btn-primary');
    }
    if ($(this).find('.btn-danger').size()>0) {
    	$(this).find('.btn').toggleClass('btn-danger');
    }
    if ($(this).find('.btn-success').size()>0) {
    	$(this).find('.btn').toggleClass('btn-success');
    }
    if ($(this).find('.btn-info').size()>0) {
    	$(this).find('.btn').toggleClass('btn-info');
    }
    
    $(this).find('.btn').toggleClass('btn-default');
       
});
     
</script>
    
<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';