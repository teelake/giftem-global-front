<?php
require_once "includes/dashboard.php";

$dashboard = new Dashboard();

if (!$dashboard->isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$errorMessage = "";
$successMessage = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propertyName = trim($_POST['propertyName']);
    $filename = strtolower(str_replace(' ', '_', $propertyName)) . '.php';

    // Sanitize filename: allow lowercase letters, numbers, underscores, and a single dot for the extension
    $filename = preg_replace('/[^a-z0-9_.]/', '', $filename);

    // Ensure the file path is outside the root folder
    $filePath = dirname(__DIR__) . '/' . $filename;

    // Check if file already exists
    if (file_exists($filePath)) {
        $errorMessage = "A page with this name already exists.";
    } else {
        // Create file content with the new template structure
        $fileContent = <<<PHP
<?php
require_once "backend/includes/dashboard.php";

\$dashboard = new Dashboard();

// Get the current URL path
\$requestUri = \$_SERVER['REQUEST_URI']; // e.g., "/$filename"

// Extract the property name
\$pathParts = explode('/', \$requestUri); // Split by '/'
\$lastPart = end(\$pathParts); // Get the last part (e.g., "$filename")
\$propertyNameWithExtension = basename(\$lastPart, '.php'); // Remove .php
\$propertyName = str_replace('_', ' ', \$propertyNameWithExtension); // Replace underscores with spaces

// Fetch data for the property
\$generalInfo = \$dashboard->getGeneralInfo(); // Fetch general data
\$propertytemplateInfo = \$dashboard->getPropertyTemplateInfo(\$propertyName); // Fetch property-specific data
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giftem Globals - <?php echo \$propertyName; ?></title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Giftem Globals - <?php echo \$propertyName; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <div class="body-wrapper">
        <?php include_once('includes/header.php'); ?>
        <div class="ltn__breadcrumb-area text-left bg-overlay-black-60 bg-image mb-0" data-bs-bg="img/giftem-about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner">
                            <h1 class="page-title text-color-white"><?php echo \$propertyName; ?></h1>
                            <div class="ltn__breadcrumb-list text-white">
                                <ul>
                                    <li><a href="index.php"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                    <li class="ltn__secondary-color"><?php echo \$propertyName; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ltn__shop-details-area pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="ltn__shop-details-inner ltn__page-details-inner mb-60">
                            <h1><?php echo \$propertytemplateInfo['propertyName']; ?></h1>
                            <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span>
                                <?php echo \$propertytemplateInfo['location']; ?></label>
                            <h4 class="title-2"><?php echo \$propertytemplateInfo['description']; ?></h4>
                            <p><?php echo \$propertytemplateInfo['description2']; ?></p>
                            <h4 class="title-2">Facilities</h4>
                            <div class="property-detail-feature-list clearfix mb-45">                            
                            <ul>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-faucet"></i>
                                        <div>
                                            <h6>  <?php echo \$propertytemplateInfo['facility1'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-video"></i>
                                        <div>
                                            <h6><?php echo \$propertytemplateInfo['facility2'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-wifi"></i>
                                        <div>
                                            <h6><?php echo \$propertytemplateInfo['facility2'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6><?php echo \$propertytemplateInfo['facility3'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-futbol"></i>
                                        <div>
                                            <h6><?php echo \$propertytemplateInfo['facility4'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-road"></i>
                                        <div>
                                            <h6><?php echo \$propertytemplateInfo['facility5'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-bolt"></i>
                                        <div>
                                            <h6><?php echo \$propertytemplateInfo['facility7'];?></h6>
                                           
                                        </div>
                                    </div>
                                </li>
                               
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "includes/footer.php"; ?>
    </div>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
PHP;

        // Save the file
        if (file_put_contents($filePath, $fileContent)) {
            //$successMessage = "Page '$propertyName' has been created successfully.";
            header("Location: property_template.php?propertyName=" . urlencode($propertyName));
        } else {
            $errorMessage = "Failed to create the page.";
        }
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

    <title>New Property Page - Giftem Globals</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DashBoard/</span> New Property Page</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-lg-8">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">New Property Page</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                    <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
    <?php elseif (!empty($successMessage)) : ?>
        <div class="alert alert-success" role="alert"><?= $successMessage; ?></div>
    <?php endif; ?>
              </div>
              <div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Create New Page</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="propertyName" class="form-label">Property Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="propertyName"
                    name="propertyName"
                    required
                />
            </div>
            <button class="btn btn-primary">Create Page</button>
        </form>
    </div>
</div>


            
    
   

                    
                </div>
                <!-- Basic with Icons -->
                 </div>
            </div>
            <!-- / Content -->
</div>
</div>

           
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
