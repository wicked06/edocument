<?php

session_start();

include('includes/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function     sendemail($lastname,$email,$docuCode,$date,$time,$comment){
    
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
    $mail->Subject = "Scheduled Release of Documents - Civil Registry Office";

    $email_template = "
            <div class='row mt-5'>
                <div class='col-12'>
                    <p class='text-center fs-4'><b>Dear $lastname,</b></p>
                    <p class='text-center fs-5'>Your request of documents on eDocument has been approved by the admin. With this please take note of the following shedule of release:</p>
                    <div class='d-grid gap-2 col-6 mx-auto mt-5 mb-5'>
                        <p class='text-center fs-4'><b>• Date: $date</b></p>
                        <p class='text-center fs-4'><b>• Time: $time</b></p>
                        <p class='text-center fs-4'><b>• Document Code: $docuCode</b></p>
                    </div>
                    <p class='text-center fs-5'>$comment</p>
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
    ";
    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['sendBtn'])) {

    $email = filter_input(INPUT_POST,'email');
    $lastname = filter_input(INPUT_POST,'LastName');
    $orgtime = filter_input(INPUT_POST,'time');
    $orgdate = filter_input(INPUT_POST,'date');
    $docuCode = filter_input(INPUT_POST,'docuCode');
    $comment = filter_input(INPUT_POST,'comment');

    $date = date("d M Y", strtotime($orgdate));
    $time = date("h:i A", strtotime($orgtime));

    $sql = "UPDATE `requests` SET `status`='1',`date_of_release`='$date',`time_of_release`='$time' WHERE `DocuCode`='$docuCode'";
    $run = mysqli_query($conn, $sql);

    if ($run) {
        sendemail("$lastname","$email","$docuCode","$date","$time","$comment");
        $_SESSION['status'] = "Request Confirmed!";
        $_SESSION['status_text'] = "The schedule has been send to the Client.";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_btn'] = "Done";
        header("Location: request");
    }else {
        $_SESSION['status'] = "Request Cannot Confirmed!";
        $_SESSION['status_text'] = "Unkown error occurred.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: requestDetails");
    }
}


?>