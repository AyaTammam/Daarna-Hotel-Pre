<!DOCTYPE html>
  <html lang='en'>
    <head>
      <title><?php echo $PageName; ?></title>
      <meta charset='UTF-8'>
      <meta name="description" content="Mary's simple recipe for maple bacon donuts makes a sticky, sweet treat with just a hint of salt that you'll keep coming back for.">
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel="icon" href="/Daarna-Hotel/photos/logo.webp">
      <link rel='stylesheet' href='/Daarna-Hotel/styles/bootstrap.min.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/balloon.min.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/all.min.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/hover-min.css' media="all">
      <link rel='stylesheet' href='/Daarna-Hotel/styles/animate.css'>
      <link rel='stylesheet' href='/Daarna-Hotel/styles/main.css'>
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
          <a class="navbar-brand mx-auto hvr-pop" href="/Daarna-Hotel/index.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $lang['DaarnaHotel']; ?>">
            <img class="img-fluid" src="/Daarna-Hotel/photos/logo.webp" alt="Logo">
          </a>
          <button class="navbar-toggler mx-100 shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav-info" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-ellipsis-v fs-3"></i>
          </button>
          <div class="collapse navbar-collapse" id="nav-info">
            <?php 
              if($Page === 'Daarna Hotel' || $Page === 'LogIn' || $Page === 'notFound')
              {
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link fw-bold text-decoration-none text-uppercase <?php echo $PageName == $lang['DaarnaHotel']? 'active': '';?>" aria-current="page" href="index.php"><?php echo $lang['Home']; ?></a>
                  </li>
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
              }
              else
              {
                ?>
                <!-- Start Setting -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link fw-bold text-decoration-none text-uppercase rounded-circle" role="button" data-bs-toggle="modal" data-bs-keyboard="false" data-bs-target="#Setting">
                      <i class="fas fa-user-cog mx-4 mb-1 d-block fs-5"></i>
                      <?php echo $lang['Setting']; ?>
                    </a>
                    <!-- Start Modal For Setting -->
                    <div class="modal fade text-white" id="Setting" tabindex="-1" aria-labelledby="Setting" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="Setting"><?php echo $lang['MyProfile'] ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form class="settingForm was-validated">
                              <div class="row g-2">
                                <div class="col-md-6">
                                  <div class="form-floating m-1">
                                    <input type="name" name="User-Name" class="form-control" id="User-Name" placeholder="UserName" value="admin" disabled>
                                    <label class="text-white" for="User-Name"><i class="fa fa-user-circle me-1"></i><?php echo $lang['UserName']; ?></label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-floating m-1">
                                    <input type="password" class="form-control" name="Password" id="Pass" placeholder="Password">
                                    <label class="text-white" for="Pass"><i class="fas fa-user-lock me-1"></i><?php echo $lang['Password']; ?></label>
                                  </div>
                                </div>
                                <?php
                                  if (isset($_SESSION['ClientId'])) 
                                  {
                                    ?>
                                    <div class="col-md-6">
                                      <div class="form-floating m-1">
                                        <input type="tel" class="form-control" name="Phone" id="Phone" pattern="[0][9][0-9]{8}" value="0990416940" required>
                                        <a tabindex="0" role="button" class="position-absolute invisible top-0 end-0 mt-3 px-5 text-light" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Enter a valid phone number that works on the Syrian network">
                                          <i class="fas fa-info-circle"></i>
                                        </a>
                                        <label class="text-white" for="Phone"><i class="fas fa-mobile-alt me-1"></i><?php echo $lang['Phone']; ?></label>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-floating m-1">
                                        <input type="email" class="form-control" name="Email" id="Email" placeholder="Email" value="a@asd.com" required>
                                        <label class="text-white" for="Email"><i class="fas fa-at me-1"></i><?php echo $lang['Email']; ?></label>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="input-group my-1 px-2">
                                        <input type="file" class="form-control form-control-lg" name="AccountImage" accept="image/*" id="AccountImage" required>
                                        <label class="input-group-text uploadImg" for="AccountImage"><i class="fas fa-upload" aria-hidden="true"></i></label>
                                      </div>
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-double align-middle"></i> <?php echo $lang['Save']; ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal For Setting -->
                  </li>
                </ul>
                <!-- End Setting -->
                <?php
              }
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
            <div class="offcanvas-header mb-2 text-center d-block">
              <button type="button" class="btn-close text-reset d-block ms-auto shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              <span class="user-icon rounded-circle d-block text-uppercase m-auto">
                <?php echo substr($_SESSION['Admin'], 0, 1); ?>
              </span>
              <h5 class="offcanvas-title" id="Admin"><?php echo $_SESSION['Admin']; ?></h5>
            </div>
            <div class="offcanvas-body p-0 overflow-visible d-block">
              <a href="/Daarna-Hotel/cpanel/admin/index.php" class="nav-link p-3 <?php echo $PageName == $lang['ControlPanel'] ? 'active' : ''; ?>">
                <i class="fa fa-chart-bar fa-fw align-middle mx-3"></i> <?php echo $lang['ControlPanel']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/floors.php" class="nav-link p-3 <?php echo in_array($PageName, array($lang['Floors'], $lang['Flats'], $lang['NewFlat'])) ? 'active' : ''; ?>">
                <i class="fa fa-building fa-fw align-middle mx-3"></i> <?php echo $lang['Floors']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/features.php" class="nav-link p-3 <?php echo $PageName == $lang['Features'] ? 'active' : ''; ?>">
                <i class="fa fa-tasks fa-fw align-middle mx-3"></i> <?php echo $lang['Features']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/employees.php" class="nav-link p-3 <?php echo $PageName == $lang['Services'] ? 'active' : ''; ?>">
                <i class="fas fa-list-ul fa-fw align-middle mx-3"></i> <?php echo $lang['Services']; ?>
              </a>
              <a href="/Daarna-Hotel/cpanel/admin/employees.php" class="nav-link p-3 <?php echo $PageName == $lang['Employees'] ? 'active' : ''; ?>">
                <i class="fas fa-user-tie fa-fw align-middle mx-3"></i> <?php echo $lang['Employees']; ?>
              </a>
              <a href="#" class="nav-link p-3 <?php 
                // echo $obj->getBody() == 'dashboard' ? 'active' : ''; ?>"> <!-- add offer -->
                <i class="fas fa-users fa-fw align-middle mx-3"></i> <?php echo $lang['Clients']; ?>
              </a>
            </div>
            <footer class="offcanvas-footer position-absolute bottom-0 py-2">
              <a href="/Daarna-Hotel/logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt fa-fw align-middle mx-3"></i> <?php echo $lang['Logout']; ?>
              </a>
            </footer>
          </div>
          <!-- End Offcanvas -->
          <?php
        }
      ?>