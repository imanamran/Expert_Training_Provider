<?php
$title = "Login";


require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
   <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
        .btn-secondary {
            background-color: white;
            color: black;
        }
        .btn-secondary.active {
            background-color: #3579f6 !important;
            color: white;
        }
		.form-row {
			margin-bottom: 40px;
		}
			
    </style>
</head>

<body>
  <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row d-flex justify-content-center align-items-center">
                        <h1 class="pt-3">Expert Training Provider</h1>
                    </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                        <img src="assets/login.png" class="image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">



                <div class="card2 card border-0 px-4 py-5">
                <a href="index.php"class="text-info ">Back to Expert Training Provider</a>
                <br>

                <form method="post" action="../controllers/loginValidation.php">
                    <!-- User type toggle -->
                    <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="userType" id="employeeOption" value="client" checked> Client
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="userType" id="clientOption" value="employee"> Employee
                        </label>
                    </div>
                    
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['error'] ?>
                        </div>
                    <?php endif; ?>
                    <div id="error" class="alert alert-danger d-none" role="alert"></div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                            <input id="email" class="mb-4" type="text" name="email" placeholder="Enter a valid email address">
                            
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                            <input id="password" type="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> 
                                <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                            </div>
                            <a href="forgotPasswordForm.php" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                        </div>
                        <div class="row mb-3 px-3">
                            <button id="loginButton" type="submit" class="btn btn-primary btn-blue text-center">Login</button>

                        </div>
                    </form>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Don't have an account? <a href="register.php"class="text-danger ">Register</a></small>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-blue py-4">
            <div class="row px-3">
                <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                <div class="social-contact ml-4 ml-sm-auto">
                    <span class="fa fa-facebook mr-4 text-sm"></span>
                    <span class="fa fa-google-plus mr-4 text-sm"></span>
                    <span class="fa fa-linkedin mr-4 text-sm"></span>
                    <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="script.js"></script>

  <!-- Bootstrap JS Bundle (includes Popper.js) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>     
