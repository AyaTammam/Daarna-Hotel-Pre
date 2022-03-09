    <!-- Start Footer -->
    <section class='footer'>
      <div class='container'>
        <h2 class="py-2"><?php echo $lang['DaarnaHotel']; ?></h2>
        <ul class='list-unstyled'>
          <div class='row'>
            <ul class="social-list mb-2">
              <li><img src="/Daarna-Hotel/photos/social-bookmarks/facebook.png" width="38" height="38" alt="Facebook" /></li>
              <li><img src="/Daarna-Hotel/photos/social-bookmarks/gplus.png" width="38" height="38" alt="Google Plus" /></li>
              <li><img src="/Daarna-Hotel/photos/social-bookmarks/twitter.png" width="38" height="38" alt="Twitter" /></li>
              <li><img src="/Daarna-Hotel/photos/social-bookmarks/pinterest.png" width="38" height="38" alt="Pinterest" /></li>
              <li><img src="/Daarna-Hotel/photos/social-bookmarks/rss.png" width="38" height="38" alt="Rss" /></li>
              <li><img src="/Daarna-Hotel/photos/social-bookmarks/email.png" width="38" height="38" alt="Email" /></li>
            </ul>
            <div class='col-6'>
              <li><a href='#' class="text-decoration-none"><?php echo $lang['InformationAboutTheCompany']; ?></a></li>
            </div>
            <div class='col-6'>
              <li><a href='#' class="text-decoration-none"><?php echo $lang['Help']; ?></a></li>
            </div>
            <div class='col-6'>
              <li><a href='#' class="text-decoration-none"><?php echo $lang['InformationOffice']; ?></a></li>
            </div>
            <div class='col-6'>
              <li><a href='#' class="text-decoration-none"><?php echo $lang['InvestorRelations']; ?></a></li>
            </div>
            <div class="col-6">
              <li><a href='#' class="text-decoration-none"><?php echo $lang['LearnHowAWebsiteWorks']; ?></a></li>
            </div>
            <div class="col-6">
              <li><a href='#' class="text-decoration-none"><?php echo $lang['TermsAndConditions']; ?></a></li>
            </div>
            <div class="col-6">
              <li><a href='#' class="text-decoration-none"><?php echo $lang['LegalInformation']; ?></a></li>
            </div>
            <div class="col-6">
              <li><a href='#' class="text-decoration-none"><?php echo $lang['PrivacyNotice']; ?></a></li>
            </div>
            <div class="col-6">
              <li><a href='#' class="text-decoration-none"><?php echo $lang['SiteMap']; ?></a></li>
            </div>
          </div>
        </ul>
        <div class='copyright text-center'>
          <strong><?php echo $lang['DaarnaHotel']; ?></strong><br>
          <?php echo $lang['Copyrights']; ?> &copy; 2021 | 2022 <?php echo $lang['AllRightsAreSave']; ?>
        </div>
      </div>
    </section>
    <!-- End Footer -->
    <script>var Word = <?php echo json_encode($lang); ?>;</script>
    <script src='/Daarna-Hotel/scripts/jquery-3.6.0.min.js'></script>
    <script src='/Daarna-Hotel/scripts/bootstrap.bundle.min.js'></script>
    <script src='/Daarna-Hotel/scripts/all.min.js'></script>
    <script src="/Daarna-Hotel/scripts/jstable.min.js"></script>
    <script src='/Daarna-Hotel/scripts/wow.min.js'></script>
    <script>new WOW().init();</script>
    <script src='/Daarna-Hotel/scripts/main.js'></script>
    <script>
      // let myTable = new JSTable("#jsTable", 
      // {
      //     prevText: "<i class='fa fa-chevron-right'></i>",
      //     nextText: "<i class='fa fa-chevron-left'></i>",
      //     labels: {
      //         placeholder: "ابحث في الجدول ..",
      //         perPage: `
      //             اعرض
      //             <select class="dt-selector"><option value="5" selected="">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select>
      //             عناصر في كل صفحة
      //         `,
      //         noRows: "لم يتم العثور على نتائج",
      //         info: "يظهر {start} من {end} من أصل {rows} سجلات",
      //         // loading: "بتم التحميل ...",
      //         infoFiltered: "يظهر {start} من {end} من أصل {rows} سجلات (تم البحث في {rowsTotal} سجلات)"
      //     },
      // });
    </script>
  </body>
</html>