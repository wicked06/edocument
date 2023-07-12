<?php

include ('admin/includes/config.php');

session_start();

$username = $_POST['input'];

$check = "SELECT * FROM `clients_acc` WHERE `cUsername` = '$username'";
$check_run = mysqli_query($conn, $check);

if (mysqli_num_rows($check_run) > 0) {
    $print = '<label class="text-danger">Username is already taken!</label>';
    // $e = '<label class="text-danger">Hello World</label>';
    // echo $print;
}else {
    $print = '<label class="text-success">Username is available!</label>';
    // $e = '<label class="text-danger">Hello</label>';
    // echo $print;

}
echo $print;

?>