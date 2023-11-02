<?php
require_once '../config.php';

$token = $_GET['token'];
$client = $clientsCollection->getClientByResetToken($token);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['create-new-password'];
    $confirmPassword = $_POST['confirm-new-password'];
    
    if($newPassword === $confirmPassword) {
        // The passwords match, so we update the user's password
        // Then redirect to login.php

        $client->setClientPassword($newPassword);
        $client->setClientToken();
        $client->updateUserInDatabase($db_handle);

        header('Location: ../views/login.php');
        exit();
    } else {
        // The passwords do not match, so we set an error message to display
        $_SESSION['error'] = "Passwords do not match!";
    }
}
?>


<!DOCTYPE html>
<html lang="en" style="--bs-primary: #0055f0;--bs-primary-rgb: 0,85,240;--bs-warning: #0055f0;--bs-warning-rgb: 0,85,240;--bs-body-color: var(--bs-btn-disabled-color);--bs-secondary: #d9d9d9;--bs-secondary-rgb: 217,217,217;">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Canadian+Aboriginal&amp;display=swap">
      <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/Testimonials-images.css">
      <link rel="stylesheet" href="assets/css/untitled.css">
      <link rel="stylesheet" href="/views/assets/css/styles.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" >
      <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" >
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin></script>
      <!-- Bootstrap Popper -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
      <!-- ReactJS Link -->
      <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
      <!-- React DOM Link -->
      <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
      <title>
          <?php
              echo $title;
          ?>
      </title>
      <style>
        body {
            background-color: midnightblue;
        }
        

        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* vh unit is the viewport height. 100vh will take the full height of the screen */
            width: 100vw; /* vw unit is the viewport width. 100vw will take the full width of the screen */
        }
    </style>
  </head>
  <body>

  
    <div class="center-screen">
        <div class="card text-center" style="width: 300px;">
            <div class="card-header h5 text-white bg-primary">Create New Password</div>


            <div class="card-body px-5">
                <p class="card-text py-2">
                    Set your new password so you can login and access Expert Training Provider
                </p>

                <?php
                if(isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>";
                    echo $_SESSION['error'];
                    echo "</div>";
                    unset($_SESSION['error']); // so the message doesn't keep showing on refresh
                }
                ?>

                <form id="forgotPasswordForm" method="post" action="">
                    <div class="form-outline">
                        <input type="password" name="create-new-password" class="form-control my-3" placeholder="Create new password"/>
                    </div>
                    <div class="form-outline">
                        <input type="password" name="confirm-new-password" class="form-control my-3" placeholder="Confirm new password"/>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset password</button>
                </form>
            </div>

        </div>
    </div>
</body>
  </html>
