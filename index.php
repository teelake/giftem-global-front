<?php
require_once "backend/includes/dashboard.php";

$dashboard = new Dashboard();

$generalInfo = $dashboard->getGeneralInfo(); // Fetch the current data
$about = $dashboard->getAbout(); // Fetch the current data
$aboutInfo = $dashboard->getAboutInfo(); // Fetch the current data
$valuesInfo = $dashboard->getValuesInfo(); // Fetch the current data
$socialInfo = $dashboard->getSocialInfo(); // Fetch the current data
$servicesInfo = $dashboard->getServicesInfo(); // Fetch the current data
$propertyInfo = $dashboard->getPropertyInfo(); // Fetch the current data
$testimonialsInfo = $dashboard->getTestimonialsInfo(); // Fetch the current data
$slidingImages = $dashboard->getSlidingImages();



?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Giftem Globals - Properties and Investment Limited </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Giftem Global - Properties and Investment Limited">
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

    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">

        
       <?php include_once('includes/header.php');?>

    <div class="ltn__utilize-overlay"></div>

    <!-- SLIDER AREA START (slider-11) -->
    <div class="ltn__slider-area ltn__slider-11 ltn__slider-11-slide-item-count-show--- ltn__slider-11-pagination-count-show--- section-bg-1">
    <div class="ltn__slider-11-inner">
        <div class="ltn__slider-11-active">
            <!-- Check if slidingImages is not empty -->
            <?php if (!empty($slidingImages)) : ?>
                <?php foreach ($slidingImages as $image) : ?>
                    <!-- Slide Item -->
                    <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3-normal ltn__slide-item-3 ltn__slide-item-11">
                        <div class="ltn__slide-item-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 align-self-center">
                                        <div class="slide-item-info">
                                            <div class="slide-item-info-inner ltn__slide-animation">
                                                <h6 class="slide-sub-title white-color--- animated">
                                                    <span><i class="fas fa-home"></i></span>
                                                    <?= htmlspecialchars($image['intro_text']); ?>
                                                </h6>
                                                <h1 class="slide-title animated">
                                                    <?= nl2br(htmlspecialchars($image['main_text'])); ?>
                                                </h1>
                                                <div class="slide-brief animated">
                                                    <p><?= nl2br(htmlspecialchars($image['sub_text'])); ?></p>
                                                </div>
                                                <div class="btn-wrapper animated">
                                                    <a href="contact.php" class="theme-btn-1 btn btn-effect-1">
                                                        <?= htmlspecialchars($image['button_name']); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide-item-img">
                                            <img src="img/slider/<?= htmlspecialchars($image['image']); ?>" 
                                                 alt="<?= htmlspecialchars($image['alt_text'] ?? 'Slider Image'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- No images fallback -->
                <p>No images found for the slider.</p>
            <?php endif; ?>
        </div>

        <!-- Slider Arrows -->
        <div class="ltn__slider-11-img-slide-arrow">
            <div class="ltn__slider-11-img-slide-arrow-inner">
                <div class="ltn__slider-11-img-slide-arrow-active">
                    <?php if (!empty($slidingImages)) : ?>
                        <?php foreach ($slidingImages as $image) : ?>
                            <div class="image-slide-item">
                                <img src="img/slider/<?= htmlspecialchars($image['image']); ?>" 
                                     alt="<?= htmlspecialchars($image['alt_text'] ?? 'Sliding Image'); ?>">
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No images found for the slider.</p>
                    <?php endif; ?>
                </div>

                <!-- Slide Item Count -->
                <div class="ltn__slider-11-slide-item-count">
                    <span class="count">1</span>
                    <span class="total"><?= count($slidingImages); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination Count -->
    <div class="ltn__slider-11-pagination-count">
        <span class="count">1</span>
        <span class="total"><?= count($slidingImages); ?></span>
    </div>

    <!-- Sticky Social Icons -->
    <div class="slider-sticky-icon-2">
        <ul>
            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a></li>
        </ul>
    </div>
