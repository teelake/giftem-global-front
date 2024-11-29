<?php
require_once "includes/dashboard.php";

$dashboard = new Dashboard();

if (!$dashboard->isLoggedIn()) {
    header("Location: index.php");
    exit;
}
$testimonialsInfo = $dashboard->getTestimonialsInfo(); // Fetch the current data
// Check if data exists
if (!$testimonialsInfo) {
  echo "No data found or an error occurred.";
  $testimonialsInfo = []; // Prevent errors if fields are accessed later
}


$message = ""; // Variable to store success or error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // $dashboard = new Dashboard();

  $data = [
      'name1' => $_POST['name1'],
      'details1' => $_POST['details1'],
      'name2' => $_POST['name2'],
      'details2' => $_POST['details2'],
      'name3' => $_POST['name3'],
      'details3' => $_POST['details3'],
      
    
      
  ];

  $message = $dashboard->updateTestimonialsInfo($data);
  //echo $message; // Display success or error message
}
?>
<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
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

    <title>Testimonials   - Giftem Globals</title>

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

    <!-- Icons. Uncomment  icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

       

        <?php include_once("includes/aside.php");?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

         <?php include_once("includes/nav.php");?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DashBoard/</span> Testimonials</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-lg-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Update Testimonials</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

                      <form method="post">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name1" name="name1"
                              value="<?php echo $testimonialsInfo['name1'];?>" />
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Review 1:</label>
                          <div class="col-sm-10">
                            <textarea
                              id="details1"
                              name="details1"
                              class="form-control"
                       
                             
                              
                            >  <?php echo $testimonialsInfo['details1'];?></textarea>
                          </div>
                        </div>

                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name2" name="name2"
                              value="<?php echo $testimonialsInfo['name2'];?>" />
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Review 2:</label>
                          <div class="col-sm-10">
                            <textarea
                              id="details2"
                              name="details2"
                              class="form-control"
                       
                             
                              
                            >  <?php echo $testimonialsInfo['details2'];?></textarea>
                          </div>
                        </div>


                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name3" name="name3"
                              value="<?php echo $testimonialsInfo['name3'];?>" />
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Review 3:</label>
                          <div class="col-sm-10">
                            <textarea
                              id="details3"
                              name="details3"
                              class="form-control"
                       
                             
                              
                            >  <?php echo $testimonialsInfo['details3'];?></textarea>
                          </div>
                        </div>


                        
                       
                      
                       
                        
                        <div class="row justify-content-end">
                          <div class="col-sm-10 mb-3">
                            <button type="submit" class="btn btn-danger">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->
                 </div>
            </div>
            <!-- / Content -->

           
            <?php include_once ("includes/footer.php");?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

   

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
