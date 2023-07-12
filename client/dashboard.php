<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        All Documents
                        <?php

                          include('includes/config.php');

                          $query_number = "SELECT `id` FROM `requests` WHERE `Status` = 1 ORDER BY `id`";
                          $query_number_run = mysqli_query($conn, $query_number);

                          if ($row = mysqli_num_rows($query_number_run)) {
                            echo '<h1 class="mb-0">'.$row.'</h1>';
                          }else {
                            echo '<h1 class="mb-0"> No Data Found </h1>';
                          }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        Pending Documents
                        <?php

                          include('includes/config.php');

                          $query_number = "SELECT `id` FROM `requests` WHERE `Status` = 1 ORDER BY `id`";
                          $query_number_run = mysqli_query($conn, $query_number);

                          if ($row = mysqli_num_rows($query_number_run)) {
                            echo '<h1 class="mb-0">'.$row.'</h1>';
                          }else {
                            echo '<h1 class="mb-0"> No Data Found </h1>';
                          }
                        ?>
                    </div>
                </div>
            </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Document Status
            </div>
            <div class="card-body">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar w-75"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
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