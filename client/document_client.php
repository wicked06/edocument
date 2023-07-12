<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><i class="fas fa-folder"></i> Documnets</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Documnets</li>
        </ol>
        <div class="card mb-4 shadow">
            <div class="card-body">
                
                <table class="table table-bordered table-striped table-hovered table-light" id="table">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Rank</th>
                            <th scope="col">Email</th>
                            <th scope="col">Logged In</th>
                            <th scope="col">Logged Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php

                            $sql = "SELECT * FROM `admin_request`";
                            $query_run = $conn->query($sql) or die($conn->error);
                            while($row=$query_run->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td>  <?= $row['id']?></td>
                            <td> <?= $row['userID']?></td>
                            <td> <?= $row['lastname']?></td>
                            <td> <?= $row['firstname']?></td>
                            <td> <?= $row['rank']?></td>
                            <td> <?= $row['email']?></td>
                            <td> <?= $row['logged_in']?></td>
                            <td> <?= $row['logged_out']?></td>

                        </tr>
                        <?php
                            }
                        ?> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
?>