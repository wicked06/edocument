<?php
include('includes/config.php');

session_start();

if (isset($_POST['updateBtn'])) {

    $id = filter_input(INPUT_POST,'IDNumber');
    $firstname = filter_input(INPUT_POST,'FirstName');
    $lastname = filter_input(INPUT_POST,'LastName');
    $middlename = filter_input(INPUT_POST, 'MiddleName');
    $address = filter_input(INPUT_POST,'address');
    $username = filter_input(INPUT_POST,'username');
    $dob = filter_input(INPUT_POST, 'dob');
    $contactNum = filter_input(INPUT_POST,'contactNum');
    $email = filter_input(INPUT_POST,'email');
    $image = $_FILES["image"]['name'];

    $select_query = ("SELECT * FROM `clients_acc` WHERE `id` = '$id'");
    $select_query_run = mysqli_query($conn, $select_query);
    foreach ($select_query_run as $select_row) {
        if ($image == null) {
            $image_data = $select_row['cPicture'];
            
        }else {
            if ($image_path = "images/uploads/".$select_row['cPicture']) {
            unlink($image_path);
            $image_data = $image;
            }
        }
    }

    if ($image == null){
        $sql =("UPDATE `clients_acc` SET `cFirstname`='$firstname',`cMiddlename`='$middlename',`cLastname`='$lastname',`cUsername`='$username',`cDOB`='$dob',`cAddress`='$address',`cEmail`='$email',`cContactNumber`='$contactNum' WHERE `id`='$id'");
        if($conn->query($sql)){
            $_SESSION['status'] = "Profile Updated!";
            $_SESSION['status_text'] = " ";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_btn'] = "Done";
            header("Location: userAccount");
            exit (0);
        }
        else{
            $_SESSION['status'] = "Profile cannot be Updated!";
            $_SESSION['status_text'] = " ";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "Back";
            header("Location: userAccount");
        }
    }else{
        $sql =("UPDATE `clients_acc` SET `cFirstname`='$firstname',`cMiddlename`='$middlename',`cLastname`='$lastname',`cUsername`='$username',`cDOB`='$dob',`cAddress`='$address',`cEmail`='$email',`cContactNumber`='$contactNum',`cPicture`='$image_data' WHERE `id`='$id'");
        if($conn->query($sql)){
            move_uploaded_file($_FILES["image"]["tmp_name"], "images/uploads/".$_FILES["image"]["name"]);
            $_SESSION['status'] = "Profile & Image Updated!";
            $_SESSION['status_text'] = " ";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_btn'] = "Done";
            header("Location: userAccount");
            exit (0);
        }
        else{
            $_SESSION['status'] = "Profile cannot be Updated!";
            $_SESSION['status_text'] = " ";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "Back";
            header("Location: userAccount");
        }
    }
}

if (isset($_POST['changePS'])) {
    $current = filter_input(INPUT_POST,'currentPS');
    $new = filter_input(INPUT_POST,'newPS');
    $confirmNew = filter_input(INPUT_POST,'confirmNewPS');

    $check_current = "SELECT `cPassword` FROM `clients_acc` WHERE `cPassword` = '$current' LIMIT 1";
    $check_current_run = mysqli_query($conn, $check_current);

    if (mysqli_num_rows($check_current_run) > 0) {
        if ($new == $confirmNew) {
            $update_ps = "UPDATE `clients_acc` SET `cPassword` = '$new' WHERE `cPassword` = '$current' LIMIT 1";
            $update_ps_run = mysqli_query($conn, $update_ps);

            if ($update_ps_run) {
                $_SESSION['status'] = "Password Change!";
                $_SESSION['status_text'] = "You have changed your password.";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_btn'] = "Done";
                header("Location: userAccount");
            }
        }else {
            $_SESSION['status'] = "Password Cannot Change!";
            $_SESSION['status_text'] = "Your Passwords doesn't match each other.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "Back";
            header("Location: userAccount");
        }
    }else {
        $_SESSION['status'] = "Password Cannot Change!";
        $_SESSION['status_text'] = "Your current password doesn't match our Records";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Back";
        header("Location: userAccount");
    }

}


