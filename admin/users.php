<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-user"></i> Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4 shadow row">
            <div class="card-body">
                
                <table class="table table-bordered table-striped table-hovered table-light" id="table">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM `admin`";
                            $query_run = $conn->query($sql) or die($conn->error);
                            while($row=$query_run->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td> <?= $row['username']?></td>
                            <td> <?= $row['password']?></td>

                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-4 shadow row">
            <div class="card-body">
                
                <table id="user" class="table table-bordered table-striped table-hovered table-light" >
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM `clients_acc`";
                            $query_run = $conn->query($sql) or die($conn->error);
                            while($row=$query_run->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td> <?= $row['cUsername']?></td>
                            <td> <?= $row['cLastname']?></td>
                            <td> <?= $row['cFirstname']?></td>
                            <td> <?= $row['cMiddlename']?></td>
                            <td> <?= $row['cEmail']?></td>
                            <td> <?= $row['cContactNumber']?></td>
                            <td> <?= $row['cAddress']?></td>

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
    new DataTable('#user');
</script> 
<?php
include('includes/footer.php');
?>