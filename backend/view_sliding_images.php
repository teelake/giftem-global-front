<?php
require_once "includes/dashboard.php";

$dashboard = new Dashboard();

if (!$dashboard->isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$message = ""; // To display success or error messages

// Handle deletion
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    if ($dashboard->deleteSlidingImage($deleteId)) {
        $message = "Record deleted successfully.";
    } else {
        $message = "Failed to delete the record.";
    }
}

// Fetch all sliding images
$slidingImages = $dashboard->getSlidingImages();

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

    <title>Manage Sliding Image   - Giftem Globals</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DashBoard/</span> View Sliding Images</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-lg-12">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Manage Sliding Images</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                   
                    <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" width="40%">
                      <thead>
                        <tr>
                        <th>SN</th>
                          <th>Image</th>
                          <th>Intro Text</th>
                          <th>Main Text</th>
                          <th>Sub Text</th>
                          <th>Button Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if (!empty($slidingImages)): ?>
                        <?php foreach ($slidingImages as $index => $image): ?>
                        <tr>
                        <td><?php echo $index + 1; ?></td>
                            <td><img src="../img/slider/<?php echo $image['image']; ?>" alt="Slider Image" style="width: 50px;"></td>
                            <td ><?php echo nl2br($image['intro_text']); ?></td>
                            <td ><?php echo nl2br($image['main_text']); ?></td>
                            <td><?php echo nl2br($image['sub_text']); ?></td>
                            <td><?php echo nl2br($image['button_name']); ?></td>
                            <td>
                                <a href="edit_sliding_image.php?id=<?php echo $image['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="view_sliding_images.php?delete_id=<?php echo $image['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                         
                    <tr>
                        <td colspan="7">No records found.</td>
                    </tr>
                <?php endif; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
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
