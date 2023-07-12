<?php

session_start();

include('admin/includes/config.php');

if (isset($_SESSION['authenticated'])) {
    $username = $_SESSION['auth_user']['username'];
    $_SESSION['status'] = "Logged Out Successfully!";
    $_SESSION['status_text'] = "You have been logged out.";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_btn'] = "Done";

    unset($_SESSION['authenticated']);
    unset($_SESSION['auth_user']);
    header("Location: index");
    exit(0);
}

if (isset($_SESSION['admin_auth'])) {
    $_SESSION['status'] = "Logged Out Successfully!";
    $_SESSION['status_text'] = "You have been logged out.";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_btn'] = "Done";

    unset($_SESSION['admin_auth']);
    header("Location: index");
    exit(0);
}

?>