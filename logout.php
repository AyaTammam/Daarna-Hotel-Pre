<?php
    session_start();
    $PageName = "logout";
    session_unset();
    session_destroy();
    header('Location: index.php');
    ?>