<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eDocument - Register</title>

     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- css link -->
    <link rel="stylesheet" href="css/register.css">
</head>
<body >
    <div class="container mt-5">
        <main>
        <script src="admin/js/sweetalert.min.js"></script>
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
        <div class="col-md-10 mx-auto col-lg-7">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row mt-3">
                        <div class="col-2">
                            <img class="mb-4" src="images/crc-logo.png" alt="" width="100" height="100">
                        </div>
                        <div class="col-10">
                            <h3>MUNICIPALITY OF CULASI</h3>
                            <h5>eDocument: Online Application and Document Tracking and Repository System for Civil Registry</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="loginCode.php" enctype="multipart/form-data">
                        
                       

                        <div class="row">
                            <div class="col-4">
                                <div class="form-floating mt-3">
                                    <input for="floatingInput" class="form-control" type="text" name="FirstName" placeholder="First Name" required>
                                    <label class="form-text" id="floatingInput">First Name</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mt-3">
                                    <input for="floatingInput" class="form-control" type="text" name="MiddleName" placeholder="Middle Name" required>
                                    <label class="form-text" id="floatingInput">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mt-3">
                                    <input for="InputLname" class="form-control" type="text" name="LastName" placeholder="Last Name" required>
                                    <label class="form-text" id="InputLname">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mt-3">
                                    <input for="floatingInput" type="text" class="form-control" placeholder="Address" name="address" id="address" required>
                                    <label class="form-text" id="floatingInput">Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-floating mt-3">
                                    <input  class="form-control" type="text" name="username" id="username" placeholder="Username" required>
                                    <label class="form-text" id="floatingInput">Username</label>
                                    <div id="user-label">

                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mt-3">
                                    <input for="floatingInput" class="form-control" type="date" name="dob" id="dob" placeholder="Date of Birth" required>
                                    <label class="form-text" id="floatingInput">Date of Birth</label>
                                    <div class="" id="date-label">
                                                
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mt-3">
                                    <input for="InputLname" class="form-control" type="text" name="contactNum" placeholder="Contact Number" required>
                                    <label class="form-text" id="InputLname">Contact Number</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mt-3">
                                    <input type="email" class="form-control" for="floatingInput" placeholder="name@gmail.com" aria-describedby="emailHelp" name="email" id="email" required>
                                    <label class="form-text" id="floatingInput">Email address</label>
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>                         
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mt-3">
                                    <input for="InputPassword" class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                    <label class="form-text" id="InputPassword">Password</label>
                                    <div class="" id="password-label">
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mt-3">
                                    <input for="InputCpassword" class="form-control" type="password" name="Cpassword" id="cpassword" placeholder="Confirm Password" required>
                                    <label class="form-text" id="InputCpassword">Confirm Password</label>
                                    <div class="" id="Cpassword-label">
                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-2 mt-1">
                        <input class="form-check-input showPassword" type="checkbox">
                        <label class="form-check-label">
                        Show Password
                        </label>
                        </div>
                        <script>
                                var toggleAdmin = document.querySelector('.showPassword');
                                var adPassword = document.querySelector('#password');
                                var adCpassword = document.querySelector('#cpassword');

                                toggleAdmin.addEventListener("click", handleToggleClick, false);

                                function handleToggleClick(event) {
                                if (this.checked) {
                                    console.warn("Change input 'type' to: text")
                                    adPassword.type = 'text';
                                    adCpassword.type = 'text';
                                }else{
                                    console.warn("Change input 'type' to: password")
                                    adPassword.type = 'password';
                                    adCpassword.type = 'password';
                                }
                                }
                            </script>

                        <div class="container text-center">
                        <div class="row ">
                            <div class="col">
                                <button class="d-grid gap-2 col-10 mx-auto btn btn-dark mt-3" type="submit" name="registerBtn" id="registerBtn">Register</button>
                            </div>
                            <div class="col">
                                <a href="index.php" class="d-grid gap-2 col-10 mx-auto btn btn-dark mt-3">Cancel Registration</a>
                            </div>
                            
                        </div>
                        </div>

                            

                            <hr class="my-4">
                            <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                            <p class="mt-3 mb-3 text-muted ">Already a User? <a href="login">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


