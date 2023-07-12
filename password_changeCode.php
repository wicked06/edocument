<?php
include('client/includes/config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function confirm_reset($Lastname, $email){
    
    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();
    $mail->SMTPAuth = true;


    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "yangyangdojillo01@gmail.com";
    $mail->Password   = "rkgohtilsixczzhm";

    $mail->SMTPSecure = "tls";
    $mail->Port       = "587";

    
    $mail->setFrom("yangyangdojillo01@gmail.com", "Sample Verification");
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Password Changed";

    $email_template = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>

        <!-- CSS only -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>

        <!-- JavaScript Bundle with Popper -->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3' crossorigin='anonymous'></script>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css'
            integrity='sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=='
            crossorigin='anonymous' referrerpolicy='no-referrer' />
    </head>
    <body>
        <div class='container '>
            <div class='row'>
                <div class='col-12'>
                    <!-- <img class='img-fluid' src='images/id-banner.png' alt='> -->
                </div>
            </div>
            <div class='row bg-primary'>
                <div class='col-12'>
                    <div class='mt-5 mb-5'>
                    </div>
                    <p class='text-center fs-6 text-white'><strong>P A S S W O R D   C H A N G E D !</strong></p>
                    <p class='text-center fs-2 text-white'><strong>Password Changed</strong></p>
                </div>
            </div>
            <div class='row mt-5'>
                <div class='col-12'>
                    <p class='text-center fs-4'><b>Dear $Lastname,</b></p>
                    <p class='text-center fs-5'>Your Password has been reset. Please don't forget your password to avoid loss of account.</p>
                </div>
            </div>
            <div class='row'>
                <p class='text-center fs-5'>Thanks,</p>
                <p class='text-center fs-5'>eDocument: Online Application and Document Tracking and Repository System</p>
            </div>
            <div class='row bg-secondary'>
                <div class='col-12'>
                    <p class='text-center fs-5 text-white mt-5'><strong>Get in touch</strong></p>
                    <p class='text-center fs-6 text-white'><strong>+11 111 333 4444</strong></p>
                    <p class='text-center fs-6 text-white'>yangyangdojillo01@gmail.com</p>
                </div>
            </div>
            <div class='row bg-primary'>
                <div class='col-12'>
                    <p class='text-center fs-6 text-white'>Copyrights © eDocument: Online Application and Document Tracking and Repository System. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['newPSBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['newPassword'];
    $cpassword = $_POST['confirmPassword'];
    $token = $_POST['password_token'];

    $checkToken = "SELECT `password_token`, `cLastname` FROM `clients_acc` WHERE `password_token`='$token' LIMIT 1";
    $checkToken_run = mysqli_query($conn, $checkToken);

    if (mysqli_num_rows($checkToken_run) > 0) {
        $row = mysqli_fetch_array($checkToken_run);

        $Lastname = $row['cLastname'];

        if ($password == $cpassword) {
            $update_password = "UPDATE `clients_acc` SET `cPassword`='$password' WHERE `password_token`='$token' LIMIT 1";
            $update_password_run = mysqli_query($conn, $update_password);
            
            if ($update_password_run) {
               $newToken = md5(rand())."eDoc";
               $change_new_token = "UPDATE `clients_acc` SET `password_token`='$newToken' WHERE `password_token`='$token' LIMIT 1";
               $change_new_token_run = mysqli_query($conn, $change_new_token);

                confirm_reset("$Lastname", "$email");

                $_SESSION['status'] = "Password Reset Success!";
                $_SESSION['status_text'] = "Password has been reset. Please Log in.";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_btn'] = "Done";
                header("Location: index.php");
            }else {
                $_SESSION['status'] = "Password Reset Error!";
                $_SESSION['status_text'] = "Password cannot be reset. Please Try Again.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
                header("Location: password_change.php?token=$token&email=$email");
            }
        }else {
            $_SESSION['status'] = "Password Do Not Match!";
            $_SESSION['status_text'] = "Password and Confirm Password does not match. Please try again.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "Done";
            header("Location: password_change.php?token=$token&email=$email");
        }
    }else {
        $_SESSION['status'] = "Token Invalid";
        $_SESSION['status_text'] = "This token does not exists. Try Again.";
        $_SESSION['status_code'] = "warning";
        $_SESSION['status_btn'] = "OK";
        header("Location: password_change.php?token=$token&email=$email");
        exit (0);
    }

 }else {
     $_SESSION['status'] = "No Token Available!";
     $_SESSION['status_text'] = "Make sure to register first.";
     $_SESSION['status_code'] = "error";
     $_SESSION['status_btn'] = "OK";
     header("Location: index.php");
     exit (0);
}
?>