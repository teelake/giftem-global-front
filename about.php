<?php
require_once "backend/includes/dashboard.php";

$dashboard = new Dashboard();

$generalInfo = $dashboard->getGeneralInfo(); // Fetch the current data
$valuesInfo = $dashboard->getValuesInfo(); // Fetch the current data
$aboutInfo = $dashboard->getAboutInfo(); // Fetch the current data
$testimonialsInfo = $dashboard->getTestimonialsInfo(); // Fetch the current data
$teamInfo = $dashboard->getTeamInfo(); // Fetch the current data

?>

<!doctype html>
<html class="no-js" lang="zxx">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giftem Globals - About Us</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Giftem Globals - About Us">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
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

    <?php include_once('includes/header.php'); ?>

    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-black-60 bg-image "  data-bs-bg="img/giftem-about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title text-white">About Us</h1>
                        <div class="ltn__breadcrumb-list text-white">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li class="ltn__secondary-color">About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- ABOUT US AREA START -->
    <div class="ltn__about-us-area pt-120--- pb-90 mt--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                    <?php echo $aboutInfo['intro_video_url'];?>

                        <div class="about-us-img-info about-us-img-info-2 about-us-img-info-3">
                            
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    
                        <div class="align-self-center">
                                            <div class="about-us-info-wrap">
                                                <div class="section-title-area ltn__section-title-2--- text-center---">
                                                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">
                                                        About Us</h6>
                                                    <h1 class="section-title">Who We Are
                                                    </h1>
                                                    <p>
                                                    <?php echo nl2br($aboutInfo['who_we_are']);?>


                                                    </p>

                                                    <h1 class="section-title">Our Philosophy</h1>
                        
                                                <p class="">
                                                <?php echo nl2br($aboutInfo['our_philosophy']);?>

                                                </p>
                                </div>
                                            </div>
                                        </div>
                 
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT US AREA END -->

    <div class="ltn__category-area ltn__product-gutter section-bg-1--- pt-115 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">About Us</h6>
                        <h1 class="section-title">Our Core Values</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__category-slider-active--- slick-arrow-1 justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                        <a href="#">
                            <span class="category-icon"><i class="fa fa-balance-scale"></i></span>
                            <span class="category-number">01</span>
                            <span class="category-title"><?php echo $valuesInfo['title1'];?></span>
                            <span class="category-brief">
                            <?php echo nl2br($valuesInfo['description1']);?>

                            </span>
                            <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                        <a href="#">
                            <span class="category-icon"><i class="fa fa-heart"></i></span>
                            <span class="category-number">02</span>
                            <span class="category-title"> <?php echo $valuesInfo['title2'];?></span>
                            <span class="category-brief">
                            <?php echo nl2br($valuesInfo['description2']);?>

                            </span>
                            <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                        <a href="#">
                            <span class="category-icon"><i class="fa fa-handshake"></i></span>
                            <span class="category-number">03</span>
                            <span class="category-title"><?php echo $valuesInfo['title3'];?></span>
                            <span class="category-brief">
                            <?php echo nl2br($valuesInfo['description3']);?>

                            </span>
                            <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                        <a href="#">
                            <span class="category-icon"><i class="fa fa-award"></i></span>
                            <span class="category-number">04</span>
                            <span class="category-title"><?php echo $valuesInfo['title4'];?></span>
                            <span class="category-brief">
                            <?php echo nl2br($valuesInfo['description4']);?>

                            </span>
                            <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                        </a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    
    <!-- FEATURE AREA END -->

    <!-- TEAM AREA START (Team - 3) -->
    <div class="ltn__team-area pt-115 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Team</h6>
                    <h1 class="section-title">A team of dedicated professionals</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__team-item ltn__team-item-3---">
                    <div class="team-img">
                        <img src="img/team/<?php echo $teamInfo['photo1']; ?>">
                    </div>
                    <div class="team-info">
                        <h4><a href="#"><?php echo $teamInfo['name1']; ?></a></h4>
                        <h6 class="ltn__secondary-color"><?php echo $teamInfo['role1']; ?></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="ltn__team-item ltn__team-item-3---">
                    <div class="team-img">
                        <img src="img/team/<?php echo $teamInfo['photo2']; ?>">
                    </div>
                    <div class="team-info">
                        <h4><a href="#"><?php echo $teamInfo['name2']; ?></a></h4>
                        <h6 class="ltn__secondary-color"><?php echo $teamInfo['role2']; ?></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="ltn__team-item ltn__team-item-3---">
                    <div class="team-img">
                        <img src="img/team/<?php echo $teamInfo['photo3']; ?>">
                    </div>
                    <div class="team-info">
                        <h4><a href="#"><?php echo $teamInfo['name3']; ?></a></h4>
                        <h6 class="ltn__secondary-color"><?php echo $teamInfo['role3']; ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TEAM AREA END -->


    <!-- TESTIMONIAL AREA START (testimonial-7) -->
    <div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-120 pb-70" data-bs-bg="img/bg/20.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Testimonial</h6>
                        <h1 class="section-title">Clients Feedback</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__testimonial-slider-5-active slick-arrow-1">
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i> 
                            <?php echo $testimonialsInfo['details1'];?></p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    
                                    <img src="img/testimonial/female-avatar.webp" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5><?php echo $testimonialsInfo['name1'];?></h5>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i> 
                            <?php echo $testimonialsInfo['details2'];?> </p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <img src="img/testimonial/male-avatar.png" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5><?php echo $testimonialsInfo['name2'];?></h5>
                                    <label></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7">
                        <div class="ltn__testimoni-info">
                            <p><i class="flaticon-left-quote-1"></i> 

                            <?php echo $testimonialsInfo['details3'];?>

                        </p>
                            <div class="ltn__testimoni-info-inner">
                                <div class="ltn__testimoni-img">
                                    <img src="img/testimonial/female-avatar.webp" alt="#">
                                </div>
                                <div class="ltn__testimoni-name-designation">
                                    <h5><?php echo $testimonialsInfo['name3'];?></h5>
                                    <label></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL AREA END -->

    

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
        <?php include_once "includes/footer.php";?>
    <!-- FOOTER AREA END -->

</div>
<!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="js/plugins.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
  
</body>

</html>

