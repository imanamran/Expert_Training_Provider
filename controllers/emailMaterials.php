<?php
require_once '../config.php';
// require_once 'tcpdf_include.php'; // TCPDF library

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$email = $_POST['email'];
$specificProgram = unserialize(base64_decode($_POST['program']));
$specificClient = unserialize(base64_decode($_POST['user']));

function sendEmail($mail_to, $mail_subject, $mail_body, $pdf_content)
{
    $cURL_key = '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';
    $mail_from = 'nicklecik@gmail.com';

    // Get the content of the file and then encode it
    $file_encoded = base64_encode($pdf_content);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"personalizations\": [{\"to\": [{\"email\": \"$mail_to\"}]}],\"from\": {\"email\": \"$mail_from\"},\"subject\": \"$mail_subject\",\"content\": [{\"type\": \"text/plain\", \"value\": \"$mail_body\"}], \"attachments\": [{\"content\": \"$file_encoded\", \"type\": \"application/pdf\", \"filename\": \"expertTrainingProvider.pdf\", \"disposition\": \"attachment\"}]}",
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
    $name = $specificProgram->getTrainingProgramName();
    $title = "Expert Training Provider: $name Materials";
    $message = "Kindly view the attached file for your $name booking";
    
    // Create PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($specificProgram->getTrainingTutorName());
    $pdf->SetTitle($specificProgram->getTrainingProgramName());
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    $txt = <<<EOD
    Program ID: {$specificProgram->getTrainingProgramID()}
    Program Name: {$specificProgram->getTrainingProgramName()}
    Program Description: {$specificProgram->getTrainingProgramDescription()}
    Program Price: {$specificProgram->getTrainingProgramPrice()}
    Program Date: {$specificProgram->getTrainingProgramDate()}
    Program Time: {$specificProgram->getTrainingProgramTime()}
    Program Duration: {$specificProgram->getTrainingProgramDuration()}
    Tutor Name: {$specificProgram->getTrainingTutorName()}
    EOD;
    $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
    
    $pdf_content = $pdf->Output('', 'S');

    // Send Email
    sendEmail($email, $title , $message, $pdf_content);
    header('Location: ../views/index.php');

}else{
    $_SESSION['error'] = "The email does not exist.";
    header('Location: ../views/login.php');
}
?>
