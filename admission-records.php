<?php
include 'includes/class.file.php';
$fileget = new File();
	if (!isset($_SESSION['admin_data'])){
        session_unset();
		session_destroy();
		echo '<script>window.location = "index.php"</script>';
	}

	if (isset($_GET['q'])){
    session_unset();
		session_destroy();
		echo '<script>window.location = "index.php"</script>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admission Records - Gautam Group Of Colleges</title>

		<meta charset="utf-8">
	<meta content='#343a40' name='theme-color'/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- viewport -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png"/>
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
	<link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
	<!-- fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script>(function() {

    const idleDurationSecs = 600;
    const redirectUrl = 'adminhome-view-delete-links.php?q=logout';
    let idleTimeout;

    const resetIdleTimeout = function() {

        if(idleTimeout) clearTimeout(idleTimeout);
        idleTimeout = setTimeout(() => location.href = redirectUrl, idleDurationSecs * 1000);
    };
    resetIdleTimeout();
    ['click', 'touchstart', 'mousemove'].forEach(evt => 
        document.addEventListener(evt, resetIdleTimeout, false)
    );
})();
</script>
<style>
    html{
        max-width:1800px;
        min-width:400px;
        width:97%;
    }
    .border-r-20 {
        border-radius:20px 20px 0 0;
    }
	table tr:hover {
        cursor: pointer;
    }
	.modal .modal-dialog {
            max-width: 800px;
        }
        .modal .modal-content p {
            font-size: 16px;
        }
    @media (max-width: 468px) {
        html{
            width:95%;
        }
        .img-logo img {
            width: 60px;
            height: 60px;
        }
        .d-flex{
            align-items: center;
        }
        .img-logo,.info {
            padding:5px;
        }
        .info {
            margin:5px 0;
            text-align:center;
        }
        .info span {
            font-size: 1rem;
        }
        .info p {
            font-size: 0.9rem;
        }
        .container {
            padding:2px 0;
        }
    }
</style>
</head>
<body>

<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <span>Admin Dashboard</span>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-info text-center">
          <span class="user-name">
            <strong><?php echo $_SESSION['admin_data']['name']; ?></strong>
		  </span>
		  <span class="user-role"><?php echo $_SESSION['admin_data']['email']; ?></span>
		  <span class="user-role">Administrator</span>
		  <div class="">
		  	<a href="adminhome-view-delete-links.php?q=logout"><i class="fa fa-power-off"></i> Logout</a>
		</div>
        </div>
      </div>
      <!-- sidebar-search  -->
	  <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <a href="adminhome.php" ><span style="color:#ffc107;">Go To Dashboard</span></a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<header>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="d-flex justify-content-center">
									<div class="img-logo">
										<a href="#"><img src="assets/img/logo1.png" alt="GGC Logo"></a>
									</div>
									<div class="info">
										<span>Gautam Group Of College</span>
										<p>Hamirpur (H.P.)</p>
									</div>
								</div>
							</div>
						</div>
				</header>
		<div class="msg-wrapper border-r-20">
			<div class="">
				<div id="latest" class="msg-box text-center">
					<div class="px-4 py-2 text-justify head-title">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Online Admission Records</h4>
						        <div class="hr"></div>
                            </div>
                            <div class="col-md-4">
                                <form action="includes/export.php" method="post" name="export">
                                    <input type="hidden" name="hidden">
                                    <button type="submit" class="btn btn-primary mb-2" name="export">Export All Records</button>
                                </form>
                            </div>
                        </div>
                        <div class="container">
                            <?php 
								if(isset($_SESSION['msg-4'])) {
									echo $_SESSION['msg-4'];
									unset($_SESSION['msg-4']);
								}
							?>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                         <thead class="thead-dark">
                                            <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">DOB</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Contact No</th>
                                            <th scope="col">Registration Type</th>
                                            <th scope="col">Bank Transaction Id</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $array =  $fileget->get_records();
                                            if(count($array)) {
                                                $count=1;
                                                foreach ($array as $obj) {
                                                    echo "<tr data-toggle='modal' data-target='#record-".$obj['id']."-modal'>";
                                                        echo "<td>".$count."</td>";
                                                        echo "<td>".$obj['name']."</td>";
                                                        echo "<td>".$obj['fatherName']."</td>";
                                                        echo "<td>".date("d-m-Y", strtotime($obj['dob']))."</td>";
                                                        echo "<td>".$obj['course']."</td>";
                                                        echo "<td>".$obj['contactNo']."</td>";
                                                        echo "<td>".$obj['regType']."</td>";
                                                        echo "<td>".$obj['bankTransId']."</td>";
                                                    echo "</tr>";
													$count++;
                                                 }
                                            } else {
                                                echo "<tr>";
                                                echo "<td>No Records</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
    </div>
				<footer class="text-center">Copyright &copy; 2019 | All Rights Reserved. <span>Gautam Group Of College</span> Hamirpur (H.P.)
				</footer>
			</div>
		</div>
  </main>
  <!-- page-content" -->
</div>
<?php 
  if(count($array)) {
    $count=1;
    foreach ($array as $obj) {
        
        echo "<div class='modal fade' id='record-".$obj['id']."-modal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLongTitle'>Details</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='col-5'>
                        <p> <b>Sr.No. :</b> ".$count."</p>
                            <p> <b>Name :</b> ".$obj['name']."</p>
                            <p><b> Father Name : </b>".$obj['fatherName']."</p>
                            <p><b> DOB : </b>".date("d-m-Y", strtotime($obj['dob']))."</p>
                            <p><b> Contact No : </b>".$obj['contactNo']."</p>
                            <p><b> Registration Type : </b>".$obj['regType']."</p>
                        </div>
                        <div class='col-7'>
                        <p><b> Course : </b>".$obj['course']."</p>
                        <p><b> Qualification With % of marks : </b>".$obj['qualification']."</p>
                        <p><b> Year Of Passing : </b>".$obj['yearOfPassing']."</p>
                        <p><b> Bank Transaction ID : </b>".$obj['bankTransId']."</p>";
                        if ($obj['bankTransDate'] == 0000-00-00) {
                           echo "<p><b> Bank Transaction Date : </b></p>";
                        } else {
                            echo "<p><b> Bank Transaction Date : </b>".date("d-m-Y", strtotime($obj['bankTransDate']))."</p>";
                        }
                      echo "</div>
                        <div class='col-12'>
                        <p><b>Address : </b>".$obj['address']."</p>
                        </div>";
                        if($obj['regType'] == "Paid") {
                            echo "<div class='col-12'>
                            <p><b>Bank Transaction slip : </b></p>
                            </div>
                            <div class='img-box'>
                            <img class='img-fluid p-4' src='bankSlips/".$obj['bankSlip']."'>
                            </div>";
                        }
                        
                    echo "</div>

                </div>
                </div>
            </div>
            </div>";
            $count++;
    }
 }
 ?>
<!-- page-wrapper -->
<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/main.js"></script>
	<script type="text/javascript">
		$("#close-sidebar").click(function() {
		$(".page-wrapper").removeClass("toggled");
		});
		$("#show-sidebar").click(function() {
		$(".page-wrapper").addClass("toggled");
		});
	</script>
</body>
</html>