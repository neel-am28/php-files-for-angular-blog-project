<?php
    session_start();
    if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
        unset($_SESSION['email']);
        echo
        '<script language="javascript">
        alert("Logout successful, Admin!");
        window.location.href="login.php"
        </script>';
    }
    else {
        echo
        '<script language="javascript">
        alert("You are not logged in. Please login!");
        window.location.href="login.php"
        </script>';
    }
?>