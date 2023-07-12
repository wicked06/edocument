<?php
session_start();

include 'admin/includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verified($Lastname,$email){
    
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
    $mail->Subject = "Email Verified";

    $email_template = "
        <h2> Dear $Lastname,</h2>
        <h3>You account on eDocument: Online Application and Document Tracking and Repository System has been verified, please use your user credentials to log in.</h3>
        
        <h5>Kind Regards, eDocument: Online Application and Document Tracking and Repository System</h5>
    ";
    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}
function sendemail_not_Verified($Lastname,$email){
    
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
    $mail->Subject = "Email Verified";

    $email_template = "
        <h2> Dear $Lastname,</h2>
        <h3>You account on eDocument: Online Application and Document Tracking and Repository System cannot be verified, Please Reuquest again to verify</h3>

        <a href='http://localhost/BJMPWebsite/resend_verification.php'> Resend Verification Mail </a>
        
        <h5>Kind Regards, eDocument: Online Application and Document Tracking and Repository System</h5>
    ";
    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $verify_query = "SELECT * FROM `clients_acc` WHERE `verifyCode` = '$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);
        $verify_status = $row['verify_status'];
        $Lastname = $row['cLastname'];
        $email= $row['cEmail'];
        $adminStatus = $row['admin_status'];
        $userID = $row['cUsername'];

        if ($verify_status == 0) {
            $clicked_token = $row['verifyCode'];
            $update_query = "UPDATE `clients_acc` SET `verify_Status`='1', `admin_status`='1' WHERE `verifyCode`='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if ($update_query_run) {

                sendemail_verified("$Lastname","$email");

                $_SESSION['status'] = "Account Verified!";
                $_SESSION['status_text'] = "Your Account has been verified Successfully.";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_btn'] = "Done";
                header("Location: index");
                exit (0);
            }else {

                sendemail_not_Verified("$Lastname","$email");

                $_SESSION['status'] = "Verification Failed.";
                $_SESSION['status_text'] = "Account cannot be verified. Request Again.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
                header("Location: index");
                exit (0);
            }
        }else {
            $_SESSION['status'] = "Email is Already Verified.";
            $_SESSION['status_text'] = "Your Account has been verified already. Please Log in.";
            $_SESSION['status_code'] = "warning";
            $_SESSION['status_btn'] = "OK";
            header("Location: index");
            exit (0);
        }
    }else {
        $_SESSION['status'] = "Token Invalid";
        $_SESSION['status_text'] = "This token does not exists. Try Again.";
        $_SESSION['status_code'] = "warning";
        $_SESSION['status_btn'] = "OK";
        header("Location: index");
        exit (0);
    }
}

?>