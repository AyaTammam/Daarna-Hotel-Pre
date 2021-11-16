<?php
    require "DBOperations.php";
    require 'en.php';
?>
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <title>Admin</title>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel="icon" href="/Daarna-Hotel/photos/logo.png">
            <link rel='stylesheet' href='/Daarna-Hotel/styles/bootstrap.min.css'>
            <link rel='stylesheet' href='/Daarna-Hotel/styles/balloon.min.css'>
            <link rel='stylesheet' href='/Daarna-Hotel/styles/all.css'>
            <link rel='stylesheet' href='/Daarna-Hotel/styles/hover-min.css'>
            <link rel='stylesheet' href='/Daarna-Hotel/styles/animate.css'>
            <link rel='stylesheet' href='/Daarna-Hotel/styles/main.css'>
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Roboto&display=swap'>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai&family=Tajawal:wght@500&display=swap">
        </head>
        <body>
            <!-- Start Scroll To Top -->
            <div id='scroll-top'>
                <i class='fas fa-arrow-circle-up fa-3x'></i>
            </div>
            <!-- End Scroll To Top -->
            <!-- Start Upper bar -->
            <!-- <section class='upper-bar'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-lg text-sm-start text-center'>
                            <div class='info'>
                                <i class='fas fa-bed fa-2x'></i>
                            </div>
                        </div>
                        <div class='col-lg text-sm-end text-center'>
                            <div class='info'>
                                <p>احجز الأن و استمتع بالعطلة </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- End Upper bar -->
            <!-- Start Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <div class="container">
                    <a class="navbar-brand" href="/Daarna-Hotel/index.php">
                        <img class="img-fluid" src="/Daarna-Hotel/photos/logo.png">
                    </a>
                    <button class="navbar-toggler responsive" type="button" data-bs-toggle="collapse" data-bs-target="#nav-info" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> -->
                        <i class="navbar-toggler responsive fas fa-ellipsis-v"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="nav-info">
                        <?php 
                            if($PageName === "Home Page" || $PageName === "login")
                            {
                                ?>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="index.php"><?php echo lang('Home'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="i.html"><?php echo lang('About'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><?php echo lang('Work'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><?php echo lang('Blog'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><?php echo lang('Contact'); ?></a>
                                    </li>
                                </ul>
                                <?php
                            }
                            else
                            {
                                ?>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link rounded-circle text-uppercase<?php 
                                            // echo $obj->getBody() == 'dashboard' ? 'active' : ''; ?>">
                                            <i class="fas fa-user-cog fa-fw m-auto d-block"></i>
                                            <?php echo lang('Settings'); ?>
                                        </a>
                                    </li>
                                </ul>
                                <?php
                            }
                        ?>
                    </div>
                    <?php
                        if ($PageName !== "login") 
                        {
                            if (COUNT($_SESSION) == 0)
                            {
                                ?>
                                <a class="user-icon side pointer text-center" style="text-decoration: none;" href="login.php" data-balloon-pos='left' aria-label="<?php echo lang('LogIn'); ?>">
                                    <i class="fas fa-sign-in-alt log d-block"></i>
                                </a>
                                <?php
                            }
                            else 
                            {
                                ?>
                                <div class="user-icon side pointer text-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" data-balloon-pos='left' aria-label="<?php echo lang('Menu'); ?>">
                                    <i class="far fa-user-circle log d-block"></i>
                                </div>
                                <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                                    <div class="offcanvas-header text-center">
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        <span class="user-icon d-block rounded-circle text-uppercase mx-auto mb-1">

                                        </span>
                                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php echo lang('Admin'); ?></h5>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="accordion accordion-flush nav" id="accordionFlushExample">
                                            <a href="/Daarna-Hotel/cpanel/admin/index.php" class="nav-link <?php 
                                                // echo $obj->getBody() == 'dashboard' ? 'active' : ''; ?>">
                                                    <i class="fa fa-chart-bar fa-fw align-middle mx-3"></i> <?php echo lang('Control Panel'); ?>
                                            </a>
                                            <a href="#" class="nav-link <?php 
                                                // echo $obj->getBody() == 'dashboard' ? 'active' : ''; ?>">
                                                    <i class="fa fa-chart-bar fa-fw align-middle mx-3"></i> <?php echo lang('Floors'); ?>
                                            </a>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed one" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        <i class="fa fa-tasks fa-fw align-middle mx-3"></i> <?php echo lang('Features'); ?>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <a href="#" class="nav-link <?php 
                                                        // echo $obj->getBody() == "requests" && (!isset($_GET['statue']) || (isset($_GET['statue']) && $_GET['statue'] == 'all')) ? 'active' : '';?>">
                                                            <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo lang('Add'); ?>
                                                        </a>
                                                        <a href="#" class="nav-link <?php 
                                                        // echo isset($_GET['statue']) && $_GET['statue'] == 'new' ? 'active' : '';?>">
                                                            <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo lang('Display'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFoure">
                                                    <button class="accordion-button collapsed one" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFoure" aria-expanded="false" aria-controls="flush-collapseFoure">
                                                        <i class="fas fa-list-ul fa-fw align-middle mx-3"></i> <?php echo lang('Services'); ?>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFoure" class="accordion-collapse collapse" aria-labelledby="flush-headingFoure" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <a href="#" class="nav-link <?php 
                                                        // echo $obj->getBody() == "requests" && (!isset($_GET['statue']) || (isset($_GET['statue']) && $_GET['statue'] == 'all')) ? 'active' : '';?>">
                                                            <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo lang('Add'); ?>
                                                        </a>
                                                        <a href="#" class="nav-link <?php 
                                                        // echo isset($_GET['statue']) && $_GET['statue'] == 'new' ? 'active' : '';?>">
                                                            <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo lang('Display'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed one" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        <i class="fas fa-user-tie fa-fw align-middle mx-3" aria-hidden="true"></i> <?php echo lang('Employees'); ?>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <a href="#" class="nav-link <?php 
                                                        // echo $obj->getBody() == "requests" && (!isset($_GET['statue']) || (isset($_GET['statue']) && $_GET['statue'] == 'all')) ? 'active' : '';?>">
                                                            <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo lang('Add'); ?>
                                                        </a>
                                                        <a href="#" class="nav-link <?php 
                                                        // echo isset($_GET['statue']) && $_GET['statue'] == 'new' ? 'active' : '';?>">
                                                            <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo lang('Display'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="nav-link <?php 
                                                // echo $obj->getBody() == 'dashboard' ? 'active' : ''; ?>"> <!-- add offer -->
                                                    <i class="fa fa-chart-bar fa-fw align-middle mx-3"></i> <?php echo lang('Clients'); ?>
                                            </a>
                                        </div>
                                    </div>
                                    <footer class="offcanvas-footer">
                                        <a href="/Daarna-Hotel/logout.php" class="nav-link">
                                            <i class="fas fa-sign-out-alt fa-fw align-middle mx-3"></i> <?php echo lang('LogOut'); ?>
                                        </a>
                                    </footer>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </nav>
            <!-- End Navbar -->