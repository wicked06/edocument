<?php

include('admin/includes/config.php');

session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function password_reset($Lastname, $email, $token){
    
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
    $mail->Subject = "Password Reset Request";

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
                    <p class='text-center fs-6 text-white'><strong>P A S S W O R D   R E S E T   R E Q U E S T !</strong></p>
                    <p class='text-center fs-2 text-white'><strong>Password Reset Link</strong></p>
                </div>
            </div>
            <div class='row mt-5'>
                <div class='col-12'>
                    <p class='text-center fs-4'><b>Dear $Lastname,</b></p>
                    <p class='text-center fs-5'>You hvae requested for a password reset. Continue by clicking here:</p>
                    <div class='d-grid gap-2 col-6 mx-auto mt-5 mb-5'>
                        <a href='http://localhost/eDocument/password_change.php?token=$token&email=$email' class='btn btn-warning btn-lg'>Password Reset</a>
                    </div>
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

if (isset($_POST['password_resetBtn'])) {
    $email = $_POST['email'];
    $token = md5(rand());

    $checkEmail = "SELECT * FROM `clients_acc` WHERE `cEmail`='$email' LIMIT 1";
    $checkEmail_run = mysqli_query($conn, $checkEmail);
        
    if (mysqli_num_rows($checkEmail_run) > 0) {
    $row = mysqli_fetch_array($checkEmail_run);
        $Lastname = $row['cLastname'];

        $password_token = "UPDATE `clients_acc` SET `password_token`='$token' WHERE `cEmail` = '$email' LIMIT 1";
        $password_token_run = mysqli_query($conn, $password_token);
    
        if ($password_token_run) {
            password_reset("$Lastname", "$email", "$token");
    
            $_SESSION['status'] = "Password Reset Sent!";
            $_SESSION['status_text'] = "Please check your email for the password reset link.";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_btn'] = "Done";
            header("Location: index.php");
        }else {
            $_SESSION['status'] = "Error";
            $_SESSION['status_text'] = "Unknown error has occured. Please Try Again.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "OK";
            header("Location: forgot_password.php");
            exit (0);
        }
    }else {
        $_SESSION['status'] = "Email is not Registered!";
        $_SESSION['status_text'] = "Make sure to register first.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "OK";
        header("Location: forgot_password.php");
        exit (0);
    }
}


?>