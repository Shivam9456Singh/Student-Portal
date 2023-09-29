<?php 
include 'class.file.php';
$fileupload = new File();
    if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['latestsubmit']))){
        $textlink = $_POST['textlink'];
        $result = $fileupload->upload_LatestLinks($textlink,$_FILES['latestfile']);
        if($result){
            $_SESSION['msg-1'] = '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>PDF Uploaded Successfully</strong>
        </div>';
            echo '<script>window.location = "../adminhome.php#latest"</script>';
        } else {
            $_SESSION['msg-1'] = '<div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!</strong>Only Pdf supported or large file size
        </div>';
            echo '<script>window.location = "../adminhome.php#latest"</script>';
        }
    }
    if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['noticeboard']))){
        $textlink = $_POST['noticetext'];
        $result = $fileupload->upload_noticeboard($textlink,$_FILES['noticefile']);
        if($result){
            $_SESSION['msg-2'] = '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>PDF Uploaded Successfully</strong>
        </div>';
            echo '<script>window.location = "../adminhome.php#notice"</script>';
        } else {
            $_SESSION['msg-2'] = '<div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!</strong>Only Pdf supported or large file size
        </div>';
            echo '<script>window.location = "../adminhome.php#notice"</script>';
        }
    }

    if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['galleryimg']))){
        $result = $fileupload->upload_galleryimg($_FILES['galleryimg']);
       if($result){
            $_SESSION['msg-2'] = '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Image Uploaded Successfully</strong>
        </div>';
            echo '<script>window.location = "../adminhome-imgupload.php#gallery"</script>';
        } else {
            $_SESSION['msg-2'] = '<div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!</strong>
        </div>';
            echo '<script>window.location = "../adminhome-imgupload.php#gallery"</script>';
        }
    }
     if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['sliderimg']))){
        $result = $fileupload->upload_sliderimg($_FILES['sliderimg']);
       if($result){
            $_SESSION['msg-3'] = '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Slider Image Uploaded Successfully</strong>
        </div>';
            echo '<script>window.location = "../adminhome-imgupload.php#slider"</script>';
        } else {
            $_SESSION['msg-3'] = '<div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!</strong>
        </div>';
            echo '<script>window.location = "../adminhome-imgupload.php#slider"</script>';
        }
    }
?>