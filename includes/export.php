<?php 
include 'exportData.php';
$file = new File();
if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['export']))){
    $result = $file->exportData();
    if ($result) {
        $_SESSION['msg-4'] = '<div class="alert alert-success alert-dismissable mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>File Exported Successfully</strong>
                    </div>';
                    echo '<script>window.location = "../admission-records.php"</script>';
    } else {
        $_SESSION['msg-4'] = '<div class="alert alert-danger alert-dismissable mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>No Records or Failed!</strong>
                    </div>';
                    echo '<script>window.location = "../admission-records.php"</script>';
    }
    
}
?>