<!-- Admin Age and Birthdate Checker -->
<script type="text/javascript">
        document.getElementById('dob').addEventListener('change', function(){
            dob = new Date(this.value);
            // console.log(dob);

            const day = dob.getDate();
            const month = dob.getMonth()+1;
            const year = dob.getFullYear();
            // console.log(year);

            const birthdate = new Date(year, month, day); 

            function age(birthdate) {

            const today = new Date();
            
            let currentYear = today.getFullYear();
            let currentMonth = today.getMonth();
            let currentDate = today.getDate();

                if (valid = (year > currentYear || (month > currentMonth && year == currentYear) || (day > currentDate && month == currentMonth && year == currentYear))) {
                    document.getElementById("dob").classList = "form-control is-invalid";
                    document.getElementById("date-label").classList = "invalid-feedback";
                    document.getElementById("date-label").innerHTML = "Invalid Date. Not Born Yet!";
                    document.getElementById("registerBtn").type = "button";
                    // alert("Not Born Yet. Please input a valid Date.");
                } else{
                    const age = currentYear - birthdate.getFullYear() - 
                                (currentMonth < birthdate.getMonth() || 
                                (currentMonth === birthdate.getMonth() && currentDate < birthdate.getDate()));

                    document.getElementById("registerBtn").type = "submit";
                    return age;
                }
            }
            const ageValue = age(birthdate);
            // console.log(ageValue);

            if (valid != true){
                if (ageValue >= 18 && ageValue < 70) {
                    document.getElementById("dob").classList.remove("is-invalid");
                    document.getElementById("date-label").classList.remove("valid-feedback");
                    document.getElementById("age").value = ageValue;
                    document.getElementById("registerBtn").type = "submit";
                    // alert("Legal Age. Your age is accepted!");
                    
                }else if(ageValue < 18  || ageValue > 70){
                    // alert("Invalid! You are still under the age of 18.");
                    document.getElementById("dob").classList = "form-control is-invalid";
                    document.getElementById("date-label").classList = "invalid-feedback";
                    document.getElementById("date-label").innerHTML = "Invalid Age. You are not Eligible!";
                    document.getElementById("registerBtn").type = "button";

                } 
                else {
                    document.getElementById("dob").classList = "form-control is-invalid";
                    document.getElementById("date-label").classList = "invalid-feedback";
                    document.getElementById("date-label").innerHTML = "Error! Age undefined.";
                    document.getElementById("registerBtn").type = "button";
                    // alert("Invalid! Age cannot be calculated.");
                }
            }
            
        });
</script>

<!-- Password Validator for Admin-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#password").keyup(function(){
            var password = $(this).val();
            var passwordBox = document.getElementById("password");
            var label = document.getElementById("password-label");

            // Validations
            var regex = new Array();
            regex.push("[A-Z]"); //Uppercase Alphabet.
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&_-]"); //Special Character.

            var passed = 0;

            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test(password)) {
                passed++;
                }
            }
            //Password Length.
            if (password.length >= 8 && passed == 4) {
                var passed = 5;
            }

            //Progress Bar
            switch (passed) {
                case 0:
                    
                case 1:
                    
                case 2:
                        passwordBox.classList = "form-control border border-danger"
                        label.classList = "form-label fs-6 text-danger";
                        label.innerHTML = "Strenght: Weak";
                    break;
                case 3:
                        passwordBox.classList = "form-control border border-warning"
                        label.classList ="form-label fs-6 text-warning";
                        label.innerHTML = "Strenght: Medium";
                    break;
                case 4:
                        passwordBox.classList = "form-control border border-primary"
                        label.classList ="form-label fs-6 text-primary";
                        label.innerHTML = "Strenght: Strong";
                    break;
                case 5:
                        passwordBox.classList = "form-control is-valid"
                        label.classList ="form-label fs-6 text-success";
                        label.innerHTML = "Strenght: Very Strong";
                    break;
                default:
                    break;
            }
            
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#cpassword").keyup(function(){
            var cPassword = $(this).val();
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("cpassword");
            var label = document.getElementById("Cpassword-label");

            if (cPassword == null || cPassword == "") {
                
            }
            else if (cPassword == password) {
               confirmPassword.classList="form-control is-valid";
                label.innerHTML = "Password matched!";
                label.classList = "form-label fs-6 text-success";
                document.getElementById("registerBtn").type = "submit";


            }else{
                confirmPassword.classList="form-control is-invalid";
                label.innerHTML = "Password Do not matched!";
                label.classList = "form-label fs-6 text-danger";
                document.getElementById("registerBtn").type = "button";
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#username").keyup(function(){
            var input = $(this).val();

            // console.log(input);
            
            if (input == null || input == "") {
                document.getElementById('user-label').setAttribute("hidden", "hidden");
            }else{
                document.getElementById('user-label').removeAttribute("hidden");
                $.ajax({
                url: 'unique_username.php',
                type: "POST",
                data: {input:input},
                success: function (res) {
                    $('#user-label').html(res);
                }
                })
            }

        });
    });
</script>
</html>