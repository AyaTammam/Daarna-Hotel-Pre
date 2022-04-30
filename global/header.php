<!DOCTYPE html>
  <html lang='en'>
    <head>
      <title><?php echo $PageName; ?></title>
      <meta charset='UTF-8'>
      <meta name="description" content="Mary's simple recipe for maple bacon donuts makes a sticky, sweet treat with just a hint of salt that you'll keep coming back for.">
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel="icon" href="/Daarna-Hotel/photos/logo.webp">
      <link rel='stylesheet' href='/Daarna-Hotel/styles/bootstrap.min.css'>
      <!-- <link rel='stylesheet' href='/Daarna-Hotel/styles/bootstrap.rtl.min.css'> -->
      <link rel='stylesheet' href='/Daarna-Hotel/styles/balloon.min.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/all.min.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/hover-min.css' media="all">
      <link rel='stylesheet' href='/Daarna-Hotel/styles/animate.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/main.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/dropzone.min.css'>
      <!-- <link rel='stylesheet' href='/Daarna-Hotel/styles/jstable.css'> -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
    </head>
    <body id="<?php echo $Page; ?>">
      <!-- Start Scroll To Top -->
      <div id='scroll-top'>
        <i class='fas fa-arrow-circle-up fs-1'></i>
      </div>
      <!-- End Scroll To Top -->
      <!-- Start Navbar -->
      <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
          <a class="navbar-brand mx-auto hvr-pop" href="/Daarna-Hotel/index.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $lang['Home']; ?>">
            <img class="ImageLogo img-fluid" src="/Daarna-Hotel/photos/logo.webp" alt="Logo">
          </a>
          <button class="navbar-toggler mx-100 shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav-info" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-ellipsis-v fs-3"></i>
          </button>
          <div class="collapse navbar-collapse" id="nav-info">
            <?php 
              // if($Page === 'DaarnaHotel' || $Page === 'LogIn' || $Page === 'notFound')
              // {
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link fw-bold text-decoration-none text-uppercase" href="i.html"><?php echo $lang['About']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold text-decoration-none text-uppercase" href="#"><?php echo $lang['Work']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold text-decoration-none text-uppercase" href="#"><?php echo $lang['Blog']; ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-bold text-decoration-none text-uppercase" href="#"><?php echo $lang['Contact']; ?></a>
                  </li>
                </ul>
                <?php
              // }
            ?>
          </div>
          <?php
            if ($Page !== 'LogIn') 
            {
              if (COUNT($_SESSION) == 0)
              {
                ?>
                <!-- Start LogIn -->
                <a href="login.php" class="user-icon side mx-auto d-flex justify-content-center align-items-center text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $lang['LogIn']; ?>">
                  <i class="fas fa-sign-in-alt fs-1"></i>
                </a>
                <!-- End LogIn -->
                <?php
              }
              else
              {
                ?>
                <!-- Start Offcanvas -->
                <a class="user-icon side mx-auto d-flex justify-content-center align-items-center" data-bs-toggle="offcanvas" data-bs-target="#MenuAdmin" aria-controls="MenuAdmin" style="cursor: pointer;">
                  <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $lang['Menu']; ?>">
                    <i class="far fa-user-circle fs-1" style="outline: none;"></i>
                  </span>
                </a>
                <!-- End Offcanvas -->
                <?php
              }
            }
          ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <?php
        if (COUNT($_SESSION) > 0)
        {
          ?>
          <!-- Start Offcanvas -->
          <div class="offcanvas offcanvas-start" tabindex="-1" id="MenuAdmin" aria-labelledby="Admin">
            <div class="offcanvas-header text-center d-block">
              <button type="button" class="btn-close text-reset d-block ms-auto shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              <span class="user-icon rounded-circle d-block text-uppercase m-auto">
                <?php echo substr($_SESSION['Admin'], 0, 1); ?>
              </span>
              <h5 class="offcanvas-title" id="Admin"><?php echo $_SESSION['Admin']; ?></h5>
            </div>
            <div class="offcanvas-body p-0">
              <a href="/Daarna-Hotel/cpanel/admin/index.php" class="nav-link p-3 <?php echo $Page == 'ControlPanel' ? 'active' : ''; ?>">
                <i class="fa fa-chart-bar fa-fw align-middle mx-3"></i> <?php echo $lang['ControlPanel']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/floors.php" class="nav-link p-3 <?php echo in_array($Page, array('Floors', 'Flats', 'NewFlat')) ? 'active' : ''; ?>">
                <i class="fa fa-building fa-fw align-middle mx-3"></i> <?php echo $lang['Floors']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/features.php" class="nav-link p-3 <?php echo $Page == 'Features' ? 'active' : ''; ?>">
                <i class="fa fa-tasks fa-fw align-middle mx-3"></i> <?php echo $lang['Features']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/services.php" class="nav-link p-3 <?php echo $Page == 'Services' ? 'active' : ''; ?>">
                <i class="fas fa-list-ul fa-fw align-middle mx-3"></i> <?php echo $lang['Services']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/employees.php" class="nav-link p-3 <?php echo $Page == 'Employees' ? 'active' : ''; ?>">
                <i class="fas fa-user-tie fa-fw align-middle mx-3"></i> <?php echo $lang['Employees']; ?>
              </a>
              <a href="#" class="nav-link p-3 <?php 
                // echo $obj->getBody() == 'dashboard' ? 'active' : ''; ?>"> <!-- add offer -->
                <i class="fas fa-users fa-fw align-middle mx-3"></i> <?php echo $lang['Clients']; ?>
              </a>
              <!-- Start Accordion -->
              <div class="accordion accordion-flush nav" id="accordionAdmin">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingSettings">
                    <button class="accordion-button one shadow-none <?php echo in_array($Page, array('MyProfile', 'SiteSettings')) ? 'active' : 'collapsed';?>" data-bs-toggle="collapse" data-bs-target="#flush-collapseSettings" aria-expanded="<?php echo in_array($Page, array('MyProfile', 'SiteSettings')) ? 'true' : 'false';?>" aria-controls="flush-collapseSettings">
                      <i class="fas fa-user-cog fa-fw align-middle mx-3"></i> <?php echo $lang['Settings']; ?>
                    </button>
                  </h2>
                  <div id="flush-collapseSettings" class="accordion-collapse collapse <?php echo in_array($Page, array('MyProfile', 'SiteSettings')) ? 'show' : '';?>" aria-labelledby="flush-headingSettings" data-bs-parent="#accordionAdmin">
                    <div class="accordion-body py-0">
                      <a href="/Daarna-Hotel/cpanel/settings.php?Page=MyProfile" class="nav-link <?php echo $Page == 'MyProfile'? 'active' : '';?>">
                        <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo $lang['MyProfile']; ?>
                      </a>
                      <a href="/Daarna-Hotel/cpanel/settings.php?Page=SiteSettings" class="nav-link <?php echo $Page == 'SiteSettings'? 'active' : '';?>">
                        <i class="far fa-circle fa-fw align-middle mx-3"></i> <?php echo $lang['SiteSettings']; ?>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Accordion -->
            </div>
            <footer class="offcanvas-footer">
              <a href="/Daarna-Hotel/logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt fa-fw align-middle mx-3"></i> <?php echo $lang['Logout']; ?>
              </a>
            </footer>
          </div>
          <!-- End Offcanvas -->
          <?php
        }
      ?>