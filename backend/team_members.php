<?php
require_once "includes/dashboard.php";

$dashboard = new Dashboard();

if (!$dashboard->isLoggedIn()) {
    header("Location: index.php");
    exit;
}
$teamInfo = $dashboard->getTeamInfo(); // Fetch the current data
// Check if data exists
if (!$teamInfo) {
  echo "No data found or an error occurred.";
  $teamInfo = []; // Prevent errors if fields are accessed later
}


$message = ""; // Variable to store success or error messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploadsDir = '../img/team/';
  if (!is_dir($uploadsDir)) {
      mkdir($uploadsDir, 0777, true); // Create the directory if it doesn't exist
  }

  // Initialize data array
  $data = [];

  // Handle each team member
  for ($i = 1; $i <= 4; $i++) {
      $nameKey = "name$i";
      $roleKey = "role$i";
      $photoKey = "photo$i";

      $data[$nameKey] = $_POST[$nameKey];
      $data[$roleKey] = $_POST[$roleKey];

      if (isset($_FILES[$photoKey]) && $_FILES[$photoKey]['error'] === UPLOAD_ERR_OK) {
          $tmpName = $_FILES[$photoKey]['tmp_name'];

          // Generate a randomized file name using the name, role, and a timestamp
          $originalExtension = pathinfo($_FILES[$photoKey]['name'], PATHINFO_EXTENSION);
          $randomizedFileName = time() . '_' . preg_replace('/\s+/', '_', strtolower($data[$nameKey])) . '_' . preg_replace('/\s+/', '_', strtolower($data[$roleKey])) . '.' . $originalExtension;

          $targetPath = $uploadsDir . $randomizedFileName;

          // Attempt to move the uploaded file
          if (move_uploaded_file($tmpName, $targetPath)) {
              $data[$photoKey] = $randomizedFileName; // Save file name (not full path) in data array
          } else {
              echo "Error uploading photo for member $i.";
              $data[$photoKey] = null; // Set null if upload fails
          }
      } else {
          // Optional: Retrieve the current photo from the database if no new file is uploaded
          $data[$photoKey] = $_POST["current_$photoKey"] ?? null;
      }
  }

  // Update team member info
  $message = $dashboard->updateTeamInfo($data);
 // echo $message; // Display success or error message
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

    <title>Team Members   - Giftem Globals</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DashBoard/</span> Team Members</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-lg-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Update Team Members</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

                      <form method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name1" name="name1"
                              value="<?php echo $teamInfo['name1'];?>" required/>
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Role:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control"
                             id="role1" name="role1"
                              value="<?php echo $teamInfo['role1'];?>" required/>
                          </div>
                        </div>

                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Photo: </label>
                          <div class="col-sm-10">
                          <input class="form-control" type="file" id="photo1" name="photo1" required
                          value="<?php echo $teamInfo['photo1'];?>" accept="image/*"/>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name2" name="name2"
                              value="<?php echo $teamInfo['name2'];?>" />
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Role:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control"
                             id="role2" name="role2"
                              value="<?php echo $teamInfo['role2'];?>" />
                          </div>
                        </div>

                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Photo: </label>
                          <div class="col-sm-10">
                          <input class="form-control" type="file" id="photo2" name="photo2"
                          value="<?php echo $teamInfo['photo2'];?>" accept="image/*"/>
                          </div>
                        </div>


                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name3" name="name3"
                              value="<?php echo $teamInfo['name3'];?>" />
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Role:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control"
                             id="role3" name="role3"
                              value="<?php echo $teamInfo['role3'];?>" />
                          </div>
                        </div>

                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Photo: </label>
                          <div class="col-sm-10">
                          <input class="form-control" type="file" id="photo3" name="photo3" 
                          value="<?php echo $teamInfo['photo3'];?>" accept="image/*"/>
                          </div>
                        </div>
                      
                       
                       
                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name: </label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"
                             id="name4" name="name4"
                              value="<?php echo $teamInfo['name4'];?>"  />
                          </div>
                        </div>

                      
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Role:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control"
                             id="role4" name="role4"
                              value="<?php echo $teamInfo['role4'];?>" />
                          </div>
                        </div>

                        
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Photo: </label>
                          <div class="col-sm-10">
                          <input class="form-control" type="file" id="photo4" name="photo4" 
                          value="<?php echo $teamInfo['photo4'];?>" accept="image/*"/>
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
