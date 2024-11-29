<?php
require_once "includes/config.php";

$errorMessage = "";  // Variable to store error messages
$successMessage = ""; // Variable to store success message

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = (new Database())->connect();

    $first_name = trim($_POST['first_name']);
    
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
  
    $status ='1';
    $role ='Admin';

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $errorMessage = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    }
     else {
        // Check if email exists
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $errorMessage = "Email already exists. Please use a different email.";
        } else {
            // Hash the password securely
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $query = "INSERT INTO users (first_name, last_name, email, password, role, status)
             VALUES (:first_name, :last_name, :email, :password, :role, :status)";

            $stmt = $db->prepare($query);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":role", $role);
            $stmt->bindParam(":status", $status);

            if ($stmt->execute()) {

                header ("Location:index.php");
                //$successMessage = "User registered successfully!";
            } else {
                $errorMessage = "Failed to register user.";
            }
        }
    }

    $db = null; // Close connection
}
?>


<!DOCTYPE html>


<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register | Giftem Globals</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.php" class="app-brand-link gap-2">
                <img src="assets/img/favicon/logo.png" alt="logo"/>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Sign Up As An Administrator</h4>
              <p class="mb-4">Make your website management easy!</p>
              <div class="mb-3">
              <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
    <?php elseif (!empty($successMessage)) : ?>
        <div class="alert alert-success" role="alert"><?= $successMessage; ?></div>
    <?php endif; ?>
              </div>

              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">First Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="first_name"
                    name="first_name"
                    placeholder="Enter your First Name" 
                    autofocus
                  required/>
                </div>

                <div class="mb-3">
                  <label for="username" class="form-label">Last Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="last_name"
                    name="last_name"
                    placeholder="Enter your Last Name" 
                  required
                  />
                </div>


                
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="" required />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                
                <button class="btn btn-danger d-grid w-100">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="index.php">
                  <span class="text-danger">Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
