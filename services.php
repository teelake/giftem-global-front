
<?php
require_once "backend/includes/dashboard.php";

$dashboard = new Dashboard();

$generalInfo = $dashboard->getGeneralInfo(); // Fetch the current data

$servicesInfo = $dashboard->getServicesInfo(); // Fetch the current data

?>
<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giftem Globals - Services</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Giftem Globals - Services">
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
                        <h1 class="page-title text-white">What We Do</h1>
                        <div class="ltn__breadcrumb-list text-white">
                            <ul>
                                <li><a href="index.php"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li class="ltn__secondary-color">Services</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- ABOUT US AREA START -->
    
    <!-- ABOUT US AREA END -->

    <!-- SERVICE AREA START (Service 1) -->
    <div class="ltn__service-area section-bg-1 pt-115 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Services</h6>
                        <h1 class="section-title">Our Core Services</h1>
                    </div>
                </div>
            </div>
            <div class="row  justify-content-center">
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                        <i class="fa fa-building"></i>
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="#"><?php echo htmlspecialchars($servicesInfo['title1']);?>
                           </a></h3>
                            <p>

                            <?php echo htmlspecialchars($servicesInfo['description1']);?>
                            </p>
                            <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                        <i class="fa fa-user-tie"></i>
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="#">
                            <?php echo htmlspecialchars($servicesInfo['title2']);?>
                           
                            </a></h3>
                            <p>
                            <?php echo htmlspecialchars($servicesInfo['description2']);?>

                            </p>
                            <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                        <i class="fa fa-chart-line"></i>
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="#"><?php echo htmlspecialchars($servicesInfo['title3']);?></a></h3>
                              <p>
                              <?php echo htmlspecialchars($servicesInfo['description3']);?>

                              </p>
                            <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                            
                        <i class="fa fa-shield-alt"></i>
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="#"><?php echo htmlspecialchars($servicesInfo['title4']);?></a></h3>
                            <p>
                            <?php echo htmlspecialchars($servicesInfo['description4']);?></a></h3>
                           

                            </p>
                            <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a> -->
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- SERVICE AREA END -->

   
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
                            <a class="btn btn-effect-3 btn-white" href="contact.html">Explore Properties <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->

    <!-- FOOTER AREA START -->
   
        <?php include_once 'includes/footer.php' ;?>
    <!-- FOOTER AREA END -->

</div>
<!-- Body main wrapper end -->

    <!-- All JS Plugins -->
    <script src="js/plugins.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
  
</body>

</html>

