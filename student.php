<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/class.file.php';
$fileget = new File();

require_once "./includes/dbh.config.php"; // Your database connection file
$conn = Database::connect();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['admin_data'])) {
    die("Session data not found.");
}

if (isset($_GET['q'])) {
    die("Query parameter 'q' detected. Redirecting...");
}

if (isset($_GET['name'])) {
    $name = $_GET['name'];

    $sql = "SELECT transaction_image, mime_type FROM student WHERE name = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (empty($row['transaction_image'])) {
            die("Image data is empty for the given name.");
        }

        // For testing, set MIME type explicitly
        header("Content-type: image/jpeg");
        // header("Content-type: " . $row['mime_type']); // Original line to use MIME type from DB

        echo $row['transaction_image'];
    } else {
        die("No data found for the name: " . $name);
    }
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Students Records - Gautam Group Of Colleges</title>

    <meta charset="utf-8">
    <meta content='#343a40' name='theme-color' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- viewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
    <!-- css -->
	<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script>(function () {

                const idleDurationSecs = 600;
                const redirectUrl = 'adminhome-view-delete-links.php?q=logout';
                let idleTimeout;

                const resetIdleTimeout = function () {

                    if (idleTimeout) clearTimeout(idleTimeout);
                    idleTimeout = setTimeout(() => location.href = redirectUrl, idleDurationSecs * 1000);
                };
                resetIdleTimeout();
                ['click', 'touchstart', 'mousemove'].forEach(evt =>
                    document.addEventListener(evt, resetIdleTimeout, false)
                );
            })();
    </script>
    <style>
        html {
            max-width: 1800px;
            min-width: 400px;
            width: 97%;
        }

        .border-r-20 {
            border-radius: 20px 20px 0 0;
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
            html {
                width: 95%;
            }

            .img-logo img {
                width: 60px;
                height: 60px;
            }

            .d-flex {
                align-items: center;
            }

            .img-logo,
            .info {
                padding: 5px;
            }

            .info {
                margin: 5px 0;
                text-align: center;
            }

            .info span {
                font-size: 1rem;
            }

            .info p {
                font-size: 0.9rem;
            }

            .container {
                padding: 2px 0;
            }
			.transaction-link:hover, .transaction-link:active {
    color: blue !important;
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
                            <strong>
                                <?php echo $_SESSION['admin_data']['name']; ?>
                            </strong>
                        </span>
                        <span class="user-role">
                            <?php echo $_SESSION['admin_data']['email']; ?>
                        </span>
                        <span class="user-role">Administrator</span>
                        <div class="">
                            <a href="adminhome-view-delete-links.php?q=logout"><i class="fa fa-power-off"></i>
                                Logout</a>
                        </div>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
						 <div class="sidebar-menu">
                        <li class="header-menu">
                            <a href="adminhome.php"><span style="color:#ffc107;">Go To Dashboard</span></a>
							<a href="student.php"><span>Students Record</span></a>
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
                                            <h4>Online Students Records</h4>
                                            <div class="hr"></div>
                                        </div>
                                        <div class="col-md-4">
                                           <!-- <form action="includes/export.php" method="post" name="export">
                                                <input type="hidden" name="hidden">
                                                <button type="submit" class="btn btn-primary mb-2" name="export">Export
                                                    All Records</button> 
                                            </form> -->
                                        </div>
                                    </div>
                                    <div class="container">
                                        <?php 
								if(isset($_SESSION['msg-4'])) {
									echo $_SESSION['msg-4'];
									unset($_SESSION['msg-4']);
								}
							?>
										<div class="container my-3">
    <form action="" method="POST">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Name, Guardian's Name, Phone, or Email" name="searchQuery">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="searchBtn">Search</button>
            </div>
        </div>
    </form>
</div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">Sr. No.</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Guardian's Name</th>
                                                            <th scope="col">Email id</th>
                                                            <th scope="col">Course</th>
                                                            <th scope="col">Contact No</th>
                                                            <th scope="col">Address</th>
															<th scope="col">Fees</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                        <?php 
	$searchQuery = "";
$whereClause = " WHERE email_verified = 1";

if (isset($_POST['searchBtn']) && !empty($_POST['searchQuery'])) {
    $searchQuery = trim($_POST['searchQuery']);
    $searchQuery = "%$searchQuery%";
    $whereClause .= " AND (name LIKE ? OR Guardians_name LIKE ? OR mobile LIKE ? OR email LIKE ?)";
}

														
										
                                            $sql = "SELECT * FROM student" . $whereClause;
$stmt = $conn->prepare($sql);

if ($searchQuery !== "") {
    $stmt->bind_param("ssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery);
}

$stmt->execute();
$result = $stmt->get_result();

														
                                            $count =1;
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                   echo "<tr>";
                                                    echo "<th scope='row'>" .$count++. "</th>"; // Assuming 'id' is the column for Sr. No.
                                                    echo "<td>" . $row["name"] . "</td>";
                                                    echo "<td>" . $row["Guardians_name"] . "</td>";
                                                    echo "<td>" . $row["email"] . "</td>";
                                                    echo "<td>" . $row["program"] . "</td>";
                                                    echo "<td>" . $row["mobile"] . "</td>";
                                                    echo "<td>" . $row["address"] . "</td>";
													echo "<td>";
if (!empty($row["transaction_image"])) {
    echo "<a href='javascript:void(0);' data-url='get_image.php?name=" . urlencode($row["name"]) . "' class='view-transaction transaction-link' style='color: black;'>View Reciept</a>";
} else {
    echo "Not Paid";
}


echo "</td>";

                                                    echo "</tr>";
                                                    
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No records found</td></tr>";
                                            }
                                            $conn->close();
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
                    <footer class="text-center">Copyright &copy; 2019 | All Rights Reserved. <span>Gautam Group Of
                            College</span> Hamirpur (H.P.)
                    </footer>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script type="text/javascript">
        $("#close-sidebar").click(function () {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function () {
            $(".page-wrapper").addClass("toggled");
        });
    </script>
	<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="transactionImage" alt="Transaction Image" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
	<script>
$(document).on('click', '.view-transaction', function(e) {
    e.preventDefault(); 
    let imageUrl = $(this).data('url');  
    $('#transactionImage').attr('src', imageUrl)
                          .on('error', function() {
                              alert('Failed to load image. Please try again.');
                          }); 
    $('#transactionModal').modal('show'); 
});
	</script>


</body>

</html>