<?php
  require "global/DBOperations.php";
  // For Title In Header
  $PageName = $lang['HotelName'] . ' | ' . $lang['HomePage'];
  // For Body Name
  $Page = 'HomePage';
  require 'global/header.php';
  ?>
  <!-- Start Carousel -->
  <section class="Carousel pb-3">
    <div id="carouselHomePage" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="0" class="CarouselMoving active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="1" class="CarouselMoving" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="2" class="CarouselMoving" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="photos/carousel2.webp" class="d-block w-100 ImageCarousel" alt="carousel1">
        </div>
        <div class="carousel-item">
          <img src="photos/carousel1.webp" class="d-block w-100 ImageCarousel" alt="carousel2">
        </div>
        <div class="carousel-item">
          <img src="photos/carousel4.webp" class="d-block w-100 ImageCarousel" alt="carousel3">
        </div>
      </div>
    </div>
  </section>
  <!-- End Carousel -->
  <!-- Start Flats Show Section -->
  <section class="SectionFlatsShow text-center py-4">
    <div class="container">
      <h1 class="pb-2"><?php echo $lang['Hotel'] . ' ' . $lang['Flats']; ?></h1>
      <!-- Start Accordion -->
      <div class="accordion accordion-flush text-start mb-3" id="accordionSearchHomePage">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingSearch">
            <button class="accordion-button one shadow-none collapsed" id="Btn-flush-collapseSearch" data-bs-toggle="collapse" data-bs-target="#flush-collapseSearch" aria-expanded="false" aria-controls="flush-collapseSearch">
              <i class="fas fa-search fa-fw align-middle mx-2"></i> <?php echo $lang['Search']; ?>
            </button>
          </h2>
          <div id="flush-collapseSearch" class="accordion-collapse collapse" aria-labelledby="flush-headingSearch" data-bs-parent="#accordionSearchHomePage">
            <div class="accordion-body">
              <form class="row FormSearch" id="FormSearch">
                <div class="col-6 mb-2">
                  <label for="FloorId" class="form-label"><?php echo $lang['FloorId']; ?></label>
                  <input type="number" name="FloorId" class="form-control hvr-shadow" id="FloorId" min="1" placeholder="0" autocomplete="off">
                </div>
                <div class="col-6 mb-2">
                  <label for="FlatId" class="form-label"><?php echo $lang['FlatId']; ?></label>
                  <input type="number" name="FlatId" class="form-control hvr-shadow" id="FlatId" min="1" placeholder="0" autocomplete="off">
                </div>
                <div class="col-6 mb-2">
                  <label for="RoomsCount" class="form-label"><?php echo $lang['RoomsCount']; ?></label>
                  <input type="number" name="RoomsCount" class="form-control hvr-shadow" id="RoomsCount" min="1" placeholder="0" autocomplete="off">
                </div>
                <div class="col-6 mb-2">
                  <label for="BedsCount" class="form-label"><?php echo $lang['BedsCount']; ?></label>
                  <input type="number" name="BedsCount" class="form-control hvr-shadow" id="BedsCount" min="1" placeholder="0" autocomplete="off">
                </div>
                <div class="col-6 mb-2">
                  <label for="LowPrice" class="form-label"><?php echo $lang['LowPrice']; ?></label>
                  <input type="text" name="LowPrice" class="form-control hvr-shadow" id="LowPrice" min="0" placeholder="0" autocomplete="off">
                </div>
                <div class="col-6 mb-2">
                  <label for="HeighPrice" class="form-label"><?php echo $lang['HeighPrice']; ?></label>
                  <input type="text" name="HeighPrice" class="form-control hvr-shadow" id="HeighPrice" min="0" placeholder="0" autocomplete="off">
                </div>
                <div class="col-6 mb-2">
                  <label for="View" class="form-label"><?php echo $lang['View']; ?></label>
                  <select class="form-select hvr-shadow" name="View" id="View">
                    <option value="All"><?php echo $lang['All']; ?></option>
                    <option value="North"><?php echo $lang['North']; ?></option>
                    <option value="East"><?php echo $lang['East']; ?></option>
                    <option value="South"><?php echo $lang['South']; ?></option>
                    <option value="West"><?php echo $lang['West']; ?></option>
                    <option value="NorthEast"><?php echo $lang['NorthEast']; ?></option>
                    <option value="EastSouth"><?php echo $lang['EastSouth']; ?></option>
                    <option value="SouthWest"><?php echo $lang['SouthWest']; ?></option>
                    <option value="WestNorth"><?php echo $lang['WestNorth']; ?></option>
                  </select>
                </div>
                <div class="col-6 mb-2">
                <label class="form-label"><?php echo $lang['Rate']; ?></label>
                <div class="fs-2 d-flex justify-content-evenly align-items-end">
                  <i class="fa-regular fa-star" id="1"></i>
                  <i class="fa-regular fa-star" id="2"></i>
                  <i class="fa-regular fa-star" id="3"></i>
                  <i class="fa-regular fa-star" id="4"></i>
                  <i class="fa-regular fa-star" id="5"></i>
                </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-outline-success hvr-wobble-horizontal shadow-none" type="submit" id="BottomSearch"><?php echo $lang['Search']; ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Accordion -->
      <div class="row row-cols-1 row-cols-md-2 g-4" id="FlatsCard">
        <!-- Start Falts Card -->
      </div>
    </div>
  </section>
  <!-- End Flats Show Section -->
  <!-- Start Section -->
  <section class="two text-center">
      <div class="overlay">
          <div class="container">
              <h2 class="h1 tw">Section #2</h2>
              <div class="row">
                  <div class="col">
                      <h2>Section #2</h2>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit odio molestias eveniet ut. Velit minus ex quos ea ab, modi, nam illum illo numquam sequi perferendis impedit ratione a. Natus.</p>
                  </div>
                  <div class="col">
                      <h2>Section #2</h2>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit odio molestias eveniet ut. Velit minus ex quos ea ab, modi, nam illum illo numquam sequi perferendis impedit ratione a. Natus.</p>
                  </div>
                  <div class="col">
                      <h2>Section #2</h2>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit odio molestias eveniet ut. Velit minus ex quos ea ab, modi, nam illum illo numquam sequi perferendis impedit ratione a. Natus.</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End Section -->
  <!-- Start Section -->
  <section class="three text-center">
      <div class="overlay">
          <div class="container">
              <h2 class="h1 th">Section #3</h2>
              <div class="row">
                  <div class="col">
                      <h2>Section #3</h2>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit odio molestias eveniet ut. Velit minus ex quos ea ab, modi, nam illum illo numquam sequi perferendis impedit ratione a. Natus.</p>
                  </div>
                  <div class="col">
                      <h2>Section #3</h2>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit odio molestias eveniet ut. Velit minus ex quos ea ab, modi, nam illum illo numquam sequi perferendis impedit ratione a. Natus.</p>
                  </div>
                  <div class="col">
                      <h2>Section #3</h2>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit odio molestias eveniet ut. Velit minus ex quos ea ab, modi, nam illum illo numquam sequi perferendis impedit ratione a. Natus.</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End Section -->

  <?php
    require 'global/footer.php';
  ?>