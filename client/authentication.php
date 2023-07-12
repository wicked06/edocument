<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Denied Access!";
    $_SESSION['status_text'] = "Please Login to Access the Page";
    $_SESSION['status_code'] = "warning";
    $_SESSION['status_btn'] = "Back";
    header("Location: /eDocument/login");
    exit(0);
}


?>