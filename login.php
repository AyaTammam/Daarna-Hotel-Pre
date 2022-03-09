<?php
  ob_start();
  require "global/DBOperations.php";
  $PageName = $lang['LogIn'];
  $Page = 'LogIn';
  require "global/header.php";
  if (COUNT($_SESSION) == 0)
  {
    ?>
    <!-- Start Section Login -->
    <section class="pageLogin">
      <div class="overlay mb-0">
        <div class="container">
          <form class="Formlogin mx-auto my-5 was-validated" id="Formlogin">
            <h4 class="text-center h2 p-2 text-white"><?php echo $lang['SignIn']; ?></h4>
            <div class="form-floating">
              <input type="name" class="form-control my-3" name="UserName" id="UserName" placeholder="UserName" autocomplete="off" required>
              <label class="text-white" for="UserName"><?php echo $lang['UserName']; ?></label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control my-3" name="Password" id="Password" placeholder="Password" required>
              <label class="text-white" for="Password"><?php echo $lang['Password']; ?></label>
            </div>
            <div class="vstack col mx-auto my-3">
              <button class="btn btn-primary btn-lg" type="submit"><?php echo $lang['LogIn']; ?></button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- End Section Login -->
    <?php
  }
  else
  {
    header("Location: index.php");
  }
  require 'global/footer.php';
  ob_end_flush();
?>