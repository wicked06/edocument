<?php
include ('client/includes/bootstrapHeader.php');
?>

<main>
    <div class="container py-5 mt-5">
        <div class="row justify-content-center pb-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark">
                        <h4 class="card-title text-white">Resend Verification Email</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-floating" action="resend_verification_code.php" method="POST">
                            <h6 class="text-muted mb-3">Input your Registered Email to receive a new Verification Email</h6>
                            <div class="row mb-4 mt-3">
                                <div class="col-md">
                                    <div class="form-floating mb-2">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="Email Address" name="resendEmail" required>
                                        <label for="floatingInput"><span class="glyphicon glyphicon-name"></span><i class="fa fa-envelope"></i> Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button class="btn btn-warning me-md-2" type="submit" name="resendBtn"><span class="glyphicon glyphicon-name"></span><i class="fa fa-send"></i> Resend Verification</button>
                            </div>
                        </form>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                            <a class="btn btn-dark me-md-2" href="index.php"><span class="glyphicon glyphicon-name"></span><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>

<script src="client/js/sweetalert.min.js"></script>
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
</html>