</div>


    <!-- SLIDER AREA END -->

    <!-- ABOUT US AREA START -->
    <!-- ABOUT US AREA START -->
    <div class="ltn__about-us-area pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                        <img src="img/others/<?php echo $about['photo'];?>" alt="About Us Image">
                        <div class="about-us-img-info about-us-img-info-2 about-us-img-info-3">
                            
                           <!-- <div class="ltn__video-img ltn__animation-pulse1">
                                <img src="img/giftem-about.jpg" alt="video popup bg image">
                                <a class="ltn__video-icon-2 ltn__video-icon-2-border---" href="https://www.youtube.com/embed/X7R-q9rsrtU?autoplay=1&amp;showinfo=0"  data-rel="lightcase:myCollection">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-info-wrap">
                        <div class="section-title-area ltn__section-title-2--- mb-20">
                            <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">About Us</h6>
                            <h1 class="section-title">Who We Are<span>.</span></h1>
                            <p><?php echo nl2br($about['about_1']);?></p>
                           
                        </div>
                        <h5>Our Core Values</h5>
                        <ul class="ltn__list-item-half clearfix">
                            <li>
                                <i class=""></i>
                               <?php echo $valuesInfo['title1'];?>
                            </li>
                            <li>
                                <i class=""></i>
                                <?php echo $valuesInfo['title2'];?>
                            </li>
                            <li>
                                <i class=""></i>
                                <?php echo $valuesInfo['title3'];?>
                            </li>
                            <li>
                                <i class=""></i>
                                <?php echo $valuesInfo['title4'];?>
                            </li>
                            
                        </ul>
                        <div class="ltn__callout bg-overlay-theme-05  mt-30">
                            <p><?php echo nl2br($about['about_2']);?>  </p>
                        </div>
                        <div class="btn-wrapper animated">
                            <a href="about.php" class="theme-btn-1 btn btn-effect-1">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
     <!-- COUNTER UP AREA START -->
     <div class="ltn__counterup-area section-bg-1 pt-120 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-color-white---">
                        <div class="counter-icon">
                            <i class="flaticon-select"></i>
                        </div>
                        <h1><span class="counter"><?php echo $socialInfo['number1'];?></span><span class="counterUp-icon">+</span> </h1>
                        <h6><?php echo $socialInfo['desc1'];?></h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-color-white---">
                        <div class="counter-icon">
                            <i class="flaticon-office"></i>
                        </div>
                        <h1><span class="counter"><?php echo $socialInfo['number2'];?></span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span> </h1>
                        <h6><?php echo $socialInfo['desc2'];?></h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-color-white---">
                        <div class="counter-icon">
                            <i class="flaticon-excavator"></i>
                        </div>
                        <h1><span class="counter"><?php echo $socialInfo['number3'];?></span><span class="counterUp-icon">+</span> </h1>
                        <h6><?php echo $socialInfo['desc3'];?></h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-color-white---">
                        <div class="counter-icon">
                            <i class="flaticon-user"></i>
                        </div>
                        <h1><span class="counter"><?php echo $socialInfo['number4'];?></span><span class="counterUp-icon">+</span> </h1>
                        <h6><?php echo $socialInfo['desc4'];?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COUNTER UP AREA END -->

    <!-- ABOUT US AREA END -->

    <!-- FEATURE AREA START ( Feature - 6) -->
    <div class="ltn__feature-area section-bg-1--- pt-115 pb-90 mb-120---">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">Our Services</h6>
                        <h1 class="section-title">Our Main Focus</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter---  justify-content-center">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                            <!-- <span><i class="flaticon-house"></i></span> -->
                            <i class="fa fa-building"></i>
                        </div>
                        <div class="ltn__feature-info">
                            <h3><a href="#"><?php echo $servicesInfo['title1'];?></a></h3>
                            <p>
                            <?php echo nl2br($servicesInfo['description1']);?> 
                            </p>
                             <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1 active">
                        <div class="ltn__feature-icon">
                            <!-- <span><i class="flaticon-house-3"></i></span> -->
                            <i class="fa fa-user-tie"></i>
                        </div>
                        <div class="ltn__feature-info">
                        <h3><a href="#"><?php echo $servicesInfo['title2'];?></a></h3>
                            <p>
                            <?php echo nl2br($servicesInfo['description2']);?> 
                            </p>
                                                       <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                            <!-- <span><i class="flaticon-deal-1"></i></span> -->
                            <i class="fa fa-chart-line"></i>
                        </div>
                        <div class="ltn__feature-info">
                        <h3><a href="#"><?php echo $servicesInfo['title3'];?></a></h3>
                            <p>
                            <?php echo nl2br($servicesInfo['description3']);?> 
                            </p>
                                                      <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a>-->
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
                        <div class="ltn__feature-icon">
                            <!-- <span><i class="flaticon-deal-1"></i></span> -->
                            <i class="fa fa-shield-alt"></i>
                        </div>
                        <div class="ltn__feature-info">
                        <h3><a href="#"><?php echo $servicesInfo['title4'];?></a></h3>
                            <p>
                            <?php echo nl2br($servicesInfo['description4']);?> 
                            </p>
                           <!-- <a class="ltn__service-btn" href="#">Find A Home <i class="flaticon-right-arrow"></i></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->
  
    <!-- UPCOMING PROJECT AREA START -->
      <!--<div class="ltn__upcoming-project-area section-bg-1--- bg-image-top pt-115 pb-65" data-bs-bg="img/bg/22.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center---">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color--- white-color">Upcoming Projects</h6>
                        <h1 class="section-title  white-color">Dream Living Space <br>
                            Setting New Standards</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__upcoming-project-slider-1-active slick-arrow-3">
               
                <div class="col-lg-12">
                    <div class="ltn__upcoming-project-item">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="ltn__upcoming-project-img">
                                    <img src="img/product-3/3.jpg" alt="#">
                                </div>
                            </div>
                            <div class="col-lg-5 section-bg-1">
                                <div class="ltn__upcoming-project-info ltn__menu-widget">
                                    <h6 class="section-subtitle ltn__secondary-color mb-0">About Projects</h6>
                                    <h1 class="mb-30">Upcoming Projects</h1>
                                    <ul class="mt">
                                        <li>1. Project Name: <span>Quarter</span></li>
                                        <li>2. Project Type: <span>Apartment / Home</span></li>
                                        <li>3. Building Location: <span>New York, USA</span></li>
                                        <li>4. No. Of Apartments: <span>568</span></li>
                                        <li>5. Total Investment: <span>$14,500,00</span></li>
                                    </ul>
                                    <div class="btn-wrapper animated">
                                        <a href="contact.html" class="theme-btn-1 btn btn-effect-1">Download Brochure</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
                <div class="col-lg-12">
                    <div class="ltn__upcoming-project-item">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="ltn__upcoming-project-img">
                                    <img src="img/product-3/2.jpg" alt="#">
                                </div>
                            </div>
                            <div class="col-lg-5 section-bg-1">
                                <div class="ltn__upcoming-project-info ltn__menu-widget">
                                    <h6 class="ltn__secondary-color">About Projects</h6>
                                    <h1>Upcoming Projects</h1>
                                    <ul>
                                        <li>1. Project Name: <span>Quarter</span></li>
                                        <li>2. Project Type: <span>Apartment / Home</span></li>
                                        <li>3. Building Location: <span>New York, USA</span></li>
                                        <li>4. No. Of Apartments: <span>568</span></li>
                                        <li>5. Total Investment: <span>$14,500,00</span></li>
                                    </ul>
                                    <div class="btn-wrapper animated">
                                        <a href="contact.html" class="theme-btn-1 btn btn-effect-1">Download Brochure</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-12">
                    <div class="ltn__upcoming-project-item">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="ltn__upcoming-project-img">
                                    <img src="img/product-3/7.jpg" alt="#">
                                </div>
                            </div>
                            <div class="col-lg-5 section-bg-1">
                                <div class="ltn__upcoming-project-info ltn__menu-widget">
                                    <h6 class="ltn__secondary-color">About Projects</h6>
                                    <h1>Upcoming Projects</h1>
                                    <ul>
                                        <li>1. Project Name: <span>Quarter</span></li>
                                        <li>2. Project Type: <span>Apartment / Home</span></li>
                                        <li>3. Building Location: <span>New York, USA</span></li>
                                        <li>4. No. Of Apartments: <span>568</span></li>
                                        <li>5. Total Investment: <span>$14,500,00</span></li>
                                    </ul>
                                    <div class="btn-wrapper animated">
                                        <a href="contact.html" class="theme-btn-1 btn btn-effect-1">Download Brochure</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>-->
    <!-- UPCOMING PROJECT AREA END -->

   

    <!-- SEARCH BY PLACE AREA START (testimonial-7) -->
    <div class="ltn__search-by-place-area before-bg-top bg-image-top--- pt-115 pb-70" data-bs-bg="img/bg/20.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center---">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">Properties</h6>
                        <h1 class="section-title">Find Your Dream Landed <br>
                            Property</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__search-by-place-slider-1-active slick-arrow-1">
                <div class="col-lg-4">
                    <div class="ltn__search-by-place-item">
                        <div class="search-by-place-img">
                            <a href="#"><img src="img/gallery/<?php echo $propertyInfo['photo1'];?>" alt="#"></a>
                            <div class="search-by-place-badge">
                                <ul>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <div class="search-by-place-info">
                            <h6><a href="#"><?php echo $propertyInfo['location1'];?></a></h6>
                            <h4><a href="#"><?php echo $propertyInfo['property1'];?></a></h4>
                            <div class="search-by-place-btn">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__search-by-place-item">
                        <div class="search-by-place-img">
                            <a href="#"><img src="img/gallery/<?php echo $propertyInfo['photo2'];?>" alt="#"></a>
                            <div class="search-by-place-badge">
                                <ul>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <div class="search-by-place-info">
                        <h6><a href="#"><?php echo $propertyInfo['location2'];?></a></h6>
                        <h4><a href="#"><?php echo $propertyInfo['property2'];?></a></h4>
                            <div class="search-by-place-btn">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__search-by-place-item">
                        <div class="search-by-place-img">
                            <a href="#"><img src="img/gallery/<?php echo $propertyInfo['photo3'];?>" alt="#"></a>
                            <div class="search-by-place-badge">
                                <ul>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <div class="search-by-place-info">
                        <h6><a href="#"><?php echo $propertyInfo['location3'];?></a></h6>
                        <h4><a href="#"><?php echo $propertyInfo['property3'];?></a></h4>
                            <div class="search-by-place-btn">
                               
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- SEARCH BY PLACE AREA END -->

    

   

    <!-- CATEGORY AREA START -->
    

    <!-- TESTIMONIAL AREA START (testimonial-8) -->
    <div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-115 pb-65" data-bs-bg="img/bg/23.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center---">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color--- white-color">Clients Testimonials</h6>
                        <h1 class="section-title white-color">See What Our Clients <br>
                            Say About Us</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__testimonial-slider-6-active slick-arrow-3">
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                        <div class="ltn__testimoni-info">
                            <div class="ltn__testimoni-author-ratting">
                                <div class="ltn__testimoni-info-inner">
                                    <div class="ltn__testimoni-img">
                                        <img src="img/testimonial/female-avatar.webp" alt="#">
                                    </div>
                                    <div class="ltn__testimoni-name-designation">
                                        <h5><?php echo $testimonialsInfo['name1'];?>
