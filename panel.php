<?php
    session_start();
    if (isset($_SESSION['client']))
    {
        echo 'welcome ' . $_SESSION['client'];
    }
    else
    {
        header('location: index.php');
        exit();
    }