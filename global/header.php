<?php
    $css = '../../salmya/styles/';
    $js = '../../salmya/scripts/';
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Admin</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='<?php echo $css ?>bootstrap.min.css'>
        <link rel='stylesheet' href='<?php echo $css ?>all.css'>
        <link rel='stylesheet' href='<?php echo $css ?>hover-min.css'>
        <link rel='stylesheet' href='<?php echo $css ?>animate.css'>
        <link rel='stylesheet' href='<?php echo $css ?>main.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Scheherazade+New&display=swap'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Scheherazade+New&display=swap'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Roboto&display=swap'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Lateef&display=swap'>
    </head>
    <body>
        <!-- Start Scroll To Top -->
        <div id='scroll-top'>
            <i class='fas fa-arrow-circle-up fa-3x'></i>
        </div>
        <!-- End Scroll To Top -->
        <!-- Start Upper bar -->
        <section class='upper-bar'>
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
        </section>
        <!-- End Upper bar -->
        <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">Salmya</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-info" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav-info">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="i.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Work</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->