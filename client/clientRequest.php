<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-file-lines"></i> Request Form</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Request Form</li>
        </ol>

        <div class="container" style="width: 45rem;">

            <!-- Form Request - Stepper 1 -->
            <div class="card shadow" id="form-request">
                <div class="card-header">
                    Request Form
                </div>
                <div class="card-body">
                    <form method="POST" action="clientDataCode.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4 mt-3">
                                <!-- <div class="form-floating mt-3"> -->
                                <label class="form-label" id="floatingInput">First Name</label>
                                <input for="floatingInput" class="form-control" type="text" name="FirstName" required>
                                <input for="floatingInput" class="form-control" type="hidden" name="username" value="<?php echo $_SESSION['auth_user']['username'];?>">
                                <!-- </div> -->
                            </div>
                            <div class="col-4 mt-3">
                                <!-- <div class="form-floating mt-3"> -->
                                <label class="form-label" id="floatingInput">Middle Name</label>
                                <input for="floatingInput" class="form-control" type="text" name="MiddleName" required>
                                <!-- </div> -->
                            </div>
                            <div class="col-4 mt-3">
                                <!-- <div class="form-floating mt-3"> -->
                                <label class="form-label" id="InputLname">Last Name</label>
                                <input for="InputLname" class="form-control" type="text" name="LastName" required>
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mt-3">
                                <!-- <div class="form-floating mt-3"> -->
                                <label class="form-label" id="floatingInput">Age</label>
                                <input  class="form-control" type="text" name="age" required>
                                <!-- </div> -->
                            </div>
                        </div>

                        <fieldset class="row mt-3">
                            <legend class="col-form-label col-sm-3 pt-0">Sex</legend>
                            <div class="col-sm-9">
                                <input class="form-check-input" type="radio" name="sex" id="sex" value="Male"/> Male
                                <input class="form-check-input" type="radio" name="sex" id="sex" value="Female"/> Female
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col mt-3">
                                <!-- <div class="form-floating mt-3"> -->
                                <label class="form-label" id="floatingInput">Email address</label>
                                <input type="email" class="form-control" for="floatingInput" aria-describedby="emailHelp" name="email" id="email" required>
                                <!-- <div id="emailHelp" class="form-label">We'll never share your email with anyone else.</div> -->
                                <!-- </div>-->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mt-3">
                                <label class="form-label">Valid ID</label>
                                <select class="form-select form-select" name="id_type" id="id_type" required>
                                    <option value="" selected>Select ID type</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Drivers Licensed">Driver's Licensed</option>
                                    <option value="PhilHealth">PhilHealth</option>
                                    <option value="UMID">UMID</option>
                                    <option value="Passport">Passport</option>
                                    <option value="PRC">PRC</option>
                                    <option value="Voters ID">Voter's ID</option>
                                    <option value="SSS/GSIS ID">SSS/GSIS ID</option>
                                    <option value="Postal ID">Postal ID</option>
                                    <option value="School ID">School ID</option>
                                </select>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="formFile" class="form-label">Upload ID</label>
                                <input class="form-control" type="file" id="formFile" name="idCard" id="idCard" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-3">
                                <label class="form-label">Type of Document</label>
                                <select class="form-select" name="tod" id=  "tod" required>
                                    <option value="" selected>Select Type of Document</option>
                                    <option value="Live Birth Certificate">Live Birth Certificate</option>
                                    <option value="Marriage Certificate">Marriage Certificate</option>
                                    <!-- <option value="Death Certificate">Death Certificate</option>
                                    <option value="CENOMAR">CENOMAR</option>
                                    <option value="NSO/PSA">NSO/PSA</option>
                                    <option value="Affidavit to use Surname of the Father">Affidavit to use Surname of the Father</option> -->
                                </select>
                            </div>
                        </div>

                        <fieldset class="row mt-4">
                            <legend class="col-form-label col-sm-3 pt-0">Register Late?</legend>
                            <div class="col-sm-9">
                                <input class="form-check-input" type="radio" name="regStatus" id="regStatus" value="Yes"/> Yes
                                <input class="form-check-input" type="radio" name="regStatus" id="regStatus" value="No"/> No
                            </div>
                        </fieldset>

                        <button type="button" class="btn btn-warning mt-5 mb-4" name="proceedBtn" id="proceedBtn">Proceed <i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Upload Documents - Stepper 2 -->
            <!-- Marriage -->
            <div class="card shadow" id="MarriageCert" hidden="hidden">
                <div class="card-header">
                    Upload Requirements
                </div>
                <div class="card-body">
                        <div class="row mb-3">
                            <label for="birthCerti" class="col-sm-3 col-form-label">Birth Certificate</label>
                            <div class="col-sm-9">
                                <input type="file" id="birthCerti" class="form-control" name="birthCerti" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cenomar" class="col-sm-3 col-form-label">CENOMAR</label>
                            <div class="col-sm-9">
                                <input type="file" id="cenomar" class="form-control" name="cenomar" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cedula" class="col-sm-3 col-form-label">CEDULA</label>
                            <div class="col-sm-9">
                                <input type="file" id="cedula" class="form-control" name="cedula" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ctp" class="col-sm-3 col-form-label">Certificate of Tree Planting</label>
                            <div class="col-sm-9">
                                <input type="file" id="ctp" class="form-control" name="ctp" required>
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-3 pt-0">Counseling/Family Planning</legend>
                            <div class="col-sm-9" required>
                                <input class="form-check-input" type="radio" name="cfp" id="cfp" value="Yes"/> Yes
                                <input class="form-check-input" type="radio" name="cfp" id="cfp" value="No"/> No
                            </div>
                        </fieldset>

                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">ADVICE</div>
                        <small class="text-dark fst-italic">Both Parent's Signature (AGES 21-24)</small>
                        <div class="row mb-3">
                            <label for="advice_sign_m" class="col-sm-3 col-form-label">Mother</label>
                            <div class="col-sm-9">
                                <input type="file" id="advice_sign_m" class="form-control" name="advice_sign_m" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="advice_sign_f" class="col-sm-3 col-form-label">Father</label>
                            <div class="col-sm-9">
                                <input type="file" id="advice_sign_f" class="form-control" name="advice_sign_f" required>
                            </div>
                        </div>
                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">CONSENT</div>
                        <small class="text-dark fst-italic">Either Mother or Father Signature</small>
                        <div class="row mb-3">
                            <label for="consent" class="col-sm-3 col-form-label">Signature</label>
                            <div class="col-sm-9">
                                <input type="file" id="consent" class="form-control" name="consent" required>
                            </div>
                        </div>
                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">IF FOREIGNER</div>
                        <div class="row mb-3">
                            <label for="clcm" class="col-sm-3 col-form-label">Certificate of Legal Capacity to Marry</label>
                            <div class="col-sm-9">
                                <input type="file" id="clcm" class="form-control" name="clcm">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="divorce" class="col-sm-3 col-form-label">Divorce Paper</label>
                            <div class="col-sm-9">
                                <input type="file" id="divorce" class="form-control" name="divorce">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="passport" class="col-sm-3 col-form-label">Passport</label>
                            <div class="col-sm-9">
                                <input type="file" id="passport" class="form-control" name="passport">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning mt-5 mb-4" name="uploadBtn" id="uploadBtn">Send Request <i class="fas fa-paper-plane"></i></button>
                </div>
            </div>

            <!-- LiveBirth -->
            <div class="card shadow" id="LiveBirth" hidden="hidden">
                <div class="card-header">
                    Upload Requirements
                </div>
                <div class="card-body">
                        <div class="row mb-3">
                            <label for="npsa" class="col-sm-4 col-form-label">Negative PSA Certification</label>
                            <div class="col-sm-8">
                                <input type="file" id="npsa" class="form-control" name="npsa" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="baptismal" class="col-sm-4 col-form-label">Baptismal Certification</label>
                            <div class="col-sm-8">
                                <input type="file" id="baptismal" class="form-control" name="baptismal" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mcp" class="col-sm-4 col-form-label">Marriage Contract of Parents</label>
                            <div class="col-sm-8">
                                <input type="file" id="mcp" class="form-control" name="mcp" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cedula" class="col-sm-4 col-form-label">Cedula of Informant</label>
                            <div class="col-sm-8">
                                <input type="file" id="cedula" class="form-control" name="cedula" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="birthCerti" class="col-sm-4 col-form-label">Birth Certificate (Siblings)</label>
                            <div class="col-sm-8">
                                <input type="file" id="birthCerti" class="form-control" name="birthCerti" required>
                                <small class="text-dark fst-italic">All Birth Certificate(s) must be in one file ONLY.</small>
                            </div>
                        </div>

                        <hr>
                        <div class="sb-sidenav-menu-heading fw-semibold">Barangay Secretary</div>
                        <div class="row mb-3">
                            <label for="affidavit" class="col-sm-4 col-form-label">Joint Affidavit</label>
                            <div class="col-sm-8">
                                <input type="file" id="affidavit" class="form-control" name="affidavit" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="brgyCerti" class="col-sm-4 col-form-label">Barangay Certification</label>
                            <div class="col-sm-8">
                                <input type="file" id="brgyCerti" class="form-control" name="brgyCerti" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning mt-5 mb-4" name="uploadBtn" id="uploadBtn">Send Request <i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>

            <small class="text-muted"><label class="text-danger">NOTE!</label> Make sure to complete the forms. Don't cancel the process to avoid Request Failure.</small>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#proceedBtn').on('click', function(e){
            
            e.preventDefault();
            var tod = $('#tod').val();
            console.log(tod);

            let fr = document.getElementById('form-request');
            // let frElement = fr.getAttribute("hidden");

            let lb = document.getElementById('LiveBirth');
            let hidden = lb.getAttribute("hidden");

            let mc = document.getElementById('MarriageCert');
            let mcElement = mc.getAttribute("hidden");

            if (tod == "Live Birth Certificate") {
                fr.setAttribute("hidden", "hidden");
                lb.removeAttribute("hidden");

            }else if (tod == "Marriage Certificate"){
                fr.setAttribute("hidden", "hidden");
                mc.removeAttribute("hidden");
            }else{

            }


        });
    });
</script>

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

<script src="js/sweetalert2.all.min.js"></script>
<?php
    if (isset($_SESSION['logged'])) {
?>
    <script type="text/javascript">
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });

        Toast.fire({
        background:'#53a653',
        color: '#fff',
        icon: '<?php echo $_SESSION['logged_icon'];?>',
        title: '<?php echo $_SESSION['logged'];?>'
        });
    </script>
<?php
  unset($_SESSION['logged']);
}
?>

<?php
include('includes/footer.php');
?>