<?php
require_once "includes/dashboard.php";
//require_once "includes/database.php"; // Ensure you have a DB connection file if needed

$dashboard = new Dashboard();

if (!$dashboard->isLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Check if the propertyName is passed via the URL
if (!isset($_GET['propertyName'])) {
    header("Location: index.php"); // Redirect if no propertyName is provided
    exit;
}

$propertyName = urldecode($_GET['propertyName']);
$errorMessage = "";
$successMessage = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $data = [
        'propertyName' => $_POST['propertyName'],
        'location' => $_POST['location'],
        'description' => $_POST['description'],
        'description2' => $_POST['description2'],
        'facility1' => $_POST['facility1'],
        'facility2' => $_POST['facility2'],
        'facility3' => $_POST['facility3'],
        'facility4' => $_POST['facility4'],
        'facility5' => $_POST['facility5'],
        'facility6' => $_POST['facility6'],
        'facility7' => $_POST['facility7'],
      
        
    ];
  
    $message = $dashboard->newProperty($data);
}

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Property Template - Giftem Globals</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/logo.png" />
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include_once("includes/aside.php"); ?>
            <div class="layout-page">
                <?php include_once("includes/nav.php"); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DashBoard/</span> Property Page Template</h4>

                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">New Property Page - <?= htmlspecialchars($propertyName); ?></h5>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($errorMessage)) : ?>
                                    <div class="alert alert-danger" role="alert"><?= $errorMessage; ?></div>
                                <?php elseif (!empty($successMessage)) : ?>
                                    <div class="alert alert-success" role="alert"><?= $successMessage; ?></div>
                                <?php endif; ?>
                                
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="propertyName" class="form-label">Property Name</label>
                                        <input type="text" class="form-control" id="propertyName" name="propertyName" value="<?= htmlspecialchars($propertyName); ?>" required readonly />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="6" maxlength="8000" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description2" name="description2" rows="6" maxlength="8000" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="facility1" class="form-label">Facility 1</label>
                                        <input type="text" class="form-control" id="facility1" name="facility1" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="facility2" class="form-label">Facility 2</label>
                                        <input type="text" class="form-control" id="facility2" name="facility2" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="facility3" class="form-label">Facility 3</label>
                                        <input type="text" class="form-control" id="facility3" name="facility3" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="facility4" class="form-label">Facility 4</label>
                                        <input type="text" class="form-control" id="facility4" name="facility4" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="facility5" class="form-label">Facility 5</label>
                                        <input type="text" class="form-control" id="facility5" name="facility5" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="facility5" class="form-label">Facility 6</label>
                                        <input type="text" class="form-control" id="facility6" name="facility6" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="facility5" class="form-label">Facility 7</label>
                                        <input type="text" class="form-control" id="facility7" name="facility7" />
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once("includes/footer.php"); ?>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
