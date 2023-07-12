<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-tasks"></i> Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Requests</li>
        </ol>
        <div class="card mb-4 shadow">
            <div class="card-body">
                
                <table id="table" class="table table-bordered table-striped table-hovered table-light" >
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type of Document</th>
                            <th scope="col">Registration Status</th>
                            <th scope="col">Date of Request</th>
                            <th scope="col">Action</th>
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
                            <td> <?= $row['cUsername']?></td>
                            <td> <?= $row['rLastname'].", ".$row['rFirstname']?></td>
                            <td> <?= $row['rEmail']?></td>
                            <td> <?= $row['tod']?></td>
                            <td> <?= $row['reg_status']?></td>
                            <td> <?= $row['dor']?></td>
                            <td><a href="requestDetails.php?id=<?php echo $row['DocuCode']?>" class="btn btn-primary">View Details</a></td>
                            <!-- <td><button type="button" id="viewModal" class="btn btn-primary">View Details</button></td> -->
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
    new DataTable('#table');
</script> 
 <!-- View Record Modal -->
 <div class="modal fade" id="ViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Request Details</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewRecordModal">

            </div>
          </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


<!-- <script type="text/javascript">
    $(document).ready(function (){
    $('#viewModal').on('click', function(e){

    e.preventDefault();
    var id = $(this).closest('tr').find('#doc').text();
    // console.log(id);
      $.ajax({
        url: "requestDetails.php",
        type: "POST",
        data: {id:id},
        success:function(response){
          $('#viewRecordModal').html(response);
          $('#ViewModal').modal('show');
        }
      });

    });
    });
</script> -->

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

<?php
include('includes/footer.php');
?>