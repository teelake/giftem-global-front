<?php
require_once "backend/includes/dashboard.php";

$dashboard = new Dashboard();

// Get the current URL path
$requestUri = $_SERVER['REQUEST_URI']; // e.g., "/alia_jd.php"

// Extract the property name
$pathParts = explode('/', $requestUri); // Split by '/'
$lastPart = end($pathParts); // Get the last part (e.g., "alia_jd.php")
$propertyNameWithExtension = basename($lastPart, '.php'); // Remove .php
$propertyName = str_replace('_', ' ', $propertyNameWithExtension); // Replace underscores with spaces

// Fetch data for the property
$generalInfo = $dashboard->getGeneralInfo(); // Fetch general data
$propertytemplateInfo = $dashboard->getPropertyTemplateInfo($propertyName); // Fetch property-specific data
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giftem Globals - <?php echo $propertyName; ?></title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Giftem Globals - <?php echo $propertyName; ?>">
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
                            <h1 class="page-title text-color-white"><?php echo $propertyName; ?></h1>
                            <div class="ltn__breadcrumb-list text-white">
                                <ul>
                                    <li><a href="index.php"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                    <li class="ltn__secondary-color"><?php echo $propertyName; ?></li>
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
                            <h1><?php echo $propertytemplateInfo['propertyName']; ?></h1>
                            <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span>
                                <?php echo $propertytemplateInfo['location']; ?></label>
                            <h4 class="title-2"><?php echo $propertytemplateInfo['description']; ?></h4>
                            <p><?php echo $propertytemplateInfo['description2']; ?></p>
                            <h4 class="title-2">Facilities</h4>
                            <div class="property-detail-feature-list clearfix mb-45">                            
                            <ul>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-faucet"></i>
                                        <div>
                                            <h6>  <?php echo $propertytemplateInfo['facility1'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-video"></i>
                                        <div>
                                            <h6><?php echo $propertytemplateInfo['facility2'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-wifi"></i>
                                        <div>
                                            <h6><?php echo $propertytemplateInfo['facility2'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="flaticon-double-bed"></i>
                                        <div>
                                            <h6><?php echo $propertytemplateInfo['facility3'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-futbol"></i>
                                        <div>
                                            <h6><?php echo $propertytemplateInfo['facility4'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-road"></i>
                                        <div>
                                            <h6><?php echo $propertytemplateInfo['facility5'];?></h6>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="fa fa-bolt"></i>
                                        <div>
                                            <h6><?php echo $propertytemplateInfo['facility7'];?></h6>
                                           
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