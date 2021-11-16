<?php
    ob_start();
    session_start();
    $PageName = "Home Admin";
    require "../../global/DBOperations.php";
    require "../../global/header.php";
    if (isset($_SESSION['admin']))
    {
        ?>
        <!-- Start Breadcrumb -->
        <nav class="shadow p-3 mb-5 rounded" aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item nav-link"><a href="../../index.php">Home</a></li>
                    <li class="breadcrumb-item nav-link active" aria-current="page">Control Panel</li>
                </ol>
            </div>
        </nav>
        <!-- End Breadcrumb -->
        <?php
    }
    else
    {
        // echo 'Error';
        header('location: insex.php');
    }
    require '../../global/footer.php';
    ?>