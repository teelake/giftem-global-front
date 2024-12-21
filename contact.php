<?php
session_start(); // Start the session for CSRF token management and error handling.
require_once "backend/includes/dashboard.php";

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$dashboard = new Dashboard();
$generalInfo = $dashboard->getGeneralInfo(); // Fetch the current data

// Initialize variables
$successMessage = '';
$errorMessage = '';


// Display success or error messages
if (isset($_SESSION['successMessage'])) {
    $successMessage= "<p style='color: green;'>{$_SESSION['successMessage']}</p>";
    unset($_SESSION['successMessage']);
}

if (isset($_SESSION['errorMessage'])) {
    $errorMessage= "<p style='color: red;'>{$_SESSION['errorMessage']}</p>";
    unset($_SESSION['errorMessage']);
}





?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giftem Globals - Contact</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Giftem Globals - Contact">
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
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">
    <?php 
     include_once('includes/header.php');
    ?>
  
    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-black-60 bg-image "  data-bs-bg="img/giftem-about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title  text-white">Contact Us</h1>
                        <div class="ltn__breadcrumb-list  text-white">
                            <ul>
                                <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li class="ltn__secondary-color">Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                        <i class="fa fa-envelope"></i>
                        </div>
                        <h3>Email Address</h3>
                        <p>  <?php echo $generalInfo['email'];?>
                           </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                        <i class="fa fa-phone"></i>
                        </div>
                        <h3>Phone Number</h3>
                        <?php echo $generalInfo['phone_number_1'];?><br><?php echo $generalInfo['phone_number_2'];?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                        <i class="fa fa-map-marker"></i>
                        </div>
                        <h3>Office Address</h3>
                        <p>  <?php echo $generalInfo['office_address'];?>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->
    
    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120 mb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php elseif ($errorMessage): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
                        <h4 class="title-2">Get A Quote</h4>
                        
                        <form action="process.php" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="input-item input-item-name ltn__custom-icon">
                <input type="text" name="name" placeholder="Enter your name" required minlength="2">
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-item input-item-email ltn__custom-icon">
                <input type="email" name="email" placeholder="Enter email address" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-item">
                <select class="nice-select"  name="service_type" required>
                    <option value="">Select Service Type</option>
                    <option value="Estate Development">Estate Development</option>
                    <option value="Property Consultation">Property Consultation</option>
                    <option value="Investment Opportunities">Investment Opportunities</option>
                    <option value="Land Titles">Land Titles</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-item input-item-phone ltn__custom-icon">
                <input type="text" name="phone" placeholder="Enter phone number" required>
            </div>
        </div>
    </div>
    <div class="input-item input-item-textarea ltn__custom-icon">
        <textarea name="message" placeholder="Enter message" required></textarea>
    </div>
 
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="btn-wrapper mt-0">
        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Send</button>
    </div>
    <p class="form-messege mb-0 mt-20"></p>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="google-map mb-120">

    <?php echo $generalInfo['google_map_address'];?>

    </div>
    <!-- GOOGLE MAP AREA END -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Looking for a dream home?</h1>
                            <p>We can help you realize your dream of a new home</p>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="contact.php">Explore Properties <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->

    <!-- FOOTER AREA START -->
    <?php include_once('includes/footer.php');?>
    <!-- FOOTER AREA END -->
</div>
<!-- Body main wrapper end -->

    <!-- All JS Plugins -->
    <script src="js/plugins.js"></script>
    <!-- Contact Form -->
    <script src="js/contact.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
  
</body>

</html>

