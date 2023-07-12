<?php
session_start();

include 'admin/includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($lname,$email,$verifyCode){
    
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
    $mail->Subject = "Email Verification";

    $email_template = "
            <div class='row bg-primary'>
                <div class='col-12'>
                    <div class='mt-5 mb-5'>
                    </div>
                    <p class='text-center fs-6 text-white'><strong>T H A N K S   F O R  R E G I S T E R I N G !</strong></p>
                    <p class='text-center fs-2 text-white'><strong>Verify Your E-mail Address</strong></p>
                </div>
            </div>
            <div class='row mt-5'>
                <div class='col-12'>
                    <p class='text-center fs-4'><b>Dear $lname,</b></p>
                    <p class='text-center fs-5'>You registered an account on eDocument: Online Application and Document Tracking and Repository System, before being able to use your account you need to verify that this is your email address by clicking here:</p>
                    <div class='d-grid gap-2 col-6 mx-auto mt-5 mb-5'>
                        <a href='http://localhost/eDocument/verify_email.php?token=$verifyCode' class='btn btn-warning btn-lg'>Verify Your Email</a>
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
    ";
    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['adminLogin'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run)> 0) {
        $_SESSION['admin_auth'] = TRUE;
        $_SESSION['logged'] = "Logged in successfully";
        $_SESSION['logged_icon'] = "success";
        header("Location: admin/dashboard");
    }else {
        $_SESSION['set'] = "show";
        $_SESSION['id'] = $username;
        $_SESSION['status'] = "Wrong Username or Password";
        $_SESSION['status_text'] = "Please check your credentials.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: index");
    }
}

if (isset($_POST['loginBtn'])) {
    
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $login_query = "SELECT * FROM `clients_acc` WHERE `cUsername` = '$username' AND `cPassword` = '$password' LIMIT 1";
        $login_query_run = mysqli_query($conn, $login_query);
    
        if (mysqli_num_rows($login_query_run)> 0) {
            $row = mysqli_fetch_array($login_query_run);

            $userID = $row['cUsername'];
            $idnum = $row['id'];

            if ($row['verify_status'] == "1") {
                if ($row['admin_status'] == "1") {
                    $_SESSION['authenticated'] = TRUE;

                    $_SESSION['auth_user'] = [
                        'username' => $userID,
                        'idnum' => $idnum,
                    ];
                    $_SESSION['logged'] = "Logged in successfully";
                    $_SESSION['logged_icon'] = "success";
                    header("Location: client/clientRequest");
                }else {
                    $_SESSION['status'] = "Account not Active!";
                    $_SESSION['status_text'] = "Please contact your Civil Registry Admin.";
                    $_SESSION['status_code'] = "warning";
                    $_SESSION['status_btn'] = "Done";
                    header("Location: login");
                }
            }else {
                $_SESSION['status'] = "Account not verified!";
                $_SESSION['status_text'] = "Please Verify your Email Address to Log in.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "Done";
                header("Location: login");
            }
        }else {
            $_SESSION['status'] = "Wrong Username or Password";
            $_SESSION['status_text'] = "Please check your credentials.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "ok";
            header("Location: login");
        }
}

if (isset($_POST['registerBtn'])) {

    $fname = filter_input(INPUT_POST, 'FirstName');
    $mname = filter_input(INPUT_POST, 'MiddleName');
    $lname = filter_input(INPUT_POST, 'LastName');
    $address = filter_input(INPUT_POST, 'address');
    $username = filter_input(INPUT_POST, 'username');
    $dob = filter_input(INPUT_POST, 'dob');
    $contactNum = filter_input(INPUT_POST, 'contactNum');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $cpassword = filter_input(INPUT_POST, 'Cpassword');
    $verifyCode = md5(rand());

    $check_data = "SELECT * FROM `clients_acc` WHERE `cFirstname`='$fname' AND `cMiddlename`='$mname' AND `cLastname`='$lname' AND `cUsername`='$username' AND `cDOB`='$dob' AND `cAddress`='$address' AND `cContactNumber`='$contactNum' LIMIT 1";
    $check_data_run = mysqli_query($conn, $check_data);

    if (mysqli_num_rows($check_data_run) > 0) {

        $_SESSION['status'] = "Data Already Exists!";
        $_SESSION['status_text'] = "Duplicate Data not Accepted.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Try Again";
        header("Location: register");
    }else {
        $check_email = "SELECT * FROM `clients_acc` WHERE `cEmail`='$email' LIMIT 1";
        $check_email_run = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($check_email_run) > 0) {
            $_SESSION['status'] = "Email Already Exists!";
            $_SESSION['status_text'] = "Please try again with a different Email Address";
            $_SESSION['status_code'] = "warning";
            header("Location: register");
        }else {
            if ($password == $cpassword) {
                $query = "INSERT INTO `clients_acc`(`cFirstname`, `cMiddlename`, `cLastname`, `cUsername`, `cPassword`, `cDOB`, `cAddress`, `cEmail`, `cContactNumber`,`verifyCode`) VALUES ('$fname','$mname','$lname','$username','$password','$dob','$address','$email','$contactNum','$verifyCode')";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {

                    sendemail_verify("$lname","$email","$verifyCode");
                    $_SESSION['status'] = "Registered Successfully!";
                    $_SESSION['status_text'] = "Please check your email for the verification before logging in.";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_btn'] = "Done";
                    header("Location: register");
                    exit (0);
                } else {
                    $_SESSION['status'] = "Registration Unsuccessful!";
                    $_SESSION['status_text'] = "Data cannot be Registered! Please check you details again.";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_btn'] = "OK";
                    header("Location: register");
                }
            } else {
                $_SESSION['status_text'] = "Password and Confirm Password do not match.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
                header("Location: register");
            }
        }
    }

}    
?>