</h5>
                                        <label></label>
                                    </div>
                                </div>
                                <div class="ltn__testimoni-rating">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p> 
                            <?php echo $testimonialsInfo['details1'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                        <div class="ltn__testimoni-info">
                            <div class="ltn__testimoni-author-ratting">
                                <div class="ltn__testimoni-info-inner">
                                    <div class="ltn__testimoni-img">
                                        <img src="img/testimonial/male-avatar.png" alt="#">
                                    </div>
                                    <div class="ltn__testimoni-name-designation">
                                        <h5><?php echo $testimonialsInfo['name2'];?></h5>
                                        <label></label>
                                    </div>
                                </div>
                                <div class="ltn__testimoni-rating">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p> 
                            <?php echo $testimonialsInfo['details2'];?>  </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                        <div class="ltn__testimoni-info">
                            <div class="ltn__testimoni-author-ratting">
                                <div class="ltn__testimoni-info-inner">
                                    <div class="ltn__testimoni-img">
                                        <img src="img/testimonial/female-avatar.webp" alt="#">
                                    </div>
                                    <div class="ltn__testimoni-name-designation">
                                        <h5><?php echo $testimonialsInfo['name3'];?></h5>
                                        <label></label>
                                    </div>
                                </div>
                                <div class="ltn__testimoni-rating">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p> 
                            <?php echo $testimonialsInfo['details3'];?>
</p>
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-4">
                    <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                        <div class="ltn__testimoni-info">
                            <div class="ltn__testimoni-author-ratting">
                                <div class="ltn__testimoni-info-inner">
                                    <div class="ltn__testimoni-img">
                                        <img src="img/testimonial/4.jpg" alt="#">
                                    </div>
                                    <div class="ltn__testimoni-name-designation">
                                        <h5></h5>
                                        <label></label>
                                    </div>
                                </div>
                                <div class="ltn__testimoni-rating">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p> 
                                Precious ipsum dolor sit amet
                                consectetur adipisicing elit, sed dos
                                mod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad min
                                veniam, quis nostrud Precious ips
                                um dolor sit amet, consecte</p>
                        </div>
                    </div>
                </div>-->
                <!--  -->
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL AREA END -->

    <!-- BLOG AREA START (blog-3) -->
    <div class="ltn__blog-area pt-115--- pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">Blog</h6>
                        <h1 class="section-title">Latest Posts</h1>
                    </div>
                </div>
            </div>
            <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                <!-- Blog Item -->
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="#"><img src="img/blog/1.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Decorate</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="#">10 Brilliant Ways To Decorate Your Home</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>June 24, 2024</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="#">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Blog Item -->
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="#"><img src="img/blog/3.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Estate</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="#">Recent Commercial Real Estate Transactions</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>May 22, 2024</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="#">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- Blog Item -->
                <div class="col-lg-12">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="#"><img src="img/blog/5.jpg" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>Trends</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="#">7 home trends that will shape your house in 2024</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>June 24, 2024</li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="#">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Looking for a dream home?</h1>
                            <p>We help you make the dream of new house a reality</p>
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

    <?php include_once ('includes/footer.php'); ?>
    <!-- FOOTER AREA END -->

    <!-- MODAL AREA START (Quick View Modal) -->
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quick_view_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-img">
                                            <img src="img/product/4.png" alt="#">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                                </ul>
                                            </div>
                                            <h3>3 Rooms Manhattan</h3>
                                            <div class="product-price">
                                                <span>$149.00</span>
                                                <del>$165.00</del>
                                            </div>
                                            <div class="modal-product-meta ltn__product-details-menu-1">
                                                <ul>
                                                    <li>
                                                        <strong>Categories:</strong> 
                                                        <span>
                                                            <a href="#">Parts</a>
                                                            <a href="#">Car</a>
                                                            <a href="#">Seat</a>
                                                            <a href="#">Cover</a>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ltn__product-details-menu-2">
                                                <ul>
                                                    <li>
                                                        <div class="cart-plus-minus">
                                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                            <i class="fas fa-shopping-cart"></i>
                                                            <span>ADD TO CART</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ltn__product-details-menu-3">
                                                <ul>
                                                    <li>
                                                        <a href="#" class="" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                            <i class="far fa-heart"></i>
                                                            <span>Add to Wishlist</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                            <i class="fas fa-exchange-alt"></i>
                                                            <span>Compare</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="ltn__social-media">
                                                <ul>
                                                    <li>Share:</li>
                                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

    <!-- MODAL AREA START (Add To Cart Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="modal-product-img">
                                            <img src="img/product/1.png" alt="#">
                                        </div>
                                         <div class="modal-product-info">
                                            <h5><a href="#">3 Rooms Manhattan</a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Cart</p>
                                            <div class="btn-wrapper">
                                                <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                                <a href="checkout.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                            </div>
                                         </div>
                                         <!-- additional-info -->
                                         <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="img/icons/payment.png" alt="#">
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

    <!-- MODAL AREA START (Wishlist Modal) -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="modal-product-img">
                                            <img src="img/product/7.png" alt="#">
                                        </div>
                                         <div class="modal-product-info">
                                            <h5><a href="#">3 Rooms Manhattan</a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Wishlist</p>
                                            <div class="btn-wrapper">
                                                <a href="wishlist.html" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                            </div>
                                         </div>
                                         <!-- additional-info -->
                                         <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="img/icons/payment.png" alt="#">
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

</div>
<!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
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

