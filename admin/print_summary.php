<?php
include('authentication.php');
include('includes/config.php');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eDocument</title>

     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body id="printThis">
    <div class="container-fluid mt-5">
        <small>DVSS2K Form 1</small>
        <div class="row align-items-center text-center">
            <!-- <div class="col-4">
                <img class="float-end" src="images/crc-logo.png" height="80" width="80" alt="">
            </div>
            <div class="col-8">
                <h3 class="fw-bold">MUNICIPALITY OF CULASI</h3>
                <h6>San Jose de Buenavista, Antique</h6>
                <h5>Visitor's Log Monitoring System</h5>
            </div> -->
            <h3 class="fw-bold">OCRG TRANSMITAL FORM</h3>
        </div>
        <div class="row">
            <div class="d-flex justify-content-end">
                <label><?php echo date("M d Y");?></label>
            </div>
        </div>
        <div class="row">
            <label>The Civil Registrar General</label>
            <label>NSO Manila</label>
        </div>
        <div class="row mt-5">
            <label>Madam:</label>
            <p class="mt-2" style="text-indent: 50px;">Please acknowledge receipt of the following duplicate copies and diskette files of civil registry documents, which were registered in this office during the month of <b><u><?php echo date("M Y");?>.</u></b></p>
        </div>
        <div class="row mt-3">
            <table class="table table-responsive">
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

                            echo $r['recss'];
                        
                        ?></td>
                    <td scope="col">
                          <?php
                            $count = "SELECT COUNT(`DocuCode`) as `docs` FROM `requests` WHERE MONTH(`date_created`) = MONTH(CURRENT_DATE()) AND `status` = '1'";
                            $crun = mysqli_query($conn, $count);
                            $d = mysqli_fetch_array($crun);
    
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
        <div class="text-end mt-5">
            <div class="row">
                <h5 class="fw-bold">RONALD REY R. GUAMEN</h5><br>
            </div>
            <!-- <hr> -->
            <div class="row">
                <label>Municipal Civil Registrar</label>    
            </div>
        </div>
    </div>

<style>
  @media print{
    body *:not(#printThis):not(#printThis *){
      visibility: hidden;
    }

    #printThis{
      position: absolute;
      top: 0;
      left: 0;

    }
  }

</style>


<script>
        window.print();
</script>

</body>
</html>