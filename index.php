<?php 
session_start();
if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
include("common.php"); }
    else {
        header("Location:login.php");
    }

    ?>