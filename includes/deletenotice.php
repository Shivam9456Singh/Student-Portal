<?php
include 'class.file.php';
$filedel = new File();
	if (!isset($_SESSION['admin_data'])){
        session_unset();
		session_destroy();
		echo '<script>window.location = "../index.php"</script>';
    }
    if (isset($_GET['id'])){
		$id = $_GET['id'];
        $result = $filedel->del_notice($id);
        if($result) {
            echo '<script>window.location = "../adminhome-view-delete-links.php"</script>';
        } else {
            echo '<script>window.location = "../adminhome.php"</script>';
        }
	}

?>