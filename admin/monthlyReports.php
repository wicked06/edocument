<?php
include('authentication.php');
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/side_nav.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2"><i class="fas fa-clipboard"></i> Monthly Summary</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a role="button" class="btn btn-warning" href="print_summary.php" target="_blank"  name="print">Print Summary</a>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Records</h5>
            <div class="card-body">
                <table id="report" class="table table-responsive" >
                  <?php    
                          $query = "SELECT DISTINCT * FROM requests WHERE MONTH(`date_created`) = MONTH(CURRENT_DATE()) GROUP BY tod";
                          $query_run = mysqli_query($conn, $query);
    
                      ?>
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">Book Type</th>
                      <th scope="col">Registry Number (From)</th>
                      <th scope="col">Registry Number (To)</th>
                      <th scope="col">Number of Documents   </th>
                      <th scope="col">Diskette Number</th>
                    </tr>
                  </thead>
                  <?php
                    if($query_run)
                    {
                      foreach($query_run as $row)
                      {
                  ?>
                  <tbody>
                    <tr>
                      <td scope="col"><?php echo $id = $row['tod']; ?></td>
                      <td scope="col">
                        <?php
                            if ($row['tod'] == "Live Birth Certificate") {
                                $rec1 = "SELECT DocuCode  as recs FROM requests WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) AND tod = 'Live Birth Certificate' ORDER BY id ASC LIMIT 1";
                                $run1 = mysqli_query($conn, $rec1);
                                $r1 = mysqli_fetch_array($run1);

                            }elseif($row['tod'] == "Marriage Certificate"){
                                $rec1 = "SELECT DocuCode  as recs FROM requests WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) AND tod = 'Marriage Certificate' ORDER BY id ASC LIMIT 1";
                                $run1 = mysqli_query($conn, $rec1);
                                $r1 = mysqli_fetch_array($run1);

                            }else{
                                echo "No Records";
                            }
                            // $rec1 = "SELECT DocuCode  as recs FROM requests WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) ORDER BY date_created AND tod LIMIT 1";
                            // $run1 = mysqli_query($conn, $rec1);
                            // $r1 = mysqli_fetch_array($run1);
    
                            echo $r1['recs'];
                        
                        ?></td>
                        <td scope="col">
                        <?php 
                            if ($row['tod'] == "Live Birth Certificate") {
                                $rec2 = "SELECT DocuCode  as recss FROM requests WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) AND tod = 'Live Birth Certificate' ORDER BY id DESC LIMIT 1";
                                $run2 = mysqli_query($conn, $rec2);
                                $r = mysqli_fetch_array($run2);

                            }elseif($row['tod'] == "Marriage Certificate"){
                                $rec2 = "SELECT DocuCode  as recss FROM requests WHERE tod = 'Marriage Certificate' AND MONTH(date_created) = MONTH(CURRENT_DATE()) ORDER BY id DESC LIMIT 1";
                                $run2 = mysqli_query($conn, $rec2);
                                $r = mysqli_fetch_array($run2);

                            }else{
                                echo "No Records";
                            }
                            // $rec1 = "SELECT DocuCode  as recs FROM requests WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) ORDER BY date_created AND tod LIMIT 1";
                            // $run1 = mysqli_query($conn, $rec1);
                            // $r1 = mysqli_fetch_array($run1);

                            echo $r['recss'];
                        
                        ?></td>
                    <td scope="col">
                          <?php
                            if ($row['tod'] == "Live Birth Certificate") {
                                $count = "SELECT COUNT(`DocuCode`) as `docs` FROM `requests` WHERE MONTH(`date_created`) = MONTH(CURRENT_DATE()) AND `status` = '1' AND tod = 'Live Birth Certificate'";
                                $crun = mysqli_query($conn, $count);
                                $d = mysqli_fetch_array($crun);

                            }elseif($row['tod'] == "Marriage Certificate"){
                                $count = "SELECT COUNT(`DocuCode`) as `docs` FROM `requests` WHERE MONTH(`date_created`) = MONTH(CURRENT_DATE()) AND `status` = '1' AND tod = 'Marriage Certificate'";
                                $crun = mysqli_query($conn, $count);
                                $d = mysqli_fetch_array($crun);

                            }else{
                                echo "No Records";
                            }
                           
    
                            echo $d['docs'];
                          ?>
                      </td>
                      <td></td>
                    </tr>
                </tbody>
                  <?php
                      }
                    }
                    else
                    {
                      echo "No Record Found";
                    }
                ?>
                <tfoot>
                    <tr>
                    <th class="text-end" colspan="3">TOTAL</th>
                    <td scope="col">
                        <?php
                                $count = "SELECT COUNT(`DocuCode`) as `docs` FROM `requests` WHERE MONTH(`date_created`) = MONTH(CURRENT_DATE()) AND `status` = '1'";
                                $crun = mysqli_query($conn, $count);
                                $d = mysqli_fetch_array($crun);                           
    
                            echo $d['docs'];
                          ?>
                    </td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
    new DataTable('#report');
</script> 

<?php
include('includes/footer.php');
?>
