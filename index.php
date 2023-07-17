<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eDcoument</title>
    <link rel="stylesheet" href="css/index.css">

<!--fontawesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- cdn for bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
  
    <header>
       <div class="logo"> <img src="images/logo-transparent.png" class="logo"></div>

        <ul class="navlist">
          <li> <a href="index.php">Home</a></li>
            
            <li><a href="contactus.html">Contact Us</a></li>

            <li><a href="login.php">Login</a></li>
        </ul>
        <!-- <div class="menu" id="menu"><i class="fa-solid fa-user-lock"></i></div> -->
        <button class="off-but" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-user-lock"></i></button>
      </header>

     <!-- offcanvas -->
     <div class="offcanvas offcanvas-end bg-dark <?php if (isset($_SESSION['set'])) { echo $_SESSION['set']; unset ($_SESSION['set']);}?>" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header mt-5">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="log-logo"><img src="images/logo-transparent.png" class="center"></div>

        <form method="POST" action="loginCode.php">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="example" name="username" value="<?php if (isset($_SESSION['id'])) { echo $_SESSION['id']; unset($_SESSION['id']);}?>" required>
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
            <span  hidden="hidden" class="fa fa-fw field-icon ps-toggle fa-eye" style="position: absolute; right: 15px; transform:translate(0, -50%); top: 50%; cursor: pointer;" id="adminIcon"></span>
            <label for="floatingPassword">Password</label>
          </div>
      
          <div class="text-start mb-3">
           <a href="">Forget Password</a>
          </div>
          <button class="admin-login" type="submit" name="adminLogin">Sign in</button>
          <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
      </div>
    </div>



<section class="hero">
    <div class="hero-text">
        <h2>Welcome to </h2>
        <h2>E-Document</h2>
    <h4>If you want to request form documents </h4>
    <h4>please click request and register first</h4>
    <h4>and fill up the form that is appropriately</h4>

   
    <a href="register.php" class="ctaa">Register Here</a>
    </div>

    <div class="hero-img">
        <img src="images/354211462_481896624140386_1090053045671443277_n.jpg" class="municipal">
    </div>

   
</section>
<footer >
 <div class="footer-content">
    
    <div class="footer-bottom">
      <p>copyright &copy; The IS-UATech Enthusiast </p>
    </div>
 </div>
</footer>
</body>

<script src="js/index.js"></script>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

<!-- Show Password Registration on offcanvas -->
<script type="text/javascript">
            $(document).ready(function(){
              $("#floatingPassword").keyup(function(){
                  var input = $(this).val();

                  let element = document.getElementById("adminIcon");
                  let hidden = element.getAttribute("hidden");

                   if (input == null || input == "") {
                    element.setAttribute("hidden", "hidden");
                   } 
                    else{
                      element.removeAttribute("hidden");
                   }
              });
            });
</script>

<script>
  const passwordToggle = document.querySelector('.ps-toggle');
  const ps = document.querySelector('#floatingPassword');
  passwordToggle.addEventListener('click', function (e) {
    const type = ps.getAttribute('type') === 'password' ? 'text' : 'password';
    ps.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });
</script>
</html>