if (isset($_POST['uploadBtn'])) {

    $id = filter_input(INPUT_POST,'IDNumber');
    $firstname = filter_input(INPUT_POST,'FirstName');
    $lastname = filter_input(INPUT_POST,'LastName');
    $middlename = filter_input(INPUT_POST, 'MiddleName');
    $age = filter_input(INPUT_POST,'age');
    $username = filter_input(INPUT_POST,'username');
    $sex = filter_input(INPUT_POST, 'sex');
    $id_type = filter_input(INPUT_POST,'id_type');
    $email = filter_input(INPUT_POST,'email');
    $tod = filter_input(INPUT_POST,'tod');
    $regStatus = filter_input(INPUT_POST,'regStatus');
    $cfp = filter_input(INPUT_POST, 'cfp');
    $idCard = $_FILES['idCard']['name'];
    $currentDate = date("Y-m-d");

    //Documents
    $npsa = $_FILES['npsa']['name'];
    $baptismal = $_FILES['baptismal']['name'];
    $mcp = $_FILES['mcp']['name'];
    $cedula = $_FILES['cedula']['name'];
    $birthCerti = $_FILES['birthCerti']['name'];
    $affidavit = $_FILES['affidavit']['name'];
    $brgyCerti = $_FILES['brgyCerti']['name'];
    $cenomar = $_FILES['cenomar']['name'];
    $ctp = $_FILES['ctp']['name'];
    $advice_sign_m = $_FILES['advice_sign_m']['name'];
    $advice_sign_f = $_FILES['advice_sign_f']['name'];
    $consent = $_FILES['consent']['name'];
    $clcm = $_FILES['clcm']['name'];
    $divorce = $_FILES['divorce']['name'];
    $passport = $_FILES['passport']['name'];

    if ($tod == "Live Birth Certificate") {

        $sql = ("INSERT INTO `requests`(`cUsername`, `rFirstname`, `rMiddlename`, `rLastname`, `rAge`, `rSex`, `rEmail`, `idType`, `validID`, `tod`, `reg_status`) VALUES ('$username','$firstname','$middlename','$lastname','$age','$sex','$email','$id_type','$idCard','$tod','$regStatus')");
        if ($conn->query($sql)) {
            $last_id = mysqli_insert_id($conn);

            if ($last_id) {
                $code = "LB-".$currentDate."-".$last_id;
                $update = "UPDATE `requests` SET `DocuCode`='$code' WHERE `id` = '$last_id'";
                $code_insert = mysqli_query($conn, $update);

                move_uploaded_file($_FILES["idCard"]["tmp_name"], "assets/files/".$_FILES["idCard"]["name"]);
                
                if ($code_insert) {
                    $docu = "INSERT INTO `documents`(`DocuCode`, `username`, `Docu_type`, `nso_psa`, `baptismal_cert`, `marriage_cert_Parents`, `cedula`, `birth_cert_Sibling`, `joint_affidavit`, `brgy_cert`) VALUES ('$code','$username','$tod','$npsa','$baptismal','$mcp','$cedula','$birthCerti','$affidavit','$brgyCerti')";
                    $upload = mysqli_query($conn, $docu);

                    if ($upload) {
                        move_uploaded_file($_FILES["npsa"]["tmp_name"], "assets/files/".$_FILES["npsa"]["name"]);
                        move_uploaded_file($_FILES["baptismal"]["tmp_name"], "assets/files/".$_FILES["baptismal"]["name"]);
                        move_uploaded_file($_FILES["mcp"]["tmp_name"], "assets/files/".$_FILES["mcp"]["name"]);
                        move_uploaded_file($_FILES["cedula"]["tmp_name"], "assets/files/".$_FILES["cedula"]["name"]);
                        move_uploaded_file($_FILES["birthCerti"]["tmp_name"], "assets/files/".$_FILES["birthCerti"]["name"]);
                        move_uploaded_file($_FILES["affidavit"]["tmp_name"], "assets/files/".$_FILES["affidavit"]["name"]);
                        move_uploaded_file($_FILES["brgyCerti"]["tmp_name"], "assets/files/".$_FILES["brgyCerti"]["name"]);

                        $_SESSION['status'] = "Request Successful!";
                        $_SESSION['status_text'] = "Request sent to the Admin for Processing.";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_btn'] = "Done";
                        header("Location: clientRequest");

                    }
                }else {
                    $_SESSION['status'] = "Request Unsuccessful!";
                    $_SESSION['status_text'] = "Data cannot be proceed! Please check you details again.";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_btn'] = "OK";
                    header("Location: clientRequest");
                }

            }else {
                $_SESSION['status'] = "Request Unsuccessful!";
                $_SESSION['status_text'] = "Data cannot be proceed! Please check you details again.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
                header("Location: clientRequest");
            }
            
        }else {
            $_SESSION['status'] = "Failed!";
            $_SESSION['status_text'] = "Cannot Upload File.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "ok";
            header("Location: clientRequest");
        }
    }elseif ($tod == "Marriage Certificate") {
        
        $sql = ("INSERT INTO `requests`(`cUsername`, `rFirstname`, `rMiddlename`, `rLastname`, `rAge`, `rSex`, `rEmail`, `idType`, `validID`, `tod`, `reg_status`) VALUES ('$username','$firstname','$middlename','$lastname','$age','$sex','$email','$id_type','$idCard','$tod','$regStatus')");
        if ($conn->query($sql)) {
            $last_id = mysqli_insert_id($conn);

            if ($last_id) {
                $code = "MC-".$currentDate."-".$last_id;
                $update = "UPDATE `requests` SET `DocuCode`='$code' WHERE `id` = '$last_id'";
                $code_insert = mysqli_query($conn, $update);

                move_uploaded_file($_FILES["idCard"]["tmp_name"], "assets/files/".$_FILES["idCard"]["name"]);
                
                if ($code_insert) {
                    $docu = "INSERT INTO `documents`(`DocuCode`, `username`, `Docu_type`, `cedula`, `cenomar_both`, `birth_cert_both`, `tree_planting`, `mar_counseling`, `parent_sign_m`, `parent_sign_f`, `consent_sign`, `cert_legal_capacity`, `divorce_paper`, `passport`) VALUES ('$code','$username','$tod','$cedula','$cenomar','$birthCerti','$ctp','$cfp','$advice_sign_m','$advice_sign_f','$consent','$clcm','$divorce','$passport')";
                    $upload = mysqli_query($conn, $docu);

                    if ($upload) {
                        move_uploaded_file($_FILES["cenomar"]["tmp_name"], "assets/files/".$_FILES["cenomar"]["name"]);
                        move_uploaded_file($_FILES["ctp"]["tmp_name"], "assets/files/".$_FILES["ctp"]["name"]);
                        move_uploaded_file($_FILES["mcp"]["tmp_name"], "assets/files/".$_FILES["mcp"]["name"]);
                        move_uploaded_file($_FILES["cedula"]["tmp_name"], "assets/files/".$_FILES["cedula"]["name"]);
                        move_uploaded_file($_FILES["birthCerti"]["tmp_name"], "assets/files/".$_FILES["birthCerti"]["name"]);
                        move_uploaded_file($_FILES["advice_sign_m"]["tmp_name"], "assets/files/".$_FILES["advice_sign_m"]["name"]);
                        move_uploaded_file($_FILES["advice_sign_f"]["tmp_name"], "assets/files/".$_FILES["advice_sign_f"]["name"]);
                        move_uploaded_file($_FILES["consent"]["tmp_name"], "assets/files/".$_FILES["consent"]["name"]);
                        move_uploaded_file($_FILES["clcm"]["tmp_name"], "assets/files/".$_FILES["clcm"]["name"]);
                        move_uploaded_file($_FILES["divorce"]["tmp_name"], "assets/files/".$_FILES["divorce"]["name"]);
                        move_uploaded_file($_FILES["passport"]["tmp_name"], "assets/files/".$_FILES["passport"]["name"]);

                        $_SESSION['status'] = "Request Successful!";
                        $_SESSION['status_text'] = "Request sent to the Admin for Processing.";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_btn'] = "Done";
                        header("Location: clientRequest");

                    }
                }else {
                    $_SESSION['status'] = "Request Unsuccessful!";
                    $_SESSION['status_text'] = "Data cannot be proceed! Please check you details again.";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_btn'] = "OK";
                    header("Location: clientRequest");
                }

            }else {
                $_SESSION['status'] = "Request Unsuccessful!";
                $_SESSION['status_text'] = "Data cannot be proceed! Please check you details again.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
                header("Location: clientRequest");
            }
            
        }else {
            $_SESSION['status'] = "Failed!";
            $_SESSION['status_text'] = "Cannot Upload File.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "ok";
            header("Location: clientRequest");
        }
    }else {
        $_SESSION['status'] = "Unkown Error!";
        $_SESSION['status_text'] = "Cannot Complete Request.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: clientRequest"); 
    }

}
?>