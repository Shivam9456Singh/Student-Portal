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
	<title>Admin Dashboard - Gautam Group Of Colleges</title>

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
            <span>View & Delete Images</span>
          </li>
          <li><a href="#slider"><span>View & Delete Slider Images</span></a></li>
          <li><a href="#gallery"><span>View & Delete Gallery Images</span></a></li>
        </ul>
      </div>
      <div class="sidebar-menu">
        <ul>
             <li class="header-menu">
            <a href="adminhome.php" ><span style="color:#ffc107;">Add Updates And Notice</span></a>
          </li>
          <li class="header-menu">
            <a href="adminhome-view-delete-links.php" ><span style="color:#ffc107;">View & Delete Notice Links</span></a>
          </li>
          <li class="header-menu">
            <a href="adminhome-imgupload.php" ><span style="color:#ffc107;">Upload Images</span></a>
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
            <div class="msg-wrapper">
      <div class="container">
        <div class="msg-box text-center">
          <div  id="slider" class="msg-details text-justify head-title">
            <h4>View & Delete Slider Images</h4>
            <div class="hr"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                <div>
                  <h5 class="text-center">Slider Images</h5>
                  <hr>
                                <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Slider Images</th>
                                            <th scope="col">Date &amp; Time</th>
                                            <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $fileget->get_slider(); ?>
                                        </tbody>
                                        </table>
                                    </div>
                </div>
                            </div>
                        </div>
          </div>
        </div>
      </div>
    </div>
    <div class="msg-wrapper">
			<div class="container">
				<div class="msg-box text-center">
					<div  id="gallery" class="msg-details text-justify head-title">
						<h4>View & Delete Gallery Images</h4>
						<div class="hr"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
								<div>
									<h5 class="text-center">Gallery Images</h5>
									<hr>
                            		<div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Gallery Images</th>
                                            <th scope="col">Date &amp; Time</th>
                                            <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $fileget->get_gallery(); ?>
                                        </tbody>
                                        </table>
                                    </div>
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