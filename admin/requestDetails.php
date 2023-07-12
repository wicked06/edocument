<?php
session_start();
?>
<script src="js/sweetalert.min.js"></script>
        <?php
            if (isset($_SESSION['status'])){
        ?>
            <script>
                swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "<?php echo $_SESSION['status_text']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "<?php echo $_SESSION['status_btn']; ?>",
            });
            </script>
            
            <?php
            unset($_SESSION['status']);
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eDocument</title>

     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>

    <div class="container mt-3 mb-5">
        <h2 class="text-center mb-3"><img class="mb-4" src="images/crc-logo.png" alt="" width="60" height="60"> REQUEST DETAILS</h2>
        <div class="row">
        <?php
        include('includes/config.php');
        // $id = '1';
        // $id = $_POST['id'];
        $pathfile = '\eDocument/client/assets/files/';
        $id = $_GET['id'];
        $query = "SELECT * FROM `requests` WHERE `DocuCode` = '$id' AND `status` = 0";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_num_rows($query_run);
        foreach ($query_run as $row) {
    ?>
            <!-- Form Request Details -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Sender
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mt-3">
                                <label class="form-label" id="floatingInput">First Name</label>
                                <input for="floatingInput" class="form-control" type="text" name="FirstName" value="<?php echo $row['rFirstname'];?>" readonly>
                            </div>
                            <div class="col-4 mt-3">
                                <label class="form-label" id="floatingInput">Middle Name</label>
                                <input for="floatingInput" class="form-control" type="text" name="MiddleName" value="<?php echo $row['rMiddlename'];?>" readonly>
                            </div>
                            <div class="col-4 mt-3">
                                <label class="form-label" id="InputLname">Last Name</label>
                                <input for="InputLname" class="form-control" type="text" name="LastName" value="<?php echo $row['rLastname'];?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mt-3">
                                <label class="form-label" id="floatingInput">Age</label>
                                <input  class="form-control" type="text" name="age" value="<?php echo $row['rAge'];?>" readonly>
                            </div>
                            <div class="col-4 mt-3">
                                <label class="form-label" id="floatingInput">Sex</label>
                                <input  class="form-control" name="sex" id="sex" value="<?php echo $row['rSex'];?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-3">
                                <label class="form-label" id="floatingInput">Email address</label>
                                <input type="email" class="form-control" for="floatingInput" name="email" id="email" value="<?php echo $row['rEmail'];?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-3">
                                <label class="form-label" id="floatingInput">Valid ID: </label>
                            </div>
                            <div class="col text-center mt-3">
                                <img src="<?php echo $pathfile.$row['validID'];?>" class="rounded" alt="" height="250" width="400">
                                <a href="<?php echo $pathfile.$row['validID'];?>" target="_blank">View Picture</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-3">
                                <label class="form-label" id="floatingInput">Type of Document</label>
                                <input type="email" class="form-control" for="floatingInput" name="type" id="type" value="<?php echo $row['tod'];?>" readonly>
                            </div>
                            <div class="col mt-3">
                                <label class="form-label" id="floatingInput">Register Late?</label>
                                <input type="email" class="form-control" for="floatingInput" name="regStatus" id="regStatus" value="<?php echo $row['reg_status'];?>" readonly>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Confirm Request
                                </button>
                            <!-- </div>
                            <div class="col d-grid gap-2"> -->
                                <a class="btn btn-dark mt-1" type="button" href="request">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Schedule of Release</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="requestCode.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $row['rEmail'];?>" readonly>
                        <input for="InputLname" class="form-control" type="hidden" name="LastName" value="<?php echo $row['rLastname'];?>" readonly>
                        <input for="InputLname" class="form-control" type="hidden" name="docuCode" value="<?php echo $row['DocuCode'];?>" readonly>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="(Optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="sendBtn" id="sendBtn"><i class="fas fa-paper-plane"></i> Send Schedule</button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <script>
            function close_window() {
                close();
            }
        </script>
        
            <?php
    }
    
