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

                          $query_number = "SELECT `id` FROM `requests` ORDER BY `id`";
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

                          $query_number = "SELECT `id` FROM `requests` WHERE `Status` = 0 ORDER BY `id`";
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
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        Receive Documents
                        <?php

                          $query_number = "SELECT `id` FROM `requests` WHERE `date_created` = CURRENT_DATE() ORDER BY `id`";
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
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        Ended Documents
                        <?php

                          $query_number = "SELECT `id` FROM `requests` WHERE `Status` = 1 AND MONTH(`date_created`) = MONTH(CURRENT_DATE()) ORDER BY `id`";
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
        </div>
        
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-tasks me-1"></i>
                        Requests
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hovered table-light" id="table">
                            <thead class="table table-dark">
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type of Document</th>
                                    <th scope="col">Date of Request</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $sql = "SELECT * FROM `requests` WHERE `status` = 0";
                                    $query_run = $conn->query($sql) or die($conn->error);
                                    while($row=$query_run->fetch_assoc())
                                    {
                                ?>
                                <tr>
                                    <td id="doc"> <?= $row['DocuCode']?></td>
                                    <td> <?= $row['rLastname'].", ".$row['rFirstname']?></td>
                                    <td> <?= $row['tod']?></td>
                                    <td> <?= $row['dor']?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-calendar me-1"></i>
                        Released Schedule
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hovered table-light" id="table">
                            <thead class="table table-dark">
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type of Document</th>
                                    <th scope="col">Date & Time of Relase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $sql = "SELECT * FROM `requests` WHERE `status` = 1";
                                    $query_run = $conn->query($sql) or die($conn->error);
                                    while($row=$query_run->fetch_assoc())
                                    {
                                ?>
                                <tr>
                                    <td id="doc"> <?= $row['DocuCode']?></td>
                                    <td> <?= $row['rLastname'].", ".$row['rFirstname']?></td>
                                    <td> <?= $row['tod']?></td>
                                    <td> <?= $row['date_of_release']."/ ".$row['time_of_release']?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
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