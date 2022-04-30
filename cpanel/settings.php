<?php
  ob_start();
  require "../global/DBOperations.php";
  $Page = isset($_GET['Page']) ? $_GET['Page'] : 'MyProfile';
  if (COUNT($_SESSION) > 0)
  {
    if ($Page == 'MyProfile')
    {
      $PageName = $lang['MyProfile'];
      require "../global/header.php";
      ?>
      <!-- Start Breadcrumb -->
      <nav class="p-2 mb-2 rounded navBredcrumb" aria-label="breadcrumb">
        <div class="container">
          <ol class="breadcrumb my-3">
            <li class="breadcrumb-item"><a class="breadcrumb-link fw-bold text-decoration-none text-uppercase" href="admin/index.php"><?php echo $lang['ControlPanel']; ?></a></li>
            <li class="breadcrumb-item breadcrumb-link fw-bold text-decoration-none text-uppercase active" aria-current="page"><?php echo $lang['MyProfile']; ?></li>
          </ol>
        </div>
      </nav>
      <!-- End Breadcrumb -->
      <!-- Start Form MyProfile -->
      <section class="MyProfile my-3">
        <div class="container">
          <h1 class="text-center my-3"><?php echo $lang['MyProfile']; ?></h1>
          <form class="settingsForm was-validated">
            <div class="row g-2">
              <div class="col-12 d-flex justify-content-center">
                <div class="form-floating m-1 w-75">
                  <input type="name" name="User-Name" class="form-control" id="User-Name" placeholder="UserName" value="admin">
                  <label for="User-Name"><i class="fa fa-user-circle me-1"></i><?php echo $lang['UserName']; ?></label>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-center">
                <div class="form-floating m-1 w-75">
                  <input type="password" class="form-control" name="Password" id="Pass" placeholder="Password">
                  <label for="Pass"><i class="fas fa-user-lock me-1"></i><?php echo $lang['Password']; ?></label>
                </div>
              </div>
              <?php
                if (true) 
                {
                  ?>
                  <div class="col-12 d-flex justify-content-center">
                    <div class="form-floating m-1 w-75">
                      <input type="tel" class="form-control" name="Phone" id="Phone" pattern="[0][9][0-9]{8}" value="0990416940" required>
                      <a tabindex="0" role="button" class="position-absolute invisible top-0 end-0 mt-3 px-5" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Enter a valid phone number that works on the Syrian network">
                        <i class="fas fa-info-circle"></i>
                      </a>
                      <label for="Phone"><i class="fas fa-mobile-alt me-1"></i><?php echo $lang['Phone']; ?></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-center">
                    <div class="form-floating m-1 w-75">
                      <input type="email" class="form-control" name="Email" id="Email" placeholder="Email" value="a@asd.com" required>
                      <label for="Email"><i class="fas fa-at me-1"></i><?php echo $lang['Email']; ?></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-center">
                    <div class="input-group my-1 w-75">
                      <input type="file" class="form-control form-control-lg" name="AccountImage" accept="image/*" id="AccountImage" required>
                      <label class="input-group-text uploadImg" for="AccountImage"><i class="fas fa-upload" aria-hidden="true"></i></label>
                    </div>
                  </div>
                  <?php
                }
              ?>
              <div class="col text-center">
                <button type="submit" class="btn btn-success"><i class="fas fa-check-double align-middle"></i> <?php echo $lang['Save']; ?></button>
              </div>
            </div>
          </form>
        </div>
      </section>
      <!-- End Form MyProfile -->
      <?php
    }
    elseif ($Page == 'SiteSettings')
    {
      if (isset($_SESSION['AdminId']))
      {
        $PageName = $lang['SiteSettings'];
        require "../global/header.php";
        ?>
        <!-- Start Breadcrumb -->
        <nav class="p-2 mb-2 rounded navBredcrumb" aria-label="breadcrumb">
          <div class="container">
            <ol class="breadcrumb my-3">
              <li class="breadcrumb-item"><a class="breadcrumb-link fw-bold text-decoration-none text-uppercase" href="admin/index.php"><?php echo $lang['ControlPanel']; ?></a></li>
              <li class="breadcrumb-item breadcrumb-link fw-bold text-decoration-none text-uppercase active" aria-current="page"><?php echo $lang['SiteSettings']; ?></li>
            </ol>
          </div>
        </nav>
        <!-- End Breadcrumb -->
        <!-- Start Form SiteSettings -->
        <section class="SiteSettings my-3">
          <div class="container">
            <h1 class="text-center my-3"><?php echo $lang['SiteSettings']; ?></h1>
            <form class="FormSiteStyle was-validated" id="FormSiteStyle" enctype="multipart/form-data">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-SiteInformation-tab" data-bs-toggle="tab" data-bs-target="#nav-SiteInformation" type="button" role="tab" aria-controls="nav-SiteInformation" aria-selected="true"><?php echo $lang['SiteInformation']; ?></button>
                  <button class="nav-link" id="nav-SiteStyle-tab" data-bs-toggle="tab" data-bs-target="#nav-SiteStyle" type="button" role="tab" aria-controls="nav-SiteStyle" aria-selected="false"><?php echo $lang['SiteStyle']; ?></button>
                  <button class="nav-link" id="nav-TableTheme-tab" data-bs-toggle="tab" data-bs-target="#nav-TableTheme" type="button" role="tab" aria-controls="nav-TableTheme" aria-selected="false"><?php echo $lang['TableTheme']; ?></button>
                  <button class="nav-link" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-about" aria-selected="false"><?php echo $lang['AboutHotel']; ?></button>
                  <button class="nav-link" id="nav-HotelImages-tab" data-bs-toggle="tab" data-bs-target="#nav-HotelImages" type="button" role="tab" aria-controls="nav-HotelImages" aria-selected="false"><?php echo $lang['HotelImages']; ?></button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-SiteInformation" role="tabpanel" aria-labelledby="nav-SiteInformation-tab">
                  <div class="row">
                    <div class="col-12 col-md-6 my-3 d-flex flex-column align-items-center">
                      <div class="DisplayImage">
                        <img class="ImageLogo img-fluid" src="../photos/logo.WebP" alt="">
                      </div>
                    </div>
                    <div class="col-12 col-md-6 my-3">
                      <div class="row">
                        <div class="col-12 my-3">
                          <div class="input-group justify-content-center justify-content-md-start">
                            <input type="file" class="form-control shadow-none" name="LogoImage" accept="image/webp" id="LogoImage" hidden>
                            <button class="border-0 rounded-pill px-3 py-2" id="CustomImageLogo" type="button"><?php echo $lang['ChooseYourLogo']; ?></button>
                          </div>
                        </div>
                        <div class="col-12 mb-3">
                          <label for="EnglishHotelName" class="form-label"><?php echo $lang['EnglishHotelName'] ?></label>
                          <input type="text" name="EnglishHotelName" class="form-control shadow-none" id="EnglishHotelName" placeholder="<?php echo $lang['EnglishHotelName']; ?>" autocomplete="off" value="<?php echo $en['HotelName']; ?>" required>
                        </div>
                        <div class="col-12">
                          <label for="ArabicHotelName" class="form-label"><?php echo $lang['ArabicHotelName'] ?></label>
                          <input type="text" name="ArabicHotelName" class="form-control shadow-none" id="ArabicHotelName" placeholder="<?php echo $lang['ArabicHotelName']; ?>" autocomplete="off" value="<?php echo $ar['HotelName']; ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-SiteStyle" role="tabpanel" aria-labelledby="nav-SiteStyle-tab">
                  <div class="row">
                    <div class="col-6 my-3 d-flex flex-column align-items-center">
                      <label for="PageColor" class="form-label"><?php echo $lang['ChoosePageColor'] ?></label>
                      <input type="color" class="form-control form-control-color shadow-none" name="PageColor" id="PageColor" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="<?php echo $lang['ChooseYourColor']; ?>">
                    </div>
                    <div class="col-6 my-3 d-flex flex-column align-items-center">
                      <label for="ElementColor" class="form-label"><?php echo $lang['ChooseElementColor'] ?></label>
                      <input type="color" class="form-control form-control-color shadow-none" id="ElementColor" name="ElementColor"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="<?php echo $lang['ChooseYourColor']; ?>">
                    </div>
                    <div class="col-6 mb-3 d-flex flex-column align-items-center">
                      <label for="TextPrimaryColor" class="form-label"><?php echo $lang['ChooseTextPrimaryColor'] ?></label>
                      <input type="color" class="form-control form-control-color shadow-none" id="TextPrimaryColor" name="TextPrimaryColor" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="<?php echo $lang['ChooseYourColor']; ?>">
                    </div>
                    <div class="col-6 mb-3 d-flex flex-column align-items-center">
                      <label for="TextSecondaryColor" class="form-label"><?php echo $lang['ChooseTextSecondaryColor'] ?></label>
                      <input type="color" class="form-control form-control-color shadow-none" id="TextSecondaryColor" name="TextSecondaryColor"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="<?php echo $lang['ChooseYourColor']; ?>">
                    </div>
                    <div class="col-6 mb-3 d-flex flex-column align-items-center">
                      <label for="InputBoxShadowColor" class="form-label"><?php echo $lang['ChooseInputBoxShadowColor'] ?></label>
                      <input type="color" class="form-control form-control-color shadow-none" id="InputBoxShadowColor" name="InputBoxShadowColor"  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="<?php echo $lang['ChooseYourColor']; ?>">
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-TableTheme" role="tabpanel" aria-labelledby="nav-TableTheme-tab">
                  <div class="row">
                    <div class="col-12 col-md-6 mt-4">
                      <div class="table-responsive overflow-visible">
                        <table class="table table-hover table-bordered table-striped text-center" id="TableTheme">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col"><?php echo $lang['First']; ?></th>
                              <th scope="col"><?php echo $lang['Next']; ?></th>
                              <th scope="col"><?php echo $lang['Last']; ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td><?php echo $lang['cell']; ?> 1</td>
                              <td><?php echo $lang['cell']; ?> 2</td>
                              <td><?php echo $lang['cell']; ?> 3</td>
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td><?php echo $lang['cell']; ?> 4</td>
                              <td><?php echo $lang['cell']; ?> 5</td>
                              <td><?php echo $lang['cell']; ?> 6</td>
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td><?php echo $lang['cell']; ?> 7</td>
                              <td><?php echo $lang['cell']; ?> 8</td>
                              <td><?php echo $lang['cell']; ?> 9</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 my-3">
                      <div class="row ThemeColor">
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-dark Theme d-flex justify-content-end" id="TableThemeDark" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['DefaultColor']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-white Theme d-flex justify-content-end" id="TableThemewhite" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['Transparent']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-primary Theme d-flex justify-content-end" id="TableThemePrimary" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['LigthBlue']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-secondary Theme d-flex justify-content-end" id="TableThemeSecondary" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['Grey']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-success Theme d-flex justify-content-end" id="TableThemeSuccess" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['lightGreen']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-danger Theme d-flex justify-content-end" id="TableThemeDanger" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['LightRed']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-warning Theme d-flex justify-content-end" id="TableThemeWarning" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['LightYellow']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-info Theme d-flex justify-content-end" id="TableThemeInfo" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['LightTeal']; ?>"></div>
                        </div>
                        <div class="col-4 my-2">
                          <div class="rounded-pill bg-light Theme d-flex justify-content-end" id="TableThemeLight" role="button" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="<?php echo $lang['Light']; ?>"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                  <div class="row">
                    <div class="col-12 col-md-6 my-3">
                      <label for="EnglishAboutHotel" class="form-label"><?php echo $lang['EnglishAboutHotel'] ?></label>
                      <textarea name="EnglishAboutHotel" id="EnglishAboutHotel" class="form-control" style="height: 225px; resize:none;" required></textarea>
                    </div>
                    <div class="col-12 col-md-6 my-3">
                      <label for="ArabicAboutHotel" class="form-label"><?php echo $lang['ArabicAboutHotel'] ?></label>
                      <textarea name="ArabicAboutHotel" id="ArabicAboutHotel" class="form-control" style="height: 225px; resize:none;" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-HotelImages" role="tabpanel" aria-labelledby="nav-HotelImages-tab">
                  <div class="row">
                    <div class="col-12 my-3">
                      <form class="dropzone" id="dropzoneForm">
                        <input type="file" class="form-control" name="HotelImages[]" id="HotelImages" accept="image/webp" multiple hidden>
                        <div class="border border-1 border-secondary p-5 d-flex justify-content-center">
                          <button class="border-0 rounded-pill px-3 py-2" id="ButtonHotelImages" type="button"><?php echo $lang['ChooseYourImages']; ?></button>
                        </div>
                      </form>
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-3">
                      <button class="btn btn-outline-info shadow-none" id="submitAll"><?php echo $lang['Upload']; ?></button>
                    </div>
                    <div class="col-12 mb-3">
                      <div class="preview">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer pt-2 pb-0">
                <button type="submit" id="ButtonAddFeature" class="btn btn-success"><i class="fas fa-check-double align-middle"></i> <?php echo $lang['Save']; ?></button>
              </div>
            </form>
          </div>
        </section>
        <!-- End Form SiteSettings -->
        <?php
      }
      else
      {
        header('location: /Daarna-Hotel/not-found.php');
      }
    }
  }
  else
  {
    header('location: /Daarna-Hotel/index.php');
  }
  require '../global/footer.php';
?>