<?php
require_once '../config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$email = $_POST['email'];

function sendEmail($mail_to, $mail_subject, $mail_body)
{
    $cURL_key = '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';
    $mail_from = 'nicklecik@gmail.com';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"personalizations\": [{\"to\": [{\"email\": \"$mail_to\"}]}],\"from\": {\"email\": \"$mail_from\"},\"subject\": \"$mail_subject\",\"content\": [{\"type\": \"text/plain\", \"value\": \"$mail_body\"}]}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $cURL_key",
            "cache-control: no-cache",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

$result = $clientsCollection->getClientByEmail($email);

if($result){
    $token = bin2hex(random_bytes(50)); // generate a secure random token
    $clientsCollection->saveResetToken($email, $token);
    $resetLink = "http://localhost:8888/MSP-Sprint1/controllers/resetPasswordForm.php?token=$token"; // replace with your actual domain and reset password script
    $message = "Click on this link to reset your password: $resetLink";

    sendEmail($email, "Password Reset Request", $message);
    header('Location: ../views/login.php');

}else{
    $_SESSION['error'] = "The email does not exist.";
    header('Location: ../views/forgotPasswordForm.php');
}
