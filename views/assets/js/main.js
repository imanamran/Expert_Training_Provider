$(function(){
    $("#form-register").validate({
        rules: {
            password : {
                required : true,
            },
            confirm_password: {
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "Please provide an username"
            },
            email: {
                required: "Please provide an email"
            },
            password: {
                required: "Please provide a password"
            },
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Please enter the same password"
            }
        }
    });
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        // enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Back',
            next : '<i class="zmdi zmdi-arrow-right"></i>',
            finish : '<i class="zmdi zmdi-arrow-right"></i>',
            current : ''
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            var requestId = $('#request-id').val();
            var programId = $('#program-id').val();
            var companyName = $('#company-name').val();
            var paymentType = $('#payment-type').val();
            var paymentStatus = "";
            var requestStatus = "Pending";
            var selectedDate = $('#selected-date').val();
            var attendees = $('#attendees').val();
            var roomNeeded = $('input[name="room-needed"]:checked').val();
            var roomName = $('#room-name').val();

            $('#request-id-val').text(requestId);
            $('#program-id-val').text(programId);
            $('#company-name-val').text(companyName);
            $('#payment-type-val').text(paymentType);
            $('#payment-status-val').text(paymentStatus);
            $('#request-status-val').text(requestStatus);
            $('#selected-dates-val').text(selectedDate);
            $('#attendees-val').text(attendees);
            $('#room-val').text(roomNeeded);
            $('#room-name-val').text(roomName);


              
            $("#form-register").validate().settings.ignore = ":disabled,:hidden";
            // $("#form-register").valid();
            return true;
        },
        onFinishing: function (event, currentIndex) {
            // Add your logic here, such as saving form data or performing final checks
            
            // Redirect to index.php
            // window.location.href = "trainingRequestUpdate.php?userId="+$('#user-id').val();
            // window.location.href = "trainingRequestUpdate.php?userId="+$('#user-id').val() + "&requestId="+$('#request-id').val() + "&programId="+$('#program-id').val() + "&companyName="+$('#company-name').val() + "&paymentType="+$('#payment-type').val() + "&paymentStatus="+$('#payment-status').val() + "&requestStatus="+$('#request-status').val() + "&selectedDate="+$('#selected-date').val() + "&attendees="+$('#attendees').val() +  "&roomNeeded="+ ('input[name="room-needed"]:checked').val() + "&roomName="+$('#room-name').val();
            window.location.href = "trainingRequestUpdate.php?userId="+$('#user-id').val() + "&requestId="+$('#request-id').val() + "&programId="+$('#program-id').val() + "&companyName="+$('#company-name').val() + "&paymentType="+$('#payment-type').val() + "&paymentStatus="+$('#payment-status').val() + "&requestStatus="+$('#request-status').val() + "&selectedDate="+$('#selected-date').val() + "&attendees="+$('#attendees').val() +  "&roomNeeded="+ $('input[name="room-needed"]:checked').val() + "&roomName="+$('#room-name').val();

            
            return true; // Return true to allow form submission
        }
    
    });
});