?>
<?php
        $id = $_GET['id'];
        $docu = "SELECT * FROM `documents` WHERE `DocuCode` = '$id'";
        $docu_run = mysqli_query($conn, $docu);
        $row = mysqli_num_rows($docu_run);
        foreach ($docu_run as $row) {
?>
            <!-- Uploaded Document -->

            <div class="col">
            <!-- Marriage -->
                <div class="card" id="MarriageCert" hidden="hidden">
                    <div class="card-header">
                        Uploaded Requirements
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="birthCerti" class="col-sm-3 col-form-label">Birth Certificate</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['birth_cert_both'];?>" target="_blank"> <?php echo $row['birth_cert_both'];?></a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cenomar" class="col-sm-3 col-form-label">CENOMAR</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['cenomar_both'];?>" target="_blank"> <?php echo $row['cenomar_both'];?></a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cedula" class="col-sm-3 col-form-label">CEDULA</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['cedula'];?>" target="_blank"> <?php echo $row['cedula'];?></a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ctp" class="col-sm-3 col-form-label">Certificate of Tree Planting</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['tree_planting'];?>" target="_blank"> <?php echo $row['tree_planting'];?></a>
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-3 pt-0">Counseling/Family Planning</legend>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="cfp" id="cfp" value="<?php echo $row['mar_counseling'];?>" readonly>
                            </div>
                        </fieldset>

                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">ADVICE</div>
                        <small class="text-dark fst-italic">Both Parent's Signature (AGES 21-24)</small>
                        <div class="row mb-3">
                            <label for="advice_sign_m" class="col-sm-3 col-form-label">Mother</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['parent_sign_m'];?>" target="_blank"> <?php echo $row['parent_sign_m'];?></a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="advice_sign_f" class="col-sm-3 col-form-label">Father</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['parent_sign_f'];?>" target="_blank"> <?php echo $row['parent_sign_f'];?></a>
                            </div>
                        </div>
                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">CONSENT</div>
                        <small class="text-dark fst-italic">Either Mother or Father Signature</small>
                        <div class="row mb-3">
                            <label for="consent" class="col-sm-3 col-form-label">Signature</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['consent_sign'];?>" target="_blank"> <?php echo $row['consent_sign'];?></a>
                            </div>
                        </div>
                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">IF FOREIGNER</div>
                        <div class="row mb-3">
                            <label for="clcm" class="col-sm-3 col-form-label">Certificate of Legal Capacity to Marry</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['cert_legal_capacity'];?>" target="_blank"> <?php echo $row['cert_legal_capacity'];?></a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="divorce" class="col-sm-3 col-form-label">Divorce Paper</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['divorce_paper'];?>" target="_blank"> <?php echo $row['divorce_paper'];?></a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="passport" class="col-sm-3 col-form-label">Passport</label>
                            <div class="col-sm-9">
                                <a href="<?php echo $pathfile.$row['passport'];?>" target="_blank"> <?php echo $row['passport'];?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End-- Marriage -->

                <!-- Live Birth -->
                <div class="card" id="LiveBirth" hidden="hidden">
                    <div class="card-header">
                        Uploaded Requirements
                    </div>
                    <div class="card-body">
                            <div class="row mb-3">
                                <label for="npsa" class="col-sm-4 col-form-label">Negative PSA Certification</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['nso_psa'];?>" target="_blank"> <?php echo $row['nso_psa'];?></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="baptismal" class="col-sm-4 col-form-label">Baptismal Certification</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['baptismal_cert'];?>" target="_blank"> <?php echo $row['baptismal_cert'];?></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="mcp" class="col-sm-4 col-form-label">Marriage Contract of Parents</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['marriage_cert_Parents'];?>" target="_blank"> <?php echo $row['marriage_cert_Parents'];?></a>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cedula" class="col-sm-4 col-form-label">Cedula of Informant</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['cedula'];?>" target="_blank"> <?php echo $row['cedula'];?></a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="birthCerti" class="col-sm-4 col-form-label">Birth Certificate (Siblings)</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['birth_cert_Sibling'];?>" target="_blank"> <?php echo $row['birth_cert_Sibling'];?></a>
                                </div>
                            </div>

                            <hr>
                            <div class="sb-sidenav-menu-heading fw-semibold">Barangay Secretary</div>
                            <div class="row mb-3">
                                <label for="affidavit" class="col-sm-4 col-form-label">Joint Affidavit</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['joint_affidavit'];?>" target="_blank"> <?php echo $row['joint_affidavit'];?></a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="brgyCerti" class="col-sm-4 col-form-label">Barangay Certification</label>
                                <div class="col-sm-8">
                                    <a href="<?php echo $pathfile.$row['brgy_cert'];?>" target="_blank"> <?php echo $row['brgy_cert'];?></a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <?php
    }
    
?>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

<script type="text/javascript">
    var type = document.getElementById('type').value;

    // console.log(type);

    let lb = document.getElementById('LiveBirth');
    let hidden = lb.getAttribute("hidden");

    let mc = document.getElementById('MarriageCert');
    let mcElement = mc.getAttribute("hidden");

    if (type == "Live Birth Certificate") {
        lb.removeAttribute("hidden");

    }else if (type == "Marriage Certificate"){
        mc.removeAttribute("hidden");

    }else{

    }
</script>


</html>