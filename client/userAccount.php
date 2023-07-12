<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-user-circle"></i> My Account</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">My Account</li>
        </ol>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="card shadow" style="width: 18rem;">
                    <?php
                                include('includes/config.php');
                                $username = $_SESSION['auth_user']['username'];
                                $query = "SELECT * FROM `clients_acc` WHERE `cUsername` = '$username' AND `admin_status` = 1";
                                $query_run = mysqli_query($conn, $query);
                                $row = mysqli_num_rows($query_run);
                                foreach ($query_run as $row) {
                            ?>
                        <!-- <img src="images/crc-logo.png" class="mt-2" height="200" width="200"> -->
                        <center><?php echo '<img src="images/uploads/'.$row['cPicture'].' " class="img-thumbnail" height="200" width="200";>'?></center>
                        <div class="card-body">
                            <form method="POST" action="clientDataCode.php" enctype="multipart/form-data">
                                <h5 class="card-title text-center"><?php echo $row['cUsername'];?></h5>
                                <hr>
                                <small class="form-label" id="picture">Upload Profile Picture</small>
                                <input for="InputPicture" class="form-control form-control-sm" type="file" name="image" id="image">
                        </div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="card shadow">
                        <div class="card-header">
                            User Profile
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-4 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="floatingInput">First Name</label>
                                            <input for="floatingInput" class="form-control" type="text" name="FirstName" value="<?php echo $row['cFirstname'];?>">
                                            <input type="hidden" name="IDNumber" value="<?php echo $row['id'];?>">
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-4 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="floatingInput">Middle Name</label>
                                            <input for="floatingInput" class="form-control" type="text" name="MiddleName" value="<?php echo $row['cMiddlename'];?>">
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-4 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="InputLname">Last Name</label>
                                            <input for="InputLname" class="form-control" type="text" name="LastName" value="<?php echo $row['cLastname'];?>">
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="floatingInput">Address</label>
                                            <input for="floatingInput" type="text" class="form-control" name="address" id="address" value="<?php echo $row['cAddress'];?>">
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="floatingInput">Username</label>
                                            <input  class="form-control" type="text" name="username" value="<?php echo $row['cUsername'];?>" readonly>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-4 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="floatingInput">Date of Birth</label>
                                            <input for="floatingInput" class="form-control" type="date" name="dob" id="dob" value="<?php echo $row['cDOB'];?>">
                                            <div class="" id="date-label">
                                                        
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-4 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="InputLname">Contact Number</label>
                                            <input for="InputLname" class="form-control" type="text" name="contactNum" value="<?php echo $row['cContactNumber'];?>">
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="floatingInput">Email address</label>
                                            <input type="email" class="form-control" for="floatingInput" aria-describedby="emailHelp" name="email" id="email" value="<?php echo $row['cEmail'];?>">
                                            <!-- <div id="emailHelp" class="form-label">We'll never share your email with anyone else.</div> -->
                                        <!-- </div>-->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <!-- <div class="form-floating mt-3"> -->
                                            <label class="form-label" id="InputPassword">Password</label>
                                            <input for="InputPassword" class="form-control" type="password" name="password" id="password" value="<?php echo $row['cPassword'];?>" readonly>
                                            <div class="" id="password-label">
                                            
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-6 mt-5">
                                        <p><a class="link-opacity-100 form-text" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</a></p>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mt-4" name="updateBtn" id="updateBtn"><i class="fas fa-pen-to-square"></i> Update Profile</button>
                            </form>
                            <?php
                                }
                                
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><span class="glyphicon glyphicon-name"></span><i class="fa fa-lock"></i> Change Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="clientDataCode.php">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="current" class="col-sm-4 col-form-label">Current Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" id="current" name="currentPS">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label"> New Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" id="ps" name="newPS">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cpassword" class="col-sm-4 col-form-label"> Confirm Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" id="cpassword" name="confirmNewPS">
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-2 mt-1 mx-3">
                        <input class="form-check-input showPassword" type="checkbox">
                        <label class="form-check-label">
                        Show Password
                        </label>
                    </div>
                        <script>
                                var toggleAdmin = document.querySelector('.showPassword');
                                var Current = document.querySelector('#current');
                                var Password = document.querySelector('#ps');
                                var Cpassword = document.querySelector('#cpassword');

                                toggleAdmin.addEventListener("click", handleToggleClick, false);

                                function handleToggleClick(event) {
                                if (this.checked) {
                                    console.warn("Change input 'type' to: text")
                                    Current.type = 'text';
                                    Password.type = 'text';
                                    Cpassword.type = 'text';
                                }else{
                                    console.warn("Change input 'type' to: password")
                                    Current.type = 'password';
                                    Password.type = 'password';
                                    Cpassword.type = 'password';
                                }
                                }
                            </script>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="changePS"><span class="glyphicon glyphicon-name"></span><i class="fa fa-share"></i> Change Password</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
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