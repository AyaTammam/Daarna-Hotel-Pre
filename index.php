<?php
    require 'global/header.php';
?>

<section class="form">
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <!-- http://placehold.it/300/300 -->
                    <img src="photos/login1.jpg" />
                </div>
            </div>
            <div class="col">
                <form class="login">
                    <h4 class="text-center">Admin Login</h4>
                    <input class="form-control form-control-lg" type="text" name="user" placeholder="UserNname" autocomplete="off" />
                    <input class="form-control form-control-lg" type="password" name="pass" placeholder="Password" autocomplete="new-password" />
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary d-grid gap-2" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    require 'global/footer.php';
?>