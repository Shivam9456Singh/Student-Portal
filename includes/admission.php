<?php 
include 'class.file.php';
$fileupload = new File();
if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['admissionForm']))){
    $regType = $_POST['regType'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $dob = $_POST['dob'];
    $course = $_POST['course'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];
    $yearPass = $_POST['yearPass'];

    if ($regType == "Free") {
        $result = $fileupload->freeAdmissionForm($name,$fname,$dob,$course,$contactNo,$address,$qualification,$yearPass,$regType);
        if($result){
            $_SESSION['msg-1'] = '<div class="alert alert-success alert-dismissable mt-2">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Registered successfully</strong>
        </div>';
            echo '<script>window.location = "../admission-form.php"</script>';
        } else {
            $_SESSION['msg-1'] = '<div class="alert alert-danger alert-dismissable mt-2">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed! </strong>
        </div>';
            echo '<script>window.location = "../admission-form.php"</script>';
        }
    } else {
        $transaction = $_POST['transaction'];
        $BankTransDate = $_POST['BankTransDate'];
        if ((trim($BankTransDate) == '' || substr($BankTransDate,0,10) == '0000-00-00') ) {
            $_SESSION['msg-1'] = '<div class="alert alert-danger alert-dismissable mt-2">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed! </strong> Required Bank Transaction Date 
                </div>';
                    echo '<script>window.location = "../admission-form.php"</script>';
       } else {
            if ((!isset($transaction) || trim($transaction) == '')) {
                $_SESSION['msg-1'] = '<div class="alert alert-danger alert-dismissable mt-2">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed! Required Bank Transaction ID  </strong> 
                </div>';
                    echo '<script>window.location = "../admission-form.php"</script>';
            } else {
                if (($_FILES['bankSlip']['name'] != "" && $_FILES['bankSlip']['error'] != 4 && $_FILES['bankSlip']['size'] < 2097152)) {
                    $result = $fileupload->paidAdmissionForm($name,$fname,$dob,$course,$contactNo,$address,$qualification,$yearPass,$regType,$transaction,$BankTransDate,$_FILES['bankSlip']);
                    if($result){
                        $_SESSION['msg-1'] = '<div class="alert alert-success alert-dismissable mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Registered successfully</strong>
                    </div>';
                        echo '<script>window.location = "../admission-form.php"</script>';
                    } else {
                        $_SESSION['msg-1'] = '<div class="alert alert-danger alert-dismissable mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed! </strong> Only JPG, PNG and JPEG files are allowed. Max Size 2MB
                    </div>';
                        echo '<script>window.location = "../admission-form.php"</script>';
                    }
                } else {
                    $_SESSION['msg-1'] = '<div class="alert alert-danger alert-dismissable mt-2">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>Required Bank Transaction slip ! </strong>Max File Size 2MB.
                            </div>';
                    echo '<script>window.location = "../admission-form.php"</script>';
                }
                
            }
            
       }
       
    }
}
?>