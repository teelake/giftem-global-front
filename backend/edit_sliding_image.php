<?php
require_once "includes/dashboard.php";

$dashboard = new Dashboard();

if (!$dashboard->isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$message = ""; // To display success or error messages

// Check if an `id` is passed to edit a specific record
$sliderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the existing slider details
$sliderDetails = $dashboard->getSlidingImageById($sliderId); // Assumes a method in Dashboard class

if (!$sliderDetails) {
    $message = "Record not found or invalid ID.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadsDir = '../img/slider/'; // Directory to store slider images
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true); // Create directory if it doesn't exist
    }

    $updatedImage = $sliderDetails['image']; // Default to the current image

    // File upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['image']['tmp_name'];
        $originalFileName = $_FILES['image']['name'];
        $targetPath = $uploadsDir . $originalFileName;

        if (move_uploaded_file($tmpName, $targetPath)) {
            $updatedImage = $originalFileName; // Update with the new image file name
        } else {
            $message = "Error uploading the file.";
        }
    }

    // Prepare data to save
    $data = [
        'id' => $sliderId,
        'image' => $updatedImage,
        'intro_text' => $_POST['intro_text'],
        'main_text' => $_POST['main_text'],
        'sub_text' => $_POST['sub_text'],
        'button_name' => $_POST['button_name']
    ];

    // Call the update method in the Dashboard class
   // Call the update method in the Dashboard class
if ($dashboard->updateSlidingImage($sliderId, $data)) { // Pass both $sliderId and $data
    $message = "Sliding image updated successfully!";
    // Optionally refresh the slider details
    $sliderDetails = $dashboard->getSlidingImageById($sliderId);
} else {
    $message = "Failed to update sliding image.";
}

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

    <title>Sliding Image   - Giftem Globals</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DashBoard/</span> Sliding Images</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-lg-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Upload Sliding Images</h5>
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
        <label class="col-sm-2 col-form-label" for="image">Sliding Image: </label>
        <div class="col-sm-10">
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
            <?php if (!empty($sliderDetails['image'])): ?>
                <p>Current Image:</p>
                <img src="../img/slider/<?php echo htmlspecialchars($sliderDetails['image']); ?>" alt="Slider Image" style="max-width: 100px; max-height: 100px;">
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="intro_text">Intro Text:</label>
        <div class="col-sm-10">
            <input type="text" id="intro_text" name="intro_text" class="form-control" value="<?php echo htmlspecialchars($sliderDetails['intro_text']); ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="main_text">Main Text:</label>
        <div class="col-sm-10">
            <textarea id="main_text" name="main_text" class="form-control" required><?php echo htmlspecialchars($sliderDetails['main_text']); ?></textarea>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="sub_text">Sub Text:</label>
        <div class="col-sm-10">
            <textarea id="sub_text" name="sub_text" class="form-control" required><?php echo htmlspecialchars($sliderDetails['sub_text']); ?></textarea>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="button_name">Button Text:</label>
        <div class="col-sm-10">
            <input type="text" id="button_name" name="button_name" class="form-control" value="<?php echo htmlspecialchars($sliderDetails['button_name']); ?>" required>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-sm-10">
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
