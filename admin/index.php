<?php
include('includes/header.php');
include('includes/navbar.php');
include_once 'includes/dbh.inc.php';
include('security.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Preview Basic Information about the registered users</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Users</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    require 'database/dbconfig.php';

                                 $query = "SELECT usersUid FROM users ORDER BY usersId";
                                 $query_run = mysqli_query($connection, $query);
                                 $row = mysqli_num_rows($query_run);
                                 echo '<h4><br><br> Total Registered Users: '.$row.'</h4>';
                    ?>

                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of records per method</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php
                  require 'database/dbconfig.php';

                               $query1 = "SELECT method FROM har WHERE method='GET'";
                               $query_run = mysqli_query($connection, $query1);
                               $row = mysqli_num_rows($query_run);
                               $query2 = "SELECT method FROM har WHERE method='POST'";
                               $query_run = mysqli_query($connection, $query2);
                               $row2 = mysqli_num_rows($query_run);
                               echo '<h4><br>Total GET Requests: '.$row.'<br>Total POST Requests: '.$row2.' </h4>';
                  ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-sort-alpha-up fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number of records per status</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                      <?php
                      require 'database/dbconfig.php';

                                    $query0 = "SELECT status FROM har WHERE status='0'";
                                    $query_run = mysqli_query($connection, $query0);
                                    $row0 = mysqli_num_rows($query_run);

                                   $query1 = "SELECT status FROM har WHERE status='200'";
                                   $query_run = mysqli_query($connection, $query1);
                                   $row = mysqli_num_rows($query_run);

                                   $query2 = "SELECT status FROM har WHERE status='204'";
                                   $query_run = mysqli_query($connection, $query2);
                                   $row2 = mysqli_num_rows($query_run);

                                   $query3 = "SELECT status FROM har WHERE status='206'";
                                   $query_run = mysqli_query($connection, $query3);
                                   $row3 = mysqli_num_rows($query_run);

                                   $query4 = "SELECT status FROM har WHERE status='301'";
                                   $query_run = mysqli_query($connection, $query4);
                                   $row4 = mysqli_num_rows($query_run);

                                   $query5 = "SELECT status FROM har WHERE status='302'";
                                   $query_run = mysqli_query($connection, $query5);
                                   $row5 = mysqli_num_rows($query_run);

                                   $query7 = "SELECT status FROM har WHERE status='304'";
                                   $query_run = mysqli_query($connection, $query5);
                                   $row7 = mysqli_num_rows($query_run);

                                   $query6 = "SELECT status FROM har WHERE status='404'";
                                   $query_run = mysqli_query($connection, $query6);
                                   $row6 = mysqli_num_rows($query_run);

                                   echo '<h6>Number of No Responses (0): <strong>#0 :</strong>'.$row0.'<br>
                                             Number of Successful Responses (200–299):<br><strong>#200 :</strong>'.$row.'&emsp;<strong>#204</strong> :'.$row2.'&emsp;<strong>#206</strong> :'.$row3.' <br>
                                             Number of Redirects (300–399):<br><strong>#301</strong> :'.$row4.'&emsp;<strong>#302</strong> :'.$row5.'&emsp;<strong>#304</strong> :'.$row7.'<br>
                                             Number of Client errors (400–499):<br><strong>#404</strong> :'.$row6.'&emsp; </h6>';
                      ?>
                    </div>
                     <div class="col">
                <!--    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                      </div>  -->
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Number of unique domains container -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number of unique domains</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    require 'database/dbconfig.php';
                                  //Important key point! The query returns a result object, which cannot be serialized into a string.
                                  //Need to access it seperately by accessing the 0 index element of the array,in out case,since we only have one row returned.
                                  $query = "SELECT COUNT(DISTINCT domainname) FROM har";
                                  //Works with this.
                                  //$query_run = mysqli_query($connection, $query);
                                  //$tourresult = $query_run->fetch_array()[0] ?? '';

                                  //Also works with this.
                                  $returnedobject = $connection->query($query);
                                  $tourresult = $returnedobject->fetch_array()[0] ?? '';

                                 echo '<h4><br>Total Unique Domains: '.$tourresult.'</h4>';
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-globe-americas fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>

  <!-- Use of another row class for the final two user info.Now these two elements will be stretched across the device screen.  -->
<div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Number of unique providers</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">  <?php
                    require 'database/dbconfig.php';
                                  //Important key point! The query returns a result object, which cannot be serialized into a string.
                                  //Need to access it seperately by accessing the 0 index element of the array,in out case,since we only have one row returned.
                                  $query = "SELECT COUNT(DISTINCT Provider) FROM requestedipinfo";
                                  $returnedobject = $connection->query($query);
                                  $tourresult2 = $returnedobject->fetch_array()[0] ?? '';

                                 echo '<h4><br>Total Unique Providers: '.$tourresult2.'</h4>';
                    ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-people-carry fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Average Content-Type lifespan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

          <!-- end of row container with User info -->
      </div>
      <!-- end of Dashboard container with User info -->
  </div>


  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
