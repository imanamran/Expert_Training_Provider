<?php
$title = "Training Request";
require_once '../config.php';

    // Make sure the id parameter exists in the URL
if (isset($_GET['id']) &&isset($_GET['userId'])) {
    $programId = $_GET['id'];
    $userId = $_GET['userId'];

	$trainingProgram = $trainingProgramCollection->getTrainingProgramById($programId);
	$rooms = $clientsCollection->getSavedRooms($userId);
	
    
    // Create a new TrainingProgramCollection instance

    // Get the specific training program from your database
    // $specificProgram = $trainingProgramCollection->getTrainingProgramById($programId);
    // $specificProgram->getTrainingProgramName();
	

} else {
    // Redirect to homepage or show an error if the id parameter doesn't exist
    // header('Location: trainingStatus.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $trainingProgram->getTrainingProgramName()?></title>
	<link rel="stylesheet" href="https://example.com/path/to/alternate-bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="assets/css/raleway-font.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="assets/css/confirmation.css"/>
	<style>
        body {
            background-color: midnightblue;
        }
        .form-holder.btn-secondary {
            background-color: red !important;
            color: red;
        }
        .btn-secondary.active {
            background-color: #80b845 !important;
            color: white;
        }
		.form-row {
			margin-bottom: 40px;
		}
			
    </style>
</head>
<body>
	
	<div class="page-content">
		<div class="wizard-v1-content">

		<div class="wizard-form">
		<h3 style="text-align: center;">One step closer to</h3>

    <h1 style="text-align: center;"><?php echo $trainingProgram->getTrainingProgramName()?></h1>
	<form class="form-register" id="form-register" action="trainingRequestUpdate.php?userId= <?php echo $userId ?>" method="post">
        <div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-account"></i></span>
			            	<span class="step-number">Step 1</span>
			            	<span class="step-text">Booking Infomation</span>
			            </h2>
			            <section>
			                <div class="inner">
								<div class="form-row">
								<input class="form-control" id="user-id" value="<?php echo $userId?>" style="display: none;">
								<input class="form-control" id="request-id" value="<?php echo substr(uniqid(), -6)?>" style="display: none;">
								<input class="form-control" id="program-id" value="<?php echo $trainingProgram->getTrainingProgramID()?>" style="display: none;">
								<input class="form-control" id="payment-status" value="Awaiting payment" style="display: none;">
								<input class="form-control" id="request-status" value="Pending" style="display: none;">




									<div class="form-holder form-holder-2">
										<label for="companyName">Company Name*</label>
										<input type="text" placeholder="eg. Swinburne University" class="form-control" id="company-name" name="companyName" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="selected_date">Selected Date*</label>
										<input type="date" class="form-control" id="selected-date" name="selected_date" required>
									</div>
								</div>

								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="attendees">Expected Attendees*</label>
										<input type="number" placeholder="Number of Attendees" class="form-control" id="attendees" name="attendees" required min="1" step="1">
									</div>
								</div>

								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="attendees">Do you need a room?  </label>

										<div class="btn-group btn-group-toggle" data-toggle="buttons">
											<label class="btn btn-secondary">
												<input type="radio" name="room-needed" id="room-needed-yes" autocomplete="off" value="True" onchange="showRoomNameField()"> Yes
											</label>
											<label class="btn btn-secondary active">
												<input type="radio" name="room-needed" id="room-needed-no" autocomplete="off" value="False" onchange="hideRoomNameField()"> No
											</label>

											<div id="room-name-field" style="display: none;">
												<label for="room-name">Select Fav Room:</label>
												<select id="room-name" name="room-name">
													<?php foreach($rooms as $room): ?>
														<option value="<?php echo $room; ?>"><?php echo $room; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>

									</div>
								</div>
							</div>
			            </section>


						<!-- SECTION 2 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-card"></i></span>
			            	<span class="step-number">Step 2</span>
			            	<span class="step-text">Payment Infomation</span>
			            </h2>
			            <section>
						<div class="my-form">
							<div class="inner">
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="card-type">Payment Type</label>
										<select name="card-type" id="payment-type" class="form-control" style="height: 50%;" onchange="updatePaymentForm()">
											<option value="" disabled selected>Select Payment type</option>
											<option value="Cash">Cash</option>
											<option value="Invoice">Invoice</option>
											<option value="Credit card">Credit Card</option>
											<option value="PayPal">PayPal</option>
										</select>
									</div>
								</div>

								<!-- Cash -->
								<div id="cash-form" style="display: none;">
									<!-- Remind them that they will need to pay on the day of the training session to the tutor -->
									<p>Reminder: Please pay on the day of the training session to the tutor.</p>
								</div>

								<!-- Invoice -->
								<div id="invoice-form" style="display: none;">
									<!-- Remind them that they will need to pay within 7 days of the training session to the tutor -->
									<p>Reminder: Please pay within 7 days of the training session to the tutor.</p>
								</div>

								<!-- PayPal -->
								<div id="paypal-form" style="display: none;">
									<!-- Show a button that links to the PayPal page -->
									<p>Click the button below to proceed with PayPal payment:</p>
									<button onclick="redirectToPayPal()">Pay with PayPal</button>
								</div>

								<!-- Credit Card -->
								<div id="credit-card-form" style="display: none;">
									<div class="form-row">
										<div class="form-holder form-holder-3">
											<label for="card-number">Card Number</label>
											<input type="text" name="card-number" class="card-number" id="card-number" placeholder="ex: 489050625008xxxx">
										</div>
										<div class="form-holder">
											<label for="cvc">CVC</label>
											<input type="text" name="cvc" class="cvc" id="cvc" placeholder="xxx">
										</div>
									</div>
									<div class="form-row form-row-2">
										<div class="form-holder">
											<label for="month">Expiry Month</label>
											<select name="month" id="month" class="form-control" style="height: 50%;">
												<option value="" disabled selected>Expiry Month</option>
												<option value="January">January</option>
												<option value="February">February</option>
												<option value="March">March</option>
												<option value="April">April</option>
												<option value="May">May</option>
											</select>
										</div>
										<div class="form-holder">
											<label for="year">Expiry Year</label>
											<select name="year" id="year" class="form-control" style="height: 50%;">
												<option value="" disabled selected>Expiry Year</option>
												<option value="2023">2023</option>
												<option value="2024">2024</option>
												<option value="2025">2025</option>
												<option value="2026">2026</option>
												<option value="2027">2027</option>
												<option value="2028">2028</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
			            	<span class="step-number">Step 3</span>
			            	<span class="step-text">Confirm Your Details</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<h3>Comfirm Details</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th>Company Name:</th>
												<td id="company-name-val"></td>
											</tr>
											<tr class="space-row">
												<th>Payment Type:</th>
												<td id="payment-type-val"></td>
											</tr>
											<tr class="space-row">
												<th>Payment Status:</th>
												<td id="payment-status-val"></td>
											</tr>
											<tr class="space-row">
												<th>Program Name:</th>
												<td><?php echo $trainingProgram->getTrainingProgramName()?></td>
											</tr>
											<tr class="space-row">
												<th>Selected date:</th>
												<td id="selected-dates-val"></td>
											</tr>
											<tr class="space-row">
												<th>Number of attendees:</th>
												<td id="attendees-val"></td>
											</tr>
											<tr class="space-row">
												<th>Room needed:</th>
												<td id="room-val"></td>
											</tr>
											<tr class="space-row">
												<th>Room name:</th>
												<td id="room-name-val"></td>
											</tr>
										</tbody>
										</tbody>
									</table>
								</div>
							</div>
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>

		<script>
    function updatePaymentForm() {
        var paymentType = document.getElementById("payment-type").value;
        var cashForm = document.getElementById("cash-form");
        var invoiceForm = document.getElementById("invoice-form");
        var creditCardForm = document.getElementById("credit-card-form");
        var paypalForm = document.getElementById("paypal-form");

        cashForm.style.display = "none";
        invoiceForm.style.display = "none";
        creditCardForm.style.display = "none";
        paypalForm.style.display = "none";

        if (paymentType === "cash") {
            cashForm.style.display = "block";
        } else if (paymentType === "invoice") {
            invoiceForm.style.display = "block";
        } else if (paymentType === "credit-card") {
            creditCardForm.style.display = "block";
        } else if (paymentType === "paypal") {
            paypalForm.style.display = "block";
        }
    }

	function showRoomNameField() {
    document.getElementById('room-name-field').style.display = '';
	}

	function hideRoomNameField() {
		document.getElementById('room-name-field').style.display = 'none';
		document.getElementById('room-name').selectedIndex = -1;  // Clear selected room
	}


    function redirectToPayPal() {
        // Implement the redirection to the PayPal page here
        window.location.href = "https://www.paypal.com";
    }
</script>



	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="assets/js/jquery.steps.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userRequest = [
      'requestId' => $_POST['requestId'],
      'requestProgramId' => $_POST['programId'],
      'requestCompanyName' => $_POST['companyName'],
      'requestPaymentType' => $_POST['paymentType'],
      'requestPaymentStatus' => $_POST['paymentStatus'],
      'requestStatus' => $_POST['requestStatus'],
      'requestSelectedDate' => $_POST['selectedDate'],
      'requestNumberOfAttendes' => $_POST['attendees'],
      'requestNeedRoom' => $_POST['roomNeeded'],
      'requestRoomName' => $_POST['roomName']
    ];

    // Assume $clientsCollection and $userId are available here
    $clientsCollection->appendUserRequestToList($userId, $userRequest);

    // Optionally, you can return a response to the JavaScript code
    echo json_encode(['status' => 'success']);
  }
?>